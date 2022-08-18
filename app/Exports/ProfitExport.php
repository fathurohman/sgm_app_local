<?php

namespace App\Exports;

use App\User;
use Carbon\Carbon;
use DateTime;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class ProfitExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    protected $month, $sales_id;

    function __construct($month, $sales_id)
    {
        $this->sales_id = $sales_id;
        $this->month = $month;
    }

    public function data_sum_selling($month, $year, $params)
    {
        return DB::select('SELECT selling_orders.curr AS curr, sum(selling_orders.sub_total ) AS sub_total
        FROM sales_orders
        INNER JOIN selling_orders ON sales_orders.id=selling_orders.sales_order_id
		where MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and sales_orders.printed = 1
		' . $params . '
		GROUP BY selling_orders.curr');
    }

    public function data_sum_buying($month, $year, $params)
    {
        return DB::select('SELECT buying_orders.curr AS curr, sum(buying_orders.sub_total ) AS sub_total
        FROM sales_orders
        INNER JOIN buying_orders ON sales_orders.id=buying_orders.sales_order_id
		where MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and sales_orders.printed = 1
		' . $params . '
		GROUP BY buying_orders.curr');
    }

    public function data_sum_profits($month, $year, $params)
    {
        return DB::select('SELECT profits.currency AS curr, sum(profits.profit ) AS sub_total
        FROM sales_orders
        INNER JOIN profits ON sales_orders.id=profits.sales_order_id
		where MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and sales_orders.printed = 1
        and profits.deleted_at is null
		' . $params . '
		GROUP BY profits.currency');
    }

    public function view(): View
    {
        $year = Carbon::now()->format('Y');
        $bulan = $this->month;
        $dateObj   = DateTime::createFromFormat('!m', $bulan);
        $monthName = $dateObj->format('F'); // March
        if ($this->sales_id == "All") {
            $params = '';
            $sales_name = "ALL";
        } else {
            $params = 'and sales_orders.created_by = ' . $this->sales_id . '';
            $sales = User::find($this->user_id);
            $sales_name = $sales->name;
        }
        $data_selling = $this->data_sum_selling($bulan, $year, $params);
        $data_buying = $this->data_sum_buying($bulan, $year, $params);
        $data_profits = $this->data_sum_profits($bulan, $year, $params);
        return view('reports.profits', [
            'data_selling' => $data_selling,
            'data_buying' => $data_buying,
            'data_profits' => $data_profits,
            'bulan' => $monthName,
            'tahun' => $year,
            'sales_name' => $sales_name,
            // 'inv_fix' => $inv_fix,
        ]);
    }
}

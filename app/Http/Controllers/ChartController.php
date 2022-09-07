<?php

namespace App\Http\Controllers;

use App\Model\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;

class ChartController extends BaseController
{
    //chart start
    public function data_sum_profits($month, $curr, $year)
    {
        $sales_profit_monthly = DB::select('SELECT profits.currency AS curr, sum(profits.profit ) AS sub_total
        FROM sales_orders
        INNER JOIN profits ON sales_orders.id=profits.sales_order_id
		where MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
				and sales_orders.printed = 1
        and profits.deleted_at is null
				and profits.currency = "' . $curr . '"
		GROUP BY profits.currency');
        return $sales_profit_monthly;
    }
    public function getAllMonths()
    {
        $month_array = array();
        $unit_dates = SalesOrder::where('printed', '1')->orderBy('inv_date', 'ASC')->pluck('inv_date');
        $unit_dates = json_decode($unit_dates);
        if (!empty($unit_dates)) {
            foreach ($unit_dates as $unk_date) {
                $date = new DateTime($unk_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] = $month_name;
            }
        }
        return $month_array;
    }

    public function getMonthlyProfitData(Request $request)
    {
        $year = Carbon::now()->format('Y');
        $curr = $request->get('curr');
        $monthly_data_profit_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)) {
            foreach ($month_array as $month_no => $month_name) {
                $monthly_profit_data = $this->data_sum_profits($month_no, $curr, $year);
                foreach ($monthly_profit_data as $x) {
                    $monthly_profit = $x->sub_total;
                }
                array_push($monthly_data_profit_array, $monthly_profit);
                array_push($month_name_array, $month_name);
            }
        }
        $max_no = max($monthly_data_profit_array);
        if ($curr == 'IDR') {
            $max = round(($max_no + 10000000 / 2) / 10) * 10;
        } else {
            $max = round(($max_no + 10000 / 2) / 10) * 10;
        }
        $monthly_total_profit_array = array(
            'months' => $month_name_array,
            'month_total_profit' => $monthly_data_profit_array,
            'max' => $max,
        );
        return $monthly_total_profit_array;
    }
}

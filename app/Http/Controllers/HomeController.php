<?php

namespace App\Http\Controllers;

use App\Model\SellingOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
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

    public function index()
    {
        $user_id = Auth::id();
        $user_dept = Auth::user()->department;
        if ($user_dept == 'super-admin') {
            $params = '';
            $name = "ALL";
        } else {
            $name = Auth::user()->name;
            $params = 'and sales_orders.created_by = ' . $user_id . '';
        }
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $data_selling = $this->data_sum_selling($month, $year, $params);
        $data_buying = $this->data_sum_buying($month, $year, $params);
        $data_profits = $this->data_sum_profits($month, $year, $params);
        $data = array(
            'data_selling' => $data_selling,
            'data_buying' => $data_buying,
            'data_profits' => $data_profits,
            'name' => $name,
        );
        return view('dashboard', compact('data'));
    }
}

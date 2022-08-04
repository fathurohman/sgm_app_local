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
    public function data_sum_selling($user_id, $month, $year, $curr)
    {
        return DB::select('SELECT sales_orders.id, sales_orders.created_by, sales_orders.created_at, selling_orders.curr, selling_orders.sales_order_id, selling_orders.sub_total
        FROM sales_orders
        INNER JOIN selling_orders ON sales_orders.id=selling_orders.sales_order_id where sales_orders.created_by = ' . $user_id . ' 
        and MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and selling_orders.curr = "' . $curr . '"');
    }

    public function data_sum_buying($user_id, $month, $year, $curr)
    {
        return DB::select('SELECT sales_orders.id, sales_orders.created_by, sales_orders.created_at, buying_orders.curr, buying_orders.sales_order_id, buying_orders.sub_total
        FROM sales_orders
        INNER JOIN buying_orders ON sales_orders.id=buying_orders.sales_order_id where sales_orders.created_by = ' . $user_id . ' 
        and MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and buying_orders.curr = "' . $curr . '"');
    }

    public function data_sum_profits($user_id, $month, $year, $curr)
    {
        return DB::select('SELECT sales_orders.id, sales_orders.created_by, sales_orders.created_at, profits.currency, profits.sales_order_id, profits.profit
        FROM sales_orders
        INNER JOIN profits ON sales_orders.id=profits.sales_order_id where sales_orders.created_by = ' . $user_id . ' 
        and MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and profits.currency = "' . $curr . '"
        and profits.deleted_at is null');
    }

    public function index()
    {
        $sum_selling_idr = 0;
        $sum_selling_usd = 0;
        $sum_buying_idr = 0;
        $sum_buying_usd = 0;
        $sum_profits_idr = 0;
        $sum_profits_usd = 0;
        $idr = "IDR";
        $usd = "USD";
        $user_id = Auth::id();
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $data_selling_idr = $this->data_sum_selling($user_id, $month, $year, $idr);
        foreach ($data_selling_idr as $x) {
            $sum_selling_idr += $x->sub_total;
        }
        $data_selling_usd = $this->data_sum_selling($user_id, $month, $year, $usd);
        foreach ($data_selling_usd as $x) {
            $sum_selling_usd += $x->sub_total;
        }
        $data_buying_idr = $this->data_sum_buying($user_id, $month, $year, $idr);
        foreach ($data_buying_idr as $x) {
            $sum_buying_idr += $x->sub_total;
        }
        $data_buying_usd = $this->data_sum_buying($user_id, $month, $year, $usd);
        foreach ($data_buying_usd as $x) {
            $sum_buying_usd += $x->sub_total;
        }
        $data_profits_idr = $this->data_sum_profits($user_id, $month, $year, $idr);
        foreach ($data_profits_idr as $x) {
            $sum_profits_idr += $x->profit;
        }
        $data_profits_usd = $this->data_sum_profits($user_id, $month, $year, $usd);
        foreach ($data_profits_usd as $x) {
            $sum_profits_usd += $x->profit;
        }
        $data = array(
            'selling_idr' => $sum_selling_idr,
            'selling_usd' => $sum_selling_usd,
            'buying_idr' => $sum_buying_idr,
            'buying_usd' => $sum_buying_usd,
            'profits_idr' => $sum_profits_idr,
            'profits_usd' => $sum_profits_usd,
        );
        return view('dashboard', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Model\SellingOrder;
use Illuminate\Http\Request;
use App\User;
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

    public function getprofit(Request $request)
    {
        $bulan = $request->get('bulan');
        $sales_id = $request->get('sales_id');
        $year = Carbon::now()->format('Y');
        if ($sales_id == "All") {
            $params = '';
            $sales_name = "ALL";
        } else {
            $params = 'and sales_orders.created_by = ' . $sales_id . '';
            $sales = User::find($sales_id);
            $sales_name = $sales->name;
        }
        $data_selling = $this->data_sum_selling($bulan, $year, $params);
        $data_buying = $this->data_sum_buying($bulan, $year, $params);
        $data_profits = $this->data_sum_profits($bulan, $year, $params);
        $data = array(
            'data_selling' => $data_selling,
            'data_buying' => $data_buying,
            'data_profits' => $data_profits,
            'sales_name' => $sales_name,
        );
        $html = view('reports.table_prof')->with(compact('data'))->render();
        return response()->json(['success' => true, 'html' => $html]);
        // return json_encode($data);
    }
    public function lempar_curr($jumlah)
    {
        $curr = 'IDR,USD,SGD,EUR';
        $isicurr = explode(',', $curr);
        if ($jumlah == '1') {
            unset($isicurr[0]);
        } elseif ($jumlah == '2') {
            unset($isicurr[0], $isicurr[1]);
        } elseif ($jumlah == '3') {
            unset($isicurr[0], $isicurr[1], $isicurr[2]);
        } elseif ($jumlah == '4') {
            unset($isicurr);
        } else {
            $isicurr;
        }
        return $isicurr;
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
        //ambil curr yang lain
        $count_s = count((array)$data_selling);
        $lempar_curr_s = $this->lempar_curr($count_s);
        //end
        $data_buying = $this->data_sum_buying($month, $year, $params);
        //ambil curr yang lain
        $count_b = count((array)$data_buying);
        $lempar_curr_b = $this->lempar_curr($count_b);
        //end
        $data_profits = $this->data_sum_profits($month, $year, $params);
        //ambil curr yang lain
        $count_p = count((array)$data_profits);
        $lempar_curr_p = $this->lempar_curr($count_p);
        //end
        $data = array(
            'data_selling' => $data_selling,
            'data_buying' => $data_buying,
            'data_profits' => $data_profits,
            'name' => $name,
            'curr_b' => $lempar_curr_b,
            'curr_s' => $lempar_curr_s,
            'curr_p' => $lempar_curr_p,
        );
        return view('dashboard', compact('data'));
    }
}

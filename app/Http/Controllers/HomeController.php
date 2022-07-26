<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        // $sum = 0;
        // $sum_b = 0;
        // $month = Carbon::now()->format('m');
        // $jml_by_month = SellingOrder::whereMonth('created_at', $month)->get();
        // $month_sell_order = SellingOrder::whereMonth('created_at', $month)->count();
        // $month_buy_order = BuyingOrder::whereMonth('created_at', $month)->get();
        // foreach ($jml_by_month as $x) {
        //     $sum += $x->sub_total;
        // }
        // foreach ($month_buy_order as $x) {
        //     $sum_b += $x->sub_total;
        // }
        // $users = User::count();
        return view('dashboard');
    }
}

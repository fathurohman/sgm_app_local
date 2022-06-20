<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\job_order;
use App\Model\Service;
use App\Model\Via;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_order = job_order::all();
        return view('job_order.show', compact('job_order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $now = Carbon::now();
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $jml_by_month = job_order::whereMonth('created_at', $month)->count();
        $order_month = $jml_by_month + 1;
        $sprint_order = sprintf('%03d', $order_month);
        $order_id = "$year$month$sprint_order";
        $service = Service::all();
        $via = Via::all();
        // dd($via);
        $sales = User::where('department', 'sales')->get();
        $data = array(
            'service' => $service,
            'via' => $via,
            'sales' => $sales,
            'order_id' => $order_id,
        );
        return view('job_order.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\job_order  $job_order
     * @return \Illuminate\Http\Response
     */
    public function show(job_order $job_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\job_order  $job_order
     * @return \Illuminate\Http\Response
     */
    public function edit(job_order $job_order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\job_order  $job_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, job_order $job_order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\job_order  $job_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(job_order $job_order)
    {
        //
    }
}

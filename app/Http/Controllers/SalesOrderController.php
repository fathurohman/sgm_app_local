<?php

namespace App\Http\Controllers;

use App\Model\job_order;
use App\Model\SalesOrder;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Response;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sales = User::where('department', 'sales')->get();
        // $job_order = job_order::where('deleted', '0')->get();
        $data = array(
            'sales' => $sales,
        );
        return view('sales_order.create', compact('data'));
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
     * @param  \App\Model\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }

    public function listordersales()
    {
        $query = job_order::where('deleted', '0');
        return Datatables::of(
            $query
        )->addColumn('job_order', function ($row) {
            return $row->order_id;
        })->addColumn('DNI', function ($row) {
            return $row->tipe_order;
        })->addColumn('Date', function ($row) {
            return $row->created_at;
        })->addColumn('Client', function ($row) {
            return $row->clients->COMPANY_NAME;
        })->addColumn('Party', function ($row) {
            return $row->party;
        })->addColumn('Pol_Pod', function ($row) {
            return $row->pol_pod;
        })->addColumn('Action', function ($row) {
            $data = [
                'id'  => $row->id
            ];
            return view('job_order.dt.act_order_pilih', compact('data'));
        })->rawColumns(['action'])->toJson();
        // $users = User::where('department', $dept)->where('active', 1)->get();
        // return view('ticket.history', compact('data'));
    }

    public function getdataordersales(Request $request)
    {
        $pid = $request->get('pid');
        $jobs = job_order::where('id', $pid)->first();
        $client_name = $jobs->clients->COMPANY_NAME;
        // $jobs->created_at = date("Y-m-d");
        // $tanggal = $jobs->created_at;
        $createdAt = Carbon::parse($jobs->created_at);
        $tanggal = $createdAt->format('Y-m-d');
        // $order_id = $jobs->order_id;
        $tipe_order = strtok($jobs->tipe_order, '-');
        $jenis_order = substr($jobs->tipe_order, strpos($jobs->tipe_order, "-") + 1);
        // print_r($jenis_order);
        //no invoice
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $jml_by_month = job_order::whereMonth('created_at', $month)->count();
        $order_month = $jml_by_month + 1;
        $inv = "$jenis_order/SGM/$tipe_order/$month/$year";
        //end
        $data = array(
            'jobs' => $jobs,
            'name_client' => $client_name,
            'inv' => $inv,
            'tanggal' => $tanggal,
        );
        return Response::json($data);
        // $tipe_name = job_order::where('order_id',$pid)->where('',$order_tipe)
        // $tipe_name = $data = job_order::find($)->artk;
    }
}

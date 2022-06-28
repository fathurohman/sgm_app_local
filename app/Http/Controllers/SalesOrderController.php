<?php

namespace App\Http\Controllers;

use App\Model\BuyingOrder;
use App\Model\Curr;
use App\Model\job_order;
use App\Model\SalesOrder;
use App\Model\SellingOrder;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Response;
use Illuminate\Support\Facades\DB;

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
        $curr = Curr::all();
        // $sales = User::where('department', 'sales')->get();
        // $job_order = job_order::where('deleted', '0')->get();
        // $data = array(
        //     'sales' => $sales,
        // );
        return view('sales_order.create', compact('curr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $i = 0;
        $sales_order = new SalesOrder;
        $sales_order->nomor_invoice = $request->no_inv;
        $sales_order->job_order_id = $request->order_id;
        $sales_order->notes = $request->notes;
        $sales_order->save();
        if (!empty($request->description_b[0])) {
            foreach ($request->description_b as $a => $v) {
                $details_b = array(
                    'sales_order_id' => $sales_order->id,
                    'description' => $v,
                    'qty' => $request->qty_b[$a],
                    'curr' => $request->curr_b[$a],
                    'price' => $request->price_b[$a],
                    'sub_total' => $request->sub_total_b[$a],
                    'remark' => $request->remark_b[$a],
                    'name' => $request->name_b[$a],
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                );
                BuyingOrder::insert($details_b);
                $i++;
            }
        }
        if (!empty($request->description_s[0])) {
            foreach ($request->description_s as $a => $v) {
                $details_s = array(
                    'sales_order_id' => $sales_order->id,
                    'description' => $v,
                    'qty' => $request->qty_s[$a],
                    'curr' => $request->curr_s[$a],
                    'price' => $request->price_s[$a],
                    'sub_total' => $request->sub_total_s[$a],
                    'remark' => $request->remark_s[$a],
                    'name' => $request->name_s[$a],
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                );
                SellingOrder::insert($details_s);
                $i++;
            }
        }
        return redirect(route('sales_order.index'));
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
        $sales_name = $jobs->sales->name;
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
            'sales_name' => $sales_name,
        );
        return Response::json($data);
        // $tipe_name = job_order::where('order_id',$pid)->where('',$order_tipe)
        // $tipe_name = $data = job_order::find($)->artk;
    }

    public function autocomplete_desc(Request $request)
    {
        $term = $request->term;
        $queries = DB::table('item')
            ->where('ITEM', 'LIKE', '%' . $term . '%')
            // ->where('rtk', '1')
            ->get();
        $results = array();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->ITEM];
        }
        return Response::json($results);
    }

    public function autocomplete_remark(Request $request)
    {
        $term = $request->term;
        $queries = DB::table('vendors')
            ->where('nick', 'LIKE', '%' . $term . '%')
            ->orWhere('VENDOR', 'LIKE', '%' . $term . '%')
            // ->where('rtk', '1')
            ->get();
        $results = array();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->VENDOR, 'nick' => $query->nick];
        }
        return Response::json($results);
    }
}

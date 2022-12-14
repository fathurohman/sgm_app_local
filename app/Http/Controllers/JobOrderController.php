<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\job_order;
use App\Model\logs_user;
use App\Model\Service;
use Yajra\Datatables\Datatables;
use App\Model\Via;
use App\User;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('job_order.show');
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
        $tahun = Carbon::now()->format('Y');
        $jml_by_month = job_order::whereMonth('created_at', $month)->whereYear('created_at', $tahun)->count();
        $urutan = job_order::select('order_row')->where('month', $month)->whereYear('created_at', $tahun)->get();
        $results = array();
        foreach ($urutan as $query) {
            $order_row = $query->order_row;
            array_push($results, $order_row);
        }
        if (empty($results)) {
            $max = 0;
        } else {
            $max = max($results);
        }
        if ($jml_by_month == '0') {
            $order_month = '1';
        } else {
            //ini ambil nilai max di kolom
            $order_month = $max + 1;
        }
        $sprint_order = sprintf('%03d', $order_month);
        $order_id = "$year$month$sprint_order";
        $service = Service::all();
        $via = Via::all();
        // $clients = Client::all();
        $job_order = job_order::all();
        // dd($via);
        $sales = User::where('department', 'sales')->get();
        $data = array(
            'service' => $service,
            'via' => $via,
            'sales' => $sales,
            'order_id' => $order_id,
            // 'clients' => $clients,
            'month' => $month,
            'order_month' => $order_month,
            'job_order' => $job_order,
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
        $ETD = Carbon::parse($request->ETD)->format('Y-m-d');
        $ETA = Carbon::parse($request->ETA)->format('Y-m-d');
        // $request->ETD = date("Y-m-d");
        // $request->ETA = date("Y-m-d");
        $job_order = new job_order;
        $job_order->order_id = $request->order_id;
        $job_order->month = $request->month_order;
        $job_order->order_row = $request->order_month;
        $job_order->tipe_order = $request->tipe_order_text;
        $job_order->client_id = $request->client_id;
        $job_order->sales_id = $request->sales_id;
        $job_order->service_id = $request->service_id;
        $job_order->via_id = $request->via_id;
        $job_order->ETD = $ETD;
        $job_order->ETA = $ETA;
        $job_order->pol_pod = $request->pol_pod;
        $job_order->party = $request->party;
        $job_order->HBL = $request->hbl;
        $job_order->MBL = $request->mbl;
        $job_order->GWT_MEAS = $request->gwt_meas;
        $job_order->vessel1 = $request->vessel1;
        $job_order->vessel2 = $request->vessel2;
        $job_order->consignee = $request->consignee;
        $job_order->agent_overseas = $request->agent_overseas;
        $job_order->created_by = Auth::id();
        $job_order->save();
        // if (!empty($request->tipe_order)) {
        //     $details = array(
        //         'job_order_id' => $job_order->id,
        //         'tipe' => $request->tipe_order,
        //         'row' => '1',
        //         'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        //         'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        //     );
        //     tipe_order::insert($details);
        // }
        return redirect(route('job_order.index'));
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
    public function edit($id)
    {
        $job_order = job_order::find($id);
        $tipe = strtok($job_order->tipe_order, '-');
        $clients = Client::all();
        $service = Service::all();
        $via = Via::all();
        $clients = Client::all();
        $sales = User::where('department', 'sales')->get();
        $data = array(
            'clients' => $clients,
            'service' => $service,
            'via' => $via,
            'sales' => $sales,
            'tipe' => $tipe,
        );
        return view('job_order.edit', compact('data', 'job_order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\job_order  $job_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ETD = Carbon::parse($request->ETD)->format('Y-m-d');
        $ETA = Carbon::parse($request->ETA)->format('Y-m-d');
        $job_order = job_order::find($id);
        $job_order->order_id = $request->order_id;
        $job_order->tipe_order = $request->tipe_order_text;
        $job_order->client_id = $request->client_id;
        $job_order->sales_id = $request->sales_id;
        $job_order->service_id = $request->service_id;
        $job_order->via_id = $request->via_id;
        $job_order->ETD = $ETD;
        $job_order->ETA = $ETA;
        $job_order->pol_pod = $request->pol_pod;
        $job_order->party = $request->party;
        $job_order->HBL = $request->hbl;
        $job_order->MBL = $request->mbl;
        $job_order->GWT_MEAS = $request->gwt_meas;
        $job_order->vessel1 = $request->vessel1;
        $job_order->vessel2 = $request->vessel2;
        $job_order->consignee = $request->consignee;
        $job_order->agent_overseas = $request->agent_overseas;
        $job_order->order_row = $request->order_row;
        $job_order->save();
        return redirect(route('job_order.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\job_order  $job_order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jo = job_order::find($id);
        // job_order::where('id', $id)->update(['deleted' => '1']);
        $details = array(
            // 'job_orders_id' => $id,
            'logs' => 'deleting job orders with id ' . $id . ' and order id is ' . $jo->order_id . '',
            'user_id' => Auth::id(),
            // 'row' => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        );
        logs_user::insert($details);
        job_order::where('id', $id)->delete();
        return redirect()->back();
    }

    public function getdata(Request $request)
    {
        $pid = $request->get('pid');
        $tipes = Client::where('id', $pid)->first();
        return Response::json($tipes);
    }

    public function getdataorder(Request $request)
    {
        $pid = $request->get('pid');
        $jobs = job_order::where('id', $pid)->first();
        $order_id = $jobs->order_id;
        $month = substr($order_id, -5, 2);
        $client_name = $jobs->clients->COMPANY_NAME;
        $data = array(
            'jobs' => $jobs,
            'name_client' => $client_name,
            'month' => $month,
        );
        return Response::json($data);
        // $tipe_name = job_order::where('order_id',$pid)->where('',$order_tipe)
        // $tipe_name = $data = job_order::find($)->artk;
    }

    public function settipeorder(Request $request)
    {
        $pid = $request->get('pid');
        $tipe = $request->get('tipe');
        $jobs = job_order::where('order_id', $pid)->where('tipe_order', 'like', '%' . $tipe . '%')->count();
        $row = $jobs + 1;
        $data = array(
            'tipe' => $tipe,
            'row' => $row,
        );
        return Response::json($data);
        // $tipe_name = job_order::where('order_id',$pid)->where('',$order_tipe)
        // $tipe_name = $data = job_order::find($)->artk;
    }

    public function showDetail($id)
    {
        $job_detail = job_order::find($id);
        return view('job_order.order_detail', compact('job_detail'));
    }

    public function listcustomer()
    {
        $query = Client::where('active', '1');
        return Datatables::of(
            $query
        )->editColumn('COMPANY_NAME', function ($row) {
            return $row->COMPANY_NAME;
        })->editColumn('NPWP', function ($row) {
            return $row->NPWP;
        })->editColumn('ADDRESS', function ($row) {
            return substr($row->ADDRESS, 0, 20);
        })->addColumn('Action', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('job_order.dt.act_pilih', compact('data'));
        })->rawColumns(['action'])->toJson();
        // $users = User::where('department', $dept)->where('active', 1)->get();
        // return view('ticket.history', compact('data'));
    }

    public function listorder()
    {
        $auth = Auth::id();
        $query = job_order::where('created_by', $auth)->where('printed', '0')->orderBy('created_at', 'desc');
        // $query = job_order::all();
        return Datatables::of(
            $query
        )->editColumn('order_id', function ($row) {
            return $row->order_id;
        })->editColumn('tipe_order', function ($row) {
            return $row->tipe_order;
        })->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->editColumn('client_id', function ($row) {
            return $row->clients->COMPANY_NAME;
        })->editColumn('party', function ($row) {
            return $row->party;
        })->editColumn('pol_pod', function ($row) {
            return $row->pol_pod;
        })->addColumn('Action', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('job_order.dt.act_order_pilih', compact('data'));
        })->rawColumns(['action'])->toJson();

        // $users = User::where('department', $dept)->where('active', 1)->get();
        // return view('ticket.history', compact('data'));
    }

    public function listordershow()
    {
        $auth = Auth::id();
        $query = job_order::where('created_by', $auth)->where('printed', '0')->orderBy('created_at', 'desc');
        // $query = job_order::all();
        return Datatables::of(
            $query
        )->editColumn('order_id', function ($row) {
            return $row->order_id;
        })->editColumn('tipe_order', function ($row) {
            return $row->tipe_order;
        })->editColumn('client_id', function ($row) {
            return $row->clients->COMPANY_NAME;
        })->editColumn('sales_id', function ($row) {
            return $row->sales->name;
        })->editColumn('service_id', function ($row) {
            return $row->service->service_name;
        })->editColumn('via_id', function ($row) {
            return $row->via->via_name;
        })->editColumn('pol_pod', function ($row) {
            return $row->pol_pod;
        })->editColumn('GWT_MEAS', function ($row) {
            return $row->GWT_MEAS;
        })->addColumn('Action', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('job_order.dt.act_list_order', compact('data'));
        })->rawColumns(['action'])->toJson();
        // $users = User::where('department', $dept)->where('active', 1)->get();
        // return view('ticket.history', compact('data'));
    }
}

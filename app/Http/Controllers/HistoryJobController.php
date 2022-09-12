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

class HistoryJobController extends Controller
{
    public function hist_job_order()
    {
        return view('job_order.history.show');
    }

    public function showDetail($id)
    {
        $job_detail = job_order::find($id);
        return view('job_order.order_detail', compact('job_detail'));
    }

    public function listorderhist()
    {
        $auth = Auth::id();
        $query = job_order::where('created_by', $auth)->where('printed', '1')->orderBy('created_at', 'desc');
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
        })->editColumn('ETD', function ($row) {
            return $row->ETD;
        })->editColumn('ETA', function ($row) {
            return $row->ETA;
        })->addColumn('Action', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('job_order.history.dt.act_list_orderhist', compact('data'));
        })->rawColumns(['action'])->toJson();
        // $users = User::where('department', $dept)->where('active', 1)->get();
        // return view('ticket.history', compact('data'));
    }

    public function pickup($id)
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
        return view('job_order.history.pickup', compact('data', 'job_order'));
    }

    public function hist_post(Request $request)
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
}

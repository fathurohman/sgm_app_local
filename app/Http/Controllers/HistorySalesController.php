<?php

namespace App\Http\Controllers;

use App\Model\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class HistorySalesController extends Controller
{
    public function index()
    {
        return view('sales_order.history.history_sales');
    }

    public function listsaleshistory()
    {
        // $query = SalesOrder::all();
        $auth = Auth::id();
        $query = SalesOrder::where('created_by', $auth)->where('published', 1)->orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('job_order_id', function ($row) {
            return $row->job_orders->order_id;
        })->editColumn('tipe', function ($row) {
            return $row->job_orders->tipe_order;
        })->editColumn('pol_pod', function ($row) {
            return $row->job_orders->pol_pod;
        })->editColumn('profits', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('sales_order.dt.act_profit', compact('data'));
        })->editColumn('published', function ($row) {
            if ($row->published == '1') {
                return 'Process by finance';
            } else {
                return 'draft';
            }
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('sales_order.dt.act_list_more', compact('data'));
        })->rawColumns(['More'])->toJson();
    }
}

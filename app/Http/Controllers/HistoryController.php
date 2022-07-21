<?php

namespace App\Http\Controllers;

use App\Model\SalesOrder;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history_index()
    {
        return view('history.show');
    }

    public function historyinvoiceshow()
    {
        $query = SalesOrder::where('published', '1')->where('printed', '1')->orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('nomor_invoice', function ($row) {
            return $row->nomor_invoice;
        })->editColumn('job_order_id', function ($row) {
            return $row->job_orders->order_id;
        })->editColumn('tipe', function ($row) {
            return $row->job_orders->tipe_order;
        })->editColumn('notes', function ($row) {
            return $row->notes;
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('history.dt.act_list_more', compact('data'));
        })->rawColumns(['action', 'More'])->toJson();
    }
}

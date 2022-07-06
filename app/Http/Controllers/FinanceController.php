<?php

namespace App\Http\Controllers;

use App\Model\SalesOrder;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FinanceController extends Controller
{
    public function index()
    {
        return view('finance.show');
    }

    public function listinvoiceshow()
    {
        $query = SalesOrder::where('deleted', '0')->where('published', '1');
        return Datatables::of(
            $query
        )->addColumn('invoice_no', function ($row) {
            return $row->nomor_invoice;
        })->addColumn('job_order_id', function ($row) {
            return $row->job_orders->order_id;
        })->addColumn('tipe_order', function ($row) {
            return $row->job_orders->tipe_order;
        })->addColumn('notes', function ($row) {
            return $row->notes;
        })->addColumn('More', function ($row) {
            $data = [
                'id'  => $row->id
            ];
            return view('finance.dt.act_list_more', compact('data'));
        })->addColumn('Action', function ($row) {
            $data = [
                'id'  => $row->id
            ];
            return view('finance.dt.act_list_cetak', compact('data'));
        })->rawColumns(['action', 'More'])->toJson();
    }

    public function cetak_invoice()
    {
        $view = View('pdf.invoice_pdf');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());
        return $pdf->stream();
    }
}

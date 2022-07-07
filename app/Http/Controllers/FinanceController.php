<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Terbilang;

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
            $tipe = $row->tipe;
            $data = [
                'id'  => $row->id,
                'tipe' => $tipe,
            ];
            return view('finance.dt.act_list_cetak', compact('data'));
        })->rawColumns(['action', 'More'])->toJson();
    }

    public function cetak_invoice($id, $tipe)
    {
        $sum = 0;
        $sales_order = SalesOrder::find($id);
        $sales_job = $sales_order->job_orders;
        $selling = SalesOrder::find($id)->sellings;
        // dd($selling);
        $createdAt = Carbon::parse($sales_order->created_at);
        $tanggal = $createdAt->format('M d,Y');
        $ETD = $sales_job->ETD;
        $ETA = $sales_job->ETA;
        $x_etd = date('M d,Y', strtotime($ETD));
        $x_eta = date('M d,Y', strtotime($ETA));
        $customer = $sales_job->client_id;
        $list_customer = Client::find($customer);
        foreach ($selling as $x) {
            $sub_total = $x->sub_total;
            $sum += $sub_total;
        }
        $vat = 11 / 100;
        $total_pajak = $sum * $vat;
        $total_charge = $sum - $total_pajak;
        $terbilang = Terbilang::make($sum, ' rupiah');
        $data = array(
            'sales_order' => $sales_order,
            'sales_job' => $sales_job,
            'selling' => $selling,
            'tanggal' => $tanggal,
            'ETD' => $x_etd,
            'ETA' => $x_eta,
            'customer' => $list_customer,
            'terbilang' => $terbilang,
            'sum' => $sum,
            'total_pajak' => $total_pajak,
            'total_charge' => $total_charge,
        );
        if ($tipe == 'I') {
            $view = View('pdf.invoice_pdf', ['data' => $data]);
        } else {
            $view = View('pdf.invoice_dn', ['data' => $data]);
        }
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}

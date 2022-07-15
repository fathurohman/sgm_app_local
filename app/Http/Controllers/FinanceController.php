<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\SalesOrder;
use App\Model\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
        $query = SalesOrder::where('published', '1');
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
        $inv = $sales_order->nomor_invoice;
        $ptng = sprintf('%03d', $inv);
        $sub_string = substr($inv, strpos($inv, "/") + 1);
        $inv_fix = "$ptng/$sub_string";
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
            $curr = $x->curr;
        }
        $pajak = Settings::where('name', 'Pajak')->first();
        $nilai_pajak = $pajak->value;
        $vat = $nilai_pajak / 100;
        $total_pajak = $sum * $vat;
        $total_charge = $sum + $total_pajak;
        if ($curr == 'IDR') {
            $terbilang = ucwords(Terbilang::make($total_charge, ' rupiah'));
            $terbilang_dn = ucwords(Terbilang::make($sum, ' rupiah'));
        } else {
            App::setLocale('en');
            $terbilang = ucwords(Terbilang::make($total_charge, ' dollars#', '# '));
            $terbilang_dn = ucwords(Terbilang::make($sum, ' dollars#', '# '));
        }
        $name = Auth::user()->name;
        // $terbilang = Terbilang::make(2858250, ' rupiah');
        $data = array(
            'inv' => $inv_fix,
            'sales_order' => $sales_order,
            'sales_job' => $sales_job,
            'selling' => $selling,
            'tanggal' => $tanggal,
            'ETD' => $x_etd,
            'ETA' => $x_eta,
            'customer' => $list_customer,
            'terbilang' => $terbilang,
            'terbilang_dn' => $terbilang_dn,
            'sum' => $sum,
            'nilai_pajak' => $nilai_pajak,
            'total_pajak' => $total_pajak,
            'total_charge' => $total_charge,
            'curr' => $curr,
            'name' => $name,
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

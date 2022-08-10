<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\job_order;
use App\Model\SalesOrder;
use App\Model\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Terbilang;

class FinanceController extends BaseController
{
    public function index()
    {
        return view('finance.show');
    }

    public function listinvoiceshow()
    {
        $query = SalesOrder::where('published', '1')->where('booked', '0')->orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('job_order_id', function ($row) {
            return $row->job_orders->order_id;
        })->editColumn('tipe', function ($row) {
            return $row->job_orders->tipe_order;
        })->editColumn('notes', function ($row) {
            return $row->notes;
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('finance.dt.act_list_more', compact('data'));
        })->addColumn('Action', function ($row) {
            $tipe = $row->tipe;
            $printed = $row->printed;
            $data = [
                'id' => $row->id,
                'tipe' => $tipe,
                'printed' => $printed,
            ];
            return view('finance.dt.act_list_cetak', compact('data'));
        })->rawColumns(['action', 'More'])->toJson();
    }

    public function modal_cetak_invoice($id, $tipe)
    {
        $settings = Settings::all();
        $sales_data = SalesOrder::find($id);
        $tipe_cetak = $tipe;
        $date = $sales_data->inv_date;
        return view('finance.detail_invoice', compact('settings', 'sales_data', 'tipe_cetak', 'date'));
    }

    public function order_row($tipe, $month, $year)
    {
        $jml_by_month = SalesOrder::whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->where([
                ['tipe', '=', $tipe],
            ])
            ->count();
        $urutan = SalesOrder::select('order_row')->where('tipe', $tipe)
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
        $results = array();
        foreach ($urutan as $query) {
            $order_row = $query->order_row;
            array_push($results, $order_row);
        }
        $max = max($results);
        if ($jml_by_month == '0') {
            $order_month = '1';
        } else {
            //ini ambil nilai max di kolom
            $order_month = $max + 1;
        }
        return $order_month;
    }

    public function cetak_invoice_dua(Request $request)
    {
        $date = $request->inv_date;
        $id = $request->id_sales;
        if (empty($date)) {
            $now = Carbon::now()->format('Y-m-d');
        } else {
            $now = $date;
        }
        $tipe = $request->tipe_cetak;
        $pajak = $request->tipe_pajak;
        $sum = 0;
        $sales_order = SalesOrder::find($id);
        $tipe = $sales_order->tipe;
        //no invoice
        $year = Carbon::now()->format('Y');
        $tahun = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        // $order_month = $jml_by_month + 1;
        if ($sales_order->printed == '1') {
            $order_month = $sales_order->order_row;
        } else {
            $order_month = $this->order_row($tipe, $month, $year);
        }
        //check inv
        if ($sales_order->nomor_invoice == '-') {
            $inv = "$order_month/SGM/$tipe/$month/$tahun";
        } else {
            $inv = $sales_order->nomor_invoice;
        }
        //end no invoice
        //update invoice dan status
        SalesOrder::where('id', $id)->update([
            'printed' => '1',
            'vat' => $pajak,
            'order_row' => $order_month,
            'nomor_invoice' => $inv,
            'inv_date' => $now,
        ]);
        //end update
        $ptng = sprintf('%03d', $inv);
        $sub_string = substr($inv, strpos($inv, "/") + 1);
        $inv_fix = "$ptng/$sub_string";
        $sales_job = $sales_order->job_orders;
        // dd($selling);
        // $createdAt = Carbon::parse($sales_order->inv_date);
        $tanggal = date('M d,Y', strtotime($sales_order->inv_date));
        // $tanggal = $createdAt->format('M d,Y');
        $ETD = $sales_job->ETD;
        $ETA = $sales_job->ETA;
        $id_job = $sales_job->id;
        job_order::where('id', $id_job)->update([
            'printed' => '1',
        ]);
        $x_etd = date('M d,Y', strtotime($ETD));
        $x_eta = date('M d,Y', strtotime($ETA));
        // $customer = $sales_job->client_id;
        // $list_customer = Client::find($customer);
        $selling = SalesOrder::find($id)->sellings;
        $jumlah_penjualan = count($selling);
        foreach ($selling as $x) {
            $sub_total = $x->sub_total;
            $sum += $sub_total;
            $curr = $x->curr;
            $customer = $x->name;
        }
        // $pajak = Settings::where('name', 'Pajak')->first();
        // $nilai_pajak = $pajak->value;
        $vat = $pajak / 100;
        $itung_pajak = $sum * $vat;
        $total_pajak = (int)$itung_pajak;
        $total_charge = $sum + $total_pajak;
        if ($curr == 'IDR') {
            $terbilang = ucwords(Terbilang::make($total_charge, ' rupiah'));
            $terbilang_dn = ucwords(Terbilang::make($sum, ' rupiah'));
        } else {
            App::setLocale('en');
            $terbilang = ucwords(Terbilang::make($total_charge, ' dollars#', '# '));
            $terbilang_dn = ucwords(Terbilang::make($sum, ' dollars#', '# '));
        }
        $list_customer = Client::where('COMPANY_NAME', $customer)->first();
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
            'nilai_pajak' => $pajak,
            'total_pajak' => $total_pajak,
            'total_charge' => $total_charge,
            'curr' => $curr,
            'name' => $name,
            'jumlah_penjualan' => $jumlah_penjualan,
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

    public function returntosales($id)
    {
        SalesOrder::where('id', $id)->update(['published' => '0']);
        return redirect()->back();
    }

    public function pembukuan($id)
    {
        SalesOrder::where('id', $id)->update(['booked' => '1']);
        return redirect()->back();
    }
}

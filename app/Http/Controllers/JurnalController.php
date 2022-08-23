<?php

namespace App\Http\Controllers;

use App\Exports\JPembelianExport;
use App\Exports\JPenjualanExport;
use App\Exports\MultiExport;
use App\Model\JurnalPenjualan;
use App\Model\SalesOrder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JurnalController extends Controller
{
    public function index()
    {
        return view('jurnal.jurnal');
    }

    public function export_jurnal(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $this->tarik_penjualan($start, $end);
        $download = Excel::download(new MultiExport($start, $end), 'JURNAL.xlsx');
        return $download;
    }

    public function tarik_penjualan($start, $end)
    {
        $sum_idr = 0;
        $sum_usd = 0;
        $sales = SalesOrder::whereBetween('inv_date', [$start, $end])
            ->where([
                ['printed', '=', '1'],
                ['published', '=', '1'],
                ['booked', '=', '1'],
            ])->get();
        foreach ($sales as $x) {
            $id = $x->id;
            $j_penjualan = JurnalPenjualan::where('sales_order_id', $id)->get();
            if ($j_penjualan->isEmpty()) {
                if (empty($x->vat)) {
                    $pajak = 0;
                } else {
                    $pajak = $x->vat;
                }
                $tanggal_inv = $x->inv_date;
                // $date_inv = date('d-F-Y', strtotime($tanggal_inv));
                $no_inv = $x->nomor_invoice;
                $ptng = sprintf('%03d', $no_inv);
                $sub_string = substr($no_inv, strpos($no_inv, "/") + 1);
                $trans_no = "$ptng/$sub_string";
                $description = $x->job_orders->order_id;
                $selling = SalesOrder::find($id)->sellings;
                foreach ($selling as $y) {
                    $curr = $y->curr;
                    $sub_total = $y->sub_total;
                    if ($curr == 'IDR') {
                        $sum_usd = 0;
                        $sum_idr += $sub_total;
                    } elseif ($curr == 'USD') {
                        $sum_idr = 0;
                        $sum_usd += $sub_total;
                    } else {
                        $sum_idr = 0;
                        $sum_usd = 0;
                    }
                    $customer = $y->name;
                }
                // $status_bayar = "-";
                // $tgl_pay = "-";
                if ($x->tipe == 'I') {
                    $vat = $pajak / 100;
                    $total_pajak = $sum_idr * $vat;
                    $total_charge = $sum_idr + $total_pajak;
                    $no_faktur = "-";
                    $ppn = array(
                        'sales_order_id' => $id,
                        'trans_date' => $tanggal_inv,
                        'Customer' => $customer,
                        'inv_No' => $trans_no,
                        'description' => $description,
                        'coa_id' => '189',
                        'debit' => '0',
                        'credit' => $total_pajak,
                        'ending_balance' => $total_pajak,
                        'inv_us' => $sum_usd,
                        'kurs_idr' => '0',
                        'no_faktur' => $no_faktur,
                        // 'status_bayar' => $status_bayar,
                        // 'tgl_pay' => $tgl_pay,
                    );
                } else {
                    $vat = 0;
                    $total_pajak = 0;
                    $total_charge = $sum_idr;
                    $no_faktur = "DEBIT NOTE";
                    $ppn = NULL;
                }
                $piutang = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'Customer' => $customer,
                    'inv_No' => $trans_no,
                    'description' => $description,
                    'coa_id' => '38',
                    'debit' => $total_charge,
                    'credit' => '0',
                    'ending_balance' => $total_charge,
                    'inv_us' => $sum_usd,
                    'kurs_idr' => '0',
                    'no_faktur' => $no_faktur,
                    // 'status_bayar' => $status_bayar,
                    // 'tgl_pay' => $tgl_pay,
                );
                $penjualan = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'Customer' => $customer,
                    'inv_No' => $trans_no,
                    'description' => $description,
                    'coa_id' => '247',
                    'debit' => '0',
                    'credit' => $sum_idr,
                    'ending_balance' => $sum_idr,
                    'inv_us' => $sum_usd,
                    'kurs_idr' => '0',
                    'no_faktur' => $no_faktur,
                    // 'status_bayar' => $status_bayar,
                    // 'tgl_pay' => $tgl_pay,
                );
                // echo var_dump($ppn) . "<br>";

                // echo var_dump($piutang) . "<br>";

                // dd($penjualan);
                JurnalPenjualan::insert($piutang);
                JurnalPenjualan::insert($penjualan);
                if (!empty($ppn)) {
                    JurnalPenjualan::insert($ppn);
                }
            } else {
                return 'data available';
            }
        }
    }
}

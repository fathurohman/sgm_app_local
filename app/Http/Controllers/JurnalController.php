<?php

namespace App\Http\Controllers;

use App\Model\SalesOrder;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        return view('jurnal.jurnal');
    }

    public function export_jurnal(Request $request)
    {
        $sum_idr = 0;
        $sum_usd = 0;
        $start = $request->start;
        $end = $request->end;
        $sales = SalesOrder::whereBetween('inv_date', [$start, $end])
            ->where([
                ['printed', '=', '1'],
                ['published', '=', '1'],
                ['booked', '=', '1'],
            ])->get();
        foreach ($sales as $x) {
            $id = $x->id;
            if (empty($x->vat)) {
                $pajak = 0;
            } else {
                $pajak = $x->vat;
            }
            $tanggal_inv = $x->inv_date;
            $date_inv = date('d-F-Y', strtotime($tanggal_inv));
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
            $status_bayar = "-";
            $tgl_pay = "-";
            if ($x->tipe == 'I') {
                $vat = $pajak / 100;
                $total_pajak = $sum_idr * $vat;
                $total_charge = $sum_idr + $total_pajak;
                $no_faktur = "-";
                $ppn = array(
                    'trans_date' => $date_inv,
                    'Customer' => $customer,
                    'Trans_No' => $trans_no,
                    'Description' => $description,
                    'chart_of_account' => '-',
                    'Debit' => '-',
                    'Credit' => $total_pajak,
                    'Ending_Balance' => $total_pajak,
                    'Nom_inv_US' => $sum_usd,
                    'Kurs_IDR' => '-',
                    'No_Faktur' => $no_faktur,
                    'status_bayar' => $status_bayar,
                    'tgl_pay' => $tgl_pay,
                );
            } else {
                $vat = 0;
                $total_pajak = 0;
                $total_charge = $sum_idr;
                $no_faktur = "DEBIT NOTE";
                $ppn = '-';
            }
            $piutang = array(
                'trans_date' => $date_inv,
                'Customer' => $customer,
                'Trans_No' => $trans_no,
                'Description' => $description,
                'chart_of_account' => '-',
                'Debit' => $total_charge,
                'Credit' => '-',
                'Ending_Balance' => $total_charge,
                'Nom_inv_US' => $sum_usd,
                'Kurs_IDR' => '-',
                'No_Faktur' => $no_faktur,
                'status_bayar' => $status_bayar,
                'tgl_pay' => $tgl_pay,
            );
            $penjualan = array(
                'trans_date' => $date_inv,
                'Customer' => $customer,
                'Trans_No' => $trans_no,
                'Description' => $description,
                'chart_of_account' => '-',
                'Debit' => '-',
                'Credit' => $sum_idr,
                'Ending_Balance' => $sum_idr,
                'Nom_inv_US' => $sum_usd,
                'Kurs_IDR' => '-',
                'No_Faktur' => $no_faktur,
                'status_bayar' => $status_bayar,
                'tgl_pay' => $tgl_pay,
            );
            echo var_dump($ppn) . "<br>";

            echo var_dump($piutang) . "<br>";

            dd($penjualan);
        }
    }
}

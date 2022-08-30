<?php

namespace App\Http\Controllers;

use App\Exports\JPembelianExport;
use App\Exports\JPenjualanExport;
use App\Exports\MultiExport;
use App\Model\JurnalPembelian;
use App\Model\JurnalPenjualan;
use App\Model\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $this->tarik_pembelian($start, $end);
        $download = Excel::download(new MultiExport($start, $end), 'JURNAL.xlsx');
        return $download;
    }

    public function tarik_penjualan($start, $end)
    {
        $sales = SalesOrder::whereBetween('inv_date', [$start, $end])
            ->where([
                ['printed', '=', '1'],
                ['published', '=', '1'],
                ['booked', '=', '1'],
            ])->get();
        foreach ($sales as $x) {
            $sum_idr = 0;
            $sum_usd = 0;
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

    public function data_sum_buying($start, $end)
    {
        return DB::select('SELECT buying_orders.curr AS curr, sum(buying_orders.sub_total ) AS sub_total,
        buying_orders.name AS customers, sales_orders.inv_date as inv_date,
				sales_orders.nomor_invoice AS nomor_invoice, sales_orders.job_order_id,
				buying_orders.sales_order_id as sales_id
        FROM sales_orders
        INNER JOIN buying_orders ON sales_orders.id=buying_orders.sales_order_id
		where sales_orders.created_at between "' . $start . '" and "' . $end . '"
        and sales_orders.printed = 1
		GROUP BY buying_orders.curr,buying_orders.name, sales_orders.inv_date, sales_orders.nomor_invoice,
        sales_orders.job_order_id,buying_orders.sales_order_id');
    }
    public function tarik_pembelian($start, $end)
    {
        $buying = $this->data_sum_buying($start, $end);
        // dd($buying);
        foreach ($buying as $y) {
            $id = $y->sales_id;
            $curr = $y->curr;
            $sub_total = $y->sub_total;
            $customer = $y->customers;
            $tanggal_inv = $y->inv_date;
            // $date_inv = date('d-F-Y', strtotime($tanggal_inv));
            $no_inv = $y->nomor_invoice;
            if ($curr == 'IDR') {
                $nilai_usd = '0';
                $ptng = sprintf('%03d', $no_inv);
                $sub_string = substr($no_inv, strpos($no_inv, "/") + 1);
                $trans_no = "$ptng/$sub_string";
                $description = $y->job_order_id;
                $vat = 1.1 / 100;
                $pph = $sub_total * (2 / 100);
                $total_pajak = $sub_total * $vat;
                $total_charge = $sub_total + $total_pajak;
                $Admin = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'inv_No' => $trans_no,
                    'description' => "A/p $customer $description",
                    'coa_id' => '386',
                    'debit' => $pph,
                    'credit' => '0',
                    'ending_balance' => $pph,
                    'inv_usd' => '0',
                    'nilai_trans' => $sub_total,
                );
                $hutang_pajak = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'inv_No' => $trans_no,
                    'description' => "A/p $customer $description",
                    'coa_id' => '195',
                    'debit' => '0',
                    'credit' => $pph,
                    'ending_balance' => $pph,
                    'inv_usd' => '0',
                );
                $ppn = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'inv_No' => $trans_no,
                    'description' => "A/p $customer $description",
                    'coa_id' => '79',
                    'debit' => $total_pajak,
                    'credit' => '0',
                    'ending_balance' => $total_pajak,
                    'inv_usd' => '0',
                );
            } else {
                $Admin = NULL;
                $hutang_pajak = NULL;
                $ppn = NULL;
                $total_charge = '0';
                $nilai_usd = $sub_total;
            }
            $pembelian = array(
                'sales_order_id' => $id,
                'trans_date' => $tanggal_inv,
                'inv_No' => $trans_no,
                'description' => "A/p $customer $description",
                'coa_id' => '253',
                'debit' => $total_charge,
                'credit' => '0',
                'ending_balance' => $total_charge,
                'inv_usd' => $nilai_usd,
            );
            $hutang = array(
                'sales_order_id' => $id,
                'trans_date' => $tanggal_inv,
                'inv_No' => $trans_no,
                'description' => "A/p $customer $description",
                'coa_id' => '155',
                'debit' => '0',
                'credit' => $total_charge,
                'ending_balance' => $total_charge,
                'inv_usd' => $nilai_usd,
            );
            // dd($hutang);
            JurnalPembelian::insert($pembelian);
            JurnalPembelian::insert($hutang);
            if (!empty($ppn) && !empty($Admin) && !empty($hutang_pajak)) {
                JurnalPembelian::insert($ppn);
                JurnalPembelian::insert($Admin);
                JurnalPembelian::insert($hutang_pajak);
            }
            $sub_total = 0;
        }
    }
}

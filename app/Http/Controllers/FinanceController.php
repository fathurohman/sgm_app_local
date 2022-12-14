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

    

    function convertNumber($number)
    {
        list($integer, $fraction) = explode(".", (string) $number);

        $output = "";

        if ($integer[0] == "-") {
            $output = "negative ";
            $integer    = ltrim($integer, "-");
        } else if ($integer[0] == "+") {
            $output = "positive ";
            $integer    = ltrim($integer, "+");
        }

        if ($integer[0] == "0") {
            $output .= "zero";
        } else {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group   = rtrim(chunk_split($integer, 3, " "), " ");
            $groups  = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g) {
                $groups2[] = $this->convertThreeDigit($g[0], $g[1], $g[2]);
            }

            for ($z = 0; $z < count($groups2); $z++) {
                if ($groups2[$z] != "") {
                    $output .= $groups2[$z] . $this->convertGroup(11 - $z) . ($z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11][0] == '0'
                        ? " and "
                        : ", "
                    );
                }
            }

            $output = rtrim($output, ", ");
        }

        if ($fraction > 0) {
            $output .= " dollars point";
            for ($i = 0; $i < strlen($fraction); $i++) {
                $output .= " " . $this->convertDigit($fraction[$i]);
            }
        }

        return $output . ' cents';
    }

    function convertGroup($index)
    {
        switch ($index) {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    function convertThreeDigit($digit1, $digit2, $digit3)
    {
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
            return "";
        }

        if ($digit1 != "0") {
            $buffer .= $this->convertDigit($digit1) . " hundred";
            if ($digit2 != "0" || $digit3 != "0") {
                $buffer .= " and ";
            }
        }

        if ($digit2 != "0") {
            $buffer .= $this->convertTwoDigit($digit2, $digit3);
        } else if ($digit3 != "0") {
            $buffer .= $this->convertDigit($digit3);
        }

        return $buffer;
    }

    function convertTwoDigit($digit1, $digit2)
    {
        if ($digit2 == "0") {
            switch ($digit1) {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1") {
            switch ($digit2) {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else {
            $temp = $this->convertDigit($digit2);
            switch ($digit1) {
                case "2":
                    return "twenty-$temp";
                case "3":
                    return "thirty-$temp";
                case "4":
                    return "forty-$temp";
                case "5":
                    return "fifty-$temp";
                case "6":
                    return "sixty-$temp";
                case "7":
                    return "seventy-$temp";
                case "8":
                    return "eighty-$temp";
                case "9":
                    return "ninety-$temp";
            }
        }
    }

    function convertDigit($digit)
    {
        switch ($digit) {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }

    public function order_row($tipe, $month, $year)
    {   
        // inv_date sebelumnya crated_at

        $jml_by_month = SalesOrder::whereMonth('inv_date', $month)->whereYear('inv_date', $year)
            ->where([
                ['tipe', '=', $tipe],
            ])
            ->count();
        $urutan = SalesOrder::select('order_row')->where('tipe', $tipe)
            ->whereMonth('inv_date', $month)->whereYear('inv_date', $year)->get();
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
        //update inv date di awal
        SalesOrder::where('id', $id)->update([
            'inv_date' => $now,
        ]);

        $tipe = $request->tipe_cetak;
        $pajak = $request->tipe_pajak;
        $sum = 0;
        $sales_order = SalesOrder::find($id);
        $tipe = $sales_order->tipe;
        //no invoice
        // $year = Carbon::now()->format('Y');
        // $tahun = Carbon::now()->format('y');
        // $month = Carbon::now()->format('m');
        $tahun = $sales_order->created_at->format('y');
        $year = $sales_order->created_at->format('Y');
        // $month = $request->inv_date;
        // mengambil format inv_date
        $month = Carbon::createFromFormat('Y-m-d', $now)->format('m');


       
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
            // 'inv_date' => $now,
        ]);
        //end update
        $ptng = sprintf('%03d', $inv);
        $sub_string = substr($inv, strpos($inv, "/") + 1);
        $inv_fix = "$ptng/$sub_string";
        $sales_job = $sales_order->job_orders;
        // dd($selling);
        // $createdAt = Carbon::parse($sales_order->inv_date);
        $tanggal = date('M d,Y', strtotime($now));
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
        if ($curr == 'IDR') {
            $total_pajak = (int)$itung_pajak;
            $total_charge = $sum + $total_pajak;
            $terbilang = ucwords(Terbilang::make($total_charge, ' rupiah'));
            $terbilang_dn = ucwords(Terbilang::make($sum, ' rupiah'));
        } else {
            App::setLocale('en');
            $total_pajak = $itung_pajak;
            $total_charge = $sum + $total_pajak;
            $cek_sen = count(explode(".", $sum));
            if ($cek_sen == '1') {
                $terbilang = ucwords(Terbilang::make($total_charge, ' dollars#', '# '));
                $terbilang_dn = ucwords(Terbilang::make($sum, ' dollars#', '# '));
            } else {
                $sum_dec = number_format((float) $sum, 2, '.', '');
                $terbilang = $this->convertNumber($total_charge);
                $terbilang_dn = $this->convertNumber($sum_dec);
            }
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

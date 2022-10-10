<?php

namespace App\Http\Controllers;

use App\Exports\ProfitExport;
use App\Exports\SalesExport;
use App\Model\Down_Payment;
use App\Model\reports;
use App\Model\SalesOrder;
use App\User;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Illuminate\Support\Facades\DB;

class HistoryController extends BaseController
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

    public function getdatahist_m(Request $request)
    {
        $pid = $request->get('pid');
        $selling_order = SalesOrder::find($pid)->sellings;
        $buying_order = SalesOrder::find($pid)->buyings;
        $profits = SalesOrder::find($pid)->profits;
        $dp = Down_Payment::where('sales_order_id', $pid)->first();
        $data = array(
            'selling_order' => $selling_order,
            'buying_order' => $buying_order,
            'profits' => $profits,
            'dp' => $dp,
        );
        $html = view('sales_order.modal.table_sales')->with(compact('data'))->render();
        return response()->json(['success' => true, 'html' => $html, 'dp' => $dp]);
        // return Response::json($data);
    }

    public function historyinvoicemodal()
    {
        $query = SalesOrder::where('published', '1')->where('printed', '1')->orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('nomor_invoice', function ($row) {
            return $row->nomor_invoice;
        })->editColumn('job_order_id', function ($row) {
            return $row->job_orders->order_id;
        })->editColumn('tipe', function ($row) {
            return $row->tipe;
        })->editColumn('pol_pod', function ($row) {
            return $row->job_orders->pol_pod;
        })->editColumn('GWT_MEAS', function ($row) {
            return $row->job_orders->GWT_MEAS;
        })->addColumn('Pickup', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('history.dt.act_history_modal', compact('data'));
        })->rawColumns(['action', 'More'])->toJson();
    }

    public function daily_home()
    {
        $month = array_reduce(range(1, 12), function ($rslt, $m) {
            $rslt[$m] = date('F', mktime(0, 0, 0, $m, 10));
            return $rslt;
        });
        
        $y = Carbon::now()->format('Y');
        // $query = DB::table('sales_orders')->groupBy('inv_date', $y)
        // ->count();
       
        // dd($query);

        $sales_name = User::where('department', 'sales')->get();
        return view('reports.daily', compact('month', 'sales_name', 'y'));
    }

    public function tarik_profit()
    {
        $month = array_reduce(range(1, 12), function ($rslt, $m) {
            $rslt[$m] = date('F', mktime(0, 0, 0, $m, 10));
            return $rslt;
        });
        $sales_name = User::where('department', 'sales')->get();
        return view('reports.tarik_profit', compact('month', 'sales_name'));
    }

   

    public function export(Request $request)
    {
        // $tipe = $request->tipe;
        // $month = $request->month;
        // $sales_id = $request->sales;
        // $this->narikdata($month, $tipe, $sales_id);
        // $download = Excel::download(new SalesExport($month), 'ReportMonthly.xlsx');
        // return $download;

        $tipe = $request->tipe;
        $month = $request->month;
        $month2 = $request->month2;
        $years = $request->years;
        $sales_id = $request->sales;
        $this->narikdata_new($tipe, $month, $month2, $years, $sales_id);
        
        $download = Excel::download(new SalesExport($month, $month2, $years), 'ReportMonthly.xlsx');
        return $download;

    }

    public function export_profit(Request $request)
    {
        $month = $request->month;
        $sales_id = $request->sales;
        // $this->narikdata($month, $sales_id);
        $download = Excel::download(new ProfitExport($month, $sales_id), 'ProfitMonthly.xlsx');
        return $download;
    }

    public function getremonthly(Request $request)
    {   
        $tipe =  $request->tipe;
        $month = $request->month;
        $month2 = $request->month2;
        $years = $request->years;
        $sales_id = $request->sales_id;

        $data = $this->narikdata_new($tipe, $month, $month2, $years, $sales_id);
       
        $html = view('reports.remonthly')->with(compact('data'))->render();
        return response()->json(['success' => true, 'html' => $html]);
        // return json_encode($data);
    }

    public function narikdata_new($tipe, $month, $month2, $years, $sales_id)
    {
        reports::query()->truncate();
        $sum_idr = 0;
        $sum_usd = 0;
        $tahun = Carbon::now()->format('Y');
        switch ($tipe) {
            case 'All':
                if ($sales_id == "All") {
                    $sales = SalesOrder::whereMonth('inv_date', '>=' , $month)->whereMonth('inv_date', '<=' , $month2)->whereYear('inv_date', $years)
                        ->where([
                            ['printed', '=', '1'],
                            ['published', '=', '1'],
                            ['booked', '=', '1'],
                        ])->get();
                } else {
                    $sales = SalesOrder::whereMonth('inv_date', '>=' , $month)->whereMonth('inv_date', '<=' , $month2)->whereYear('inv_date', $years)
                        ->where([
                            ['printed', '=', '1'],
                            ['published', '=', '1'],
                            ['booked', '=', '1'],
                            ['created_by', '=', $sales_id]
                        ])->get();
                }
                break;
            case  'I':
            case 'DN':
                if ($sales_id == "All") {
                    $sales = SalesOrder::whereMonth('inv_date', '>=' ,  $month)->whereMonth('inv_date', '<=' , $month2)->whereYear('inv_date', $years)
                        ->where([
                            ['printed', '=', '1'],
                            ['published', '=', '1'],
                            ['booked', '=', '1'],
                            ['tipe', '=', $tipe],
                        ])->get();
                } else {
                    $sales = SalesOrder::whereMonth('inv_date', '>=' , $month)->whereMonth('inv_date', '<=' , $month2)->whereYear('inv_date', $years)
                        ->where([
                            ['printed', '=', '1'],
                            ['published', '=', '1'],
                            ['booked', '=', '1'],
                            ['tipe', '=', $tipe],
                            ['created_by', '=', $sales_id]
                        ])->get();
                }
                break;
            default:
                echo "HHMMMMM!";
        }
        // var_dump($sales_id);
        foreach ($sales as $x) {
            $id = $x->id;
            if (empty($x->vat)) {
                $pajak = 0;
            } else {
                $pajak = $x->vat;
            }
            $no_inv = $x->nomor_invoice;
            $ptng = sprintf('%03d', $no_inv);
            $sub_string = substr($no_inv, strpos($no_inv, "/") + 1);
            $inv_fix = "$ptng/$sub_string";
            $inv_date = $x->inv_date;
            $job_orders = $x->job_orders->order_id;
            if ($x->tipe == 'I') {
                $faktur = '-';
            } else {
                $faktur = 'DEBIT NOTE';
            }
            $sales_name = $x->sales->name;
            // $dop = '0000-00-00';
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
            // $pajak = Settings::where('name', 'Pajak')->first();
            // $nilai_pajak = $pajak->value;
            if ($x->tipe == 'I') {
                $pph = $sum_idr * (2 / 100);
                $vat = $pajak / 100;
                $total_pajak = $sum_idr * $vat;
                $total_charge = $sum_idr + $total_pajak;
                $amount_ar = $total_charge - $pph;
            } else {
                $pph = 0;
                $vat = 0;
                $total_pajak = 0;
                $total_charge = $sum_idr;
                $amount_ar = $total_charge;
            }

            $payment = 0;
            $kurs_bi = 0;

            $reports = new reports;
            $reports->no_inv = $inv_fix;
            $reports->inv_date = $inv_date;
            $reports->seri_faktur = $faktur;
            $reports->cust_name = $customer;
            $reports->nilai_inv_idr = $sum_idr;
            $reports->nilai_inv_usd = $sum_usd;
            $reports->ppn = $total_pajak;
            $reports->grand_total = $total_charge;
            $reports->vat = $pajak;
            $reports->job_no = $job_orders;
            $reports->sales_name = $sales_name;
            // $reports->dop = $dop;
            $reports->pph = $pph;
            $reports->amount = $amount_ar;
            $reports->payment = $payment;
            $reports->AR = $amount_ar;
            $reports->sales_usd = $sum_usd;
            $reports->kurs_bi = $kurs_bi;
            $reports->save();
            $sum_idr = 0;
            $sum_usd = 0;

            
        }
       
        return array('sales' => $sales);
    }


  
}

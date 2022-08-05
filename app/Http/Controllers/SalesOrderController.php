<?php

namespace App\Http\Controllers;

use App\Model\BuyingOrder;
use App\Model\Client;
use App\Model\Curr;
use App\Model\Down_Payment;
use App\Model\job_order;
use App\Model\logs_user;
use App\Model\Profit;
use App\Model\SalesOrder;
use App\Model\SellingOrder;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Response;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class SalesOrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sales_orders = SalesOrder::all();
        return view('sales_order.show');
    }

    public function data_sales()
    {
        return view('sales_order.data_sales');
    }

    public function listsalesshow()
    {
        // $query = SalesOrder::all();
        $auth = Auth::id();
        $query = SalesOrder::where('created_by', $auth)->where('published', 0)->orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('job_order_id', function ($row) {
            return $row->job_orders->order_id;
        })->editColumn('tipe', function ($row) {
            return $row->job_orders->tipe_order;
        })->editColumn('notes', function ($row) {
            return $row->notes;
        })->editColumn('published', function ($row) {
            if ($row->published == '1') {
                return 'Process by finance';
            } else {
                return 'draft';
            }
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('sales_order.dt.act_list_more', compact('data'));
        })->addColumn('Action', function ($row) {
            $data = [
                'id' => $row->id,
                'status' => $row->published,
            ];
            return view('sales_order.dt.act_list_crud', compact('data'));
        })->rawColumns(['action', 'More'])->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curr = Curr::all();
        // $sales = User::where('department', 'sales')->get();
        // $job_order = job_order::all()->get();
        // $data = array(
        //     'sales' => $sales,
        // );
        return view('sales_order.create', compact('curr'));
    }

    public function pickup($id)
    {
        $curr = Curr::all();
        $job_data = job_order::find($id);
        $createdAt = Carbon::parse($job_data->created_at);
        $tanggal = $createdAt->format('Y-m-d');
        $sales = $job_data->sales->name;
        $shipper = $job_data->clients->COMPANY_NAME;
        return view('sales_order.create', compact('curr', 'job_data', 'tanggal', 'sales', 'shipper'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $i = 0;
        job_order::where('id', $request->job_order_id)->update(['pickup' => '1']);
        $sales_order = new SalesOrder;
        $tipe = $request->tipe_order_text;
        $tipe_order = strtok($tipe, '-');
        $sales_order->nomor_invoice = $request->no_inv;
        $sales_order->job_order_id = $request->job_order_id;
        $sales_order->tipe = $tipe_order;
        $sales_order->notes = $request->notes;
        // if (empty($request->published)) {
        //     $sales_order->published = 0;
        // } else {
        //     $sales_order->published = $request->published;
        // }
        // job_order::where('id', $id)->update(['booked' => '1']);
        $sales_order->created_by = Auth::id();
        $sales_order->save();
        if (!empty($request->description_b[0])) {
            foreach ($request->description_b as $a => $v) {
                $details_b = array(
                    'sales_order_id' => $sales_order->id,
                    'description' => $v,
                    'qty' => $request->qty_b[$a],
                    'curr' => $request->curr_b[$a],
                    'price' => $request->price_b[$a],
                    'sub_total' => $request->sub_total_b[$a],
                    'remark' => $request->remark_b[$a],
                    'name' => $request->name_b[$a],
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                );
                BuyingOrder::insert($details_b);
                $i++;
            }
        }
        if (!empty($request->description_s[0])) {
            foreach ($request->description_s as $a => $v) {
                $details_s = array(
                    'sales_order_id' => $sales_order->id,
                    'description' => $v,
                    'qty' => $request->qty_s[$a],
                    'curr' => $request->curr_s[$a],
                    'price' => $request->price_s[$a],
                    'sub_total' => $request->sub_total_s[$a],
                    'remark' => $request->remark_s[$a],
                    'name' => $request->name_s[$a],
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                );
                SellingOrder::insert($details_s);
                $i++;
            }
        }
        if (!empty($request->currency_prof[0])) {
            foreach ($request->currency_prof as $a => $v) {
                $details_prof = array(
                    'sales_order_id' => $sales_order->id,
                    'currency' => $v,
                    'total_selling' => $request->total_selling_prof[$a],
                    'total_buying' => $request->total_buying_prof[$a],
                    'profit' => $request->profit[$a],
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                );
                Profit::insert($details_prof);
                $i++;
            }
        }
        $details_dp = array(
            'sales_order_id' => $sales_order->id,
            'customer' => $request->customer_dp,
            'currency' => $request->currency_dp,
            'total' => $request->total_dp,
            'dp' => $request->dp,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        );
        Down_Payment::insert($details_dp);
        return redirect(route('data_sales'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sales_order = SalesOrder::find($id);
        $job_id = $sales_order->job_order_id;
        $data_job = job_order::find($job_id);
        $createdAt = Carbon::parse($data_job->created_at);
        $tanggal = $createdAt->format('Y-m-d');
        $sales = $data_job->sales->name;
        $shipper = $data_job->clients->COMPANY_NAME;
        $data = array(
            'tanggal' => $tanggal,
            'sales' => $sales,
            'shipper' => $shipper,
        );
        // $selling = SellingOrder::where('sales_order_id', $sales_order->id)->get();
        $selling = SalesOrder::find($id)->sellings;
        $buying = SalesOrder::find($id)->buyings;
        $profit = SalesOrder::find($id)->profits;
        // $buying = BuyingOrder::where('sales_order_id', $sales_order->id)->get();
        // $profit = Profit::where('sales_order_id', $sales_order->id)->get();
        $down_payment = Down_Payment::where('sales_order_id', $sales_order->id)->first();
        // $data = array('');
        return view('sales_order.edit', compact(
            'sales_order',
            'data_job',
            'data',
            'selling',
            'buying',
            'down_payment',
            'profit'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $i = 0;
        $sales_order = SalesOrder::find($id);
        $sales_order->nomor_invoice = $request->no_inv;
        $sales_order->job_order_id = $request->order_id;
        $sales_order->notes = $request->notes;
        // if (empty($request->published)) {
        //     $sales_order->published = 0;
        // } else {
        //     $sales_order->published = $request->published;
        // }
        $sales_order->save();
        //down_payments
        $down_payment = Down_Payment::find($request->dp_id);
        $down_payment->sales_order_id = $id;
        $down_payment->customer = $request->customer_dp;
        $down_payment->currency = $request->currency_dp;
        $down_payment->total = $request->total_dp;
        $down_payment->dp = $request->dp;
        $down_payment->save();
        //buying
        $buying = SalesOrder::find($id)->buyings;
        $itung_buying = $buying->count();
        if ($itung_buying == 0) {
            foreach ($request->description_b as $a => $v) {
                BuyingOrder::updateorCreate(
                    ['id' => $request->id_buying[$a]],
                    [
                        'sales_order_id' => $sales_order->id,
                        'description' => $v,
                        'qty' => $request->qty_b[$a],
                        'curr' => $request->curr_b[$a],
                        'price' => $request->price_b[$a],
                        'sub_total' => $request->sub_total_b[$a],
                        'remark' => $request->remark_b[$a],
                        'name' => $request->name_b[$a],
                    ]
                );
            }
        } else {
            foreach ($buying as $x) {
                $id_buying  = $x->id;
                if (in_array($id_buying, $request->id_buying)) {
                    foreach ($request->description_b as $a => $v) {
                        BuyingOrder::updateorCreate(
                            ['id' => $request->id_buying[$a]],
                            [
                                'sales_order_id' => $sales_order->id,
                                'description' => $v,
                                'qty' => $request->qty_b[$a],
                                'curr' => $request->curr_b[$a],
                                'price' => $request->price_b[$a],
                                'sub_total' => $request->sub_total_b[$a],
                                'remark' => $request->remark_b[$a],
                                'name' => $request->name_b[$a],
                            ]
                        );
                    }
                } else {
                    BuyingOrder::where('id', $id_buying)->delete();
                }
            }
        }
        //selling
        $selling = SalesOrder::find($id)->sellings;
        foreach ($selling as $x) {
            //seluruh data selling
            $id_selling  = $x->id;
            //ini cek id yang ke post
            if (in_array($id_selling, $request->id_selling)) {
                foreach ($request->description_s as $a => $v) {
                    // if (in_array($request->id_selling[$a])) {
                    //     # code...
                    // }
                    SellingOrder::updateorCreate(
                        ['id' => $request->id_selling[$a]],
                        [
                            'sales_order_id' => $sales_order->id,
                            'description' => $v,
                            'qty' => $request->qty_s[$a],
                            'curr' => $request->curr_s[$a],
                            'price' => $request->price_s[$a],
                            'sub_total' => $request->sub_total_s[$a],
                            'remark' => $request->remark_s[$a],
                            'name' => $request->name_s[$a],
                        ]
                    );
                }
            } else {
                SellingOrder::where('id', $id_selling)->delete();
            }
        }
        //profit
        // dd($request->id_prof['0']);
        if (empty($request->id_prof['0']) || empty($request->id_prof)) {
            Profit::where('sales_order_id', $sales_order->id)->delete();
        }
        // dd($request->id_prof);
        foreach ($request->currency_prof as $a => $v) {
            Profit::updateOrCreate(
                // ['sales_order_id' => $sales_order->id],
                ['id' => $request->id_prof[$a]],
                [
                    'sales_order_id' => $sales_order->id,
                    'currency' => $v,
                    'total_selling' => $request->total_selling_prof[$a],
                    'total_buying' => $request->total_buying_prof[$a],
                    'profit' => $request->profit[$a],
                ]
            );
        }
        return redirect(route('data_sales'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $so = SalesOrder::find($id);
        // SalesOrder::where('id', $id)->update(['deleted' => '1']);
        $details = array(
            // 'job_orders_id' => $id,
            'logs' => 'deleting sales orders with id ' . $id . ' and nomor invoice ' . $so->nomor_invoice . '',
            'user_id' => Auth::id(),
            // 'row' => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        );
        logs_user::insert($details);
        // job_order::where('id', $id)->delete();
        SalesOrder::where('id', $id)->delete();
        return redirect()->back();
    }

    // public function listordersales()
    // {
    //     // $query = SalesOrder::all();
    //     $auth = Auth::id();
    //     $query = job_order::where('created_by', $auth)->orderBy('created_at', 'desc');
    //     // $query = job_order::all();
    //     return Datatables::of(
    //         $query
    //     )->editColumn('order_id', function ($row) {
    //         return $row->order_id;
    //     })->editColumn('tipe_order', function ($row) {
    //         return $row->tipe_order;
    //     })->editColumn('created_at', function ($row) {
    //         return $row->created_at;
    //     })->editColumn('client_id', function ($row) {
    //         return $row->clients->COMPANY_NAME;
    //     })->editColumn('party', function ($row) {
    //         return $row->party;
    //     })->editColumn('pol_pod', function ($row) {
    //         return $row->pol_pod;
    //     })->addColumn('Action', function ($row) {
    //         $data = [
    //             'id' => $row->id
    //         ];
    //         return view('job_order.dt.act_order_pilih', compact('data'));
    //     })->rawColumns(['action'])->toJson();
    // }

    // public function getdataordersales(Request $request)
    // {
    //     $pid = $request->get('pid');
    //     $jobs = job_order::where('id', $pid)->first();
    //     $client_name = $jobs->clients->COMPANY_NAME;
    //     $sales_name = $jobs->sales->name;
    //     // $jobs->created_at = date("Y-m-d");
    //     // $tanggal = $jobs->created_at;
    //     $createdAt = Carbon::parse($jobs->created_at);
    //     $tanggal = $createdAt->format('Y-m-d');
    //     // $order_id = $jobs->order_id;
    //     $tipe_order = strtok($jobs->tipe_order, '-');
    //     // $jenis_order = substr($jobs->tipe_order, strpos($jobs->tipe_order, "-") + 1);
    //     // print_r($jenis_order);
    //     //end
    //     $data = array(
    //         'jobs' => $jobs,
    //         'name_client' => $client_name,
    //         // 'inv' => $inv,
    //         'tanggal' => $tanggal,
    //         'sales_name' => $sales_name,
    //     );
    //     return Response::json($data);
    // }

    public function autocomplete_desc(Request $request)
    {
        $term = $request->term;
        $queries = DB::table('item')
            ->where('ITEM', 'LIKE', '%' . $term . '%')
            // ->where('rtk', '1')
            ->get();
        $results = array();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->ITEM];
        }
        return Response::json($results);
    }

    public function autocomplete_remark(Request $request)
    {
        $term = $request->term;
        $queries = DB::table('vendors')
            ->where('nick', 'LIKE', '%' . $term . '%')
            ->orWhere('VENDOR', 'LIKE', '%' . $term . '%')
            // ->where('rtk', '1')
            ->get();
        $results = array();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->VENDOR, 'nick' => $query->nick];
        }
        return Response::json($results);
    }

    public function autocomplete_client(Request $request)
    {
        $term = $request->term;
        $queries = DB::table('clients')
            ->where('nick', 'LIKE', '%' . $term . '%')
            ->orWhere('COMPANY_NAME', 'LIKE', '%' . $term . '%')
            ->where('active', '1')
            ->get();
        $results = array();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->COMPANY_NAME, 'nick' => $query->nick];
        }
        return Response::json($results);
    }

    public function showDetailSelling($id)
    {
        $selling_orders = SellingOrder::where('sales_order_id', $id)->get();
        return view('sales_order.sales_selling', compact('selling_orders'));
    }

    public function showDetailBuying($id)
    {
        $buying_orders = BuyingOrder::where('sales_order_id', $id)->get();
        return view('sales_order.sales_buying', compact('buying_orders'));
    }

    public function showDetailDP($id)
    {
        $dp_orders = Down_Payment::where('sales_order_id', $id)->first();
        return view('sales_order.sales_dp', compact('dp_orders'));
    }

    public function showDetailProfit($id)
    {
        $profit_orders = Profit::where('sales_order_id', $id)->get();
        return view('sales_order.sales_profit', compact('profit_orders'));
    }

    public function sendtofinance($id)
    {
        SalesOrder::where('id', $id)->update(['published' => '1']);
        return redirect()->back();
    }

    public function listojobrdersalesshow()
    {
        $auth = Auth::id();
        $query = job_order::where('sales_id', $auth)->where('pickup', 0)->orderBy('created_at', 'desc');
        // $query = job_order::all();
        return Datatables::of(
            $query
        )->editColumn('order_id', function ($row) {
            return $row->order_id;
        })->addColumn('Pickup', function ($row) {
            $data = [
                'id'  => $row->id
            ];
            return view('sales_order.dt_sales.act_pickup', compact('data'));
        })->editColumn('tipe_order', function ($row) {
            return $row->tipe_order;
        })->editColumn('client_id', function ($row) {
            return $row->clients->COMPANY_NAME;
        })->editColumn('service_id', function ($row) {
            return $row->service->service_name;
        })->editColumn('via_id', function ($row) {
            return $row->via->via_name;
        })->editColumn('ETD', function ($row) {
            return $row->ETD;
        })->editColumn('ETA', function ($row) {
            return $row->ETA;
        })->addColumn('Action', function ($row) {
            $data = [
                'id'  => $row->id
            ];
            return view('sales_order.dt_sales.act_list_order', compact('data'));
        })->rawColumns(['action'])->toJson();
        // $users = User::where('department', $dept)->where('active', 1)->get();
        // return view('ticket.history', compact('data'));
    }
}

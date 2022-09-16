<?php

namespace App\Http\Controllers;

use App\Model\BOL;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Response;

class BOLController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('BOL.show');
    }

    public function getdatabol()
    {
        $query = BOL::orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('BL_NO', function ($row) {
            return $row->BL_NO;
        })->editColumn('Place_Date_Issue', function ($row) {
            return $row->Place_Date_Issue;
        })->editColumn('ON_Board_Date', function ($row) {
            return $row->ON_Board_Date;
        })->editColumn('Total_Charges', function ($row) {
            return $row->Total_Charges;
        })->addColumn('Actions', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('BOL.dt.act_list_action', compact('data'));
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('BOL.dt.act_list_more', compact('data'));
        })->rawColumns(['More'])->toJson();
    }

    public function listbol()
    {
        $query = BOL::orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('BL_NO', function ($row) {
            return $row->BL_NO;
        })->editColumn('Place_Date_Issue', function ($row) {
            return $row->Place_Date_Issue;
        })->editColumn('ON_Board_Date', function ($row) {
            return $row->ON_Board_Date;
        })->addColumn('Actions', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('BOL.dt.act_listpick', compact('data'));
        })->rawColumns(['Actions'])->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('BOL.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $BY = Carbon::parse($request->BY)->format('Y-m-d');
        $on_board_date = Carbon::parse($request->on_board_date)->format('Y-m-d');
        $bol = new BOL;
        $bol->BL_NO = $request->bl_no;
        $bol->Shipper = $request->shipper;
        $bol->Export_References = $request->export_ref;
        $bol->Consignee = $request->consignee;
        $bol->Forwarding_Agent = $request->forwarding_agent;
        $bol->Point_Country_Origin = $request->point_country_origin;
        $bol->Notify_Party = $request->notify_party;
        $bol->Obtain_Delivery = $request->delivery_contact;
        $bol->Pre_Carriage = $request->pre_carriage;
        $bol->Place_Receipt = $request->place_receipt;
        $bol->Exporting_Carrier = $request->exporting_carrier;
        $bol->Port_Loading = $request->port_loading;
        $bol->Port_Discharge = $request->Port_Discharge;
        $bol->Port_Delivery = $request->Port_Delivery;
        $bol->Transshipment_to = $request->transshipment;
        $bol->Final_destination = $request->final_destination;
        $bol->Marks_Number = $request->marks_number;
        $bol->No_Cont_Pkgs = $request->no_of_cont;
        $bol->Description_Packages_Goods = $request->description_packages;
        $bol->Gross_Weight = $request->gross_weight;
        $bol->Measurement = $request->measurement;
        $bol->Freight_Charges = $request->freight_charges;
        $bol->Prepaid = $request->prepaid;
        $bol->Collect = $request->collect;
        $bol->Total_Charges = $request->total_charges;
        $bol->Freight_Payable = $request->freight_payable;
        $bol->No_Original = $request->no_original_bl;
        $bol->BY = $BY;
        $bol->Place_Date_Issue = $request->place_and_date;
        $bol->ON_Board_Date = $on_board_date;
        $bol->save();
        return redirect(route('bol.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\BOL  $bOL
     * @return \Illuminate\Http\Response
     */
    public function show(BOL $bOL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\BOL  $bOL
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bol = BOL::find($id);
        return view('BOL.edit', compact('bol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\BOL  $bOL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $BY = Carbon::parse($request->BY)->format('Y-m-d');
        $on_board_date = Carbon::parse($request->on_board_date)->format('Y-m-d');
        $bol = BOL::find($id);
        $bol->BL_NO = $request->bl_no;
        $bol->Shipper = $request->shipper;
        $bol->Export_References = $request->export_ref;
        $bol->Consignee = $request->consignee;
        $bol->Forwarding_Agent = $request->forwarding_agent;
        $bol->Point_Country_Origin = $request->point_country_origin;
        $bol->Notify_Party = $request->notify_party;
        $bol->Obtain_Delivery = $request->delivery_contact;
        $bol->Pre_Carriage = $request->pre_carriage;
        $bol->Place_Receipt = $request->place_receipt;
        $bol->Exporting_Carrier = $request->exporting_carrier;
        $bol->Port_Loading = $request->port_loading;
        $bol->Port_Discharge = $request->port_discharge;
        $bol->Port_Delivery = $request->port_delivery;
        $bol->Transshipment_to = $request->transshipment;
        $bol->Final_destination = $request->final_destination;
        $bol->Marks_Number = $request->marks_number;
        $bol->No_Cont_Pkgs = $request->no_of_cont;
        $bol->Description_Packages_Goods = $request->description_packages;
        $bol->Gross_Weight = $request->gross_weight;
        $bol->Measurement = $request->measurement;
        $bol->Freight_Charges = $request->freight_charges;
        $bol->Prepaid = $request->prepaid;
        $bol->Collect = $request->collect;
        $bol->Total_Charges = $request->total_charges;
        $bol->Freight_Payable = $request->freight_payable;
        $bol->No_Original = $request->no_original_bl;
        $bol->BY = $BY;
        $bol->Place_Date_Issue = $request->place_and_date;
        $bol->ON_Board_Date = $on_board_date;
        $bol->save();
        return redirect(route('bol.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BOL  $bOL
     * @return \Illuminate\Http\Response
     */
    public function destroy(BOL $bOL)
    {
        //
    }

    public function getdataorder(Request $request)
    {
        $pid = $request->get('pid');
        $bols = BOL::where('id', $pid)->first();
        $data = array(
            'bols' => $bols,
        );
        return Response::json($data);
        // $tipe_name = job_order::where('order_id',$pid)->where('',$order_tipe)
        // $tipe_name = $data = job_order::find($)->artk;
    }

    public function Cetak($id)
    {
        $bol_data = BOL::find($id);
        $view = View('pdf.bol', ['data' => $bol_data]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}

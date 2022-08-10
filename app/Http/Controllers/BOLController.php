<?php

namespace App\Http\Controllers;

use App\Model\BOL;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class BOLController extends Controller
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
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('BOL.dt.act_list_more', compact('data'));
        })->rawColumns(['More'])->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(BOL $bOL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\BOL  $bOL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BOL $bOL)
    {
        //
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
}

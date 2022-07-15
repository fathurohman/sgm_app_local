<?php

namespace App\Http\Controllers;

use App\Model\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::orderBy('created_at', 'desc')->get();
        return view('mitra.show', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendor = new Vendor;
        $vendor->NPWP = $request->npwp;
        $vendor->VENDOR = $request->name;
        $vendor->ADDRESS = $request->alamat;
        $vendor->TELEPHONE = $request->telephone;
        if (empty($request->active)) {
            $vendor->active = 0;
        } else {
            $vendor->active = $request->active;
        }
        $vendor->save();
        return redirect(route('vendor.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return view('mitra.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendor = Vendor::find($id);
        $vendor->NPWP = $request->npwp;
        $vendor->VENDOR = $request->name;
        $vendor->ADDRESS = $request->alamat;
        $vendor->TELEPHONE = $request->telephone;
        if (empty($request->active)) {
            $vendor->active = 0;
        } else {
            $vendor->active = $request->active;
        }
        $vendor->save();
        return redirect(route('vendor.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vendor::where('id', $id)->delete();
        return redirect()->back();
    }

    public function showTracking($id)
    {
        $details = Vendor::where('id', $id)->first();
        return view('mitra.alamat', compact('details'));
    }
}

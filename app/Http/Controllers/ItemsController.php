<?php

namespace App\Http\Controllers;

use App\Model\Items;
use Illuminate\Http\Request;

class ItemsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::all();
        return view('items.show', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = new Items;
        $items->ITEM = $request->ITEM;
        $items->save();
        return redirect(route('items.index'))->withSuccessMessage(__('global.data_saved_successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Items::find($id);
        return view('items.edit', compact('items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $items = Items::find($id);
        $items->ITEM = $request->ITEM;
        $items->save();
        return redirect(route('items.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Items::where('id', $id)->delete();
        return redirect()->back();
    }
}

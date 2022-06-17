<?php

namespace App\Http\Controllers;

use App\Model\permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = permission::all();
        return view('permission.show', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = new permission;
        $permission->name = $request->name;
        $permission->for = $request->for;
        $permission->save();
        return redirect(route('permission.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = permission::find($id);
        return view('permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = permission::find($id);
        $permission->name = $request->name;
        $permission->for = $request->for;
        $permission->save();
        return redirect(route('permission.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        permission::where('id', $id)->delete();
        return redirect()->back();
    }
}

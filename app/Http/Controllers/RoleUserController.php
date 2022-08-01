<?php

namespace App\Http\Controllers;

use App\Model\role;
use App\Model\roleuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ru = roleuser::all();
        return view('user_role.show', compact('ru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = role::all();
        return view('user_role.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->name);
        $ru = new roleuser;
        $ru->user_id = $request->name;
        $ru->role_id = $request->for;
        $ru->save();
        return redirect(route('roleuser.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function autocomplete_username(Request $request)
    {
        $term = $request->term;
        $queries = DB::table('users')
            ->where('name', 'LIKE', '%' . $term . '%')
            // ->where('rtk', '1')
            ->get();
        $results = array();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->name];
        }
        return Response::json($results);
    }
}

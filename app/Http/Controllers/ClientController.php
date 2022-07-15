<?php

namespace App\Http\Controllers;

use App\Model\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::orderBy('created_at', 'desc')->get();
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client;
        $client->NPWP = $request->npwp;
        $client->COMPANY_NAME = $request->name;
        $client->ADDRESS = $request->alamat;
        $client->TELEPHONE = $request->telephone;
        if (empty($request->active)) {
            $client->active = 0;
        } else {
            $client->active = $request->active;
        }
        $client->save();
        return redirect(route('client.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->NPWP = $request->npwp;
        $client->COMPANY_NAME = $request->name;
        $client->ADDRESS = $request->alamat;
        $client->TELEPHONE = $request->telephone;
        if (empty($request->active)) {
            $client->active = 0;
        } else {
            $client->active = $request->active;
        }
        $client->save();
        return redirect(route('client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::where('id', $id)->delete();
        return redirect()->back();
    }

    public function showTracking($id)
    {
        $details = Client::where('id', $id)->first();
        return view('client.alamat', compact('details'));
    }
}

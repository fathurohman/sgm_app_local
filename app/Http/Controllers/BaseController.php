<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use View;
use RealRashid\SweetAlert\Facades\Alert;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success_message')) {
                Alert::success('Success!', session('success_message'));
            }
            $foto = Auth::user()->foto;
            $data = array(
                'foto' => $foto,
            );
            View::share('data', $data);
            return $next($request);
        });
    }
}

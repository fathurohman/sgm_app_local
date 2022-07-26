<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use View;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $foto = Auth::user()->foto;
            $data = array(
                'foto' => $foto,
            );
            View::share('data', $data);
            return $next($request);
        });
    }
}

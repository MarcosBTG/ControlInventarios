<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Auth::guest()) {
            return view('products.catalogue');
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

}

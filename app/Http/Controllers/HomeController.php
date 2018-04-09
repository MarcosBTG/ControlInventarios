<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class) {
                
            return view('/products/index');
            }
        } else {
            return redirect('/')->with('error', 'No tienes permiso para realizar esta acción. Intenta iniciando sesi&oacute;n');
        }
    }

}

<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PainelController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
	 
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
	public function index()
    {
        //return view('home');
        return view('painel.index');
    }

    public function perfil()
    {
        //return view('home');
        return view('painel\perfil');
    }
}

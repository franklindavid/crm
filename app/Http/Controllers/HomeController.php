<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
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
        $anio=date("Y");
        $mes=date("m");
        if (Auth::user()->type == 'admin'){
            return view('homes.homeadmin')->with("anio",$anio)->with("mes",$mes);
        }
        if (Auth::user()->type == 'advisor'){
            return view('homes.homeadvisor')->with("anio",$anio);
        }
        if (Auth::user()->type == 'customer_service_manager'){
            return view('homes.homecostumerservicemanager')->with("anio",$anio);
        }
        if (Auth::user()->type == 'marketing_manager'){
            return view('homes.homemarketingmanager');
        }
        if (Auth::user()->type == 'technical'){
            return view('homes.hometechnical');
        }
        if (Auth::user()->type == 'sales_manager'){
            return view('homes.homesalesmanager')->with("anio",$anio)->with("mes",$mes);
        }
    }
}

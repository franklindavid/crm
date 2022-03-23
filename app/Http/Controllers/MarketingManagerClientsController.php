<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use App\Referred;
use App\Product;  
use App\Negotiation;
use App\DetalleNegociacion;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use Auth;

class MarketingManagerClientsController extends Controller
{
    public function index(Request $request){
        $clients=Client::where('name', 'LIKE', '%'.$request->name.'%')->orwhere('cedula', 'LIKE', '%'.$request->name.'%')->orwhere('email', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
        return view('marketingmanager.clients.index')->with('clients',$clients)->with('request',$request->name); 
    }
    public function show($id){
        
    }
    public function index2($id){
        $client = Client::find($id);
        $referreds = Referred::where('client_id', '=', $id)->simplePaginate(11);
        return view('marketingmanager.clients.index2')->with('client',$client)->with('referreds',$referreds);        
    }
    public function negotiations($id){
        $negotiations = Negotiation::where('client_id', '=', $id)->where('estado', '!=', 'ganada')->simplePaginate(11);
        $client = Client::find($id);
        return view('marketingmanager.clients.negotiations')->with('negotiations',$negotiations)->with('client',$client);
    }
    public function sales($id){
        $sales = Negotiation::where('client_id', '=', $id)->where('estado', '=', 'ganada')->simplePaginate(11);
        $client = Client::find($id);
        return view('marketingmanager.clients.sales')->with('sales',$sales)->with('client',$client);
    }
    public function details($id){
        $client = Client::find($id);
        return view('marketingmanager.clients.show')->with('client',$client);    
    }
}

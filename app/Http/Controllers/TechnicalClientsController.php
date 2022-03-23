<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use App\Ticket; 

class TechnicalClientsController extends Controller
{
    public function index(Request $request){ 
        $clients = Client::where('cedula', 'LIKE', '%'.$request->name.'%')->Paginate(11);  
//        $clients=Client::where('name', 'LIKE', '%'.$request->name.'%')->orwhere('cedula', 'LIKE', '%'.$request->name.'%')->orwhere('email', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
        return view('technical.clients.index')->with('clients',$clients)->with('clients',$clients)->with('request',$request->name); 
    }
    public function ticket($id){ 
        $client = Client::find($id);
        $ticketspendientes = Ticket::where('client_id', '=', $id)->where('estado', '=', 'pendiente')->orderBy('id','ASC')->Paginate(11);
        $ticketsresueltos = Ticket::where('client_id', '=', $id)->where('estado', '=', 'resuelto')->orderBy('id','DESC')->Paginate(11);
        return view('technical.clients.ticket')->with('ticketspendientes',$ticketspendientes)->with('ticketsresueltos',$ticketsresueltos)->with('client',$client); 
    } 
    public function show($id){
        $client = Client::find($id);
        return view('technical.clients.show')->with('client',$client);    
    }
}
 
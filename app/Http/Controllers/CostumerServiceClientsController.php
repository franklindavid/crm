<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use App\Ticket;
 
class CostumerServiceClientsController extends Controller
{
   public function index(Request $request){ 
        $clients = Client::where('cedula', 'LIKE', '%'.$request->name.'%')->Paginate(11); 
        return view('costumerservicemanager.clients.index')->with('clients',$clients)->with('clients',$clients)->with('request',$request->name); 
    }
    public function ticket($id){
        $ticketspendientes = Ticket::where('client_id', '=', $id)->where('estado', '=', 'pendiente')->orderBy('id','ASC')->Paginate(11);
        $ticketsresueltos = Ticket::where('client_id', '=', $id)->where('estado', '=', 'resuelto')->orderBy('id','DESC')->Paginate(11);
        return view('costumerservicemanager.clients.ticket')->with('ticketspendientes',$ticketspendientes)->with('ticketsresueltos',$ticketsresueltos); 
    } 
    public function show($id){
        $client = Client::find($id);
        return view('costumerservicemanager.clients.show')->with('client',$client);    
    }
}
 
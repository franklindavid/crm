<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Ticket;
use Auth; 

class TechnicalTicketController extends Controller
{ 
     public function index(){
        $ticketspendientes = Ticket::where('user_id', '=', Auth::user()->id)->where('estado', '=', 'pendiente')->orderBy('prioridad','ASC')->Paginate(11);
        $ticketsresueltos = Ticket::where('user_id', '=', Auth::user()->id)->where('estado', '=', 'resuelto')->orderBy('id','DESC')->Paginate(11);
//         dd($ticketspendientes);
        return view('technical.tickets.index')->with('ticketspendientes',$ticketspendientes)->with('ticketsresueltos',$ticketsresueltos); 
    } 
    public function resuelto($id){
        $ticket = Ticket::find($id);
        $ticket->estado='resuelto';
        $ticket->update();
        flash('se ha enviado a resueltos el ticket numero '.$ticket->id.' de forma exitosa!', 'success');
        return redirect()->route('technical.tickets.index');
    }
    public function pendiente($id){  
        $ticket = Ticket::find($id);
        $ticket->estado='pendiente';
        $ticket->update();
        flash('se ha enviado a pendientes el ticket numero '.$ticket->id.' de forma exitosa!', 'success');
        return redirect()->route('technical.tickets.index');
    }
}

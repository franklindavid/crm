<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Ticket;

class TechnicalsController extends Controller
{
    public function index(){
        $technicals = User::where('type', '=', 'technical')->Paginate(11);
        return view('costumerservicemanager.technicals.index')->with('technicals',$technicals); 
    }
    public function ticket($id){
        $ticketspendientes = Ticket::where('user_id', '=', $id)->where('estado', '=', 'pendiente')->orderBy('id','ASC')->Paginate(11);
        $ticketsresueltos = Ticket::where('user_id', '=', $id)->where('estado', '=', 'resuelto')->orderBy('id','DESC')->Paginate(11);
//        dd($tickets);
        return view('costumerservicemanager.technicals.ticket')->with('ticketspendientes',$ticketspendientes)->with('ticketsresueltos',$ticketsresueltos); 
    } 
}
 
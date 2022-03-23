<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Ticket;
use App\Client;
use App\User;  
use App\Product; 

class TicketsController extends Controller
{
    public function index(){
        $ticketsunassigned =Ticket::orderBy('id','DESC')->where('estado', '=', 'unassigned')->Paginate(11);
        $ticketsresueltos =Ticket::orderBy('id','DESC')->where('estado', '=', 'resuelto')->Paginate(11);
        $ticketspendientes =Ticket::orderBy('prioridad','ASC')->where('estado', '=', 'pendiente')->Paginate(11);
        $ticketsdescartados =Ticket::orderBy('id','DESC')->where('estado', '=', 'descartado')->Paginate(11);
//        $ticket = Ticket::find(2);
//        dd($ticket->products);
        return view('costumerservicemanager.tickets.index')->with('ticketsresueltos',$ticketsresueltos)->with('ticketspendientes',$ticketspendientes)->with('ticketsdescartados',$ticketsdescartados)->with('ticketsunassigned',$ticketsunassigned);  
    } 
    public function create(){ 
        $clients = Client::orderBy('id','ASC')->lists('name','id');
        $technicals = User::where('type', '=', 'technical')->lists('name','id');
        $products = Product::orderBy('id','ASC')->lists('name','id'); 
        return view('costumerservicemanager.tickets.create')->with('clients',$clients)->with('technicals',$technicals)->with('products',$products);
    }
    public function asignar($id){
        $ticket = Ticket::find($id);
        $clients = Client::orderBy('id','ASC')->lists('name','id');
        $products = Product::orderBy('id','ASC')->lists('name','id');
        $technicals = User::where('type', '=', 'technical')->lists('name','id');
        return view('costumerservicemanager.tickets.asignar')->with('ticket',$ticket)->with('clients',$clients)->with('technicals',$technicals)->with('products',$products);
    }
    public function descartar($id){
        $ticket = Ticket::find($id);
        $ticket->estado='descartado';
        $ticket->update();
        flash('se ha descartado el ticket numero '.$ticket->id.' de forma exitosa!', 'warning');
        $ticketsunassigned =Ticket::orderBy('id','DESC')->where('estado', '=', 'unassigned')->Paginate(11);
        $ticketsresueltos =Ticket::orderBy('id','DESC')->where('estado', '=', 'resuelto')->Paginate(11);
        $ticketspendientes =Ticket::orderBy('prioridad','ASC')->where('estado', '=', 'pendiente')->Paginate(11);
        $ticketsdescartados =Ticket::orderBy('id','DESC')->where('estado', '=', 'descartado')->Paginate(11);
        return back();
//        return view('costumerservicemanager.tickets.index')->with('ticketsresueltos',$ticketsresueltos)->with('ticketspendientes',$ticketspendientes)->with('ticketsdescartados',$ticketsdescartados)->with('ticketsunassigned',$ticketsunassigned);  
    }
    public function resuelto($id){
        $ticket = Ticket::find($id);
        $ticket->estado='resuelto';
        $ticket->update();
        flash('se ha enviado a resueltos el ticket numero '.$ticket->id.' de forma exitosa!', 'success');
        $ticketsunassigned =Ticket::orderBy('id','DESC')->where('estado', '=', 'unassigned')->Paginate(11);
        $ticketsresueltos =Ticket::orderBy('id','DESC')->where('estado', '=', 'resuelto')->Paginate(11);
        $ticketspendientes =Ticket::orderBy('prioridad','ASC')->where('estado', '=', 'pendiente')->Paginate(11);
        $ticketsdescartados =Ticket::orderBy('id','DESC')->where('estado', '=', 'descartado')->Paginate(11);
        return back();
//        return view('costumerservicemanager.tickets.index')->with('ticketsresueltos',$ticketsresueltos)->with('ticketspendientes',$ticketspendientes)->with('ticketsdescartados',$ticketsdescartados)->with('ticketsunassigned',$ticketsunassigned);  
    }
    public function pendiente($id){
        $ticket = Ticket::find($id);
        $ticket->estado='pendiente';
        $ticket->update();
        flash('se ha enviado a pendientes el ticket numero '.$ticket->id.' de forma exitosa!', 'success');
        $ticketsunassigned =Ticket::orderBy('id','DESC')->where('estado', '=', 'unassigned')->Paginate(11);
        $ticketsresueltos =Ticket::orderBy('id','DESC')->where('estado', '=', 'resuelto')->Paginate(11);
        $ticketspendientes =Ticket::orderBy('prioridad','ASC')->where('estado', '=', 'pendiente')->Paginate(11);
        $ticketsdescartados =Ticket::orderBy('id','DESC')->where('estado', '=', 'descartado')->Paginate(11);
        return back();
//        return view('costumerservicemanager.tickets.index')->with('ticketsresueltos',$ticketsresueltos)->with('ticketspendientes',$ticketspendientes)->with('ticketsdescartados',$ticketsdescartados)->with('ticketsunassigned',$ticketsunassigned);  
    }
    public function store(Request $request){
        $ticket= new Ticket($request->all());
        $ticket->save();
        if ($request->products){
            $ticket->products()->sync($request->products);
        }
        flash('se guardado el ticket numero '.$ticket->id.' de forma exitosa!', 'success');
        $ticketsunassigned =Ticket::orderBy('id','DESC')->where('estado', '=', 'unassigned')->Paginate(11);
        $ticketsresueltos =Ticket::orderBy('id','DESC')->where('estado', '=', 'resuelto')->Paginate(11);
        $ticketspendientes =Ticket::orderBy('prioridad','ASC')->where('estado', '=', 'pendiente')->Paginate(11);
        $ticketsdescartados =Ticket::orderBy('id','DESC')->where('estado', '=', 'descartado')->Paginate(11);
//        return back();
        return view('costumerservicemanager.tickets.index')->with('ticketsresueltos',$ticketsresueltos)->with('ticketspendientes',$ticketspendientes)->with('ticketsdescartados',$ticketsdescartados)->with('ticketsunassigned',$ticketsunassigned);  
    }
    public function edit($id){
        $ticket = Ticket::find($id);
        $clients = Client::orderBy('id','ASC')->lists('name','id');
        $technicals = User::where('type', '=', 'technical')->lists('name','id');
        $products = Product::orderBy('id','ASC')->lists('name','id');
        $my_products=$ticket->products->lists('id')->ToArray();
        return view('costumerservicemanager.tickets.edit')->with('ticket',$ticket)->with('clients',$clients)->with('technicals',$technicals)->with('products',$products)->with('my_products',$my_products);          
    }
    public function update(Request $request, $id){
        $ticket = Ticket::find($id);
        $ticket->fill($request->all());
        if ($request->client_id==""){
           $ticket->client_id=null;
        }
        if ($request->user_id==""){
           $ticket->user_id=null;
        }
        if ($request->products){
            $ticket->products()->sync($request->products);
        }  
        $ticket->update();
        flash('se ha enviado a modificado el ticket numero '.$ticket->id.' de forma exitosa!', 'success');
        $ticketsunassigned =Ticket::orderBy('id','DESC')->where('estado', '=', 'unassigned')->Paginate(11);
        $ticketsresueltos =Ticket::orderBy('id','DESC')->where('estado', '=', 'resuelto')->Paginate(11);
        $ticketspendientes =Ticket::orderBy('prioridad','ASC')->where('estado', '=', 'pendiente')->Paginate(11);
        $ticketsdescartados =Ticket::orderBy('id','DESC')->where('estado', '=', 'descartado')->Paginate(11);
        return back();
//        return view('costumerservicemanager.tickets.index')->with('ticketsresueltos',$ticketsresueltos)->with('ticketspendientes',$ticketspendientes)->with('ticketsdescartados',$ticketsdescartados)->with('ticketsunassigned',$ticketsunassigned);  
        
    }
    public function update2(Request $request, $id){
//        dd($request->all());
        $ticket = Ticket::find($id);
        $ticket->fill($request->all());
        $ticket->estado='pendiente';
        //         dd($request->client_id);
        if ($request->client_id==""){
           $ticket->client_id=null;
        }
        if ($request->user_id==""){
           $ticket->user_id=null;
        }
//                dd($ticket);
        if ($request->products){
            $ticket->products()->sync($request->products);
        }        
        $ticket->update();
        flash('se ha enviado a pendientes el ticket numero '.$ticket->id.' de forma exitosa!', 'success');
        $ticketsunassigned =Ticket::orderBy('id','DESC')->where('estado', '=', 'unassigned')->Paginate(11);
        $ticketsresueltos =Ticket::orderBy('id','DESC')->where('estado', '=', 'resuelto')->Paginate(11);
        $ticketspendientes =Ticket::orderBy('prioridad','ASC')->where('estado', '=', 'pendiente')->Paginate(11);
        $ticketsdescartados =Ticket::orderBy('id','DESC')->where('estado', '=', 'descartado')->Paginate(11);
//        return back();
        return view('costumerservicemanager.tickets.index')->with('ticketsresueltos',$ticketsresueltos)->with('ticketspendientes',$ticketspendientes)->with('ticketsdescartados',$ticketsdescartados)->with('ticketsunassigned',$ticketsunassigned);  
    }
    public function destroy($id){
        $ticket = Ticket::find($id);
        $ticket->delete();
        flash('se ha eliminado el ticket numero '.$ticket->id.' de forma exitosa!', 'danger');
        $ticketsunassigned =Ticket::orderBy('id','DESC')->where('estado', '=', 'unassigned')->Paginate(11);
        $ticketsresueltos =Ticket::orderBy('id','DESC')->where('estado', '=', 'resuelto')->Paginate(11);
        $ticketspendientes =Ticket::orderBy('prioridad','ASC')->where('estado', '=', 'pendiente')->Paginate(11);
        $ticketsdescartados =Ticket::orderBy('id','DESC')->where('estado', '=', 'descartado')->Paginate(11);
        return back();
//        return view('costumerservicemanager.tickets.index')->with('ticketsresueltos',$ticketsresueltos)->with('ticketspendientes',$ticketspendientes)->with('ticketsdescartados',$ticketsdescartados)->with('ticketsunassigned',$ticketsunassigned);  
    }
}
 
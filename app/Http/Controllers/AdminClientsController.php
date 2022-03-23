<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client; 
use App\Referred;
use App\Negotiation; 
use App\Task; 
use App\Http\Requests\ClientUpdateRequest;
use App\Ticket; 

class AdminClientsController extends Controller
{
    public function index(Request $request){ 
        $clients=Client::where('name', 'LIKE', '%'.$request->name.'%')->orwhere('cedula', 'LIKE', '%'.$request->name.'%')->orwhere('email', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
//        $clients = Client::orderBy('id','ASC')->paginate(11);
        return view('admin.clients.index')->with('clients',$clients)->with('clients',$clients)->with('request',$request->name); 
    }
    public function index2($id){
        $client = Client::find($id);
        $referreds = Referred::where('client_id', '=', $id)->simplePaginate(11);
        return view('admin.clients.index2')->with('client',$client)->with('referreds',$referreds); 
    }
    public function show($id){
       $client = Client::find($id);
       return view('admin.clients.show')->with('client',$client);
    }
    public function negotiations($id){
       $negotiations = Negotiation::where('client_id', '=', $id)->where('estado', '!=', 'ganada')->simplePaginate(11);
       $client = Client::find($id);
       return view('admin.clients.negotiations')->with('negotiations',$negotiations)->with('client',$client);
    }  
    public function sales($id){
       $negotiations = Negotiation::where('client_id', '=', $id)->where('estado', '=', 'ganada')->simplePaginate(11);
       $client = Client::find($id);
       return view('admin.clients.sales')->with('negotiations',$negotiations)->with('client',$client);
    }   
    public function edit($id){ 
        $client = Client::find($id);
        return view('admin.clients.edit')->with('client',$client);
    }
    
    public function update(ClientUpdateRequest $request, $id){                
        $client = Client::find($id);
        $client->fill($request->all());
        $client->save();
        flash('se ha modificado el '.$client->estado.' '.$client->name.' de forma exitosa!', 'success');
        return redirect()->route('admin.clients.index');
    }
    
    public function destroy($id){
        $client = Client::find($id);
        $referred = Referred::where('padre_id', '=', $id);
        $referred->delete();
        $client->delete();
        flash('se ha eliminado '.$client->name.' de forma exitosa!', 'warning');
        return redirect()->route('admin.clients.index');    
    }
    public function ticket($id){
        $client = Client::find($id);
        $ticketspendientes = Ticket::where('client_id', '=', $id)->where('estado', '=', 'pendiente')->orderBy('id','ASC')->Paginate(11);
        $ticketsresueltos = Ticket::where('client_id', '=', $id)->where('estado', '=', 'resuelto')->orderBy('id','DESC')->Paginate(11);
        return view('admin.clients.ticket')->with('ticketspendientes',$ticketspendientes)->with('ticketsresueltos',$ticketsresueltos)->with('client',$client); 
    } 
    public function statsclient($id){
        $client = Client::find($id);
        return view('admin.clients.statsclient')->with('id',$id)->with('client',$client);
    } 
    public function statsprospec($id){
        $client = Client::find($id);
        return view('admin.clients.statsprospect')->with('id',$id)->with('client',$client);
    } 
    public function tasks($id){
        $client = Client::find($id);
        ////// tareas para hoy
        $inicio=(date("Y-m-d").' 00:00:00 ');
        $fin=(date("Y-m-d").' 23:59:00 ');
        $taskstoday= Task::whereBetween('fecha', [$inicio,  $fin])->where('client_id', '=', $id)->orderBy('prioridad','ASC')->Paginate(11);
        ///// tareas para mas adelante
        $dia=(date("d")+1);
        $inicio=(date("Y-m").'-'.$dia.' 00:00:00 ');
        $mes=(date("m")+1);
        $fin=(date("Y").'-'.$mes.'-'.($dia-1).' 23:59:00 ');
        $tasksnext= Task::whereBetween('fecha', [$inicio,  $fin])->where('client_id', '=', $id)->orderBy('prioridad','ASC')->Paginate(11);
        ////// tareas viejas
        $dia=(date("d")-1);
        $fin=(date("Y-m").'-'.$dia.' 23:59:00 ');
        $mes=(date("m")-1);
        $inicio=(date("Y").'-'.$mes.'-'.($dia+1).' 00:00:00 ');
        $tasksold= Task::whereBetween('fecha', [$inicio,  $fin])->where('client_id', '=', $id)->orderBy('prioridad','ASC')->Paginate(11);
        return view('admin.clients.tasks')->with('tasksold',$tasksold)->with('taskstoday',$taskstoday)->with('tasksnext',$tasksnext)->with('client',$client); 
        ////////////////////////////////
    } 
    public function createtasks($id){
        $client = Client::find($id); 
        return view('admin.clients.createtasks')->with('client',$client);
    }
}

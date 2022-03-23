<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; 
use App\Client;
use App\User;
use App\Referred;   
use App\Product;
use App\Negotiation;
use App\DetalleNegociacion;
use App\Task;
use App\Http\Requests\ClientRequest; 
use App\Http\Requests\ClientUpdateRequest;
use Auth;  
class SalesManagerClientsController extends Controller
{
    public function index(Request $request){
        $clients = Client::search($request->name)->Paginate(11); 
        return view('salesmanager.clients.index')->with('clients',$clients)->with('request',$request->name); 
    }
    public function generalclients(Request $request){
//        $clients = Client::orderBy('id','ASC')->paginate(11);
        $clients=Client::where('name', 'LIKE', '%'.$request->name.'%')->orwhere('cedula', 'LIKE', '%'.$request->name.'%')->orwhere('email', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
//        $clients = $clients->where('user_id', '=', Auth::user()->id)->paginate(11);
//        dd($clients->where('user_id', '=', Auth::user()->id));
        
//        $clients = $clients::where('user_id', '=', Auth::user()->id)->Paginate(11);
        return view('salesmanager.clients.generalclients')->with('clients',$clients)->with('request',$request->name); 
    }
    public function index2($id){
        $client = Client::find($id);
        $referreds = Referred::where('client_id', '=', $id)->simplePaginate(11);
         return view('salesmanager.clients.index2')->with('client',$client)->with('referreds',$referreds);        
    }
    public function create(){
        return view('salesmanager.clients.create');
    }
    public function create2($id){
        $client = Client::find($id);    
        return view('salesmanager.clients.create2')->with('client',$client);
    }
    
    public function store(ClientRequest $request){        
        $client= new Client($request->all());         
        $client->save();
        flash('se ha registrado '.$client->name.' de forma exitosa!', 'success');
        return redirect()->route('salesmanager.clients.index');
    }
    public function store2(ClientRequest $request){        
        $client= new Client($request->all());  
        $client->save();
        $referred= new Referred($request->all());
        $referred->padre_id=$client->id;
        $referred->save();
        $referreds = Referred::orderBy('id','ASC')->paginate(5);
        flash('se ha registrado '.$referred->name.' de forma exitosa!', 'success');
        return redirect()->route('salesmanager.clients.index2',$referred->client_id)->with('client',$referred->client_id)->with('referreds',$referreds);;
    }

    public function storenegotiation(Request $request){       
        $negotiation= new Negotiation($request->all());
        if ($negotiation->estado=='ganada'){
            $client = Client::find($negotiation->client_id);
            $client->estado='cliente';
            $client->save();
        }   
        $negotiation->save();        
          if ($request->idservicio){
            $negotiation->products()->sync($request->idservicio);
        }
        $idproducto=$request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $cont = 0;
            while ($cont < count($idproducto)) {
                $detalle = new DetalleNegociacion();
                $detalle->negotiation_id=$negotiation->id;
                $detalle->product_id=$idproducto[$cont];                
                $detalle->cantidad=$cantidad[$cont];
                $detalle->save();
                $cont=$cont+1;
            }
        flash('se ha registrado la negociacion de forma exitosa!', 'success');
        return redirect()->route('salesmanager.negotiations.index');
    } 
    public function show($id){
        
    }
    public function negotiations($id){
        $negotiations = Negotiation::where('client_id', '=', $id)->where('estado', '!=', 'ganada')->Paginate(11);     
        $client = Client::find($id);
        return view('salesmanager.clients.negotiations')->with('negotiations',$negotiations)->with('client',$client);        
    }
    public function sales($id){
        $negotiations = Negotiation::where('client_id', '=', $id)->where('estado', '=', 'ganada')->Paginate(11);        
        $client = Client::find($id);
        return view('salesmanager.clients.sales')->with('negotiations',$negotiations)->with('client',$client);        
    }
    public function createnegotiations($id){ 
        $client = Client::find($id); 
        $products = Product::where('flag', '=', 1)->get();
        $services = Product::where('flag', '=', 0)->get();
        return view('salesmanager.clients.createnegotiations')->with('client',$client)->with('products',$products)->with('services',$services);
        
    }
    public function createsales($id){ 
        $client = Client::find($id); 
        $products = Product::where('flag', '=', 1)->get();
        $services = Product::where('flag', '=', 0)->get();
        return view('salesmanager.clients.createsales')->with('client',$client)->with('products',$products)->with('services',$services);
        
    }
    public function edit($id){
        $users=User::orderBy('name','ASC')->where('type', '=', 'advisor')->orwhere('type', '=', 'sales_manager')->lists('name','id');
//        dd($users);
        $client = Client::find($id);
        return view('salesmanager.clients.edit')->with('client',$client)->with('client',$client)->with('users',$users);        
    }
    public function edit2($id){   
        $users=User::orderBy('name','ASC')->where('type', '=', 'advisor')->lists('name','id');
//        dd($users);
        $client = Client::find($id);
        return view('salesmanager.clients.edit2')->with('client',$client)->with('client',$client)->with('users',$users);     
    }
    public function update(ClientUpdateRequest $request, $id){   
        $client = Client::find($id);
        $client->fill($request->all());
        $client->save();
        flash('se ha modificado el '.$client->estado.' '.$client->name.' de forma exitosa!', 'success');
        return redirect()->route('salesmanager.clients.index');
    }
    
    public function destroy($id){
//        $client = Client::find($id);
//        $referred = Referred::where('padre_id', '=', $id);
//        $referred->delete();
//        $client->delete();
//        flash('se ha eliminado '.$client->name.' de forma exitosa!', 'warning');
//        return redirect()->route('salesmanager.clients.index');    
    }
    
    public function details($id){
        $client = Client::find($id);
        return view('salesmanager.clients.show')->with('client',$client);    
    }
    
    
    public function statsclient($id){
        $client = Client::find($id);
        return view('salesmanager.clients.statsclient')->with('id',$id)->with('client',$client);
    } 
    public function statsprospec($id){
        $client = Client::find($id);
        return view('salesmanager.clients.statsprospect')->with('id',$id)->with('client',$client);
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
        return view('salesmanager.clients.tasks')->with('tasksold',$tasksold)->with('taskstoday',$taskstoday)->with('tasksnext',$tasksnext)->with('client',$client); 
        ////////////////////////////////
        $tasks = Task::where('client_id', '=', $id)->orderBy('prioridad','ASC')->Paginate(11); 
        $client = Client::find($id);
        return view('salesmanager.clients.tasks')->with('tasks',$tasks)->with('client',$client);
    } 
public function createtasks($id){
        $client = Client::find($id); 
        return view('salesmanager.clients.createtasks')->with('client',$client);
    }
}

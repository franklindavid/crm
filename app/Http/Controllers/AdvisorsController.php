<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; 
use App\User;
use App\Negotiation;
use App\Client; 
use App\Referred; 
use App\Task; 
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\SalesManagerAdvisorUpdateRequest;
use App\Http\Requests\ClientUpdateRequest; 

class AdvisorsController extends Controller 
{  
    public function index(Request $request){
        $advisors = User::where('type', '=', 'advisor')->where('name', 'LIKE', '%'.$request->name.'%')->Paginate(11);
        return view('salesmanager.advisors.index')->with('advisors',$advisors)->with('request',$request->name);
    }
    public function create(){
//        return view('salesmanager.advisors.create');
    } 
    public function store(AdminUserRequest $request){
//        dd($request);
//        $user= new User($request->all());
//        $user->password=bcrypt($request->password);
//        $user->save();
//        flash('se ha registrado '.$user->name.' de forma exitosa!', 'success');
//        return redirect()->route('salesmanager.advisors.index');
    }
    public function edit($id){
        $user = User::find($id);
        return view('salesmanager.advisors.edit')->with('user',$user);        
    }
    public function update(SalesManagerAdvisorUpdateRequest $request, $id){
        $user = User::find($id);
        $user->fill($request->all());
        $user->password=bcrypt($request->password);
        $user->save();
        flash('se ha modificado el Asesor '.$user->name.' de forma exitosa!', 'success');
        return redirect()->route('salesmanager.advisors.index');        
    }
    public function destroy($id){
//        $user = User::find($id);
//        $user->delete();
//        flash('se ha eliminado '.$user->name.' de forma exitosa!', 'warning');
//        return redirect()->route('salesmanager.advisors.index');
    
    } 
     public function index2($id){
        $clients = Client::where('user_id', '=', $id)->Paginate(11);
        return view('salesmanager.advisors.index2')->with('clients',$clients); 
    }
    public function negociacion($id){
        $advisor = User::find($id);
        $negotiations = Negotiation::where('user_id', '=', $id)->where('estado', '!=', 'ganada')->Paginate(11);
        return view('salesmanager.advisors.negociacion')->with('negotiations',$negotiations)->with('advisor',$advisor); 
    } 
    public function venta($id){
        $advisor = User::find($id);
        $negotiations = Negotiation::where('user_id', '=', $id)->where('estado', '=', 'ganada')->Paginate(11);
        return view('salesmanager.advisors.venta')->with('negotiations',$negotiations)->with('advisor',$advisor); 
    }
    public function referreds($id){
        $client = Client::find($id);
        $referreds = Referred::where('client_id', '=', $id)->simplePaginate(11);
//        dd($referreds);
         return view('salesmanager.advisors.referreds')->with('client',$client)->with('referreds',$referreds);  
    }
    public function negotiations($id){
        $negotiations = Negotiation::where('user_id', '=', $id)->where('estado', '!=', 'ganada')->Paginate(11);   
        $client = Client::find($id);
        return view('salesmanager.advisors.negotiations')->with('negotiations',$negotiations)->with('client',$client);          
    }
    public function sales($id){
        $negotiations = Negotiation::where('user_id', '=', $id)->where('estado', '=', 'ganada')->Paginate(11);     
        $client = Client::find($id);
        return view('salesmanager.advisors.sales')->with('negotiations',$negotiations)->with('client',$client);          
    }
    public function clients($id){
        $users=User::orderBy('name','ASC')->where('type', '=', 'advisor')->lists('name','id');
//        dd($users);
        $client = Client::find($id);
        return view('salesmanager.advisors.editclient')->with('client',$client)->with('users',$users);   
    } 
    public function updateclients(ClientUpdateRequest $request, $id){   
        $client = Client::find($id);
        $client->fill($request->all());
        $client->save();
        flash('se ha modificado el '.$client->estado.' '.$client->name.' de forma exitosa!', 'success');
        return redirect()->route('salesmanager.advisors.index');
    }
    public function stats($id){
        $advisor = User::find($id);
        return view('salesmanager.advisors.stats')->with('id',$id)->with('advisor',$advisor);
    } 
    public function tasks($id){
        $advisor = User::find($id);
        ////// tareas para hoy
        $inicio=(date("Y-m-d").' 00:00:00 ');
        $fin=(date("Y-m-d").' 23:59:00 ');
        $taskstoday= Task::whereBetween('fecha', [$inicio,  $fin])->where('user_id', '=', $id)->orderBy('prioridad','ASC')->Paginate(11);
        ///// tareas para mas adelante
        $dia=(date("d")+1);
        $inicio=(date("Y-m").'-'.$dia.' 00:00:00 ');
        $mes=(date("m")+1);
        $fin=(date("Y").'-'.$mes.'-'.($dia-1).' 23:59:00 ');
        $tasksnext= Task::whereBetween('fecha', [$inicio,  $fin])->where('user_id', '=', $id)->orderBy('prioridad','ASC')->Paginate(11);
        ////// tareas viejas
        $dia=(date("d")-1);
        $fin=(date("Y-m").'-'.$dia.' 23:59:00 ');
        $mes=(date("m")-1);
        $inicio=(date("Y").'-'.$mes.'-'.($dia+1).' 00:00:00 ');
        $tasksold= Task::whereBetween('fecha', [$inicio,  $fin])->where('user_id', '=', $id)->orderBy('prioridad','ASC')->Paginate(11);
//        $tasks = Task::where('user_id', '=', Auth::user()->id)->orderBy('prioridad','ASC')->Paginate(11); 
        return view('salesmanager.advisors.tasks')->with('tasksold',$tasksold)->with('taskstoday',$taskstoday)->with('tasksnext',$tasksnext)->with('advisor',$advisor);
    }
    public function createtasks($id){
        $clients = Client::where('user_id', '=', $id)->lists('name','id');
        $advisor = User::find($id);
        return view('salesmanager.advisors.createtasks')->with('clients',$clients)->with('advisor',$advisor);
    }
    public function schedules($id){
         $advisor = User::find($id);
         return view('salesmanager.advisors.schedules')->with('id',$id)->with('advisor',$advisor);        
    }
}
 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User; 
use App\Client;
use App\Negotiation;
use App\Sale;
use App\Task; 
use App\Http\Requests\AdminUserRequest; 
use App\Http\Requests\AdminUserUpdateRequest;
use App\Http\Requests\AdminUserUpdatePasswordRequest;

class UsersController extends Controller
{
   public function index(Request $request){ 
//       dd($request);
        $users=User::where('name', 'LIKE', '%'.$request->name.'%')->orwhere('type', 'LIKE', '%'.$request->name.'%')->orwhere('email', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
        return view('admin.users.index')->with('users',$users)->with('request',$request->name);
    } 
    public function index2($id){
        $clients = Client::where('user_id', '=', $id)->Paginate(11);
        return view('admin.users.index2')->with('clients',$clients); 
    }
    public function negociacion($id){
        $negotiations = Negotiation::where('user_id', '=', $id)->where('estado', '!=', 'ganada')->Paginate(11);
        return view('admin.users.negociacion')->with('negotiations',$negotiations); 
    } 
    public function stats($id){
        return view('admin.users.stats')->with('id',$id);
    } 
    public function venta($id){
        $negotiations = Negotiation::where('user_id', '=', $id)->where('estado', '=', 'ganada')->Paginate(11);
        return view('admin.users.venta')->with('negotiations',$negotiations); 
    }
    public function password($id){
        $user = User::find($id);
        return view('admin.users.password')->with('user',$user);   
    }
    public function create(){ 
        return view('admin.users.create');
    } 
    public function store(AdminUserRequest $request){
        $user= new User($request->all());
        $user->password=bcrypt($request->password);
        $user->save();
        flash('se ha registrado '.$user->name.' de forma exitosa!', 'success');
        return redirect()->route('admin.users.index');
    }
    public function show($id){
         
    }
    public function edit($id){
        $user = User::find($id);
        return view('admin.users.edit')->with('user',$user);        
    }
    public function update(AdminUserUpdateRequest $request, $id){
        $user = User::find($id);
        $user->fill($request->all());
        $user->password=bcrypt($request->password);
        $user->save();
        flash('se ha modificado el usuario '.$user->name.' de forma exitosa!', 'success');
        return redirect()->route('admin.users.index');        
    }
    public function update2(AdminUserUpdatePasswordRequest $request, $id){
        $user = User::find($id);
        $user->fill($request->all());
        $user->password=bcrypt($request->password);
        $user->save(); 
        flash('se ha modificado la contraseña del usuario '.$user->name.' de forma exitosa!', 'success');
        return redirect()->route('admin.users.index');        
    } 
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        flash('se ha eliminado '.$user->name.' de forma exitosa!', 'warning');
        return redirect()->route('admin.users.index');
    
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
        return view('admin.users.tasks')->with('tasksold',$tasksold)->with('taskstoday',$taskstoday)->with('tasksnext',$tasksnext)->with('advisor',$advisor);
    }
    public function createtasks($id){
        $clients = Client::where('user_id', '=', $id)->lists('name','id');
        return view('admin.users.createtasks')->with('clients',$clients)->with('id',$id);
    }
     public function schedules($id){
         return view('admin.users.schedules')->with('id',$id);        
    }
    
}

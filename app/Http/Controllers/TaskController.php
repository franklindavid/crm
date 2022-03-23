<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task; 
use App\Schedule; 
use App\Client; 
use Carbon\Carbon;
use Auth;

class TaskController extends Controller
{
     public function __construct(){ 
        Carbon::setLocale('es');
    }
    public function index(){
        ////// tareas para hoy
        $inicio=(date("Y-m-d").' 00:00:00 ');
        $fin=(date("Y-m-d").' 23:59:00 ');
        $taskstoday= Task::whereBetween('fecha', [$inicio,  $fin])->where('user_id', '=', Auth::user()->id)->orderBy('prioridad','ASC')->Paginate(11);
        ///// tareas para mas adelante
        $dia=(date("d")+1);
        $inicio=(date("Y-m").'-'.$dia.' 00:00:00 ');
        $mes=(date("m")+1);
        $fin=(date("Y").'-'.$mes.'-'.($dia-1).' 23:59:00 ');
        $tasksnext= Task::whereBetween('fecha', [$inicio,  $fin])->where('user_id', '=', Auth::user()->id)->orderBy('prioridad','ASC')->Paginate(11);
        ////// tareas viejas
        $dia=(date("d")-1);
        $fin=(date("Y-m").'-'.$dia.' 23:59:00 ');
        $mes=(date("m")-1);
        $inicio=(date("Y").'-'.$mes.'-'.($dia+1).' 00:00:00 ');
        $tasksold= Task::whereBetween('fecha', [$inicio,  $fin])->where('user_id', '=', Auth::user()->id)->orderBy('prioridad','ASC')->Paginate(11);
//        $tasks = Task::where('user_id', '=', Auth::user()->id)->orderBy('prioridad','ASC')->Paginate(11); 
        return view('advisor.tasks.index')->with('tasksold',$tasksold)->with('taskstoday',$taskstoday)->with('tasksnext',$tasksnext);
    }
    public function create(){
        $clients = Client::where('user_id', '=', Auth::user()->id)->lists('name','id');
        return view('advisor.tasks.create')->with('clients',$clients);
    }
    public function store(Request $request){
        if ($request->tipo=='cita'){
            $fecha=date("Y-m-d H:i:s", strtotime($request->fecha));
            $task= new Task($request->all());
            $task->motivo=$request->motivo2;
            $task->fecha=$fecha;
//            dd($task);
//            $task->save();
            $client = Client::find($request->client_id);
            $schedule=new Schedule;
            
            $hora=date("H:i:s", strtotime($request->fecha));
            $schedule->fechainicio=$fecha;
            if ($hora>0){
                $schedule->todoeldia=0;
            }else{
                $schedule->todoeldia=1;
            }
            $schedule->asunto=$request->tipo." ".$client->name." ".$request->motivo2;
            $schedule->lugar=$request->lugar;
            $schedule->user_id=$request->user_id;
            if ($request->prioridad==1){
                $schedule->color="rgb(200, 30, 30)";
            }elseif($request->prioridad==2){
                $schedule->color="rgb(58, 199, 30)";
            }else{
                $schedule->color="rgb(30, 64, 199)";
            }
            $schedule->save();
            $task->schedule_id=$schedule->id;
            $task->save();
            $schedule = Schedule::find($task->schedule_id);
            $schedule->task_id=$task->id;
            $schedule->save();
        }elseif($request->tipo=='llamada'){
            $task= new Task($request->all());
            $task->motivo=$request->motivo1;
//            $task->save();
            $client = Client::find($request->client_id);
            $schedule=new Schedule;
            $fecha=date("Y-m-d H:i:s", strtotime($request->fecha));
            $hora=date("H:i:s", strtotime($request->fecha));
            $schedule->fechainicio=$fecha;
            if ($hora>0){
                $schedule->todoeldia=0;
            }else{
                $schedule->todoeldia=1;
            }
            $schedule->asunto=$request->tipo." ".$client->name." ".$request->motivo1;
            $schedule->lugar='sin definir';
            $schedule->user_id=$request->user_id;
            if ($request->prioridad==1){
                $schedule->color="rgb(200, 30, 30)";
            }elseif($request->prioridad==2){
                $schedule->color="rgb(58, 199, 30)";
            }else{
                $schedule->color="rgb(30, 64, 199)";
            }
            $schedule->save();
            $task->schedule_id=$schedule->id;
            $task->save();
            $schedule = Schedule::find($task->schedule_id);
            $schedule->task_id=$task->id;
            $schedule->save();
        }else{
            $task= new Task($request->all());
            $task->motivo=$request->motivo3;
//            $task->save();
            $client = Client::find($request->client_id);
            $schedule=new Schedule;
            $fecha=date("Y-m-d H:i:s", strtotime($request->fecha));
            $hora=date("H:i:s", strtotime($request->fecha));
            $schedule->fechainicio=$fecha;
            if ($hora>0){
                $schedule->todoeldia=0;
            }else{
                $schedule->todoeldia=1;
            }
            $schedule->asunto=$request->tipo." ".$client->name." ".$request->motivo3;
            $schedule->lugar='sin definir';
            $schedule->user_id=$request->user_id;
            if ($request->prioridad==1){
                $schedule->color="rgb(200, 30, 30)";
            }elseif($request->prioridad==2){
                $schedule->color="rgb(58, 199, 30)";
            }else{
                $schedule->color="rgb(30, 64, 199)";
            }
            $schedule->save(); 
            $task->schedule_id=$schedule->id;
            $task->save();
            $schedule = Schedule::find($task->schedule_id);
            $schedule->task_id=$task->id;
            $schedule->save();
        }
        flash('se ha agregado la tarea '.$task->id.' de forma exitosa!', 'success');
        return redirect()->route('advisor.clients.tasks',$task->client_id);
//        dd($request->tipo);
    
    }
    public function edit($id){
        $task = Task::find($id);
        return view('advisor.tasks.edit')->with('task',$task);        
    }
    public function update(Request $request, $id){
         $task = Task::find($id);
         $task->prioridad=$request->prioridad;
         
         $fecha=date("Y-m-d H:i:s", strtotime($request->fecha));
         $task->fecha=$fecha;
         if ($request->tipo=='cita'){
            $task->motivo=$request->motivo2;
            $task->update();
            $client = Client::find($request->client_id);
            //////////////////////////////////////////////
            $schedule = Schedule::find($task->schedule_id);
            $hora=date("H:i:s", strtotime($request->fecha));
            $schedule->fechainicio=$fecha;
            if ($hora>0){
                $schedule->todoeldia=0;
            }else{
                $schedule->todoeldia=1;
            }
            $schedule->asunto=$request->tipo." ".$client->name." ".$request->motivo2;
            $schedule->lugar=$request->lugar;
            $schedule->user_id=$request->user_id;
            if ($request->prioridad==1){
                $schedule->color="rgb(200, 30, 30)";
            }elseif($request->prioridad==2){
                $schedule->color="rgb(58, 199, 30)";
            }else{
                $schedule->color="rgb(30, 64, 199)";
            }
            $schedule->update();
            ////////////////////////////////////////////////
            
        }elseif($request->tipo=='llamada'){
//            $task= new Task($request->all());
            $task->motivo=$request->motivo1;
            $task->update();
            $client = Client::find($request->client_id);
            ////////////////////////////////////////////////
            $schedule = Schedule::find($task->schedule_id);
            $hora=date("H:i:s", strtotime($request->fecha));
            $schedule->fechainicio=$fecha;
            if ($hora>0){
                $schedule->todoeldia=0;
            }else{
                $schedule->todoeldia=1;
            }
            $schedule->asunto=$request->tipo." ".$client->name." ".$request->motivo1;
            $schedule->lugar='sin definir';
            $schedule->user_id=$request->user_id;
            if ($request->prioridad==1){
                $schedule->color="rgb(200, 30, 30)";
            }elseif($request->prioridad==2){
                $schedule->color="rgb(58, 199, 30)";
            }else{
                $schedule->color="rgb(30, 64, 199)";
            }
            $schedule->update();
            ///////////////////////////////////////////////
        }else{
//            $task= new Task($request->all());
            $task->motivo=$request->motivo3;
            $task->update();
            $client = Client::find($request->client_id);
            //////////////////////////////////////////////
            $schedule = Schedule::find($task->schedule_id);
            $hora=date("H:i:s", strtotime($request->fecha));
            $schedule->fechainicio=$fecha;
            if ($hora>0){
                $schedule->todoeldia=0;
            }else{
                $schedule->todoeldia=1;
            }
            $schedule->asunto=$request->tipo." ".$client->name." ".$request->motivo3;
            $schedule->lugar='sin definir';
            $schedule->user_id=$request->user_id;
            if ($request->prioridad==1){
                $schedule->color="rgb(200, 30, 30)";
            }elseif($request->prioridad==2){
                $schedule->color="rgb(58, 199, 30)";
            }else{
                $schedule->color="rgb(30, 64, 199)";
            }
            $schedule->update();
            ///////////////////////////////////////////
        }
        flash('se ha modificado la tarea '.$task->id.' de forma exitosa!', 'success');
        return redirect()->route('advisor.tasks.edit',$id); 
    }
    public function destroy($id){
        $task = Task::find($id);
        if ($task->schedule_id<>null){
            $schedule = Schedule::find($task->schedule_id);
            $schedule->delete();
        }
        $task->delete();
        return back();
    }
}

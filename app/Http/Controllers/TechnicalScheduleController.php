<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Schedule;
use Auth;

class TechnicalScheduleController extends Controller
{
    public function index(){ 
//        $advisors = User::where('type', '=', 'advisor')->Paginate(11);
        return view('technical.schedule.index');
    } 
    public function index2(){ 
        $data = array(); //declaramos un array principal que va contener los datos
        $id = Schedule::where('user_id', '=', Auth::user()->id)->lists('id'); //listamos todos los id de los Scheduleos
        $titulo = Schedule::where('user_id', '=', Auth::user()->id)->lists('asunto'); //lo mismo para lugar y fecha
        $fechaIni = Schedule::where('user_id', '=', Auth::user()->id)->lists('fechainicio');
        $fechaFin = Schedule::where('user_id', '=', Auth::user()->id)->lists('fechafin');
        $informacion = Schedule::where('user_id', '=', Auth::user()->id)->lists('informacion');
        $lugar = Schedule::where('user_id', '=', Auth::user()->id)->lists('lugar');/////
        $allDay = Schedule::where('user_id', '=', Auth::user()->id)->lists('todoeldia');
        $background = Schedule::where('user_id', '=', Auth::user()->id)->lists('color');
        $count = count($id); //contamos los ids obtenidos para saber el numero exacto de Scheduleos
 
        //hacemos un ciclo para anidar los valores obtenidos a nuestro array principal $data
        for($i=0;$i<$count;$i++){
            $data[$i] = array(
                "title"=>$titulo[$i], //obligatoriamente "title", "start" y "url" son campos requeridos
                "start"=>$fechaIni[$i], //por el plugin asi que asignamos a cada uno el valor correspondiente
                "end"=>$fechaFin[$i],
                "informacion"=>$informacion[$i],
                "lugar"=>$lugar[$i],
                "allDay"=>$allDay[$i],
                "backgroundColor"=>$background[$i],
//                "borderColor"=>$borde[$i],
                "id"=>$id[$i]
                //"url"=>"cargaScheduleos".$id[$i]
                //en el campo "url" concatenamos el el URL con el id del Scheduleo para luego
                //en el Scheduleo onclick de JS hacer referencia a este y usar el método show
                //para mostrar los datos completos de un Scheduleo
            );
        }
 
        json_encode($data); //convertimos el array principal $data a un objeto Json 
       return $data; //para luego retornarlo y estar listo para consumirlo
    }
    public function create(){
        //Valores recibidos via ajax
        $title = $_POST['title'];
        $start = $_POST['start'];
        $back = $_POST['background'];

        //Insertando Scheduleo a base de datos
        $Schedule=new Schedule;
        $Schedule->fechainicio=$start;
        //$Schedule->fechaFin=$end;
        $Schedule->todoeldia=true;
        $Schedule->color=$back;
        $Schedule->asunto=$title;
        $Schedule->user_id=Auth::user()->id;
//        dd($Schedule);
        $Schedule->save();
    }
    public function update(){
        //Valores recibidos via ajax
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $allDay = $_POST['allday'];
        $back = $_POST['background'];

        $Scheduleo=Schedule::find($id);
        if($end=='NULL'){
            $Scheduleo->fechaFin=NULL;
        }else{
            $Scheduleo->fechaFin=$end;
        }
        $Scheduleo->fechainicio=$start;
        $Scheduleo->todoeldia=$allDay;
        $Scheduleo->color=$back;
        $Scheduleo->asunto=$title;
        //$Scheduleo->fechaFin=$end;

        $Scheduleo->save();
   }
     public function delete(){
        //Valor id recibidos via ajax
        $id = $_POST['id'];
        Schedule::destroy($id);
   }
    public function update2(Request $request){
        
        $Schedule = Schedule::find($request->id);
        $Schedule->fill($request->all());
        $Schedule->update();
        flash('se ha modificado el Asunto '.$Schedule->asunto.' de forma exitosa!', 'success');
        return redirect()->route('technical.schedule.index');
        
}
}

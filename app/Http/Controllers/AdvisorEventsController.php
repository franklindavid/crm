<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Event;
class AdvisorEventsController extends Controller
{
    public function index(){
//        $advisors = User::where('type', '=', 'advisor')->Paginate(11);
        return view('advisor.events.index');
    } 
    public function index2(){ 
        $data = array(); //declaramos un array principal que va contener los datos
        $id = Event::all()->lists('id'); //listamos todos los id de los eventos
        $titulo = Event::all()->lists('asunto'); //lo mismo para lugar y fecha
        $fechaIni = Event::all()->lists('fechainicio');
        $fechaFin = Event::all()->lists('fechafin');
        $informacion = Event::all()->lists('informacion');
        $lugar = Event::all()->lists('lugar');/////
        $allDay = Event::all()->lists('todoeldia');
        $background = Event::all()->lists('color');
        $count = count($id); //contamos los ids obtenidos para saber el numero exacto de eventos
 
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
                //"url"=>"cargaEventos".$id[$i]
                //en el campo "url" concatenamos el el URL con el id del evento para luego
                //en el evento onclick de JS hacer referencia a este y usar el método show
                //para mostrar los datos completos de un evento
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

        //Insertando evento a base de datos
        $event=new Event;
        $event->fechainicio=$start;
        //$event->fechaFin=$end;
        $event->todoeldia=true;
        $event->color=$back;
        $event->asunto=$title;
//        dd($event);
        $event->save();
    }
    public function update(){
        dd('hola');
        //Valores recibidos via ajax
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $allDay = $_POST['allday'];
        $back = $_POST['background'];

        $evento=Event::find($id);
        if($end=='NULL'){
            $evento->fechaFin=NULL;
        }else{
            $evento->fechaFin=$end;
        }
        $evento->fechainicio=$start;
        $evento->todoeldia=$allDay;
        $evento->color=$back;
        $evento->asunto=$title;
        //$evento->fechaFin=$end;

        $evento->save();
   }
     public function delete(){
        //Valor id recibidos via ajax
        $id = $_POST['id'];
        Event::destroy($id);
   }
    public function update2(Request $request){
        $event = Event::find($request->id);
        $event->fill($request->all());
        $event->update();
        flash('se ha modificado el evento '.$event->asunto.' de forma exitosa!', 'success');
        return redirect()->route('advisor.events.index');
        
}
} 

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use App\Negotiation;
use App\Referred;
use App\Ticket;
use App\DetalleNegociacion;
use App\Product;
use Auth; 

class ChartsController extends Controller
{
    public function index(){
        $anio=date("Y");
        $mes=date("m");
        $totalclientes=Client::all();
        $ctc=count($totalclientes);
        $clientes=Client::where('estado','=','cliente')->get();
        $cc =count($clientes);
        $prospectos=Client::where('estado','=','prospecto')->get();
        $cp =count($prospectos);
        $porcentajeclientes=($cc/$ctc)*100;
        $porcentajeprospectos=($cp/$ctc)*100;
        return view('admin.charts.advisors')->with("anio",$anio)->with("mes",$mes)->with("porcentajeprospectos",$porcentajeprospectos)->with("porcentajeclientes",$porcentajeclientes); 
    }
    public function advisors(){
          $anio=date("Y");
          $mes=date("m");
//        $totalclientes=Client::all();
//        $ctc=count($totalclientes);
//        $clientes=Client::where('estado','=','cliente')->get();
//        $cc =count($clientes);
//        $prospectos=Client::where('estado','=','prospecto')->get();
//        $cp =count($prospectos);
//        $porcentajeclientes=($cc/$ctc)*100;
//        $porcentajeprospectos=($cp/$ctc)*100;
        return view('admin.charts.advisors')->with("anio",$anio)->with("mes",$mes);
    }
    public function getUltimoDiaMes($elAnio,$elMes) {
        return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }
    public function clientes_mes($anio,$mes)
    {
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $clientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','cliente')->get();
        $prospectos=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','prospecto')->get();
//        $ct=count($usuarios);

        for($d=1;$d<=$ultimo_dia;$d++){
            $registrosclientes[$d]=0;     
            $registrosprospectos[$d]=0;     
        }

        foreach($clientes as $cliente){
        $diasel=intval(date("d",strtotime($cliente->created_at) ) );
        $registrosclientes[$diasel]++;    
        }
        foreach($prospectos as $prospecto){
        $diasel=intval(date("d",strtotime($prospecto->created_at) ) );
        $registrosprospectos[$diasel]++;    
        }

        $data=array("totaldias"=>$ultimo_dia, "registrosclientes" =>$registrosclientes, "registrosprospectos" =>$registrosprospectos);
//        dd($data);
        return   json_encode($data);
    }
    public function ventas_mes($anio,$mes)
    {
        $primer_dia=1; 
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $ventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
        $negociaciones=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->get();
        for($d=1;$d<=$ultimo_dia;$d++){
            $registrosventas[$d]=0; 
            $registrosnegociaciones[$d]=0;
        }
        foreach($ventas as $venta){
        $diasel=intval(date("d",strtotime($venta->created_at) ) );
        $registrosventas[$diasel]++;    
        }
        foreach($negociaciones as $negociacion){
        $diasel2=intval(date("d",strtotime($negociacion->created_at) ) );
        $registrosnegociaciones[$diasel2]++;    
        }
        $data=array("totaldias"=>$ultimo_dia, "registrosventas" =>$registrosventas, "registrosnegociaciones" =>$registrosnegociaciones);
        return   json_encode($data);
    }
//    public function total_publicaciones(){
//        $tipospublicacion=TipoPublicaciones::all();
//        $ctp=count($tipospublicacion);
//        $publicaciones=Publicaciones::all();
//        $ct =count($publicaciones);
//        
//        for($i=0;$i<=$ctp-1;$i++){
//         $idTP=$tipospublicacion[$i]->id;
//         $numerodepubli[$idTP]=0;
//        }
//
//        for($i=0;$i<=$ct-1;$i++){
//         $idTP=$publicaciones[$i]->idTipopublicacion;
//         $numerodepubli[$idTP]++;
//           
//        }
//
//        $data=array("totaltipos"=>$ctp,"tipos"=>$tipospublicacion, "numerodepubli"=>$numerodepubli);
//        return json_encode($data);
//    }
    public function total_clientes($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalclientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        $ctc=count($totalclientes);
        if($ctc!=0){
            $clientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','cliente')->get();
            $cc =count($clientes);
            $prospectos=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','prospecto')->get();
            $cp =count($prospectos);
            $porcentajeclientes=($cc/$ctc)*100;
            $porcentajeprospectos=($cp/$ctc)*100;
            $data=array("porcentajeclientes"=>$porcentajeclientes,"porcentajeprospectos"=>$porcentajeprospectos);
            return json_encode($data);
            }else{
            $data=array("porcentajeclientes"=>0,"porcentajeprospectos"=>0);
            return json_encode($data);
        }
        
        
        /////
//        $totalclientes=Client::all();
//        $ctc=count($totalclientes);
//        $clientes=Client::where('estado','=','cliente')->get();
//        $cc =count($clientes);
//        $prospectos=Client::where('estado','=','prospecto')->get();
//        $cp =count($prospectos);
//        $porcentajeclientes=($cc/$ctc)*100;
//        $porcentajeprospectos=($cp/$ctc)*100;
//        $data=array("porcentajeclientes"=>$porcentajeclientes,"porcentajeprospectos"=>$porcentajeprospectos);
//        return json_encode($data);
        //////
    }
     public function total_ventas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalclientes=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        $ctc=count($totalclientes);
        if($ctc!=0){
            $clientes=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
            $cc =count($clientes);
            $prospectos=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->get();
            $cp =count($prospectos);
            $porcentajeclientes=($cc/$ctc)*100;
            $porcentajeprospectos=($cp/$ctc)*100;
            $data=array("porcentajeclientes"=>$porcentajeclientes,"porcentajeprospectos"=>$porcentajeprospectos);
            return json_encode($data);
            }else{
            $data=array("porcentajeclientes"=>0,"porcentajeprospectos"=>0);
            return json_encode($data);
        }
    }
    public function grafica_asesor_con_mas_clientes($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalclientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','cliente')->get();
//        dd($totalclientes);
        $i=0;
        foreach($totalclientes as $cliente){
            if ($i==0){
                    $asesores[0]['nombre']=$cliente->user->name;
                    $asesores[0]['numeroclientes']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$cliente->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$cliente->user->name;
                            $asesores[$j]['numeroclientes']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$cliente->user->name;
                    $asesores[$i]['numeroclientes']=1;
                    $i++;
                }
            }
        }
        if ($totalclientes->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroclientes']=0;
        }else{
            if (count($asesores)<5){
            $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroclientes']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeroclientes']>$ordenado[$i]['numeroclientes']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeroclientes']=$asesores[$j]['numeroclientes'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeroclientes']=-5;
                $i++;  
            }
        }
//        dd(asort($asesores['numeroclientes']));
//        $desordenado[0]['nombre']='hector';
//        $desordenado[0]['numeroclientes']=6;
//        
//        $desordenado[1]['nombre']='ana';
//        $desordenado[1]['numeroclientes']=2;
//        
//        $desordenado[2]['nombre']='fidel';
//        $desordenado[2]['numeroclientes']=6;
//        
//        $desordenado[3]['nombre']='maribel';
//        $desordenado[3]['numeroclientes']=5;
//        
//        $desordenado[4]['nombre']='alonso';
//        $desordenado[4]['numeroclientes']=3;
//        
//        $desordenado[5]['nombre']='julia';
//        $desordenado[5]['numeroclientes']=8;
//        
//        $desordenado[6]['nombre']='juliana';
//        $desordenado[6]['numeroclientes']=9;
//        
//        $desordenado[7]['nombre']='juan';
//        $desordenado[7]['numeroclientes']=1;
//        
//        $desordenado[8]['nombre']='jose';
//        $desordenado[8]['numeroclientes']=4;
//        
//        $desordenado[9]['nombre']='pedro';
//        $desordenado[9]['numeroclientes']=7;
//        $i=0;
//        while ($i < 5) {
//            $ordenado[$i]['numeroclientes']=999;
//            for($j=0;$j<count($desordenado);$j++){
//                if($desordenado[$j]['numeroclientes']<$ordenado[$i]['numeroclientes']){
//                    $ordenado[$i]['nombre']=$desordenado[$j]['nombre'];
//                    $ordenado[$i]['numeroclientes']=$desordenado[$j]['numeroclientes'];
//                    $k=$j;
//                    
//                }
//            }
//            $desordenado[$k]['nombre']='';
//            $desordenado[$k]['numeroclientes']=999;
//            $i++;  
//        }
//        dd(($ordenado));
        
//        dd($ordenado);
//        $asesores[0]['nombre']='anamaria';
//        $asesores[0]['numeroclientes']=1;
//        $asesores[0]['numeroprospectos']=1;
//        $asesores[1]['nombre']='aparecido';
//        $asesores[1]['numeroclientes']=2;
//        $asesores[1]['numeroprospectos']=2;
//        dd($asesores);
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_asesor_con_menos_clientes($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalclientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','cliente')->get();
        $i=0;
        foreach($totalclientes as $cliente){
            if ($i==0){
                    $asesores[0]['nombre']=$cliente->user->name;
                    $asesores[0]['numeroclientes']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$cliente->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$cliente->user->name;
                            $asesores[$j]['numeroclientes']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$cliente->user->name;
                    $asesores[$i]['numeroclientes']=1;
                    $i++;
                }
            }
        }
            if ($totalclientes->isEmpty()){
                $ordenado[0]['nombre']='';
                $ordenado[0]['numeroclientes']=0;
            }else{
                if (count($asesores)<5){
                    $top=count($asesores);
                }else{
                    $top=5;
                }
                $i=0;
                while ($i < $top) {
                $ordenado[$i]['numeroclientes']=999;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeroclientes']<$ordenado[$i]['numeroclientes']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeroclientes']=$asesores[$j]['numeroclientes'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeroclientes']=999;
                $i++;  
                }
            }
            
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_asesor_con_mas_prospectos($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalclientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','prospecto')->get();
//        dd($totalclientes);
        $i=0;
        foreach($totalclientes as $cliente){
            if ($i==0){
                    $asesores[0]['nombre']=$cliente->user->name;
                    $asesores[0]['numeroprospectos']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$cliente->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$cliente->user->name;
                            $asesores[$j]['numeroprospectos']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$cliente->user->name;
                    $asesores[$i]['numeroprospectos']=1;
                    $i++;
                }
            }
        }
        if ($totalclientes->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroprospectos']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroprospectos']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeroprospectos']>$ordenado[$i]['numeroprospectos']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeroprospectos']=$asesores[$j]['numeroprospectos'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeroprospectos']=-5;
                $i++;  
            }
        }
        
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_asesor_con_menos_prospectos($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalclientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','prospecto')->get();
//        dd($totalclientes);
        $i=0;
        foreach($totalclientes as $cliente){
            if ($i==0){
                    $asesores[0]['nombre']=$cliente->user->name;
                    $asesores[0]['numeroprospectos']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$cliente->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$cliente->user->name;
                            $asesores[$j]['numeroprospectos']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$cliente->user->name;
                    $asesores[$i]['numeroprospectos']=1;
                    $i++;
                }
            }
        }
        if ($totalclientes->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroprospectos']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroprospectos']=999;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeroprospectos']<$ordenado[$i]['numeroprospectos']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeroprospectos']=$asesores[$j]['numeroprospectos'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeroprospectos']=999;
                $i++;  
            }
        }
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_asesor_con_mas_ventas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
//        dd($totalventas);
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->user->name;
                    $asesores[0]['numeroventas']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->user->name;
                            $asesores[$j]['numeroventas']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->user->name;
                    $asesores[$i]['numeroventas']=1;
                    $i++;
                }
            }
        }
        
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroventas']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroventas']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeroventas']>$ordenado[$i]['numeroventas']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeroventas']=$asesores[$j]['numeroventas'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeroventas']=-5;
                $i++;  
            }
        }
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_asesor_con_menos_ventas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
//        dd($totalventas);
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->user->name;
                    $asesores[0]['numeroventas']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->user->name;
                            $asesores[$j]['numeroventas']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->user->name;
                    $asesores[$i]['numeroventas']=1;
                    $i++;
                }
            }
        }
        
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroventas']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroventas']=999;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeroventas']<$ordenado[$i]['numeroventas']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeroventas']=$asesores[$j]['numeroventas'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeroventas']=999;
                $i++;  
            }
        }
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_asesor_con_mas_negociaciones($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->get();
//        dd($totalventas);
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->user->name;
                    $asesores[0]['numeronegociaciones']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->user->name;
                            $asesores[$j]['numeronegociaciones']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->user->name;
                    $asesores[$i]['numeronegociaciones']=1;
                    $i++;
                }
            }
        }
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeronegociaciones']=0;
        }else{
            if (count($asesores)<5){
            $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeronegociaciones']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeronegociaciones']>$ordenado[$i]['numeronegociaciones']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeronegociaciones']=$asesores[$j]['numeronegociaciones'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeronegociaciones']=-5;
                $i++;  
            }
        }
        
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_asesor_con_menos_negociaciones($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->get();
//        dd($totalventas);
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->user->name;
                    $asesores[0]['numeronegociaciones']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->user->name;
                            $asesores[$j]['numeronegociaciones']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->user->name;
                    $asesores[$i]['numeronegociaciones']=1;
                    $i++;
                }
            }
        }
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeronegociaciones']=0;
        }else{
            if (count($asesores)<5){
            $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeronegociaciones']=999;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeronegociaciones']<$ordenado[$i]['numeronegociaciones']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeronegociaciones']=$asesores[$j]['numeronegociaciones'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeronegociaciones']=999;
                $i++;  
            }
        }
        
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_asesor_con_mas_perdidas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','perdida')->get();
//        dd($totalventas);
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->user->name;
                    $asesores[0]['numeronegociaciones']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->user->name;
                            $asesores[$j]['numeronegociaciones']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->user->name;
                    $asesores[$i]['numeronegociaciones']=1;
                    $i++;
                }
            }
        }
        if ($totalventas->isEmpty()){
            $asesores[0]['nombre']='';
            $asesores[0]['numeronegociaciones']=0;
        }
        $data=array("asesores"=>$asesores);
        return json_encode($data);
    }
    public function clientes_anuales($anio,$id){
//        dd($id);
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $usuarios=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','cliente')->where('user_id', '=', $id)->get();
            $prospectos=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','prospecto')->where('user_id', '=', $id)->get();
            $totalclientes[$i]=count($usuarios);
            $totalprospectos[$i]=count($prospectos);
        }
//        dd($totalprospectos);
        $data=array("totalclientes"=>$totalclientes, "totalprospectos" =>$totalprospectos);
//        dd($data);
        return   json_encode($data);
    }
    public function ventas_anuales($anio,$id){
//        dd($id);
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $ventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->where('user_id', '=', $id)->get();
            $negociaciones=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->where('user_id', '=', $id)->get();
            $totalventas[$i]=count($ventas);
            $totalnegociaciones[$i]=count($negociaciones);
        }
//        dd($totalprospectos);
        $data=array("totalventas"=>$totalventas, "totalnegociaciones" =>$totalnegociaciones);
//        dd($data);
        return   json_encode($data);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////clientes prospectos//////////////////////////////////////////////////////////////////////////////////////
    public function clients(){
        $anio=date("Y");
        $mes=date("m");
        return view('admin.charts.clients')->with("anio",$anio)->with("mes",$mes);
    }
    public function grafica_cliente_con_mas_referidos($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalreferidos=Referred::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
//        dd($totalreferidos);
//        $client2 = App\Client::find($referred->padre_id)
        $i=0;
        foreach($totalreferidos as $referido){
            if ($i==0){
                    $padre = Client::find($referido->client_id);   
                    $clientes[0]['nombre']=$padre->name;
                    $clientes[0]['numeroreferidos']=1;
                    $i++;
//                dd($clientes);
            }else{
                $flag=0;
                for($j=0;$j<count($clientes);$j++){ 
                    
                    $padre2 = Client::find($referido->client_id);  
                    if ($clientes[$j]['nombre']==$padre2->name){
                            $flag=1;
                            $padre = Client::find($referido->client_id);  
                            $clientes[$j]['nombre']=$padre->name;
                            $clientes[$j]['numeroreferidos']++;
                            break;
                        }
                }
                if ($flag==0){
                    $padre = Client::find($referido->client_id);
                    $clientes[$i]['nombre']=$padre->name;
                    $clientes[$i]['numeroreferidos']=1;
                    $i++;
                }
            }
        }
//        dd($clientes);
        if ($totalreferidos->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroreferidos']=0;
        }
        else{
            if (count($clientes)<5){
            $top=count($clientes);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroreferidos']=0;
                for($j=0;$j<count($clientes);$j++){
                    if($clientes[$j]['numeroreferidos']>$ordenado[$i]['numeroreferidos']){
                        $ordenado[$i]['nombre']=$clientes[$j]['nombre'];
                        $ordenado[$i]['numeroreferidos']=$clientes[$j]['numeroreferidos'];
                        $k=$j;

                    }
                }
                $clientes[$k]['nombre']='';
                $clientes[$k]['numeroreferidos']=-1;
                $i++;  
            }
        }
        $data=array("clientes"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_cliente_con_mas_negociaciones($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->get();
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->client->name;
                    $asesores[0]['numeronegociaciones']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->client->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->client->name;
                            $asesores[$j]['numeronegociaciones']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->client->name;
                    $asesores[$i]['numeronegociaciones']=1;
                    $i++;
                }
            }
        }
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeronegociaciones']=0;
        }else{
            if (count($asesores)<5){
            $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeronegociaciones']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeronegociaciones']>$ordenado[$i]['numeronegociaciones']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeronegociaciones']=$asesores[$j]['numeronegociaciones'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeronegociaciones']=-5;
                $i++;  
            }
        }
        
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_cliente_con_mas_ventas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
//        dd($totalventas);
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->client->name;
                    $asesores[0]['numeroventas']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->client->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->client->name;
                            $asesores[$j]['numeroventas']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->client->name;
                    $asesores[$i]['numeroventas']=1;
                    $i++;
                }
            }
        }
        
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroventas']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroventas']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeroventas']>$ordenado[$i]['numeroventas']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeroventas']=$asesores[$j]['numeroventas'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeroventas']=-5;
                $i++;  
            }
        }
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_cliente_con_mas_tickets($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalticketsresueltos=Ticket::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','resuelto')->get();
        $totalticketspendientes=Ticket::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','pendiente')->get();
        $i=0;
        foreach($totalticketsresueltos as $ticket){
            if ($i==0){
                    $asesores[0]['nombre']=$ticket->client->name;
                    $asesores[0]['numerotickets']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$ticket->client->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$ticket->client->name;
                            $asesores[$j]['numerotickets']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$ticket->client->name;
                    $asesores[$i]['numerotickets']=1;
                    $i++;
                }
            }
        }
        
        if ($i<>0){
            foreach($totalticketspendientes as $ticket){
            $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$ticket->client->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$ticket->client->name;
                            $asesores[$j]['numerotickets']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$ticket->client->name;
                    $asesores[$i]['numerotickets']=1;
                    $i++;
                }
            }
        }else{
            foreach($totalticketspendientes as $ticket){
            if ($i==0){
                    $asesores[0]['nombre']=$ticket->client->name;
                    $asesores[0]['numerotickets']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$ticket->client->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$ticket->client->name;
                            $asesores[$j]['numerotickets']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$ticket->client->name;
                    $asesores[$i]['numerotickets']=1;
                    $i++;
                }
            }
            }
        }
        
        
        if ($totalticketsresueltos->isEmpty() and $totalticketspendientes->isEmpty() ){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numerotickets']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numerotickets']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numerotickets']>$ordenado[$i]['numerotickets']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numerotickets']=$asesores[$j]['numerotickets'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numerotickets']=-5;
                $i++;  
            }
        }
        $data=array("clientes"=>$ordenado);
        return json_encode($data);
    }
     public function ventas_anuales_cliente($anio,$id){
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $ventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->where('client_id', '=', $id)->get();
            $negociaciones=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->where('client_id', '=', $id)->get();
            $totalventas[$i]=count($ventas);
            $totalnegociaciones[$i]=count($negociaciones);
        }
        $data=array("totalventas"=>$totalventas, "totalnegociaciones" =>$totalnegociaciones);
        return   json_encode($data);
    }
    public function referidos_anuales_cliente($anio,$id){
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $referidos=Referred::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('client_id', '=', $id)->get();
            $totalventas[$i]=count($referidos);
        }
        $data=array("totalventas"=>$totalventas);
        return   json_encode($data);
    }
    public function tickets_anuales_cliente($anio,$id){
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $ticketsresueltos=Ticket::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','resuelto')->where('client_id', '=', $id)->get();
            $ticketspendientes=Ticket::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','pendiente')->where('client_id', '=', $id)->get();
            $totalventas[$i]=count($ticketsresueltos)+count($ticketspendientes);
        }
        $data=array("totalventas"=>$totalventas);
        return   json_encode($data);
    }
    ///////////////////////////////////////////////////////////////////////////////negociaciones ///////////////////////////////////////////////////
    public function negotiations(){
        $anio=date("Y");
        return view('admin.charts.negotiations')->with("anio",$anio);
    }
    public function negociaciones_anuales($anio){
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $perdidas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','perdida')->get();
            $enproceso=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->get();
            $totalperdidas[$i]=count($perdidas);
            $totalenproceso[$i]=count($enproceso);
            $totalnegociaciones[$i]=count($perdidas)+count($enproceso);
        }
        $data=array("totalperdidas"=>$totalperdidas, "totalenproceso" =>$totalenproceso, "totalnegociaciones" =>$totalnegociaciones);
        return   json_encode($data);
    }
    ///////////////////////////////////////////////////////////////////////////////ventas ///////////////////////////////////////////////////
    public function sales(){
        $anio=date("Y");
        return view('admin.charts.sales')->with("anio",$anio);
    }
    public function venta_anual($anio){
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $ventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
            $totalventas[$i]=count($ventas);
        }
        $data=array( "totalventas" =>$totalventas);
        return   json_encode($data);
    }
    public function ingreso_anual($anio){
        for($i=1;$i<=12;$i++){
            $ingreso=0;
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $ventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
            foreach($ventas as $vent){
                $ingreso=$ingreso+$vent->total_negociacion;
            }
            $totalventas[$i]=$ingreso;
        }
        $data=array( "totalventas" =>$totalventas);
        return   json_encode($data);
    }
    ///////////////////////////////////////////////////////////////////////////////productos ///////////////////////////////////////////////////
    public function products(){
        $anio=date("Y");
        $mes=date("m");
        return view('admin.charts.products')->with("anio",$anio)->with("mes",$mes);
    }
    public function grafica_producto_con_mas_ventas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
//        dd($negociaciones);
//        dd($negociaciones[2]->products);
        $i=0;
        $k=0;
//        dd(count($totalventas));
        foreach($totalventas as $venta){
                foreach($venta->products as $product){
                    if ($k==0){
                        if ($product->flag<>0){
                            $producto[0]['nombre']=$product->name;
                            $producto[0]['numerovendidos']=1;
                            $k++;
                        }
                    }else{
                        $flag=0;
                        for($j=0;$j<count($producto);$j++){
                            if ($producto[$j]['nombre']==$product->name){
                                if ($product->flag<>0){
                                    $flag=1;
                                    $producto[$j]['nombre']=$product->name;
                                    $producto[$j]['numerovendidos']++;
                                    break;
                                }
                            }
                        }
                        if ($flag==0){
                            if ($product->flag<>0){
                                $producto[$k]['nombre']=$product->name;
                                $producto[$k]['numerovendidos']=1;
                                $k++;
                            }
                        }
                    }
                }
        }
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numerovendidos']=0;
        }else{
            if (count($producto)<5){
            $top=count($producto);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numerovendidos']=0;
                for($j=0;$j<count($producto);$j++){
                    if($producto[$j]['numerovendidos']>$ordenado[$i]['numerovendidos']){
                        $ordenado[$i]['nombre']=$producto[$j]['nombre'];
                        $ordenado[$i]['numerovendidos']=$producto[$j]['numerovendidos'];
                        $k=$j;

                    }
                }
                $producto[$k]['nombre']='';
                $producto[$k]['numerovendidos']=-5;
                $i++;  
            }
        }
        $data=array("productos"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_producto_con_menos_ventas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
//        dd($negociaciones);
//        dd($negociaciones[2]->products);
        $i=0;
        $k=0;
//        dd(count($totalventas));
        foreach($totalventas as $venta){
                foreach($venta->products as $product){
                    if ($k==0){
                        if ($product->flag<>0){
                            $producto[0]['nombre']=$product->name;
                            $producto[0]['numerovendidos']=1;
                            $k++;
                        }
                    }else{
                        $flag=0;
                        for($j=0;$j<count($producto);$j++){
                            if ($producto[$j]['nombre']==$product->name){
                                if ($product->flag<>0){
                                    $flag=1;
                                    $producto[$j]['nombre']=$product->name;
                                    $producto[$j]['numerovendidos']++;
                                    break;
                                }
                            }
                        }
                        if ($flag==0){
                            if ($product->flag<>0){
                                $producto[$k]['nombre']=$product->name;
                                $producto[$k]['numerovendidos']=1;
                                $k++;
                            }
                        }
                    }
                }
        }
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numerovendidos']=0;
        }else{
            if (count($producto)<5){
            $top=count($producto);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numerovendidos']=999;
                for($j=0;$j<count($producto);$j++){
                    if($producto[$j]['numerovendidos']<$ordenado[$i]['numerovendidos']){
                        $ordenado[$i]['nombre']=$producto[$j]['nombre'];
                        $ordenado[$i]['numerovendidos']=$producto[$j]['numerovendidos'];
                        $k=$j;

                    }
                }
                $producto[$k]['nombre']='';
                $producto[$k]['numerovendidos']=999;
                $i++;  
            }
        }
        $data=array("productos"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_servicio_con_mas_ventas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
//        dd($negociaciones);
//        dd($negociaciones[2]->products);
        $i=0;
        $k=0;
//        dd(count($totalventas));
        foreach($totalventas as $venta){
                foreach($venta->products as $product){
                    if ($k==0){
                        if ($product->flag<>1){
                            $producto[0]['nombre']=$product->name;
                            $producto[0]['numerovendidos']=1;
                            $k++;
                        }
                    }else{
                        $flag=0;
                        for($j=0;$j<count($producto);$j++){
                            if ($producto[$j]['nombre']==$product->name){
                                if ($product->flag<>1){
                                    $flag=1;
                                    $producto[$j]['nombre']=$product->name;
                                    $producto[$j]['numerovendidos']++;
                                    break;
                                }
                            }
                        }
                        if ($flag==0){
                            if ($product->flag<>1){
                                $producto[$k]['nombre']=$product->name;
                                $producto[$k]['numerovendidos']=1;
                                $k++;
                            }
                        }
                    }
                }
        }
//        dd($producto=='undefined');/////////////////////////////////////////////////////////////////////////
        if ($totalventas->isEmpty() or $k==0){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numerovendidos']=0;
        }else{
            if (count($producto)<5){
            $top=count($producto);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numerovendidos']=0;
                for($j=0;$j<count($producto);$j++){
                    if($producto[$j]['numerovendidos']>$ordenado[$i]['numerovendidos']){
                        $ordenado[$i]['nombre']=$producto[$j]['nombre'];
                        $ordenado[$i]['numerovendidos']=$producto[$j]['numerovendidos'];
                        $k=$j;

                    }
                }
                $producto[$k]['nombre']='';
                $producto[$k]['numerovendidos']=-5;
                $i++;  
            }
        }
        $data=array("productos"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_servicio_con_menos_ventas($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
//        dd($negociaciones);
//        dd($negociaciones[2]->products);
        $i=0;
        $k=0;
//        dd(count($totalventas));
        foreach($totalventas as $venta){
                foreach($venta->products as $product){
                    if ($k==0){
                        if ($product->flag<>1){
                            $producto[0]['nombre']=$product->name;
                            $producto[0]['numerovendidos']=1;
                            $k++;
                        }
                    }else{
                        $flag=0;
                        for($j=0;$j<count($producto);$j++){
                            if ($producto[$j]['nombre']==$product->name){
                                if ($product->flag<>1){
                                    $flag=1;
                                    $producto[$j]['nombre']=$product->name;
                                    $producto[$j]['numerovendidos']++;
                                    break;
                                }
                            }
                        }
                        if ($flag==0){
                            if ($product->flag<>1){
                                $producto[$k]['nombre']=$product->name;
                                $producto[$k]['numerovendidos']=1;
                                $k++;
                            }
                        }
                    }
                }
        }
        if ($totalventas->isEmpty() or $k==0){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numerovendidos']=0;
        }else{
            if (count($producto)<5){
            $top=count($producto);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numerovendidos']=999;
                for($j=0;$j<count($producto);$j++){
                    if($producto[$j]['numerovendidos']<$ordenado[$i]['numerovendidos']){
                        $ordenado[$i]['nombre']=$producto[$j]['nombre'];
                        $ordenado[$i]['numerovendidos']=$producto[$j]['numerovendidos'];
                        $k=$j;

                    }
                }
                $producto[$k]['nombre']='';
                $producto[$k]['numerovendidos']=999;
                $i++;  
            }
        }
        $data=array("productos"=>$ordenado);
        return json_encode($data);
    }
    public function productos_anuales($anio,$id){
        $producto=Product::find($id);
        for($i=1;$i<=12;$i++){
            $contador=0;
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->get();
            
//            $negociaciones=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->where('user_id', '=', $id)->get();
//            $totalventas[$i]=count($ventas);
//            $totalnegociaciones[$i]=count($negociaciones);
            
//                $detalle=DetalleNegociacion::find(2);
                $detalles=DetalleNegociacion::orderBy('id','ASC')->paginate(11);;
//                dd($detalles);
            if ($producto->flag==1){
                foreach($totalventas as $venta){
                    foreach($detalles as $detalle ){
                        if (($venta->id==$detalle->negotiation_id)and($id==$detalle->product_id)){
                            $contador=$contador+$detalle->cantidad;
                        }
                    }
                } 
                $totalproductos[$i]=$contador;  
            }else{
                foreach($totalventas as $venta){
                    foreach($detalles as $detalle ){
                        if (($venta->id==$detalle->negotiation_id)and($id==$detalle->product_id)){
                            $contador++;
                        }
                    }
                } 
                $totalproductos[$i]=$contador;  
            } 
            
        }
        $data=array("totalproductos"=>$totalproductos);
        return   json_encode($data);
    }
    ///////////////////////////////////////////////////////////////////////////////tickets ///////////////////////////////////////////////////
    public function tickets(){
        $anio=date("Y");
        $mes=date("m");
        return view('admin.charts.tickets')->with("anio",$anio)->with("mes",$mes);
    }
    public function ticket_anual($anio){
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $resueltos=Ticket::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','resuelto')->get();
            $pendientes=Ticket::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','pendiente')->get();
            $totalresueltos[$i]=count($resueltos);
            $totalpendientes[$i]=count($pendientes);
            $totaltickets[$i]=count($resueltos)+count($pendientes);
        }
        $data=array( "totaltickets" =>$totaltickets,"totalresueltos" =>$totalresueltos,"totalpendientes" =>$totalpendientes);
        return   json_encode($data);
    }
    
    public function grafica_tecnico_con_mas_tickets_resueltos($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalticketsresueltos=Ticket::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','resuelto')->get();
        $totalticketspendientes=Ticket::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','pendiente')->get();
        $i=0;
        foreach($totalticketsresueltos as $ticket){
            if ($i==0){
                    $asesores[0]['nombre']=$ticket->user->name;
                    $asesores[0]['numerotickets']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$ticket->user->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$ticket->user->name;
                            $asesores[$j]['numerotickets']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$ticket->user->name;
                    $asesores[$i]['numerotickets']=1;
                    $i++;
                }
            }
        }
//        foreach($totalticketspendientes as $ticket){
//            $flag=0;
//                for($j=0;$j<count($asesores);$j++){
//                    if ($asesores[$j]['nombre']==$ticket->user->name){
//                        $flag=1;
//                            $asesores[$j]['nombre']=$ticket->user->name;
//                            $asesores[$j]['numerotickets']++;
//                            break;
//                        }
//                }
//                if ($flag==0){
//                    $asesores[$i]['nombre']=$ticket->user->name;
//                    $asesores[$i]['numerotickets']=1;
//                    $i++;
//                }
//        }
        
        if ($totalticketsresueltos->isEmpty() and $totalticketspendientes->isEmpty() ){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numerotickets']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numerotickets']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numerotickets']>$ordenado[$i]['numerotickets']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numerotickets']=$asesores[$j]['numerotickets'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numerotickets']=-5;
                $i++;  
            }
        }
        $data=array("clientes"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_tecnico_con_mas_tickets_pendientes(){
        $totalticketspendientes=Ticket::where('estado','=','pendiente')->get();
        $i=0;
        
        foreach($totalticketspendientes as $ticket){
        if ($i==0){
                $asesores[0]['nombre']=$ticket->user->name;
                $asesores[0]['numerotickets']=1;
                $i++;
        }else{
            $flag=0;
            for($j=0;$j<count($asesores);$j++){
                if ($asesores[$j]['nombre']==$ticket->user->name){
                    $flag=1;
                        $asesores[$j]['nombre']=$ticket->user->name;
                        $asesores[$j]['numerotickets']++;
                        break;
                    }
            }
            if ($flag==0){
                $asesores[$i]['nombre']=$ticket->user->name;
                $asesores[$i]['numerotickets']=1;
                $i++;
            }
        }
        }
        
        if ($totalticketspendientes->isEmpty() ){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numerotickets']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) { 
                $ordenado[$i]['numerotickets']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numerotickets']>$ordenado[$i]['numerotickets']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numerotickets']=$asesores[$j]['numerotickets'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numerotickets']=-5;
                $i++;  
            }
        }
        $data=array("clientes"=>$ordenado);
        return json_encode($data);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////// ESTADISTICAS ASESOR
    public function indexadvisor(){
        $anio=date("Y");
        $mes=date("m");
        return view('advisor.charts.index')->with("anio",$anio)->with("mes",$mes); 
    }
    public function clientes_mes_individual($anio,$mes)
    {
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $clientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','cliente')->where('user_id','=',Auth::user()->id)->get();
        $prospectos=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','prospecto')->where('user_id','=',Auth::user()->id)->get();
//        $ct=count($usuarios);

        for($d=1;$d<=$ultimo_dia;$d++){
            $registrosclientes[$d]=0;     
            $registrosprospectos[$d]=0;     
        }

        foreach($clientes as $cliente){
        $diasel=intval(date("d",strtotime($cliente->created_at) ) );
        $registrosclientes[$diasel]++;    
        }
        foreach($prospectos as $prospecto){
        $diasel=intval(date("d",strtotime($prospecto->created_at) ) );
        $registrosprospectos[$diasel]++;    
        }

        $data=array("totaldias"=>$ultimo_dia, "registrosclientes" =>$registrosclientes, "registrosprospectos" =>$registrosprospectos);
//        dd($data);
        return   json_encode($data);
    }
    public function total_clientes_individual($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalclientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('user_id','=',Auth::user()->id)->get();
        $ctc=count($totalclientes);
        if($ctc!=0){
            $clientes=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','cliente')->where('user_id','=',Auth::user()->id)->get();
            $cc =count($clientes);
            $prospectos=Client::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','prospecto')->where('user_id','=',Auth::user()->id)->get();
            $cp =count($prospectos);
            $porcentajeclientes=($cc/$ctc)*100;
            $porcentajeprospectos=($cp/$ctc)*100;
            $data=array("porcentajeclientes"=>$porcentajeclientes,"porcentajeprospectos"=>$porcentajeprospectos);
            return json_encode($data);
            }else{
            $data=array("porcentajeclientes"=>0,"porcentajeprospectos"=>0);
            return json_encode($data);
        }
    }
    public function grafica_cliente_con_mas_ventas_individual($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('updated_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->where('user_id','=',Auth::user()->id)->get();
//        dd($totalventas);
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->client->name;
                    $asesores[0]['numeroventas']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->client->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->client->name;
                            $asesores[$j]['numeroventas']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->client->name;
                    $asesores[$i]['numeroventas']=1;
                    $i++;
                }
            }
        }
        
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroventas']=0;
        }else{
            if (count($asesores)<5){
                $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroventas']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeroventas']>$ordenado[$i]['numeroventas']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeroventas']=$asesores[$j]['numeroventas'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeroventas']=-5;
                $i++;  
            }
        }
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_cliente_con_mas_negociaciones_individual($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->where('user_id','=',Auth::user()->id)->get();
        $i=0;
        foreach($totalventas as $venta){
            if ($i==0){
                    $asesores[0]['nombre']=$venta->client->name;
                    $asesores[0]['numeronegociaciones']=1;
                    $i++;
            }else{
                $flag=0;
                for($j=0;$j<count($asesores);$j++){
                    if ($asesores[$j]['nombre']==$venta->client->name){
                        $flag=1;
                            $asesores[$j]['nombre']=$venta->client->name;
                            $asesores[$j]['numeronegociaciones']++;
                            break;
                        }
                }
                if ($flag==0){
                    $asesores[$i]['nombre']=$venta->client->name;
                    $asesores[$i]['numeronegociaciones']=1;
                    $i++;
                }
            }
        }
        if ($totalventas->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeronegociaciones']=0;
        }else{
            if (count($asesores)<5){
            $top=count($asesores);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeronegociaciones']=0;
                for($j=0;$j<count($asesores);$j++){
                    if($asesores[$j]['numeronegociaciones']>$ordenado[$i]['numeronegociaciones']){
                        $ordenado[$i]['nombre']=$asesores[$j]['nombre'];
                        $ordenado[$i]['numeronegociaciones']=$asesores[$j]['numeronegociaciones'];
                        $k=$j;

                    }
                }
                $asesores[$k]['nombre']='';
                $asesores[$k]['numeronegociaciones']=-5;
                $i++;  
            }
        }
        
        $data=array("asesores"=>$ordenado);
        return json_encode($data);
    }
    public function grafica_cliente_con_mas_referidos_individual($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $totalreferidos=Referred::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
//        dd($totalreferidos);
//        $client2 = App\Client::find($referred->padre_id)
        $i=0;
        foreach($totalreferidos as $referido){
            if ($i==0){
//                    $padre = Client::find($referido->client_id);
//                    $padre = Client::find($referido->client_id)->where('user_id','=',Auth::user()->id)->get();
                    $padre = Client::where('id','=',$referido->client_id)->where('user_id','=',Auth::user()->id)->get();
                
                    if ($padre->isEmpty()){
                        
                    }else{
//                        dd($padre);
                        foreach($padre as $father){
                            $clientes[0]['nombre']=$father->name;
                            $clientes[0]['numeroreferidos']=1;
                            $i++;
                        }
                    }
                    
                    
//                dd($clientes);
            }else{
                $flag=0;
                for($j=0;$j<count($clientes);$j++){ 
                    
//                    $padre2 = Client::find($referido->client_id);  
                    
                    $padre2 = Client::where('id','=',$referido->client_id)->where('user_id','=',Auth::user()->id)->get();
                    foreach($padre2 as $father2){
                        if ($clientes[$j]['nombre']==$father2->name){
                            $flag=1;
                            $padre = Client::find($referido->client_id); 
                            $padre = Client::where('id','=',$referido->client_id)->where('user_id','=',Auth::user()->id)->get();
                            foreach($padre as $father){
                                $clientes[$j]['nombre']=$father->name;
                                $clientes[$j]['numeroreferidos']++;
                                break;
                            }
                        }
                        
                    }
                    
                    
                }
                if ($flag==0){
                    $padre = Client::find($referido->client_id);
                    $clientes[$i]['nombre']=$padre->name;
                    $clientes[$i]['numeroreferidos']=1;
                    $i++;
                }
            }
        }
//        dd($clientes);
        if ($totalreferidos->isEmpty()){
            $ordenado[0]['nombre']='';
            $ordenado[0]['numeroreferidos']=0;
        }
        else{
            if (count($clientes)<5){
            $top=count($clientes);
            }else{
                $top=5;
            }
            $i=0;
            while ($i < $top) {
                $ordenado[$i]['numeroreferidos']=0;
                for($j=0;$j<count($clientes);$j++){
                    if($clientes[$j]['numeroreferidos']>$ordenado[$i]['numeroreferidos']){
                        $ordenado[$i]['nombre']=$clientes[$j]['nombre'];
                        $ordenado[$i]['numeroreferidos']=$clientes[$j]['numeroreferidos'];
                        $k=$j;

                    }
                }
                $clientes[$k]['nombre']='';
                $clientes[$k]['numeroreferidos']=-1;
                $i++;  
            }
        }
        $data=array("clientes"=>$ordenado);
        return json_encode($data);
    }
    public function negociaciones_anuales_individual($anio){
        for($i=1;$i<=12;$i++){
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $perdidas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','perdida')->where('user_id','=',Auth::user()->id)->get();
            $enproceso=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','en proceso')->where('user_id','=',Auth::user()->id)->get();
            $totalperdidas[$i]=count($perdidas);
            $totalenproceso[$i]=count($enproceso);
            $totalnegociaciones[$i]=count($perdidas)+count($enproceso);
        }
        $data=array("totalperdidas"=>$totalperdidas, "totalenproceso" =>$totalenproceso, "totalnegociaciones" =>$totalnegociaciones);
        return   json_encode($data);
    }
    public function venta_anual_individual($anio){
        for($i=1;$i<=12;$i++){ 
            $primer_dia=1;
            $mes=$i;
            $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
            $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
            $ventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->where('user_id','=',Auth::user()->id)->get();
            $totalventas[$i]=count($ventas);
        }
        $data=array( "totalventas" =>$totalventas);
        return   json_encode($data);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////// ESTADISTICAS ASESOR
    public function indexsalesmanager(){
        $anio=date("Y");
        $mes=date("m");
        return view('salesmanager.charts.index')->with("anio",$anio)->with("mes",$mes); 
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////// ESTADISTICAS JEFE DE MARKETING
    public function indexmarketingmanager(){
        $anio=date("Y");
        $mes=date("m");
        return view('marketingmanager.charts.index')->with("anio",$anio)->with("mes",$mes); 
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////// ESTADISTICAS JEFE DE MARKETING
    public function indexcostumerservicemanager(){
        $anio=date("Y");
        $mes=date("m");
        return view('costumerservicemanager.charts.index')->with("anio",$anio)->with("mes",$mes); 
    }
}


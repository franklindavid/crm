<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Negotiation;
use App\Client;
use App\Product;
use App\DetalleNegociacion;
use Auth; 
use Carbon\Carbon;
use DB;
 
class AdminSalesController extends Controller
{
     
    public function __construct(){
        Carbon::setLocale('es');
    }   
    public function index(Request $request){
        $negotiations = Negotiation::where('estado', '=', 'ganada')->Paginate(11);
//        $negotiations=DB::table('negotiations as n')
//            ->join('clients as c','n.client_id','=','c.id')
//            ->select('n.id','c.name','n.estado','n.detalles','n.forma_pago','n.total_negociacion')->where('n.estado','=', 'ganada')
//            ->orwhere('forma_pago', 'LIKE', '%'.$request->name.'%')
//            ->orwhere('name', 'LIKE', '%'.$request->name.'%') 
//            ->orwhere('cedula', 'LIKE', '%'.$request->name.'%')
//            ->paginate(11);     
        
//        dd($negotiations);
        $anio=date("Y");
        $mes=date("m");
        return view('admin.sales.index')->with('negotiations',$negotiations)->with('request',$request->name)->with("anio",$anio)->with("mes",$mes);        
    }
    public function show($id){        
        $negotiation = Negotiation::find($id);
        return view('admin.sales.show')->with('negotiation',$negotiation);
    }
    public function edit($id){
        $products = Product::where('flag', '=', 1)->get(); 
        $services = Product::where('flag', '=', 0)->get();
        $clients=Client::orderBy('name','ASC')->lists('name','id');
        $negotiation = Negotiation::find($id);
        $my_products=$negotiation->products->lists('id')->ToArray();
        return view('admin.sales.edit')->with('negotiation',$negotiation)->with('products',$products)->with('services',$services)->with('clients',$clients)->with('my_products',$my_products);               
    }  
     public function update(Request $request, $id){
///////////////////////////////////////////////actualizar negociacion
         $negotiation = Negotiation::find($id);  
         $negotiation->fill($request->all());
//            $client = Client::find($negotiation->client_id);
//            $client->estado='cliente';
//            $client->save();   
        $negotiation->save();
         ////////////////////////////////////////////////////////////////retornar a prospecto
           $negotiations = Negotiation::where('client_id', '=', $negotiation->client_id)->where('estado', '=', 'ganada')->get();
//         $client=Client::where('id', '=', $negotiation->client_id)->first();
//         dd($client);
           if (empty($negotiations[0])){
               $client = Client::find($negotiation->client_id);
               $client->estado='prospecto';
               $client->save();
//               dd($client);
           }
//         $old=$negotiation->products;
         //////////////////////////////////////////////////////////////// reseteando productos en detalle
         $resetdetail = DetalleNegociacion::where('negotiation_id', '=', $id)->get();
         $resetcont=0;
         while(count($resetdetail= DetalleNegociacion::where('negotiation_id', '=', $id)->get())){
             $resetproducto = Product::find($resetdetail[0]->product_id);
             $resetproducto->cantidad=$resetproducto->cantidad+$resetdetail[0]->cantidad;
             $resetproducto->update();
             $resetdetail[0]->delete();
         }
//         dd('break');
         
        ///////////////////////////////////////////////////////////////////// actualizar productos en detalle
//         if ($request->idproducto and $request->idservicio){
//            $compra = array_merge($request->idproducto, $request->idservicio);
//            $negotiation->products()->sync($compra);
//        }elseif($request->idproducto){
//            $negotiation->products()->sync($request->idproducto);            
//        }elseif($request->idservicio){
//            $negotiation->products()->sync($request->idservicio);
//        }
         
//        if ($request->idservicio){
//            $negotiation->products()->sync($request->idservicio);
//        }
        $idproducto=$request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $cont = 0;
            while ($cont < count($idproducto)) {
                $detalle = new DetalleNegociacion();
                $detalle->negotiation_id=$negotiation->id;
                $detalle->product_id=$idproducto[$cont];                
                $detalle->cantidad=$cantidad[$cont];
                if($negotiation->estado=='ganada'){
                    $producto = Product::find($idproducto[$cont]);
                    $producto->cantidad=$producto->cantidad-$cantidad[$cont];
                    $producto->update();
                    }
                $detalle->save();
                $cont=$cont+1;
            }
        $idservicio=$request->get('idservicio');
        $cont = 0;
            while ($cont < count($idservicio)) {
                # code...
                $detalle = new DetalleNegociacion();
                $detalle->negotiation_id=$negotiation->id;
                $detalle->product_id=$idservicio[$cont]; 
                $detalle->save();
                $cont=$cont+1;
            }
//         dd('break');
        ////////////////////////////////////////////////////////////////////////actualizar cantidad e productos en detalle
//         if ($request->idproducto){
//             $idproducto=$request->get('idproducto');
//             $cantidad = $request->get('cantidad');
////             dd($cantidad);
//             $cont=0;
////            while ($cont < count($idproducto)) { 
////                 $detalle = DetalleNegociacion::where('negotiation_id', '=', $id)->where('product_id', '=', $idproducto[$cont])->get();
////                 $detalle[0]->cantidad=$cantidad[$cont];
////                if($negotiation->estado=='ganada'){
////                    $producto = Product::find($idproducto[$cont]);
////                    $producto->cantidad=$producto->cantidad-$cantidad[$cont];
////                    $producto->update();
////                    }
////                 $detalle[0]->update();
////                $cont=$cont+1;
////             }
////            $new=$negotiation->products;
////             for ($i = 0; $i < count($old); $i++){
////                 $bandera=0;
//////                 dd($old[$i]->id);
////                 for ($j = 0; $j < count($new); $j++){
//////                     dd($new[$j]->id);
////                    if (($old[$i])==($new[$j])){
////                        $bandera=1;
//////                        dd($bandera);
////                        }
////                   }
////                 if ($bandera==0){
////                     dd($old[$i]);
////                 }
////               }
//
//
////            dd($new);
//while ($cont < count($idproducto)) {            
//    $detalle = DetalleNegociacion::where('negotiation_id', '=', $id)->where('product_id', '=', $idproducto[$cont])->get();
//    if($negotiation->estado!='ganada'){
////        if ($detalle[0]->cantidad==$cantidad[$cont]){
////            $producto = Product::find($idproducto[$cont]);
////            $producto->cantidad=$producto->cantidad+$cantidad[$cont];
////            $producto->update();
////            $detalle[0]->cantidad=$cantidad[$cont];
////            $detalle[0]->update();
////        }elseif($detalle[0]->cantidad<$cantidad[$cont]){
////            $producto = Product::find($idproducto[$cont]);
////            $producto->cantidad=$producto->cantidad+$detalle[0]->cantidad;
////            $producto->update();
////            $detalle[0]->cantidad=$cantidad[$cont];
////            $detalle[0]->update();            
////        }elseif($detalle[0]->cantidad>$cantidad[$cont]){
//            $producto = Product::find($idproducto[$cont]);
//            $producto->cantidad=$producto->cantidad+$detalle[0]->cantidad;
//            $producto->update();
//            $detalle[0]->cantidad=$cantidad[$cont];
//            $detalle[0]->update();                   
////        }        
//    }else{
//        if ($detalle[0]->cantidad==$cantidad[$cont]){                
//            }
//        elseif($detalle[0]->cantidad<$cantidad[$cont]){
//            if($negotiation->estado=='ganada'){
//                $resultado=$cantidad[$cont]-$detalle[0]->cantidad;
//                $producto = Product::find($idproducto[$cont]);
//                $producto->cantidad=$producto->cantidad-$resultado;
//                $producto->update();
//                $detalle[0]->cantidad=$cantidad[$cont];
//                $detalle[0]->update();
//            }
//        }elseif($detalle[0]->cantidad>$cantidad[$cont]){
//            if($negotiation->estado=='ganada'){
//                $resultado=$detalle[0]->cantidad-$cantidad[$cont];
//                $producto = Product::find($idproducto[$cont]);
//                $producto->cantidad=$producto->cantidad+$resultado;
//                $producto->update();
//                $detalle[0]->cantidad=$cantidad[$cont];
//                $detalle[0]->update();
//            }
//            }
//                
//}
//            
//            
//            $cont=$cont+1;
//        }   
//              
//             }  
        flash('se ha modificado la negociacion del usuario '.$negotiation->client->name.' de forma exitosa!', 'success');
        return redirect()->route('admin.sales.index');
    } 
    public function getUltimoDiaMes($elAnio,$elMes) {
        return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }
    public function comprobantsales(Request $request){
        $ingreso=0;
        $anio=$request->get('anio');
        $mes=$request->get('mes');
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $ventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->Paginate(11);
        foreach($ventas as $vent){
                $ingreso=$ingreso+$vent->total_negociacion;
            }
        return view('admin.sales.comprobante')->with('negotiations',$ventas)->with("anio",$anio)->with("mes",$mes)->with("ingreso",$ingreso);
        dd($ventas);
        
    }
}

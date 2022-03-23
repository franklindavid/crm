<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; 
use App\Negotiation;
use App\DetalleNegociacion;
use App\Client; 
use App\Product;
use Carbon\Carbon; 
use DB;
 
class AdminNegotiationsController extends Controller 
{
    public function __construct(){
        Carbon::setLocale('es');
    } 
    public function index(Request $request){
//        $negotiations=Negotiation::where('forma_pago', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
//        $negotiations=DB::table('negotiations as n')
//            ->join('clients as c','n.client_id','=','c.id')
//            ->select('n.id','c.name','n.estado','n.detalles','n.forma_pago','n.total_negociacion')
//            ->where('forma_pago', 'LIKE', '%'.$request->name.'%')->orwhere('name', 'LIKE', '%'.$request->name.'%')->orwhere('cedula', 'LIKE', '%'.$request->name.'%')->paginate(11);
//        dd($negotiations);
        $negotiations = Negotiation::where('estado', '!=', 'ganada')->Paginate(11);
//        $negotiations = Negotiation::orderBy('id','ASC')->paginate(11);       
//        $negotiations = Negotiation::search($request->name)->orderBy('id','DESC')->paginate(5); 
        return view('admin.negotiations.index')->with('negotiations',$negotiations)->with('request',$request->name);  
    }   
    public function show($id){        
        $negotiation = Negotiation::find($id);
        return view('admin.negotiations.show')->with('negotiation',$negotiation);
    }
    public function edit($id){
        $products = Product::where('flag', '=', 1)->get();
        $services = Product::where('flag', '=', 0)->get();
        $clients=Client::orderBy('name','ASC')->lists('name','id');
        $negotiation = Negotiation::find($id);
//        $my_products=$negotiation->products->lists('id')->ToArray();
        $cont2=0;
        $flag=0;   
        $productoAgotado[0]=0;
        $productoAgotado2[0]=0;        
        $productoAgotado3[0]=0;
        while ($cont2<count($negotiation->products)){
            if ($negotiation->products[$cont2]->cantidad<$negotiation->products[$cont2]->pivot->cantidad){  
                flash('no hay suficientes productos para la negociacion en el inventario','danger');
                $flag=1;
            }
            if($negotiation->products[$cont2]->flag<>0){
                $productoAgotado[$cont2] = [
                    "id" => $negotiation->products[$cont2]->id,
                    "cantidad" => $negotiation->products[$cont2]->pivot->cantidad,
                ];
            }
            $cont2=$cont2+1;
        }
        ///////////////////////////////////////////////////////////////
        if($productoAgotado[0]<>0){
            $cont3=0;
            $cont5=0;
            while ($cont3<count($productoAgotado)){
            $cont4=$cont3+1;
            while ($cont4<count($productoAgotado)){ 
                if ($productoAgotado[$cont3]["id"]==$productoAgotado[$cont4]["id"]){
                    $productoAgotado2[$cont5] = [
                    "id" => $productoAgotado[$cont3]["id"],
                    "cantidad" => $productoAgotado[$cont3]["cantidad"]+$productoAgotado[$cont4]["cantidad"],
                    ];
                    $cont5=$cont5+1;
                    $cont4=$cont4+1;
                }
                $cont4=$cont4+1;
            }
            $cont3=$cont3+1;
        }
        $cont6=0;
        $cont7=0;
//        dd($productoAgotado2);  
        if($productoAgotado2[0]<>0){
            while ($cont6<count($productoAgotado2)){
            $producto = Product::find($productoAgotado2[$cont6]["id"]);
            if($producto->cantidad<$productoAgotado2[$cont6]["cantidad"]){
                flash('no hay suficientes productos para la negociacion en el inventario','danger');
                $flag=1;
                $productoAgotado3[$cont7] = [
                    "id" => $productoAgotado2[$cont6]["id"],
                    "cantidad" => $productoAgotado2[$cont6]["cantidad"] ,
                    ];
                 $cont7=$cont7+1;
            }
            $cont6=$cont6+1;
        } 
                
        }
                     
        }
//        dd($productoAgotado3);
        //////////////////////////////////////////////////////////////// 
        
        
        return view('admin.negotiations.edit')->with('negotiation',$negotiation)->with('products',$products)->with('services',$services)->with('clients',$clients)->with('flag',$flag)->with('productoAgotado',$productoAgotado3);               
    }  
     public function update(Request $request, $id){
//         dd($request);
         $negotiation = Negotiation::find($id);  
//         dd($negotiation);
         $negotiation->fill($request->all());
        if ($negotiation->estado=='ganada'){
            $negotiation->updated_at=Carbon::now('America/Bogota');
            $client = Client::find($negotiation->client_id);
            $client->estado='cliente';
            $client->save();
        }   
        $negotiation->save();
         
//         if ($request->idproducto and $request->idservicio){
//            $compra = array_merge($request->idproducto, $request->idservicio);
//            $negotiation->products()->sync($compra);
//        }elseif($request->idproducto){
//            $negotiation->products()->sync($request->idproducto);            
//        }elseif($request->idservicio){
//            $negotiation->products()->sync($request->idservicio);
//        }      
         //////////////////////////////////////////////////////////////// reseteando productos en detalle
         $resetdetail = DetalleNegociacion::where('negotiation_id', '=', $id)->get();
         $resetcont=0;
         while(count($resetdetail= DetalleNegociacion::where('negotiation_id', '=', $id)->get())){
             $resetproducto = Product::find($resetdetail[0]->product_id);
             $resetproducto->cantidad=$resetproducto->cantidad+$resetdetail[0]->cantidad;
             $resetproducto->update();
             $resetdetail[0]->delete();
         }
         
         //////////////////////////////////////////////////////////////////actualizar productos en detalle
             $idproducto=$request->get('idproducto');
             $cantidad = $request->get('cantidad');
//             dd($cantidad);
             $cont=0;
//            while ($cont < count($idproducto)) { 
//                 $detalle = DetalleNegociacion::where('negotiation_id', '=', $id)->where('product_id', '=', $idproducto[$cont])->get();
//                 $detalle[0]->cantidad=$cantidad[$cont];
//                 if($negotiation->estado=='ganada'){
//                    $producto = Product::find($idproducto[$cont]);
//                    $producto->cantidad=$producto->cantidad-$cantidad[$cont];
//                    $producto->update();
//                    }
//                 $detalle[0]->update();
//                $cont=$cont+1;
//             }
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
     flash('se ha modificado la negociacion del usuario '.$negotiation->client->name.' de forma exitosa!', 'success');
        return redirect()->route('admin.negotiations.index');
     }
        
//         if (!$request->product and !$request->service){
//            $this->validate($request, [
//            'product[]'=>'required',
//            ],[
//            'product[].required'=>'la negociacion debe tener al menos un producto o servicio',
//                ]); 
//                }
//        $negotiation = Negotiation::find($id);
//        $negotiation->fill($request->all());
//        if ($negotiation->estado=='ganada'){
//            $client = Client::find($negotiation->client_id);
//            $client->estado='cliente';
//            $client->save();
//        }        
//        $negotiation->save();
//        if ($request->product and $request->service){
//            $compra = array_merge($request->product, $request->service);
//            $negotiation->products()->sync($compra);
//        }elseif($request->product){
//            $negotiation->products()->sync($request->product);            
//        }elseif($request->service){
//            $negotiation->products()->sync($request->service);
//        }
//        flash('se ha modificado la negociacion del usuario '.$negotiation->client->name.' de forma exitosa!', 'success');
//        return redirect()->route('admin.negotiations.index');
        
    }


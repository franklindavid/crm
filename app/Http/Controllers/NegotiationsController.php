<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Negotiation;
use App\Client; 
use App\DetalleNegociacion;
use App\Product;
use Auth;
use Carbon\Carbon;
use DB;

class NegotiationsController extends Controller
{
    public function __construct(){ 
        Carbon::setLocale('es');
    }
    public function index(Request $request){
//        $negotiations = Negotiation::where('user_id', '=', Auth::user()->id)->where('estado', '!=', 'ganada')->Paginate(11);
        
//        $negotiations = DB::table('negotiations as n')
//            ->join('clients as c','n.client_id','=','c.id')
//            ->select('n.id','n.user_id','c.name','n.estado','n.detalles','n.forma_pago','n.total_negociacion')
//            ->where('n.user_id', '=', Auth::user()->id)->where('n.estado', '!=', 'ganada')->where('forma_pago', 'LIKE', '%'.$request->name.'%')->orwhere('name', 'LIKE', '%'.$request->name.'%')->orwhere('cedula', 'LIKE', '%'.$request->name.'%')->paginate(11);
        
        $negotiations = DB::table('negotiations as n')
            ->join('clients as c','n.client_id','=','c.id')
            ->select('n.id','n.user_id','c.name','n.estado','n.detalles','n.forma_pago','n.total_negociacion')
            ->where('n.user_id', '=', Auth::user()->id)->where('n.estado', '!=', 'ganada')->where('cedula', 'LIKE', '%'.$request->name.'%')->paginate(11);
        
        return view('advisor.negotiations.index')->with('negotiations',$negotiations)->with('request',$request->name); 
    }
    public function create(){ 
//        $products = Product::orderBy('id','ASC')->lists('name','id');
//        $products = Product::orderBy('id','ASC')->lists('name','id');
        $products = Product::where('flag', '=', 1)->get();
        $services = Product::where('flag', '=', 0)->get();
//        dd($services);
        $clients = Client::where('user_id', '=', Auth::user()->id)->lists('name','id');
        return view('advisor.negotiations.create')->with('clients',$clients)->with('products',$products)->with('services',$services);
    }
    
    public function store(Request $request){
//        dd($request);
        $negotiation= new Negotiation($request->all());
        if ($negotiation->estado=='ganada'){    
//            dd(Carbon::now('America/Bogota')->toDateTimeString());
            $negotiation->cierre=Carbon::now('America/Bogota');
            $client = Client::find($negotiation->client_id);
            $client->estado='cliente';
            $client->save();
        }   
        $negotiation->save();
//        $request->cantidad;
        
//        if ($request->idproducto and $request->idservicio){
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
                # code...
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
//                dd($detalle);
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
//        negotiation_product 
        flash('se ha registrado la negociacion de forma exitosa!', 'success');
        return redirect()->route('advisor.negotiations.index');
    }    
    public function show($id){        
        $negotiation = Negotiation::find($id);
        $products = Product::orderBy('name','ASC')->lists('name','id','precio_venta');
//        dd($products);
        $my_products=$negotiation->products->lists('id')->ToArray();
//        dd($my_products);
//        $totalCost = $my_products->sum('precio_venta');
//        dd($totalcost);
        return view('advisor.negotiations.show')->with('negotiation',$negotiation)->with('my_products',$my_products);
    } 
    public function edit($id){
        $products = Product::where('flag', '=', 1)->get();
        $services = Product::where('flag', '=', 0)->get();
        $clients = Client::where('user_id', '=', Auth::user()->id)->lists('name','id');
        $negotiation = Negotiation::find($id);
        $my_products=$negotiation->products->lists('id')->ToArray();
//        dd(count($negotiation->products));
        $cont2=0;
        $flag=0;
////        $productoAgotado = new Product();
        $productoAgotado[0]=0;        
        $productoAgotado2[0]=0;        
        $productoAgotado3[0]=0;        
        while ($cont2<count($negotiation->products)){
            if ($negotiation->products[$cont2]->cantidad<$negotiation->products[$cont2]->pivot->cantidad){  
                flash('no hay suficientes productos para la negociacion en el inventario','danger');
                $flag=1;
//                $productoAgotado[0]=$negotiation->products[0]->id;
//                $productoAgotado[$cont2]=$negotiation->products[$cont2]->id;
                
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
        //////////////////////////////////////////////////////////////// 
        
//        dd($cont5);
//        dd($productoAgotado2);
        
//        dd($negotiation->products[0]->pivot->cantidad);
//        flash('hola', 'success');
//        flash('Message 1');
//        flash('Message 2')->important();
        
        return view('advisor.negotiations.edit')->with('negotiation',$negotiation)->with('clients',$clients)->with('products',$products)->with('services',$services)->with('flag',$flag)->with('productoAgotado',$productoAgotado3);               
    } 
    public function update(Request $request, $id){
         $negotiation = Negotiation::find($id);  
         $negotiation->fill($request->all());
        if ($negotiation->estado=='ganada'){
            $negotiation->cierre=Carbon::now('America/Bogota');
            $negotiation->updated_at=Carbon::now('America/Bogota');
            $client = Client::find($negotiation->client_id);
            $client->estado='cliente';
            $client->save();
        }   
        $negotiation->save();
        //////////////////////////////////////////////////////////////// reseteando productos en detalle
         $resetdetail = DetalleNegociacion::where('negotiation_id', '=', $id)->get();
         $resetcont=0;
         while(count($resetdetail= DetalleNegociacion::where('negotiation_id', '=', $id)->get())){
             $resetdetail[0]->delete();
         }
//         if ($request->idproducto and $request->idservicio){
//            $compra = array_merge($request->idproducto, $request->idservicio);
//            $negotiation->products()->sync($compra);
//        }elseif($request->idproducto){
//            $negotiation->products()->sync($request->idproducto);            
//        }elseif($request->idservicio){
//            $negotiation->products()->sync($request->idservicio);
//        }         
         
             $idproducto=$request->get('idproducto');
             $cantidad = $request->get('cantidad');
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
        return redirect()->route('advisor.negotiations.index');
        
    }
    public function destroy($id){
//        $product = Product::find($id);
//        $product->delete();
//         flash('se ha eliminado '.$product->name.' de forma exitosa!', 'warning');
//         return redirect()->route('admin.products.index');
    
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; 
use App\Negotiation;
use App\Client;
use App\Product;
use Auth;  
use Carbon\Carbon;
use App\DetalleNegociacion; 
use DB;
 

class SalesManagerSalesController extends Controller
{ 
    public function __construct(){
        Carbon::setLocale('es');
    }
        public function index(Request $request){
//        $negotiations = Negotiation::where('user_id', '=', Auth::user()->id)->where('estado', '=', 'ganada')->Paginate(11);
        $negotiations = DB::table('negotiations as n')
            ->join('clients as c','n.client_id','=','c.id')
            ->select('n.id','n.user_id','c.name','n.estado','n.detalles','n.forma_pago','n.total_negociacion')
            ->where('n.user_id', '=', Auth::user()->id)->where('n.estado', '=', 'ganada')->where('cedula', 'LIKE', '%'.$request->name.'%')->paginate(11);
            $anio=date("Y");
            $mes=date("m");
        return view('salesmanager.sales.index')->with('negotiations',$negotiations)->with('request',$request->name)->with("anio",$anio)->with("mes",$mes);  
    }
    public function create(){ 
        $products = Product::where('flag', '=', 1)->get();
        $services = Product::where('flag', '=', 0)->get();
        $clients = Client::where('user_id', '=', Auth::user()->id)->lists('name','id');     
        return view('salesmanager.sales.create')->with('clients',$clients)->with('products',$products)->with('services',$services);
    }
    
    public function store(Request $request){
        $negotiation= new Negotiation($request->all());
        if ($negotiation->estado=='ganada'){            
            $negotiation->cierre=Carbon::now('America/Bogota');
            $negotiation->updated_at=Carbon::now('America/Bogota');
            $client = Client::find($negotiation->client_id); 
            $client->estado='cliente';
            $client->save();
        }   
        $negotiation->save(); 
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
        flash('se ha registrado la negociacion de forma exitosa!', 'success');
        return redirect()->route('salesmanager.sales.index');        
    }
    public function show($id){        
        $negotiation = Negotiation::find($id);
        $products = Product::orderBy('name','ASC')->lists('name','id','precio_venta');
        $my_products=$negotiation->products->lists('id')->ToArray();
        return view('salesmanager.sales.show')->with('negotiation',$negotiation)->with('my_products',$my_products);
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
        $ventas=Negotiation::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('estado','=','ganada')->where('user_id', '=', Auth::user()->id)->Paginate(11);
        foreach($ventas as $vent){
                $ingreso=$ingreso+$vent->total_negociacion;
            }
        return view('salesmanager.sales.comprobante')->with('negotiations',$ventas)->with("anio",$anio)->with("mes",$mes)->with("ingreso",$ingreso);
        dd($ventas);
        
    }
}
 
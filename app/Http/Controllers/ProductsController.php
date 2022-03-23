<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
 
class ProductsController extends Controller
{
    public function index(Request $request){
        $products=Product::where('name', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
//        $products = Product::orderBy('id','ASC')->paginate(11);        
//        $totalCost = $products->sum('precio_venta');
//        dd($totalCost);
//return View::make('your.view', array('totalCost' => $totalCost));
        return view('admin.products.index')->with('products',$products)->with('request',$request->name);
    }
    public function create($flag){         
        if ($flag==1){
//            dd(1);
            return view('admin.products.create');
        }else{
//            dd(0);
            return view('admin.products.create2');
        }        
    }
    
    public function store(ProductRequest $request){
        $product= new Product($request->all());
        $product->save();
        flash('se ha registrado '.$product->name.' de forma exitosa!', 'success');
        return redirect()->route('admin.products.index');
    }
    public function show($id){
        
    }
    public function showProductAdvisor(Request $request){
        $products=Product::where('name', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
//        $products = Product::orderBy('id','ASC')->paginate(5);
//        $totalCost = $products->sum('precio_venta');
//        dd($totalCost);
        return view('advisor.products.index')->with('products',$products)->with('request',$request->name);
    }
    public function showProductCostumerServiceManager(Request $request){
        $products=Product::where('name', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
        return view('costumerservicemanager.products.index')->with('products',$products)->with('request',$request->name);
    }
    public function showProductTechnical(Request $request){
        $products=Product::where('name', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
        return view('technical.products.index')->with('products',$products)->with('request',$request->name);
    }
    public function showProductSalesManager(Request $request){
        $products=Product::where('name', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
        return view('salesmanager.products.index')->with('products',$products)->with('request',$request->name);
    }
    public function showProductMarketingManager(Request $request){
        $products=Product::where('name', 'LIKE', '%'.$request->name.'%')->orderBy('id','ASC')->paginate(11);
        return view('marketingmanager.products.index')->with('products',$products)->with('request',$request->name);
    }
    public function edit($id){
        $product = Product::find($id);
//        dd($product->flag);
        if ($product->flag=='1'){
//            dd($product->flag);
            return view('admin.products.edit')->with('product',$product);
        }else{
            return view('admin.products.edit2')->with('product',$product);
        }
                
    }
    public function update(ProductUpdateRequest $request, $id){
        $product = Product::find($id);
        $product->fill($request->all());
        $product->save();
        flash('se ha modificado el producto '.$product->name.' de forma exitosa!', 'success');
        return redirect()->route('admin.products.index');
        
    }
    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
         flash('se ha eliminado '.$product->name.' de forma exitosa!', 'warning');
         return redirect()->route('admin.products.index');
    
    }
    public function stats($id){
        $product = Product::find($id);
        $anio=date("Y");
        return view('admin.products.stats')->with('id',$id)->with('name',$product->name)->with('anio',$anio);
    } 
}

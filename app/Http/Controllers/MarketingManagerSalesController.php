<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Negotiation;
use App\Product;
use Carbon\Carbon;

class MarketingManagerSalesController extends Controller
{
    public function __construct(){ 
        Carbon::setLocale('es');
    }
    public function show($id){        
        $negotiation = Negotiation::find($id);
        $products = Product::orderBy('name','ASC')->lists('name','id','precio_venta');
        $my_products=$negotiation->products->lists('id')->ToArray();
        return view('marketingmanager.sales.show')->with('negotiation',$negotiation)->with('my_products',$my_products);
    }
}
 
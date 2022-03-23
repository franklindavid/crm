<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>comprobante de venta</title>
	<link rel="stylesheet" href="/localhost/crmpdf/public/plugins/bootstrap/css/bootstrap.min.css">
<style>
 
 .col-md-12 {
    width: 100%;
} 

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    background-color: #ECF0F5;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}


.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;

}


.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}


.table-bordered {
    border: 1px solid #fff;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

table {
    background-color: transparent;
}

 .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #fff;
/*     border-top:thin solid red;*/
}


.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
}

.bg-red {
    background-color: #dd4b39 !important;
}
.bg-blue {
    background-color: #3A48DF !important;
}
</style>
</head>
<body>

<div class="row">
        <div>
            <div>
               <label>Cliente</label>
               <p>{{$negotiation->client->name}}</p>
            </div>
        </div>
        <div>
            <div>
                <label>Forma de pago</label>
                <p>{{$negotiation->forma_pago}}</p>
            </div>
        </div>
        <div>
            <div>
                <label>Detalles</label>
                <p>{{$negotiation->detalles}}</p>
            </div>
        </div>
         <div>
            <div>
                <label>Frecha apertura</label>
                <p>{{$negotiation->created_at}}({!!$negotiation->created_at->diffForHumans()!!} )</p>
            </div>
        </div>
        <div>
            <div>
                <label>Frecha cierre</label>
                <p>{{$negotiation->updated_at}}({!!$negotiation->updated_at->diffForHumans()!!} )</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <tr style="background-color: #A9D0F5">                                
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                            <tbody>
                            @foreach($negotiation->products as $product)
                             <tr>
                                 <td>{{$product->name}}</td>
                                 @if($product->flag==1)
                                 <td>{{$product->pivot->cantidad}}</td>
                                 @else
                                 <td></td>                                 
                                 @endif
                                 <td>{{$product->precio_venta}}</td>
                                 @if($product->flag==1)
                                 <td>{{$product->pivot->cantidad*$product->precio_venta}}</td>                                 
                                 @else
                                 <td>{{$product->precio_venta}}</td>                                 
                                 @endif
                             </tr>
                             @endforeach                           
                            </tbody>
                            <tr>
                                <th>TOTAL</th>                               
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">$/ {{$negotiation->total_negociacion}}</h4></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    <script src="localhost/crmpdf/public/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>



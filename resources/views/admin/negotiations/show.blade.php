@extends('layouts.app')
@section('title','detalle negociacion')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-briefcase"></i> Detalle negociación  <font style="text-transform: capitalize;">{{$negotiation->client->estado}} {{$negotiation->client->name}}</font> </h2>   
    </div>
        <div class="panel-body">
<div class="row"> 
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
               <label>Cliente</label>
               <p>{{$negotiation->client->name}}</p>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Estado</label>
                <p>{{$negotiation->estado}}</p>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Frecha apertura</label>
                <p><i class="fa fa-clock-o"> </i>{{$negotiation->created_at}}({!!$negotiation->created_at->diffForHumans()!!} )</p>
            </div>
        </div>        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Forma de pago</label>
                <p>{{$negotiation->forma_pago}}</p>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label>Detalles</label>
                <p>{{$negotiation->detalles}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #A9D0F5">                                
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </thead>
                            <tfoot>
                                <th>TOTAL</th>                               
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">$/ {{$negotiation->total_negociacion}}</h4></th>
                            </tfoot>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>
@endsection
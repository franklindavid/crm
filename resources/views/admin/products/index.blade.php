@extends('layouts.app')
@section('title','Productos/servicios')
@section('content') 
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-archive"></i> <i class="fa fa-wrench"></i> Productos/servicios </h2>   
    </div>
        <div class="panel-body">
<div role="tabpanel"> 
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#Seccion1" aria-controls="Seccion1" data-toggle="tab" role="tab">PRODUCTOS</a></li>
            <li role="presentation"><a href="#Seccion2" aria-controls="Seccion2" data-toggle="tab" role="tab">SERVICIOS</a></li>						
        </ul>
    <div class="tab-content">
 
    {!! Form::open(['route'=>'admin.products.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
    <div class="input-group">     
     	{!! Form::text('name',$request,['class'=>'form-control','placeholder'=>'buscar producto/servicio...','aria-describedby'=>'search']) !!}
     	<span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
    </div>
    {!! Form::close() !!} 
       
        <div role="tabpanel" class="tab-pane active" id="Seccion1">							
            <a href="{{ route('admin.products.create',1) }}" class="btn btn-info">Registrar producto</a><a title="genera pdf" href="product/pdf?name={{$request}}" class="btn btn-danger">Generar PDF <i class="fa fa-file-pdf-o"></i></a><br>
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Nombre</th>
		<th>Cantidad</th> 
		<th>Precio fabrica</th>
		<th>Precio venta</th>		
		<th>Descripcion</th>
		<th>Accion</th> 
	</thead>
	<tbody>
		@foreach($products as $product)
           @if($product->flag == 1)
            <tr>
            	<td>{{ $product->id }}</td>
            	<td>{{ $product->name }}</td>
            	<td>{{ $product->cantidad }}</td>
            	<td>{{ $product->precio_fabrica }}</td>
            	<td>{{ $product->precio_venta }}</td>
            	<td>{{ $product->descripcion }}</td>
            	
            	<td><a title="modificar" href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-wrench"></i></a>
                    <a title="ver estadisticas" href="{{ route('admin.products.stats',$product->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-bar-chart"></i></a>
                    <a title="eliminar" href="{{ route('admin.products.destroy',$product->id) }}" onclick="return confirm('¿desea eliminar el producto?')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
                </td>
            </tr>
            @endif
		@endforeach		
	</tbody>
</table>
        </div>
        <div role="tabpanel" class="tab-pane" id="Seccion2">							
        <a href="{{ route('admin.products.create',0) }}" class="btn btn-info">Registrar servicio</a><a title="genera pdf" href="service/pdf?name={{$request}}" class="btn btn-danger">Generar pdf <i class="fa fa-file-pdf-o"></i></a><br>
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Nombre</th>		
		<th>Precio</th>		
		<th>Descripcion</th>
		<th>Accion</th>
	</thead>
	<tbody>
		@foreach($products as $product)
           @if($product->flag == 0)
            <tr> 
            	<td>{{ $product->id }}</td>
            	<td>{{ $product->name }}</td>            	
            	<td>{{ $product->precio_venta }}</td>
            	<td>{{ $product->descripcion }}</td>
            	
            	<td><a title="modificar" href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-wrench"></i></a>
                    <a title="ver estadisticas" href="{{ route('admin.products.stats',$product->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-bar-chart"></i></a>
                    <a title="eliminar" href="{{ route('admin.products.destroy',$product->id) }}" onclick="return confirm('¿desea eliminar el producto?')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
                </td>
            </tr>
            @endif
		@endforeach		
	</tbody>
</table>
        </div>						
    </div>
</div>
{!! $products->render() !!}

@endsection
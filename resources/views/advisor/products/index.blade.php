@extends('layouts.app')
@section('title','Lista de productos')
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
       {!! Form::open(['route'=>'advisor.products.showProductAdvisor','method'=>'GET','class'=>'navbar-form pull-right']) !!}
    <div class="input-group">     
     	{!! Form::text('name',$request,['class'=>'form-control','placeholder'=>'buscar producto/servicio...','aria-describedby'=>'search']) !!}
     	<span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
    </div>
    {!! Form::close() !!}
        <div role="tabpanel" class="tab-pane active" id="Seccion1">
           <a title="genera pdf" href="product/pdf?name={{$request}}" class="btn btn-danger">Generar pdf <i class="fa fa-file-pdf-o"></i></a>							
            <br> 
<table class="table table-striped">
	<thead>
		<th>ID</th> 
		<th>Nombre</th>
		<th>Cantidad</th>		
		<th>Precio venta</th>		
		<th>Descripcion</th>
	</thead>
	<tbody> 
		@foreach($products as $product)
           @if($product->flag == 1)
            <tr>
            	<td>{{ $product->id }}</td>
            	<td>{{ $product->name }}</td>
            	<td>{{ $product->cantidad }}</td>            	
            	<td>{{ $product->precio_venta }}</td>
            	<td>{{ $product->descripcion }}</td> 
            </tr>
            @endif
		@endforeach		
	</tbody>
</table>
        </div>
        <div role="tabpanel" class="tab-pane" id="Seccion2">
        <a title="genera pdf" href="service/pdf?name={{$request}}" class="btn btn-danger">Generar pdf <i class="fa fa-file-pdf-o"></i></a>	
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Nombre</th>		
		<th>Precio</th>		
		<th>Descripcion</th>
	</thead>
	<tbody>
		@foreach($products as $product)
           @if($product->flag == 0)
            <tr> 
            	<td>{{ $product->id }}</td>
            	<td>{{ $product->name }}</td>            	
            	<td>{{ $product->precio_venta }}</td>
            	<td>{{ $product->descripcion }}</td>
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
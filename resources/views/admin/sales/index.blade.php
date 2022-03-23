@extends('layouts.app')
@section('title','Lista de Ventas')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-usd"></i> Ventas </h2>   
    </div>
        <div class="panel-body">
{!! Form::open(['route'=>'admin.sales.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
     <div class="input-group">     
     	{!! Form::text('name',$request,['class'=>'form-control','placeholder'=>'buscar venta...','aria-describedby'=>'search']) !!}
     	<span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
     </div>
{!! Form::close() !!}
<a title="generar PDF" href="generalsale/pdf?name={{$request}}" class="btn btn-danger">Generar pdf <i class="fa fa-file-pdf-o"></i></a>
<a title="Comprobantes" href="comprobantesale?anio={{$anio}}&mes={{$mes}}" class="btn btn-default">Comprobantes <i class="fa fa-file-o"></i></a>
<table class="table table-striped">
	<thead> 
		<th>Cliente</th>
		<th>Detalles</th>
		<th>Forma de pago</th>		
		<th>Total</th>		
		<th>Asesor</th>		
		<th>Accion</th>		
	</thead> 
	<tbody>	 
		@foreach($negotiations as $negotiation)  
                     
            <tr>
            	<td>{{ $negotiation->client->name }}</td>            	 
                <td>{{ $negotiation->detalles }}</td>          	
                <td>{{ $negotiation->forma_pago }}</td> 
                <td>{{ $negotiation->total_negociacion }}</td> 
                <td>{{ $negotiation->user->name }}</td> 
                <td>
                    <a title="ver detalle" href="{{ route('admin.sales.show',$negotiation->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>                 
                    <a title="modificar" href="{{ route('admin.sales.edit',$negotiation->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-wrench"></i>   
                    </a>                    
                </td>         	
            </tr> 
                      
		@endforeach		
	</tbody>
</table>
{!! $negotiations->render() !!}
@endsection 
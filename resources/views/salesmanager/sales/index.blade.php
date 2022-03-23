@extends('layouts.app')
@section('title','Lista de ventas')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-usd"></i> Ventas </h2>   
    </div>
        <div class="panel-body">
        
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
<a href="{{ route('salesmanager.sales.create') }}" class="btn btn-info">Registrar</a>
<a title="generar PDF" href="generalsale/pdf?name={{$request}}" class="btn btn-danger">GENERAR PDF <i class="fa fa-file-pdf-o"></i></a>
<a title="Comprobantes" href="comprobantesale?anio={{$anio}}&mes={{$mes}}" class="btn btn-default">Comprobantes <i class="fa fa-file-o"></i></a>
</div>
{!! Form::open(['route'=>'salesmanager.sales.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
     <div class="input-group">     
     	{!! Form::text('name',$request,['class'=>'form-control','placeholder'=>'buscar venta...','aria-describedby'=>'search']) !!}
     	<span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
     </div>
{!! Form::close() !!} 

<table class="table table-striped">
	<thead> 
		<th>Cliente</th>
		<th>Estado</th>
		<th>Detalles</th>
		<th>Forma de pago</th>		
		<th>Total</th>		
		<th>Accion</th>		
	</thead>
	<tbody>	
		@foreach($negotiations as $negotiation)  
           @if($negotiation->estado == "ganada")            
            <tr>
            	<td>{{ $negotiation->name }}</td>
            	<td><span class="label label-primary">{{ $negotiation->estado }}</span></td>  
                <td>{{ $negotiation->detalles }}</td>          	
                <td>{{ $negotiation->forma_pago }}</td> 
                <td>{{ $negotiation->total_negociacion }}</td> 
                <td>
                    <a title="ver detalles" href="{{ route('salesmanager.sales.show',$negotiation->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>                                       
                </td>         	
            </tr> 
            @endif           
		@endforeach		
	</tbody>
</table>
{!! $negotiations->render() !!}
@endsection
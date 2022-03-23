@extends('layouts.app')
@section('title','Lista de Ventas')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-usd"></i> Comprobantes </h2>   
    </div>
        <div class="panel-body">
{!! Form::open(['route'=>'advisor.sales.comprobant','method'=>'GET']) !!}
     <div class="input-group">  
         <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">    
            {!! Form::select('anio',['2017'=>'2017','2018'=>'2018','2019'=>'2019'],$anio,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
         </div>
         <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">  
            {!! Form::select('mes',['1'=>'enero','2'=>'febrero','3'=>'marzo','4'=>'abril','5'=>'mayo','6'=>'junio','7'=>'julio','8'=>'agosto','9'=>'septiembre','10'=>'octubre','11'=>'noviembre','12'=>'diciembre'],$mes,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
         </div>
         <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12"> 
            {!! Form::submit('Filtrar',['class'=>'btn btn-primary']) !!} 
         </div>
         <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12"> 
         Total ingresos: ${{$ingreso}}
        </div>
     </div>
{!! Form::close() !!}
<table class="table table-striped">
	<thead> 
		<th>Cliente</th>
		<th>Detalles</th>
		<th>Forma de pago</th>		
		<th>Total</th>		
		<th>Accion</th>		
	</thead> 
	<tbody>	 
		@foreach($negotiations as $negotiation)  
                     
            <tr>
            	<td>{{ $negotiation->client->name }}</td>            	 
                <td>{{ $negotiation->detalles }}</td>          	
                <td>{{ $negotiation->forma_pago }}</td> 
                <td>{{ $negotiation->total_negociacion }}</td> 
                <td>
                    <a title="ver detalle" href="{{ route('admin.sales.show',$negotiation->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>                   
                </td>         	
            </tr>    
		@endforeach	
	</tbody>
</table>
{!! $negotiations->render() !!}
@endsection 
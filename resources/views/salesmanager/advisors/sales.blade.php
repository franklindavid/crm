@extends('layouts.app')
@section('title','Lista de ventas del cliente '.$client->name)
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Ventas <font style="text-transform: capitalize;">{{$client->estado}} {{$client->name}}</font></h2>   
    </div>
        <div class="panel-body">
<!--<a href="{{ route('salesmanager.clients.createnegotiations',$client->id) }}" class="btn btn-info">Crear Negociacion</a><br>-->
<table class="table table-striped">
	<thead> 		
		<th>Estado</th>
		<th>Detalles</th>
		<th>Forma de pago</th>		
		<th>Total</th>		
		<th>Accion</th>		
	</thead>
	<tbody>	
		@foreach($negotiations as $negotiation)             
            <tr>            	
            	<td>
                    @if($negotiation->estado == "en proceso")
                        <span class="label label-success">{{ $negotiation->estado }}</span>
                    @elseif($negotiation->estado == "ganada")
                        <span class="label label-primary">{{ $negotiation->estado }}</span>
                    @else
                        <span class="label label-danger">{{ $negotiation->estado }}</span>
                    @endif
                </td>  
                <td>{{ $negotiation->detalles }}</td>          	
                <td>{{ $negotiation->forma_pago }}</td> 
                <td>{{ $negotiation->total_negociacion }}</td> 
                <td><a title="ver detalle" href="{{ route('salesmanager.sales.show',$negotiation->id) }}" class="glyphicon glyphicon-eye-open btn btn-success btn-xs"></a> 
                 
                  @if($negotiation->estado != "ganada")             
                   <a title="modificar" href="{{ route('salesmanager.negotiations.edit',$negotiation->id) }}" class="glyphicon glyphicon-wrench btn btn-warning btn-xs"></a> 
                   @endif                   
                </td>         	
            </tr>            
		@endforeach		
	</tbody>
</table>
{!! $negotiations->render() !!}
@endsection
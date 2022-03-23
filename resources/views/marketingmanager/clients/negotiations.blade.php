@extends('layouts.app')
@section('title','Lista de negociaciones del cliente '.$client->name)
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-briefcase"></i> Negociaciones <font style="text-transform: capitalize;">{{$client->name}}</font></h2>   
    </div>
        <div class="panel-body">
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
                <td>
                    <a title="ver detalle" href="{{ route('marketingmanager.negotiations.show',$negotiation->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>      
                </td>         	
            </tr>            
		@endforeach		
	</tbody>
</table>
{!! $negotiations->render() !!}
@endsection
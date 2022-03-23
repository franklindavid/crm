@extends('layouts.app')
@section('title','Lista de negociaciones del cliente '.$client->name)
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h3><i class="fa fa-usd"></i> Ventas <font style="text-transform: capitalize;">{{$client->name}}</font></h3>   
    </div>
        <div class="panel-body">

<table class="table table-striped">
	<thead> 		
		<th>Estado</th>
		<th>Detalles</th>
		<th>Forma de pago</th>		
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
                <td><a title="ver detalles" href="{{ route('admin.negotiations.show',$negotiation->id) }}" class="glyphicon glyphicon-eye-open btn btn-success btn-xs"></a>                 
                   <a title="modificar" href="{{ route('admin.negotiations.edit',$negotiation->id) }}" class="glyphicon glyphicon-wrench btn btn-warning btn-xs"></a>                    
                </td>          	
            </tr>            
		@endforeach		
	</tbody>
</table>
{!! $negotiations->render() !!}
@endsection
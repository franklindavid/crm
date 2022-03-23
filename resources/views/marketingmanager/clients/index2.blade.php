@extends('layouts.app')
@section('title','Lista de referidos del cliente '.$client->name) 
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Referidos <font style="text-transform: capitalize;">{{$client->name}}</font></h2>   
    </div>
        <div class="panel-body">
<table class="table table-striped">
	<thead> 
		<th>Cedula</th>
		<th>Nombre</th>
		<th>Estado</th>
		<th>Tipo</th>		
		<th>Asesor</th>		
		<th>Accion</th>		
	</thead>
	<tbody>		 
		@foreach($referreds as $referred)           
                      
<!--           {!! $client2 = App\Client::find($referred->padre_id) !!}-->
            <tr>
            	<td>{{ $client2->cedula }}</td>
            	<td>{{ $client2->name }}</td>
            	<td>
                    @if($client2->estado == "prospecto")
                        <span class="label label-danger">{{ $client2->estado }}</span>
                    @else
                        <span class="label label-primary">{{ $client2->estado }}</span>
                    @endif
                </td>
            	<td>{{ $client2->tipo }}</td>             	
            	<td>{{ $client2->user->name }}</td>              	
            	<td>
                    <a title="ver detalles" href="{{ route('marketingmanager.clients.details',$referred->padre_id) }}" class="btn btn-success btn-xs">
                            <i class="fa fa-eye"></i>
            	    </a>
                    <a title="ver referidos" href="{{ route('marketingmanager.clients.index2',$referred->padre_id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"></i>
                    </a>
                    <a title="ver negociaciones" href="{{ route('marketingmanager.clients.negotiations',$referred->padre_id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-briefcase"></i>
                    </a>
                    <a title="ver ventas" href="{{ route('marketingmanager.clients.sales',$client->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-usd"></i>
                    </a>
                </td>
            </tr>
            
		@endforeach
	</tbody>
</table>
{!! $referreds->render() !!}
@endsection
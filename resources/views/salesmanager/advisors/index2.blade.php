@extends('layouts.app')
@section('title','Lista de clientes')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Clientes/prospectos </h2>   
    </div>
        <div class="panel-body">
<table class="table table-striped">
	<thead> 
		<th>Cedula</th>
		<th>Nombre</th>
		<th>Estado</th>
		<th>Tipo</th>		
		<th>Agregado por</th>		
		<th>Accion</th>		
	</thead>
	<tbody>	 
		@foreach($clients as $client)  
            <tr>
            	<td>{{ $client->cedula }}</td>
            	<td>{{ $client->name }}</td>
            	<td>
                    @if($client->estado == "prospecto")
                        <span class="label label-danger">{{ $client->estado }}</span>
                    @else
                        <span class="label label-primary">{{ $client->estado }}</span>
                    @endif
                </td> 
            	<td>{{ $client->tipo }}</td>             	
            	<td>{{ $client->user->name }}</td>            	
            	<td>
                    <a title="ver detalles" href="{{ route('salesmanager.clients.details',$client->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
            	    </a>
                    <a title="ver referidos" href="{{ route('salesmanager.advisors.referreds',$client->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"></i>
                    </a>
                    <a title="ver negociaciones" href="{{ route('salesmanager.advisors.negotiations',$client->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-briefcase"></i>
                    </a>
                    <a title="ver vemtas" href="{{ route('salesmanager.advisors.sales',$client->id) }}" class="btn btn-success btn-xs">
                            <i class="fa fa-usd"></i>
                        </a>
                    @if($client->estado == "prospecto")
                        <a title="ver estadisticas" href="{{ route('salesmanager.clients.statsprospect',$client->id) }}" class="btn btn-default btn-xs">
                            <i class="fa fa-bar-chart"></i>
                        </a>
                    @endif
                    @if($client->estado == "cliente")
                        <a title="ver estadisticas" href="{{ route('salesmanager.clients.statsclient',$client->id) }}" class="btn btn-default btn-xs">
                            <i class="fa fa-bar-chart"></i>
                        </a>
                    @endif
                    
                    <a title="modificar" href="{{ route('salesmanager.advisors.clients',$client->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-wrench"></i>    
                    </a>
<!--                    <a title="eliminar" href="{{ route('salesmanager.clients.destroy',$client->id) }}" onclick="return confirm('¿desea eliminar el cliente/prospecto?')" class="glyphicon glyphicon-remove btn btn-danger btn-xs"></a>-->
                </td>
            </tr>            
		@endforeach		
	</tbody>
</table>
{!! $clients->render() !!}
@endsection
@extends('layouts.app')
@section('title','Lista de clientes')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> clientes/prospectos Generales</h2>   
    </div>
        <div class="panel-body">
<a href="{{ route('salesmanager.clients.create') }}" class="btn btn-info">Registrar</a>
<a title="generar PDF" href="generalclient/pdf?name={{$request}}" class="btn btn-danger">GENERAR PDF <i class="fa fa-file-pdf-o"></i></a>
{!! Form::open(['route'=>'salesmanager.generalclients.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
     <div class="input-group">     
     	{!! Form::text('name',$request,['class'=>'form-control','placeholder'=>'buscar cliente/prospecto...','aria-describedby'=>'search']) !!}
     	<span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
     </div>
{!! Form::close() !!}
 
<table class="table table-striped">
	<thead> 
		<th>Cedula</th>
		<th>Nombre</th>
		<th>Estado</th> 
		<th>Tipo</th>		
		<th>Agregado por:</th>		
		<th>Oportunidad</th>		
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
            	@if($client->estado == "prospecto")   
                    <td>    
                        @if( $client->oportunidad == 1)
                            <span class="label label-danger">ALTA</span>
                        @elseif($client->oportunidad == 2)
                            <span class="label label-success">MEDIA</span>
                        @else
                            <span class="label label-primary">BAJA</span>
                        @endif
                    </td>
                @else
                    <td></td>
            	@endif               	
            	<td>
                    <a title="ver detalles" href="{{ route('salesmanager.clients.details',$client->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a title="ver referidos" href="{{ route('salesmanager.clients.index2',$client->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"></i> 
                    </a>
                    <a title="asignar tarea" href="{{ route('salesmanager.clients.tasks',$client->id) }}" class="btn btn-danger btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a title="ver negociaciones" href="{{ route('salesmanager.clients.negotiations',$client->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-briefcase"></i>      
                    </a>
                    <a title="ver ventas" href="{{ route('salesmanager.clients.sales',$client->id) }}" class="btn btn-success btn-xs">
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
                    <a title="modificar" href="{{ route('salesmanager.clients.edit2',$client->id) }}" class="btn btn-warning btn-xs">
                       <i class="fa fa-wrench"></i>
                    </a>
<!--                    <a  title="eliminar" href="{{ route('salesmanager.clients.destroy',$client->id) }}" onclick="return confirm('¿desea eliminar el cliente/prospecto?')" class="glyphicon glyphicon-remove btn btn-danger btn-xs"></a>-->
                </td>
            </tr>
            
		@endforeach		
	</tbody>
</table>
{!! $clients->render() !!}

@endsection
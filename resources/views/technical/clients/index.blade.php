@extends('layouts.app')
@section('title','Lista de clientes')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Clientes/prospectos </h2>   
    </div>
        <div class="panel-body">
{!! Form::open(['route'=>'technical.clients.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
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
            	<td>
                   <a title="ver detalles" href="{{ route('technical.clients.show',$client->id) }}" class="btn btn-success btn-xs">
            	    <i class="fa fa-eye"></i>
            	   </a>
                   <a title="ver tickets" href="{{ route('technical.clients.ticket',$client->id) }}" class="btn btn-warning btn-xs">
                       <i class="fa fa-tags"></i>
                   </a>
                </td>
            </tr>
            
		@endforeach		
	</tbody>
</table>
{!! $clients->render() !!}

@endsection
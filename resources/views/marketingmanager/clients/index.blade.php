@extends('layouts.app')
@section('title','Lista de clientes')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Clientes/prospectos </h2>   
    </div>
        <div class="panel-body">
        
<a title="generar PDF" href="generalclient/pdf?name={{$request}}" class="btn btn-danger">GENERAR PDF <i class="fa fa-file-pdf-o"></i></a>

{!! Form::open(['route'=>'marketingmanager.clients.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
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
		<th>Asesor</th>		
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
                    <a title="ver detalles" href="{{ route('marketingmanager.clients.details',$client->id) }}" class="btn btn-success btn-xs">
            	        <i class="fa fa-eye"></i>
            	    </a>
                  <a title="ver referidos" href="{{ route('marketingmanager.clients.index2',$client->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"></i>
                  </a>
                  <a title="ver negociaciones" href="{{ route('marketingmanager.clients.negotiations',$client->id) }}" class="btn btn-info btn-xs">
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
{!! $clients->render() !!}

@endsection
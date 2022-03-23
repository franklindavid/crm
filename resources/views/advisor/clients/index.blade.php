@extends('layouts.app')
@section('title','Lista de clientes')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Clientes/prospectos </h2>   
    </div>
        <div class="panel-body">
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
<a href="{{ route('advisor.clients.create') }}" class="btn btn-info">Registrar</a>
<a title="generar PDF" href="client/pdf?name={{$request}}" class="btn btn-danger">GENERAR PDF <i class="fa fa-file-pdf-o"></i></a>
</div>
{!! Form::open(['route'=>'advisor.clients.index','method'=>'GET','class'=>'navbar-form pull-right']) !!}
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
                  <a title="ver detalles" href="{{ route('advisor.clients.details',$client->id) }}" class="btn btn-success btn-xs">
                      <i class="fa fa-eye"></i>
                  </a>
                  <a title="ver referidos" href="{{ route('advisor.clients.index2',$client->id) }}" class="btn btn-primary btn-xs">
                      <i class="fa fa-user"></i>
                  </a>
                  
                  <a title="asignar tarea" href="{{ route('advisor.clients.tasks',$client->id) }}" class="btn btn-danger btn-xs">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a title="ver negociaciones" href="{{ route('advisor.clients.negotiations',$client->id) }}" class="btn btn-info btn-xs">
                      <i class="fa fa-briefcase"></i>
                  </a>
                  <a title="ver ventas" href="{{ route('advisor.clients.sales',$client->id) }}" class="btn btn-default btn-xs">
                          <i class="fa fa-usd"></i>
                      </a>
                  @if($client->estado == "prospecto")
                      <a title="ver estadisticas" href="{{ route('advisor.clients.statsprospect',$client->id) }}" class="btn btn-success btn-xs">
                          <i class="fa fa-bar-chart"></i>
                      </a>
                  @endif
                  @if($client->estado == "cliente")
                      <a title="ver estadisticas" href="{{ route('advisor.clients.statsclient',$client->id) }}" class="btn btn-success btn-xs">
                          <i class="fa fa-bar-chart"></i>
                      </a>
                  @endif
<!--                  <a title="ver ventas" href="{{ route('advisor.clients.sales',$client->id) }}" class="glyphicon glyphicon-usd btn btn-default btn-xs"></a>-->
                   <a title="modificar" href="{{ route('advisor.clients.edit',$client->id) }}" class="btn btn-warning btn-xs">
                       <i class="fa fa-wrench"></i>
                   </a>
<!--                    <a  title="eliminar" href="{{ route('advisor.clients.destroy',$client->id) }}" onclick="return confirm('¿desea eliminar el cliente/prospecto?')" class="glyphicon glyphicon-remove btn btn-danger btn-xs"></a>-->
                </td>
            </tr>
            
		@endforeach		
	</tbody>
</table>
{!! $clients->render() !!}

@endsection
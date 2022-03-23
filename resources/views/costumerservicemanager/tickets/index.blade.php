@extends('layouts.app')
@section('title','Tickets')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-tags"></i> Tickets </h2>   
    </div>
        <div class="panel-body">
        
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
<a href="{{ route('costumerservicemanager.tickets.create') }}" class="btn btn-info">Abrir ticket</a><br>
</div>
<div role="tabpanel"> 
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#Seccion2" aria-controls="Seccion2" data-toggle="tab" role="tab">TICKETS PENDIENTES</a></li>
        <li role="presentation"><a href="#Seccion3" aria-controls="Seccion3" data-toggle="tab" role="tab">TICKETS RESUELTOS</a></li>						
        <li role="presentation"><a href="#Seccion4" aria-controls="Seccion4" data-toggle="tab" role="tab">TICKETS DESCARTADOS</a></li>						
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="Seccion2">							
        
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Caso</th>
<!--                <th>Nombre</th>-->
                <th>Telefono</th> 
                <th>Direccion</th>
<!--                <th>Estado</th>-->
                <th>Descripcion</th>
                <th>Tecnico</th>
                <th>Cliente</th> 
                <th>Producto</th> 
                <th>Prioridad</th> 
                <th><center>Accion</center></th>
            </thead> 
            <tbody>
                @foreach($ticketspendientes as $ticketpendiente)
                    <tr>
                        <td>{{ $ticketpendiente->id }}</td>
                        <td>{{ $ticketpendiente->caso }}</td>
<!--                        <td>{{ $ticketpendiente->nombre }}</td>-->
                        <td>{{ $ticketpendiente->client->telefono }}</td>
                        <td>{{ $ticketpendiente->client->direccion }}</td>
<!--                        <td>{{ $ticketpendiente->estado }}</td>-->
                        <td>{{ $ticketpendiente->descripcion }}</td>
                        @if($ticketpendiente->user_id==null)
                            <td>Desconocido</td>
                        @else
                               <td>{{ $ticketpendiente->user->name }}</td>
                        @endif
                        @if($ticketpendiente->client_id==null)
                                <td>Desconocido</td>
                        @else
                           <td> 
                               <a href="{{ route('costumerservicemanager.clients.show',$ticketpendiente->client->id) }}">
                                  {{ $ticketpendiente->client->name }}
                               </a>
                           </td>                            
                        @endif
                        <td>
                            @foreach($ticketpendiente->products as $producto)
                             {{ $producto->name }} ,
                            @endforeach
                        </td>
                        <td>
                            @if( $ticketpendiente->prioridad == 1)
                                <span class="label label-danger">ALTA</span>
                            @elseif($ticketpendiente->prioridad == 2)
                                <span class="label label-success">MEDIA</span>
                            @else
                                <span class="label label-primary">BAJA</span>
                            @endif
                        </td> 
                        <td>
                           <center>
                            <a title="modificar" href="{{ route('costumerservicemanager.tickets.edit',$ticketpendiente->id) }}" class="btn btn-warning btn-xs">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a title="resuelto" href="{{ route('costumerservicemanager.tickets.resuelto',$ticketpendiente->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-check"></i>
                            </a>
                            <a title="descartar" href="{{ route('costumerservicemanager.tickets.descartar',$ticketpendiente->id) }}" onclick="return confirm('¿desea descartar el ticket?')" class="btn btn-danger btn-xs">
                                <i class="fa fa-times"></i>
                            </a>
                            </center>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $ticketspendientes->render() !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="Seccion3">	
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Caso</th>
<!--		<th>Nombre</th>-->
		<th>Telefono</th>
		<th>Direccion</th>
<!--		<th>Estado</th>-->
		<th>Descripcion</th>
		<th>Tecnico</th>
		<th>Cliente</th>
		<th>Producto</th>
		<th>Prioridad</th>
		<th><center>Accion</center></th>
	</thead>
	<tbody>
		@foreach($ticketsresueltos as $ticketresuelto)
            <tr>
            	<td>{{ $ticketresuelto->id }}</td>
            	<td>{{ $ticketresuelto->caso }}</td>
<!--            	<td>{{ $ticketresuelto->nombre }}</td>-->
            	<td>{{ $ticketresuelto->client->telefono }}</td>
            	<td>{{ $ticketresuelto->client->direccion }}</td>
<!--            	<td>{{ $ticketresuelto->estado }}</td>-->
            	<td>{{ $ticketresuelto->descripcion }}</td>
                @if($ticketresuelto->user_id==null)
                    <td>Desconocido</td>
                @else
                    <td>{{ $ticketresuelto->user->name }}</td>
                @endif
                @if($ticketresuelto->client_id==null)
                    <td>Desconocido</td>
                @else
                    <td><a href="{{ route('costumerservicemanager.clients.show',$ticketresuelto->client->id) }}">
                       {{ $ticketresuelto->client->name }}
                    </a></td>
                @endif
                    <td>
                        @foreach($ticketresuelto->products as $producto)
                            {{ $producto->name }} ,
                        @endforeach
                    </td>
                    <td>
                    @if( $ticketresuelto->prioridad == 1)
                        <span class="label label-danger">ALTA</span>
                    @elseif($ticketresuelto->prioridad == 2)
                        <span class="label label-success">MEDIA</span>
                    @else
                        <span class="label label-primary">BAJA</span>
                    @endif
                </td> 
            	<td>
                   <center>
                        <a title="modificar" href="{{ route('costumerservicemanager.tickets.edit',$ticketresuelto->id) }}" class="btn btn-warning btn-xs">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a title="retornar a pendiente" href="{{ route('costumerservicemanager.tickets.pendiente',$ticketresuelto->id) }}" class="btn btn-success btn-xs">
                            <i class="fa fa-refresh"></i>   
                        </a>
                        <a title="descartar" href="{{ route('costumerservicemanager.tickets.descartar',$ticketresuelto->id) }}" onclick="return confirm('¿desea descartar el ticket?')" class="btn btn-danger btn-xs">
                            <i class="fa fa-times"></i>
                        </a>
                   </center>
                </td>
            </tr>
		@endforeach
	</tbody>
</table>
{!! $ticketsresueltos->render() !!}
        </div>
            <div role="tabpanel" class="tab-pane" id="Seccion4">	
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Caso</th>
<!--		<th>Nombre</th>-->
		<th>Telefono</th>
		<th>Direccion</th>
		<th>Descripcion</th>
		<th>Tecnico</th>
		<th>Cliente</th>
		<th>Producto</th>
		<th>Prioridad</th>
		<th><center>Accion</center></th>
	</thead>
	<tbody>
		@foreach($ticketsdescartados as $ticketdescartado)
            <tr>
            	<td>{{ $ticketdescartado->id }}</td>
            	<td>{{ $ticketdescartado->caso }}</td>
<!--            	<td>{{ $ticketdescartado->nombre }}</td>-->
            	<td>{{ $ticketdescartado->client->telefono }}</td>
            	<td>{{ $ticketdescartado->client->direccion }}</td>
            	<td>{{ $ticketdescartado->descripcion }}</td>
            	@if($ticketdescartado->user_id==null)
                    <td>Desconocido</td>
                @else
                    <td>{{ $ticketdescartado->user->name }}</td>
                @endif
                @if($ticketdescartado->client_id==null)
                    <td>Desconocido</td>
                @else
                    <td><a href="{{ route('costumerservicemanager.clients.show',$ticketdescartado->client->id) }}">
                       {{ $ticketdescartado->client->name }}
                    </a></td>
                @endif
                    <td>
                        @foreach($ticketdescartado->products as $producto)
                            {{ $producto->name }} ,
                        @endforeach
                    </td>
                <td>
                    @if( $ticketdescartado->prioridad == 1)
                        <span class="label label-danger">ALTA</span>
                    @elseif($ticketdescartado->prioridad == 2)
                        <span class="label label-success">MEDIA</span>
                    @else
                        <span class="label label-primary">BAJA</span>
                    @endif
                </td> 
            	<td>
                   <center>
                    <a title="eliminar permanentemente" href="{{ route('costumerservicemanager.tickets.destroy',$ticketdescartado->id) }}" onclick="return confirm('¿desea eliminar de manera permanente el ticket?')" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i> 
                    </a>
                    </center>
                </td>
            </tr>
		@endforeach
	</tbody>
</table>
{!! $ticketsdescartados->render() !!}
        </div>
           </div>
</div>
@endsection 
@extends('layouts.app')
@section('title','Lista de usuarios')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-tags"></i> Tickets </h2>   
    </div>
        <div class="panel-body">
        
<a title="generar PDF" href="ticket/pdf" class="btn btn-danger">GENERAR PDF TICKETS PENDIENTES <i class="fa fa-file-pdf-o"></i></a>

<div role="tabpanel"> 
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#Seccion1" aria-controls="Seccion1" data-toggle="tab" role="tab">TICKETS PENDIENTES</a></li>
        <li role="presentation"><a href="#Seccion2" aria-controls="Seccion2" data-toggle="tab" role="tab">TICKETS RESUELTOS</a></li>						
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="Seccion1">							
        
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Cliente</th>
                <th>Caso</th>
<!--                <th>Nombre</th>-->
                <th>Telefono</th> 
                <th>Direccion</th>
<!--                <th>Estado</th>-->
                <th>Descripcion</th>
                <th>Producto</th>
                <th>Prioridad</th>
                <th><center>Accion</center></th>
            </thead>   
            <tbody> 
                @foreach($ticketspendientes as $ticketpendiente)
                    <tr>
                        <td>{{ $ticketpendiente->id }}</td>
                        <td> 
                               <a href="{{ route('technical.clients.show',$ticketpendiente->client->id) }}">
                                  {{ $ticketpendiente->client->name }}
                               </a>
                           </td> 
                        <td>{{ $ticketpendiente->caso }}</td>
<!--                        <td>{{ $ticketpendiente->nombre }}</td>-->
                        <td>{{ $ticketpendiente->client->telefono }}</td>
                        <td>{{ $ticketpendiente->client->direccion }}</td>
<!--                        <td>{{ $ticketpendiente->estado }}</td>-->
                        <td>{{ $ticketpendiente->descripcion }}</td>
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
                            <a title="resuelto" href="{{ route('technical.tickets.resuelto',$ticketpendiente->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-check"></i>
                            </a>
                            </center>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $ticketspendientes->render() !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="Seccion2">	
<table class="table table-striped">
	<thead>
		<th>ID</th>
		<th>Cliente</th>
		<th>Caso</th>
<!--		<th>Nombre</th>-->
		<th>Telefono</th>
		<th>Direccion</th>
<!--		<th>Estado</th>-->
		<th>Descripcion</th>
		<th>Producto</th>
		<th><center>Accion</center></th>
	</thead>
	<tbody>
		@foreach($ticketsresueltos as $ticketresuelto)
            <tr>
            	<td>{{ $ticketresuelto->id }}</td>
            	<td> 
                               <a href="{{ route('technical.clients.show',$ticketpendiente->client->id) }}">
                                  {{ $ticketpendiente->client->name }}
                               </a>
                           </td> 

            	<td>{{ $ticketresuelto->caso }}</td>
<!--            	<td>{{ $ticketresuelto->nombre }}</td>-->
            	<td>{{ $ticketresuelto->client->telefono }}</td>
            	<td>{{ $ticketresuelto->client->direccion }}</td>
<!--            	<td>{{ $ticketresuelto->estado }}</td>-->
            	<td>{{ $ticketresuelto->descripcion }}</td>
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
                    <a title="retornar a pendiente" href="{{ route('technical.tickets.pendiente',$ticketresuelto->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-refresh"></i>
                    </a>
                    </center>
                </td>
            </tr>
		@endforeach
	</tbody>
</table>
{!! $ticketsresueltos->render() !!}
        </div>
           </div>
</div>
@endsection 
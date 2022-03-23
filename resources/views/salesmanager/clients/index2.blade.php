@extends('layouts.app')
@section('title','Lista de referidos del cliente '.$client->name) 
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Referidos <font style="text-transform: capitalize;">{{$client->estado}} {{$client->name}}</font></h2>   
    </div>
        <div class="panel-body">
        
<a href="{{ route('salesmanager.clients.create2',$client->id) }}" class="btn btn-info">Registrar referido</a><br>
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
            	@if($client2->estado == "prospecto")   
                    <td>    
                        @if( $client2->oportunidad == 1)
                            <span class="label label-danger">ALTA</span>
                        @elseif($client2->oportunidad == 2)
                            <span class="label label-success">MEDIA</span>
                        @else
                            <span class="label label-primary">BAJA</span>
                        @endif
                    </td>
                @else
                    <td></td>
            	@endif            	
            	<td>
                   <a title="ver detalles" href="{{ route('salesmanager.clients.details',$referred->padre_id) }}" class="btn btn-success btn-xs">
            	    <i class="fa fa-eye"></i>
            	   </a>
                  <a title="ver referidos" href="{{ route('salesmanager.clients.index2',$referred->padre_id) }}" class="btn btn-primary btn-xs">
                      <i class="fa fa-user"></i>
                  </a>
                 <a title="ver negociaciones" href="{{ route('salesmanager.clients.negotiations',$referred->padre_id) }}" class="btn btn-info btn-xs">
                     <i class="fa fa-briefcase"></i>
                 </a>
                  <a title="ver ventas" href="{{ route('salesmanager.clients.sales',$referred->padre_id) }}" class="btn btn-success btn-xs">
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
                   <a title="modificar" href="{{ route('salesmanager.clients.edit',$referred->padre_id) }}" class="btn btn-warning btn-xs">
                       <i class="fa fa-wrench"></i>
                   </a>
                   
<!--                    <a title="eliminar" href="{{ route('salesmanager.clients.destroy',$referred->padre_id) }}" onclick="return confirm('¿desea eliminar el cliente/prospecto?')" class="glyphicon glyphicon-remove btn btn-danger btn-xs"></a>-->
                </td>
            </tr>
            
		@endforeach
	</tbody>
</table>
{!! $referreds->render() !!}
@endsection
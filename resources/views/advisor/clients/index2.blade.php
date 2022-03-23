@extends('layouts.app')
@section('title','Lista de referidos del cliente '.$client->name) 
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-user"></i> Referidos <font style="text-transform: capitalize;">{{$client->name}}</font></h2>   
    </div>
        <div class="panel-body">
<a href="{{ route('advisor.clients.create2',$client->id) }}" class="btn btn-info">Registrar referido</a><br>
<h3>{{$client->name}}</h3>
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
                   <a title="ver detalles" href="{{ route('advisor.clients.details',$referred->padre_id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
            	   </a>
                   <a title="ver referidos" href="{{ route('advisor.clients.index2',$referred->padre_id) }}" class="btn btn-primary btn-xs">
                       <i class="fa fa-user"></i>
                   </a>
                  <a title="asignar tarea" href="{{ route('advisor.clients.tasks',$client->id) }}" class="btn btn-danger btn-xs">
                       <i class="fa fa-pencil"></i>
                  </a>
                 <a title="ver negociaciones" href="{{ route('advisor.clients.negotiations',$referred->padre_id) }}" class="btn btn-info btn-xs">
                     <i class="fa fa-briefcase"></i>
                 </a>
                   @if($client2->estado == "cliente")
                  <a title="ver ventas" href="{{ route('advisor.clients.sales',$referred->padre_id) }}" class="btn btn-default btn-xs">
                      <i class="fa fa-usd"></i>
                  </a>
                  @endif
                  <a title="modificar" href="{{ route('advisor.clients.edit',$referred->padre_id) }}" class="btn btn-warning btn-xs">
                       <i class="fa fa-wrench"></i>
                  </a>
<!--                    <a title="eliminar" href="{{ route('advisor.clients.destroy',$referred->padre_id) }}" onclick="return confirm('¿desea eliminar el cliente/prospecto?')" class="glyphicon glyphicon-remove btn btn-danger btn-xs"></a>-->
                </td>
            </tr>
            
		@endforeach
	</tbody>
</table>
{!! $referreds->render() !!}
@endsection
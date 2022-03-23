@extends('layouts.app')
@section('title','Lista de referidos del cliente '.$client->name) 
@section('content')
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h3><i class="fa fa-user"></i> Referidos de <font style="text-transform: capitalize;">{{$client->name}}</font></h3>   
    </div>
        <div class="panel-body">

<table class="table table-striped">
	<thead> 
		<th>Cedula</th>
		<th>Nombre</th>
		<th>Estado</th>
		<th>Tipo</th>		
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
            	<td>
                    <a title="ver detalles" href="{{ route('admin.clients.show',$referred->padre_id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a title="ver referidos" href="{{ route('admin.clients.index2',$referred->padre_id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"></i>
                    </a>
                    <a title="ver tareas" href="{{ route('admin.clients.tasks',$referred->padre_id) }}" class="btn btn-default btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a title="ver negociaciones" href="{{ route('admin.clients.negotiations',$referred->padre_id) }}" class="btn btn-info btn-xs">
                         <i class="fa fa-briefcase"></i>
                    </a>
                  @if($client->estado == "prospecto")
                      <a title="ver estadisticas" href="{{ route('admin.clients.statsprospect',$referred->padre_id) }}" class="btn btn-success btn-xs">
                          <i class="fa fa-bar-chart"></i>
                      </a>
                  @endif
                  @if($client2->estado == "cliente")
                      <a title="ver ventas" href="{{ route('admin.clients.sales',$referred->padre_id) }}" class="btn btn-default btn-xs">
                         <i class="fa fa-usd"></i>
                      </a>
                      <a title="ver estadisticas" href="{{ route('admin.clients.statsclient',$referred->padre_id) }}" class="btn btn-success btn-xs">
                          <i class="fa fa-bar-chart"></i>
                      </a>
                      <a title="ver tickets" href="{{ route('admin.clients.ticket',$referred->padre_id) }}" class="btn btn-primary btn-xs">
                          <i class="fa fa-tags"></i>
                      </a>
                  @endif
                  <a title="modificar" href="{{ route('admin.clients.edit',$referred->padre_id) }}" class="btn btn-warning btn-xs">
                      <i class="fa fa-wrench"></i>       
                  </a>
                  <a title="eliminar" href="{{ route('admin.clients.destroy',$referred->padre_id) }}" onclick="return confirm('¿desea eliminar el cliente/prospecto?')" class="btn btn-danger btn-xs">
                      <i class="fa fa-times"></i>
                  </a>
                </td>
            </tr>
            
		@endforeach
	</tbody>
</table>
{!! $referreds->render() !!}
@endsection
@extends('layouts.app')
@section('title','Lista de tareas')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-pencil"></i> Tareas <font style="text-transform: capitalize;">{{$client->estado}} {{$client->name}}</font></h2>   
    </div>
        <div class="panel-body">
<div class="">
    <a href="{{ route('salesmanager.clients.createtasks',$client->id) }}" class="btn btn-info">Asignar tarea</a>
</div> 
<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#Seccion1" aria-controls="Seccion1" data-toggle="tab" role="tab">TAREAS PARA HOY</a></li>
        <li role="presentation"><a href="#Seccion2" aria-controls="Seccion2" data-toggle="tab" role="tab">TAREAS SIGUIENTES</a></li>						
        <li role="presentation"><a href="#Seccion3" aria-controls="Seccion3" data-toggle="tab" role="tab">TAREAS ANTERIORES</a></li>						
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="Seccion1"> 
            <table class="table table-striped">
                <thead> 
                    <th>ID</th>
                    <th>Cliente/Prospecto</th>
                    <th>Tipo</th>
                    <th>Motivo</th>
                    <th>Lugar</th>		
                    <th>Fecha y Hora</th>		
                    <th>Prioridad</th>		
                    <th>Accion</th>		
                </thead> 
                <tbody>	  
                    @foreach($taskstoday as $task)          

                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->client->name }}</td>
                            <td>{{ $task->tipo }}</td>
                            <td>{{ $task->motivo }}</td>
                            <td>{{ $task->lugar }}</td>  
                            <td>{{ $task->fecha }}</td>           	
                            <td>
                                @if( $task->prioridad == 1)
                                    <span class="label label-danger">ALTA</span>
                                @elseif($task->prioridad == 2)
                                    <span class="label label-success">MEDIA</span>
                                @else
                                    <span class="label label-primary">BAJA</span>
                                @endif
                            </td>            	
                            <td>
                               <a title="modificar" href="{{ route('salesmanager.tasks.edit',$task->id) }}" class="btn btn-warning btn-xs">
                                   <i class="fa fa-wrench"></i>
                               </a>
                                <a  title="eliminar" href="{{ route('salesmanager.tasks.destroy',$task->id) }}" onclick="return confirm('¿desea eliminar la terea')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach		
                </tbody>
            </table>
            {!! $taskstoday->render() !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="Seccion2">
            <table class="table table-striped">
                <thead> 
                    <th>ID</th>
                    <th>Cliente/Prospecto</th>
                    <th>Tipo</th>
                    <th>Motivo</th>
                    <th>Lugar</th>		
                    <th>Fecha y Hora</th>		
                    <th>Prioridad</th>		
                    <th>Accion</th>		
                </thead> 
                <tbody>	  
                    @foreach($tasksnext as $task)          

                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->client->name }}</td>
                            <td>{{ $task->tipo }}</td>
                            <td>{{ $task->motivo }}</td>
                            <td>{{ $task->lugar }}</td>  
                            <td>{{ $task->fecha }}</td>           	
                            <td>
                                @if( $task->prioridad == 1)
                                    <span class="label label-danger">ALTA</span>
                                @elseif($task->prioridad == 2)
                                    <span class="label label-success">MEDIA</span>
                                @else
                                    <span class="label label-primary">BAJA</span>
                                @endif
                            </td>            	
                            <td>
                               <a title="modificar" href="{{ route('salesmanager.tasks.edit',$task->id) }}" class="btn btn-warning btn-xs">
                                   <i class="fa fa-wrench"></i>
                               </a>
                                <a  title="eliminar" href="{{ route('salesmanager.tasks.destroy',$task->id) }}" onclick="return confirm('¿desea eliminar la terea')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach		
                </tbody>
            </table>
            {!! $tasksnext->render() !!}
        </div>			
        <div role="tabpanel" class="tab-pane" id="Seccion3">
            <table class="table table-striped">
                <thead> 
                    <th>ID</th>
                    <th>Cliente/Prospecto</th>
                    <th>Tipo</th>
                    <th>Motivo</th>
                    <th>Lugar</th>		
                    <th>Fecha y Hora</th>		
                    <th>Prioridad</th>		
                    <th>Accion</th>		
                </thead> 
                <tbody>	  
                    @foreach($tasksold as $task)          

                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->client->name }}</td>
                            <td>{{ $task->tipo }}</td>
                            <td>{{ $task->motivo }}</td>
                            <td>{{ $task->lugar }}</td>  
                            <td>{{ $task->fecha }}</td>           	
                            <td>
                                @if( $task->prioridad == 1)
                                    <span class="label label-danger">ALTA</span>
                                @elseif($task->prioridad == 2)
                                    <span class="label label-success">MEDIA</span>
                                @else
                                    <span class="label label-primary">BAJA</span>
                                @endif
                            </td>            	
                            <td>
                               <a title="modificar" href="{{ route('salesmanager.tasks.edit',$task->id) }}" class="btn btn-warning btn-xs">
                                   <i class="fa fa-wrench"></i>
                               </a>
                                <a  title="eliminar" href="{{ route('salesmanager.tasks.destroy',$task->id) }}" onclick="return confirm('¿desea eliminar la terea')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach		
                </tbody>
            </table>
            {!! $tasksold->render() !!}
        </div>						
    </div>
</div>

@endsection
@extends('layouts.app')
@section('title','Modificar tarea')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-pencil"></i> Modificar tarea <font style="text-transform: capitalize;">{{$task->client->estado}} {{$task->client->name}}</font></h2>   
    </div>
        <div class="panel-body">
{!! Form::open(array('route' => ['advisor.tasks.update',$task->id], 'method' => 'put')) !!}
<!--{!! Form::open(['route'=>'advisor.tasks.store','method'=>'POST']) !!}-->
 
 {!! Form::text('user_id',Auth::user()->id,['class'=>'form-control hidden ','required']) !!} 
 {!! Form::text('client_id',$task->client_id,['class'=>'form-control hidden ','required']) !!}   
  <div class="form-group">
 	{!! Form::label('tipo','Tipo') !!}
 	{!! Form::select('tipo',['cita'=>'cita','llamada'=>'llamada','email'=>'email'],$task->tipo,['class'=>'form-control','onchange'=>'cambiar();','id'=>'tipo','placeholder'=>'seleccione una opcion...','required']) !!}
 </div>
 <div class="form-group">
    {!! Form::label('fecha','Fecha y hora') !!}
 	{!! Form::text('fecha',$task->fecha,['class'=>'form-control','placeholder'=>'DD-MM-YYYY HH:mm:ss','id'=>'datetimepicker']) !!}
</div>
 
 <div class="form-group">
 	{!! Form::label('motivo','Motivo de la llamada',['class'=>'hidden','id'=>'label1']) !!}
 	{!! Form::select('motivo1',['cerrar venta'=>'cerrar venta','mostrar propuesta'=>'mostrar propuesta','seguimiento'=>'seguimiento','seguimiento'=>'seguimiento','mostrar productos'=>'mostrar productos','otros'=>'otros'],$task->motivo,['class'=>'form-control hidden','placeholder'=>'seleccione una opcion...','id'=>'motivo1']) !!}
 </div>
 
 <div class="form-group">
 	{!! Form::label('motivo','Motivo de la cita',['class'=>'hidden','id'=>'label2']) !!}
 	{!! Form::select('motivo2',['cerrar venta'=>'cerrar venta','mostrar propuesta'=>'mostrar propuesta','seguimiento'=>'seguimiento','otros'=>'otros'],$task->motivo,['class'=>'form-control hidden','placeholder'=>'seleccione una opcion...','id'=>'motivo2']) !!}
 </div>
 
 <div class="form-group">
 	{!! Form::label('motivo','Motivo del email',['class'=>'hidden','id'=>'label3']) !!}
 	{!! Form::select('motivo3',['brochure'=>'brochure','promocion'=>'promocion','cotizacion'=>'cotizacion','factura'=>'factura','otros'=>'otros'],$task->motivo,['class'=>'form-control hidden','placeholder'=>'seleccione una opcion...','id'=>'motivo3']) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('lugar','Lugar',['class'=>'hidden','id'=>'label4']) !!}
 	{!! Form::text('lugar',$task->lugar,['class'=>'form-control hidden','placeholder'=>'Lugar','id'=>'lugar']) !!}
 </div>
 

<div class="form-group">
    {!! Form::label('prioridad','Prioridad') !!}
 	{!! Form::select('prioridad',['1'=>'Alta','2'=>'Media','3'=>'Baja'],$task->prioridad,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
</div>
 <div class="form-group">
 	{!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!} 	
 </div>
{!! Form::close() !!}
@endsection
@section('js')
<script>
function cambiar(){
    var tipo=$("#tipo").val();
    if (tipo == 'llamada') {
        $('#motivo1').removeClass('hidden');
        $('#label1').removeClass('hidden');
        $('#motivo2').addClass('hidden');
        $('#label2').addClass('hidden');
        $('#motivo3').addClass('hidden');
        $('#label3').addClass('hidden');
        $('#lugar').addClass('hidden');
        $('#label4').addClass('hidden');
    } else if (tipo == 'cita') {
        $('#motivo1').addClass('hidden');
        $('#label1').addClass('hidden');
        $('#motivo2').removeClass('hidden');
        $('#label2').removeClass('hidden');
        $('#motivo3').addClass('hidden');
        $('#label3').addClass('hidden');
        $('#lugar').removeClass('hidden');
        $('#label4').removeClass('hidden');
    } else {
        $('#motivo1').addClass('hidden');
        $('#label1').addClass('hidden');
        $('#motivo2').addClass('hidden');
        $('#label2').addClass('hidden');
        $('#motivo3').removeClass('hidden');
        $('#label3').removeClass('hidden');+
        $('#lugar').addClass('hidden');
        $('#label4').addClass('hidden');
    }
}
    $("#datetimepicker").datetimepicker({
                    format:'YYYY-MM-DD HH:mm:ss'
                });
    cambiar();
</script>
@endsection

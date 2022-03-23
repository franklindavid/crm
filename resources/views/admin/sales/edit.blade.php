@extends('layouts.app')
@section('title','editar venta')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-usd"></i> Editar venta <font style="text-transform: capitalize;">{{$negotiation->client->estado}} {{$negotiation->client->name}}</font> </h2>   
    </div>
        <div class="panel-body">
{!! Form::open(array('route' => ['admin.sales.update',$negotiation->id], 'id'=>'formulario', 'method' => 'put')) !!}﻿ 
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"> 
    <div class="form-group">
        {!! Form::label('client_id','Cliente') !!}
        {!! Form::select('client_id',$clients,$negotiation->client_id,['class'=>'form-control select-client','required']) !!}
    </div>
</div>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    <div class="form-group">
        {!! Form::label('estado','Estado') !!}
        {!! Form::select('estado',['en proceso'=>'EN PROCESO','ganada'=>'GANADA','perdida'=>'PERDIDA'],$negotiation->estado,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
    </div>
</div>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    <div class="form-group">
        {!! Form::label('forma_pagoforma_pago','Forma de pago') !!}
        {!! Form::select('forma_pago',['decontado'=>'DECONTADO','credito'=>'CREDITO'],$negotiation->forma_pago,['class'=>'form-control','placeholder'=>'seleccione una opcion...','required']) !!}
    </div>
</div>   
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="form-group">
        {!! Form::label('detalles','DETALLES') !!}
        {!! Form::textarea('detalles',$negotiation->detalles,['class'=>'form-control','placeholder'=>'detalles','required']) !!}
    </div>
</div> 

<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
     <div class="form-group">
        {!! Form::label('product','Producto') !!}
        <select name="pidproducto" id="pidproducto" class="form-control select-product" data-live-search="true">
            @foreach($products as $product)
                <option id="{{$product->id}}" value="{{$product->id}}_{{$product->precio_venta}}_{{$product->cantidad}}">{{$product->name}}</option>
            @endforeach
        </select>
     </div>
 </div>   
 <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" name="pstock" id="pstock" class="form-control" placeholder="Stock" disabled>
    </div>
</div>
 <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">    
        {!! Form::label('product','♥♥♥♥') !!}
         <button title="agregar producto" class="glyphicon glyphicon-plus btn btn-primary btn-xs" type="button" id="bt_add_product"></button>
             
  </div>
 <div class="col-lg-4 col-sm-3 col-md-4 col-xs-12">
 <div class="form-group">
 	{!! Form::label('service','Servicio') !!}
 	 <select name="pidservicio" id="pidservicio" class="form-control select-product" data-live-search="true">
            @foreach($services as $service)
                <option value="{{$service->id}}_{{$service->precio_venta}}">{{$service->name}}</option>
            @endforeach
        </select>
 </div>
 </div>
 <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">     
        {!! Form::label('product','♥♥♥♥') !!}
         <button title="agregar servicio" class="glyphicon glyphicon-plus btn btn-primary btn-xs" type="button" id="bt_add_service"></button>     
  </div>
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table id="detalles2" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #A9D0F5">
                <th WIDTH="10">Opcion</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </thead>
            <tfoot>
                <th>TOTAL</th>
                <th></th>                                
                <th></th>
                <th></th>
                <th><h4 id="total">$/{{$negotiation->total_negociacion}}</h4></th>
                <input type="hidden" name="total_negociacion" id="total_venta" value="{{$negotiation->total_negociacion}}">
            </tfoot>
            <tbody> 
<!--            {!! $cont = 0; !!}-->
<!--            {!! $i = 0; !!}-->
            @foreach($negotiation->products as $product)
            @if($product->flag==1)
            <tr class="selected" id="fila{{$cont}}">
                 <td><center><button type="button" class="btn btn-danger btn-xs" onclick="eliminar2({{$cont}}.{{$product->id}});">X</button></center></td>
                 <td><input type="hidden" name="idproducto[]" value="{{$product->id}}">{{$product->name}}</td>
                 <td><input id="cantidad{{$cont}}" type="hidden" name="cantidad[]" value="{{$product->pivot->cantidad}}">{{$product->pivot->cantidad}}</td>    
                 <td><input type="hidden" name="precio_venta[]" value="{{$product->precio_venta}}">{{$product->precio_venta}}</td>
                 <td><input type="hidden" id="subtotal{{$cont}}" value="{{$product->pivot->cantidad*$product->precio_venta}}">{{$product->pivot->cantidad*$product->precio_venta}}</td> 
<!--                 {{$subtotal[$cont]=$product->pivot->cantidad*$product->precio_venta}}-->
             </tr>                                      
            @else  
             <tr class="selected" id="fila{{$cont}}">
                 <td><center><button type="button" class="btn btn-danger btn-xs" onclick="eliminar({{$cont}});">X</button></center></td>
                 <td><input type="hidden" name="idservicio[]" value="{{$product->id}}">{{$product->name}}</td>
                 <td></td>    
                 <td><input type="hidden" name="precio_venta[]" value="{{$product->precio_venta}}">{{$product->precio_venta}}</td>
                 <td><input type="hidden" id="subtotal{{$cont}}" value="{{$product->precio_venta}}">{{$product->precio_venta}}</td> 
<!--                 {{$subtotal[$cont]=$product->precio_venta}}-->
             </tr>                                                 
            @endif
<!--             {{$cont=$cont+1}}-->                 
             @endforeach  
            </tbody>
            
           
        </table>
    </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
 <div class="form-group">
 	{!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!} 	
 </div>
</div>
<tr><td></td><td></td><td></td><td></td><td></td></tr>
{!! Form::close() !!}

@endsection
@section('js')
<script>
$(document).ready(function(){
    console.log(document.forms["formulario"].pidproducto.value);
//    document.forms["formulario"].pidproducto.value='2_15000_92';
//    document.forms["formulario"].pidproducto[1].selected = true;
        $('#bt_add_service').click(function(){
            agregarservicio();
        });
        $('#bt_add_product').click(function(){
            agregarproducto();
        });    
    $("#guardar").show();
    mostrarValores();
    });
    var cont={{$cont}};
    cont2=0;
    total={{$negotiation->total_negociacion}};
    subtotal=[];
    @while($i<$cont)
    subtotal[{{$i}}]={{$subtotal[$i]}};
//        {!!$i=$i+1!!}
    @endwhile
    $("#guardar").hide();
    $("#pidproducto").change(mostrarValores);
    function mostrarValores(){
        datosArticulo=document.getElementById('pidproducto').value.split('_');
        $("#pstock").val(datosArticulo[2]);
    }
    function agregarservicio(){
        datosservicio=document.getElementById('pidservicio').value.split('_');
        idservicio=datosservicio[0];
        servicio=$("#pidservicio option:selected").text();
        precio_venta=Number(datosservicio[1]);
        total=Number(total+precio_venta);
        subtotal[cont]=precio_venta;
        var fila='<tr class="selected" id="fila'+cont+'"><td><center><button type="button" class="btn btn-danger btn-xs" onclick="eliminar('+cont+');">X</button></center></td><td><input type="hidden" name="idservicio[]" value="'+idservicio+'">'+servicio+'</td><td></td><td><input type="hidden" name="precio_venta[]" value="'+precio_venta+'">'+precio_venta+'</td><td></td></tr>';
        cont++;
        $('#total').html("$/ " + total);
        $('#total_venta').val(total);
        evaluar();
        $('#detalles2').append(fila);
    }
    function agregarproducto(){
        datosproducto=document.getElementById('pidproducto').value.split('_');
        idproducto=datosproducto[0];
        producto=$("#pidproducto option:selected").text();
        precio_venta=Number(datosproducto[1]);
        stock=datosproducto[2];
        cantidad=$("#pcantidad").val();  
        combinado=cont+'.'+idproducto;
        if (cantidad!=""){
            if (Number(stock)>=Number(cantidad)){
                subtotal[cont]=cantidad*precio_venta;
                total=total+subtotal[cont];
                var fila='<tr class="selected" id="fila'+cont+'"><td><center><button type="button" class="btn btn-danger btn-xs" onclick="eliminar3('+combinado+');">X</button></center></td><td><input type="hidden" name="idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input id="cantidad'+cont+'" type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="precio_venta[]" value="'+precio_venta+'">'+precio_venta+'</td><td>'+subtotal[cont]+'</td></tr>';
                cont++;
                $('#total').html("$/ " + total);
                $('#total_venta').val(total);
                evaluar();
                $('#detalles2').append(fila);
                document.getElementById('pidproducto').options[document.getElementById('pidproducto').selectedIndex].value=(idproducto+'_'+precio_venta+'_'+(stock-cantidad));
                $("#pstock").val(stock-cantidad);
            }else{
                   alert('la cantidad supera al stock disponible');
               }  
            }       
    }
    function evaluar()    {
        if (total>0)
        {
            $("#guardar").show();
        }
        else
        {
            $("#guardar").hide(); 
        }
    }
    function eliminar(index){
        total=Number(total-subtotal[index]); 
        $("#total").html("S/. " + total);   
        $("#total_venta").val(total); 
//        $("#pstock").val($("#pstock").val(datosArticulo[2])+cantidad);
        $("#fila" + index).remove();
        evaluar();
    }
    function eliminar3(index){        
        index=index.toString();
        separacion=index.split('.');        
        index2=Number(separacion[0]);
        producto=separacion[1];        
        separacion2=$("#"+producto).val().split('_');
//        console.log(separacion2);
        idproducto=separacion2[0];
        precio_venta=separacion2[1];
        stock=separacion2[2];
        cantidad=$("#cantidad" + index2).val();
        $("#"+producto).prop("value",idproducto+'_'+precio_venta+'_'+(Number(stock)+Number(cantidad)));
        
        actual=document.forms["formulario"].pidproducto.value;
        document.forms["formulario"].pidproducto.value=actual;
        actualseparacion=actual.split('_');
        console.log(actualseparacion);
        $("#pstock").val(actualseparacion[2]);
        
        total=Number(total-subtotal[index2]); 
        $("#total").html("S/. " + total);   
        $("#total_venta").val(total);  
        $("#fila" + index2).remove();
        if ( $("#agotado").length ) {
//            alert('existe');
        }else{ 
//        alert('no existe');
        evaluar();
        }
    } 
    function eliminar2(index){        
        index=index.toString();
        separacion=index.split('.');
        index2=Number(separacion[0]);
        producto=separacion[1];        
        separacion2=$("#"+producto).val().split('_');
        idproducto=separacion2[0];
        precio_venta=separacion2[1];
        stock=separacion2[2];
        cantidad=$("#cantidad" + index2).val();
        $("#"+producto).prop("value",idproducto+'_'+precio_venta+'_'+(Number(stock)+Number(cantidad)));
        valor=$("#"+producto).val();
//        console.log(valor);
//        $("#pidproducto").find('option:first').attr('selected', 'selected').parent('select');
//        $("#"+producto+" option[value='1_15000_100']").attr('selected', 'selected');
//        $("#"+producto option[value=$("#"+producto).val()]).attr('selected', 'selected');
        
//        $("#pstock").val(Number(stock)+Number(cantidad));
        
        /////actualizar actual//////////////
        actual=document.forms["formulario"].pidproducto.value;
        document.forms["formulario"].pidproducto.value=actual;
        actualseparacion=actual.split('_');
        console.log(actualseparacion);
        $("#pstock").val(actualseparacion[2]);
        ///////////////////////////////////
        
//        console.log("stock: "+stock+" cantidad: "+cantidad);
//        console.log(Number(stock)+Number(cantidad));
        total=Number(total-subtotal[index2]); 
        $("#total").html("S/. " + total);   
        $("#total_venta").val(total);  
        $("#fila" + index2).remove();
        evaluar();
    }
</script>
<script>
    $('.select-client').chosen({
        no_results_text: "no se encuentra el cliente!",
        allow_single_deselect: true
    });
    $('.select-estado').chosen({
        no_results_text: "no se encuentra el cliente!",
        allow_single_deselect: true
    });
    $('.select-product').chosen({
        no_results_text: "no se encuentra el producto!"
    });
    $('.select-service').chosen({
        no_results_text: "no se encuentra el servicio!"
    }); 
    $('.select-formapago').chosen({
        no_results_text: "no se encuentra el servicio!"
    });
</script>
<script>
    
</script>
@endsection

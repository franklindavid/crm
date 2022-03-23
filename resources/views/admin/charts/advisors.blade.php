@extends('layouts.app')
@section('title','Lista de clientes')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-bar-chart"></i> Estadísticas asesores </h2>   
    </div>
        <div class="panel-body">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header"> 
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Prospectos/Clientes <span class="caret"></span></a>
        <ul class="dropdown-menu">                            
<!--            <li><a href="#" onclick="uno()">numero de prospectos/clientes diario</a></li>-->
<!--            <li><a href="#" onclick="dos()">porcentaje prospectos/clientes al mes</a></li>-->
            <li><a href="#" onclick="tres()">Top 5 asesores con mas clientes</a></li>
            <li><a href="#" onclick="cuatro()">Top 5 asesores con menos clientes</a></li>
            <li><a href="#" onclick="cinco()">Top 5 asesores con mas prospectos</a></li>
            <li><a href="#" onclick="seis()">Top 5 asesores con menos prospectos</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Negociaciones/ventas <span class="caret"></span></a>
        <ul class="dropdown-menu">
<!--            <li><a href="#" onclick="doce()">numero de Negociaciones/Ventas diario</a></li>-->
<!--            <li><a href="#" onclick="trece()">porcentaje Negociaciones/Ventas al mes</a></li>-->
            <li><a href="#" onclick="siete()">Top 5 asesores con mas ventas</a></li>
            <li><a href="#" onclick="ocho()">Top 5 asesores con menos ventas</a></li>
            <li><a href="#" onclick="nueve()">Top 5 asesores con mas negociaciones</a></li>
            <li><a href="#" onclick="diez()">Top 5 asesores con menos negociaciones</a></li>
            <li><a href="#" onclick="once()">Negociaciones perdidas</a></li>
        </ul>
    </li>
    </ul>
  </div>
</nav>
<!--///////////////////////////////-->
<?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>

<div  class="row" > 
    <div class="col-md-6">
<!--        <label>Año</label>-->
        <select class="form-control hidden" id="anio_sel_uno"  onchange="cambiar_fecha_uno();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_dos"  onchange="cambiar_fecha_dos();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control" id="anio_sel_tres"  onchange="cambiar_fecha_tres();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_cuatro"  onchange="cambiar_fecha_cuatro();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_cinco"  onchange="cambiar_fecha_cinco();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_seis"  onchange="cambiar_fecha_seis();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_siete"  onchange="cambiar_fecha_siete();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_ocho"  onchange="cambiar_fecha_ocho();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_nueve"  onchange="cambiar_fecha_nueve();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_diez"  onchange="cambiar_fecha_diez();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_once"  onchange="cambiar_fecha_once();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_doce"  onchange="cambiar_fecha_doce();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
        <select class="form-control hidden" id="anio_sel_trece"  onchange="cambiar_fecha_trece();">
            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
            <option value="2017" >2017</option>
            <option value="2018">2018</option>
            <option value="2019" >2019</option>
            <option value="2020" >2020</option>
            <option value="2021" >2021</option>
        </select>
    </div>
    <div class="col-md-6">
        <select class="form-control hidden" id="mes_sel_uno" onchange="cambiar_fecha_uno();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_dos" onchange="cambiar_fecha_dos();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control " id="mes_sel_tres" onchange="cambiar_fecha_tres();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_cuatro" onchange="cambiar_fecha_cuatro();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_cinco" onchange="cambiar_fecha_cinco();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_seis" onchange="cambiar_fecha_seis();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_siete" onchange="cambiar_fecha_siete();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
           <select class="form-control hidden" id="mes_sel_ocho" onchange="cambiar_fecha_ocho();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_nueve" onchange="cambiar_fecha_nueve();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_diez" onchange="cambiar_fecha_diez();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_once" onchange="cambiar_fecha_once();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_doce" onchange="cambiar_fecha_doce();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
        <select class="form-control hidden" id="mes_sel_trece" onchange="cambiar_fecha_trece();" >
            <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
        </select>
    </div>
</div>
<div  class="row">
<br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>
		<div class="box-body" id="container">
		</div>
	    <div class="box-footer">
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
    ////////////////////////////////////// pie
//Highcharts.chart('container', {
//    chart: {
//        type: 'column'
//    },
//    title: {
//        text: 'clientes y prospectos septiembre'
//    },
//    xAxis: {
//        categories: [
//            'ana maria',
//            'ane marie',
//            'ani marii',
//            'ano mario',
//            'anu mariu'
//        ],title: {
//                    text: 'ASESORES'
//                },
//        crosshair: true
//    },
//    yAxis: {
//        min: 0,
//        title: {
//            text: 'clientes/prospectos al mes'
//        }
//    },
//    tooltip: {
//        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
//        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//            '<td style="padding:0"><b>{point.y} </b></td></tr>',
//        footerFormat: '</table>',
//        shared: true,
//        useHTML: true
//    },
//    plotOptions: {
//        column: {
//            pointPadding: 0.2,
//            borderWidth: 0
//        }
//    },
//    series: [{
//        name: 'CLIENTES',
//        data: [8, 4, 2, 0, 1]
//
//    }, {
//        name: 'PROSPECTOS',
//        data: [4, 2, 1, 1, 1]
//
//    }]
//});
    ////////////////////////////////////// pie
</script>
<script>
    function uno(){
        var anio_sel=$("#anio_sel_uno").val();
        var mes_sel=$("#mes_sel_uno").val();
        cargar_grafica_clientes_mes(anio_sel,mes_sel);
        $('#anio_sel_uno').removeClass('hidden');
        $('#mes_sel_uno').removeClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden');
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_uno(){
        var anio_sel=$("#anio_sel_uno").val();
        var mes_sel=$("#mes_sel_uno").val();
        cargar_grafica_clientes_mes(anio_sel,mes_sel);  
    }
    function dos(){
        var anio_sel=$("#anio_sel_dos").val();
        var mes_sel=$("#mes_sel_dos").val();
        cargar_grafica_pie(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').removeClass('hidden');
        $('#mes_sel_dos').removeClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden');
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_dos(){
        var anio_sel=$("#anio_sel_dos").val();
        var mes_sel=$("#mes_sel_dos").val();
        cargar_grafica_pie(anio_sel,mes_sel);
    }
    function tres(){
        var anio_sel=$("#anio_sel_tres").val();
        var mes_sel=$("#mes_sel_tres").val();
        cargar_grafica_asesor_con_mas_clientes(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').removeClass('hidden');
        $('#mes_sel_tres').removeClass('hidden');
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_tres(){
        var anio_sel=$("#anio_sel_tres").val();
        var mes_sel=$("#mes_sel_tres").val();
        cargar_grafica_asesor_con_mas_clientes(anio_sel,mes_sel);
    }
    function cuatro(){
        var anio_sel=$("#anio_sel_cuatro").val();
        var mes_sel=$("#mes_sel_cuatro").val();
        cargar_grafica_asesor_con_menos_clientes(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').removeClass('hidden');
        $('#mes_sel_cuatro').removeClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_cuatro(){
        var anio_sel=$("#anio_sel_cuatro").val();
        var mes_sel=$("#mes_sel_cuatro").val();
        cargar_grafica_asesor_con_menos_clientes(anio_sel,mes_sel);
    }
    function cinco(){
        var anio_sel=$("#anio_sel_cinco").val();
        var mes_sel=$("#mes_sel_cinco").val();
        cargar_grafica_asesor_con_mas_prospectos(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').removeClass('hidden');
        $('#mes_sel_cinco').removeClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_cinco(){
        var anio_sel=$("#anio_sel_cinco").val();
        var mes_sel=$("#mes_sel_cinco").val();
        cargar_grafica_asesor_con_mas_prospectos(anio_sel,mes_sel);
    }
    function seis(){
        var anio_sel=$("#anio_sel_seis").val();
        var mes_sel=$("#mes_sel_seis").val();
        cargar_grafica_asesor_con_menos_prospectos(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').removeClass('hidden');
        $('#mes_sel_seis').removeClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_seis(){
        var anio_sel=$("#anio_sel_seis").val();
        var mes_sel=$("#mes_sel_seis").val();
        cargar_grafica_asesor_con_menos_prospectos(anio_sel,mes_sel);
    }
    function siete(){
        var anio_sel=$("#anio_sel_siete").val();
        var mes_sel=$("#mes_sel_siete").val();
        cargar_grafica_asesor_con_mas_ventas(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').removeClass('hidden');
        $('#mes_sel_siete').removeClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_siete(){
        var anio_sel=$("#anio_sel_siete").val();
        var mes_sel=$("#mes_sel_siete").val();
        cargar_grafica_asesor_con_mas_ventas(anio_sel,mes_sel);
    }
    function ocho(){
        var anio_sel=$("#anio_sel_ocho").val();
        var mes_sel=$("#mes_sel_ocho").val();
        cargar_grafica_asesor_con_menos_ventas(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').removeClass('hidden');
        $('#mes_sel_ocho').removeClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_ocho(){
        var anio_sel=$("#anio_sel_ocho").val();
        var mes_sel=$("#mes_sel_ocho").val();
        cargar_grafica_asesor_con_menos_ventas(anio_sel,mes_sel);
    }
    function nueve(){
        var anio_sel=$("#anio_sel_nueve").val();
        var mes_sel=$("#mes_sel_nueve").val();
        cargar_grafica_asesor_con_mas_negociaciones(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').removeClass('hidden');
        $('#mes_sel_nueve').removeClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_nueve(){
        var anio_sel=$("#anio_sel_nueve").val();
        var mes_sel=$("#mes_sel_nueve").val();
        cargar_grafica_asesor_con_mas_negociaciones(anio_sel,mes_sel);
    }
    function diez(){
        var anio_sel=$("#anio_sel_diez").val();
        var mes_sel=$("#mes_sel_diez").val();
        cargar_grafica_asesor_con_menos_negociaciones(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').removeClass('hidden');
        $('#mes_sel_diez').removeClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_diez(){
        var anio_sel=$("#anio_sel_diez").val();
        var mes_sel=$("#mes_sel_diez").val();
        cargar_grafica_asesor_con_menos_negociaciones(anio_sel,mes_sel);
    }
    function once(){
        var anio_sel=$("#anio_sel_once").val();
        var mes_sel=$("#mes_sel_once").val();
        cargar_grafica_asesor_con_mas_perdidas(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').removeClass('hidden');
        $('#mes_sel_once').removeClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_once(){
        var anio_sel=$("#anio_sel_once").val();
        var mes_sel=$("#mes_sel_once").val();
        cargar_grafica_asesor_con_mas_perdidas(anio_sel,mes_sel);
    }
    function doce(){
        var anio_sel=$("#anio_sel_doce").val();
        var mes_sel=$("#mes_sel_doce").val();
        cargar_grafica_ventas_mes(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').removeClass('hidden');
        $('#mes_sel_doce').removeClass('hidden');
        $('#anio_sel_trece').addClass('hidden');
        $('#mes_sel_trece').addClass('hidden');
    }
    function cambiar_fecha_doce(){
        var anio_sel=$("#anio_sel_doce").val();
        var mes_sel=$("#mes_sel_doce").val();
        cargar_grafica_ventas_mes(anio_sel,mes_sel);
    }
    function trece(){
        var anio_sel=$("#anio_sel_trece").val();
        var mes_sel=$("#mes_sel_trece").val();
        cargar_grafica_pie_ventas(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_uno').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_tres').addClass('hidden');
        $('#mes_sel_tres').addClass('hidden'); 
        $('#anio_sel_cuatro').addClass('hidden');
        $('#mes_sel_cuatro').addClass('hidden');
        $('#anio_sel_cinco').addClass('hidden');
        $('#mes_sel_cinco').addClass('hidden');
        $('#anio_sel_seis').addClass('hidden');
        $('#mes_sel_seis').addClass('hidden');
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
        $('#anio_sel_ocho').addClass('hidden');
        $('#mes_sel_ocho').addClass('hidden');
        $('#anio_sel_nueve').addClass('hidden');
        $('#mes_sel_nueve').addClass('hidden');
        $('#anio_sel_diez').addClass('hidden');
        $('#mes_sel_diez').addClass('hidden');
        $('#anio_sel_once').addClass('hidden');
        $('#mes_sel_once').addClass('hidden');
        $('#anio_sel_doce').addClass('hidden');
        $('#mes_sel_doce').addClass('hidden');
        $('#anio_sel_trece').removeClass('hidden');
        $('#mes_sel_trece').removeClass('hidden');
    }
    function cambiar_fecha_trece(){
        var anio_sel=$("#anio_sel_trece").val();
        var mes_sel=$("#mes_sel_trece").val();
        cargar_grafica_pie_ventas(anio_sel,mes_sel);
    }
////////////////////////////////////////////////////////////////////////////////////////    
    function cargar_grafica_clientes_mes(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Numero de Clientes/prospecto en el Mes julio'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'dias del mes'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'REGISTROS AL DIA'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'prospecto',
                data: []

            },{
                name: 'cliente',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "../grafica_clientes/"+anio+"/"+mes+"";


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var totaldias=datos.totaldias;
    var registrosclientes=datos.registrosclientes;
    var registrosprospectos=datos.registrosprospectos;
    var i=0;
        for(i=1;i<=totaldias;i++){

        options.series[0].data.push( registrosprospectos[i] );
        options.series[1].data.push( registrosclientes[i] );
        options.xAxis.categories.push(i);
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    
    options.title.text='Numero de Clientes/prospecto en '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }



//    function cargar_grafica_lineas(anio,mes){
//
//    var options={
//         chart: {
//                renderTo: 'div_grafica_lineas',
//
//            },
//              title: {
//                text: 'Numero de Registros en el Mes julio',
//                x: -20 //center
//            },
//            subtitle: {
//                text: 'Source: Plusis.net',
//                x: -20
//            },
//            xAxis: {
//                categories: []
//            },
//            yAxis: {
//                title: {
//                    text: 'REGISTROS POR DIA'
//                },
//                plotLines: [{
//                    value: 0,
//                    width: 1,
//                    color: '#808080'
//                }]
//            },
//            tooltip: {
//                valueSuffix: ' registros'
//            },
//            legend: {
//                layout: 'vertical',
//                align: 'right',
//                verticalAlign: 'middle',
//                borderWidth: 0
//            },
//            series: [{
//                name: 'registros',
//                data: []
//            }],
//            credits: {
//               enabled: false
//           },
//    }
//
//    $("#div_grafica_lineas").html( $("#cargador_empresa").html() );
//    var url = "grafica_clientes/"+anio+"/"+mes+"";
//    $.get(url,function(resul){
//    var datos= jQuery.parseJSON(resul);
//    var totaldias=datos.totaldias;
//    var registrosdia=datos.registrosdia;
//    var i=0;
//        for(i=1;i<=totaldias;i++){
//        options.series[0].data.push( registrosdia[i] );
//        options.xAxis.categories.push(i);
//        }
//     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
//         if (mes==1){
//        mez='enero';
//    }
//    if (mes==2){
//        mez='febrero';
//    }
//    if (mes==3){
//        mez='marzo';
//    }
//    if (mes==4){
//        mez='abril';
//    }
//    if (mes==5){
//        mez='mayo';
//    }
//    if (mes==6){
//        mez='junio';
//    }
//    if (mes==7){
//        mez='julio';
//    }
//    if (mes==8){
//        mez='agosto';
//    }
//    if (mes==9){
//        mez='septiembre';
//    }
//    if (mes==10){
//        mez='octubre';
//    }
//    if (mes==11){
//        mez='noviembre';
//    }
//    if (mes==12){
//        mez='diciembre';
//    }
//    
//    options.title.text='Numero de Clientes/prospecto en '+mez+' de '+anio;
//     chart = new Highcharts.Chart(options);
//
//    })
//
//
//    }
function cargar_grafica_pie(anio,mes){
var options={
           chart: {
        renderTo: 'container',
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Comparacion entre clientes y prospectos '
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Porcentaje',
        colorByPoint: true,
        data: []
    }],
    credits: {
               enabled: false
           },
     
}
$("#div_grafica_pie").html( $("#cargador_empresa").html() );

var url = "../grafica_total_clientes/"+anio+"/"+mes+"";
//    console.log("grafica_publicaciones/"+anio+"/"+mes+"");


$.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var porcentajeclientes=datos.porcentajeclientes;
    var porcentajeprospectos=datos.porcentajeprospectos;
    var objeto= {name: "prospectos", y: porcentajeprospectos }; 
    options.series[0].data.push( objeto );  
    var objeto= {name: "clientes", y: porcentajeclientes,sliced: true,
            selected: true }; 
    options.series[0].data.push( objeto );
    if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    
    options.title.text='Comparacion entre clientes y prospectos '+mez+' de '+anio;
//    for(i=0;i<=totattipos-1;i++){  
//    var idTP=parseInt(tipos[i].id);
//    var objeto= {name: tipos[i].titulo, y:numeropublicaciones[idTP] };     
//    options.series[0].data.push( objeto );  
//    }
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})
}
////////// grafica asesor que mas vendio
    function cargar_grafica_asesor_con_mas_clientes(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con mas clientes'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'clientes/prospectos al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'CLIENTES',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_mas_clientes").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_mas_clientes/"+anio+"/"+mes+"";


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
//        console.log(asesores);
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeroclientes'] )
//            options.series[1].data.push(asesores[i]['numeroprospectos'] )
//            console.log(i);
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='TOP 5 asesores con mas clientes '+mez+' de '+anio;
        
//        for(i=1;i<=totaldias;i++){
//
//        options.series[0].data.push( registrosdia[i] );
//        options.xAxis.categories.push(i);
//        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
     chart = new Highcharts.Chart(options);

    })
    }
    ////////// grafica asesor que mas vendio
    function cargar_grafica_asesor_con_menos_clientes(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con menos clientes'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'clientes/prospectos al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'CLIENTES',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_menos_clientes").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_menos_clientes/"+anio+"/"+mes+"";


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
//        console.log(asesores);
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeroclientes'] )
//            options.series[1].data.push(asesores[i]['numeroprospectos'] )
//            console.log(i);
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='TOP 5 asesores con menos clientes '+mez+' de '+anio;
        
//        for(i=1;i<=totaldias;i++){
//
//        options.series[0].data.push( registrosdia[i] );
//        options.xAxis.categories.push(i);
//        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
     chart = new Highcharts.Chart(options);

    })
    }
    ///////////////////////////////////////////////////////////////////////////////////////////
    function cargar_grafica_asesor_con_mas_prospectos(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con mas prospectos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'clientes/prospectos al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'PROSPECTOS',
                data: []
            }],
            credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_mas_prospectos").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_mas_prospectos/"+anio+"/"+mes+"";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeroprospectos'] )
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='TOP 5 asesores con mas prospectos '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
///////// fin grafica asesor que mas vendio  
    ///////////////////////////////////////////////////////////////////////////////////////////
    function cargar_grafica_asesor_con_menos_prospectos(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con menos prospectos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'clientes/prospectos al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'PROSPECTOS',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_menos_prospectos").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_menos_prospectos/"+anio+"/"+mes+"";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeroprospectos'] )
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='TOP 5 asesores con menos prospectos '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
///////// fin grafica asesor que mas vendio  
    ///////////////////////////////////////////////////////////////////////////////////////////
    function cargar_grafica_asesor_con_mas_ventas(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con mas ventas'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'ventas al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Ventas',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_mas_ventas").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_mas_ventas/"+anio+"/"+mes+"";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeroventas'] )
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='TOP 5 asesores con mas Ventas '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
///////// fin grafica asesor que mas vendio 
///////////////////////////////////////////////////////////////////////////////////////////
    function cargar_grafica_asesor_con_menos_ventas(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con mas prospectos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'ventas al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Ventas',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_menos_ventas").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_menos_ventas/"+anio+"/"+mes+"";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeroventas'] )
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='TOp 5 asesores con menos Ventas '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
///////// fin grafica asesor que mas vendio  
///////////////////////////////////////////////////////////////////////////////////////////
    function cargar_grafica_asesor_con_mas_negociaciones(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con mas prospectos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'negociaciones al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'negociaciones',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_mas_negociaciones").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_mas_negociaciones/"+anio+"/"+mes+"";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeronegociaciones'] )
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='TOP 5 asesores con mas negociaciones '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
///////// fin grafica asesor que mas vendio  
///////////////////////////////////////////////////////////////////////////////////////////
    function cargar_grafica_asesor_con_menos_negociaciones(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con mas prospectos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'negociaciones al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'negociaciones',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_menos_negociaciones").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_menos_negociaciones/"+anio+"/"+mes+"";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeronegociaciones'] )
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='TOP 5 asesores con menos negociaciones '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
///////// fin grafica asesor que mas vendio  
    ///////////////////////////////////////////////////////////////////////////////////////////
    function cargar_grafica_asesor_con_mas_perdidas(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 asesores con mas prospectos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'asesores'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'perdidas al mes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'negociaciones',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_asesor_con_mas_perdidas").html( $("#cargador_empresa").html() );

    var url = "../grafica_asesor_con_mas_perdidas/"+anio+"/"+mes+"";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var asesores=datos.asesores;
    var i=0;
        for(i=0;i<=asesores.length-1;i++){
            options.xAxis.categories.push(asesores[i]['nombre']);
            options.series[0].data.push(asesores[i]['numeronegociaciones'] )
        }
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    options.title.text='negociaciones perdidas de asesores '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    
///////// fin grafica asesor que mas vendio 
    function cargar_grafica_ventas_mes(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Numero de Clientes/prospecto en el Mes julio'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'dias del mes'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'REGISTROS AL DIA'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'negociaciones',
                data: []

            },{
                name: 'ventas',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "../grafica_ventas/"+anio+"/"+mes+"";


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var totaldias=datos.totaldias;
    var registrosventas=datos.registrosventas;
    var registrosnegociaciones=datos.registrosnegociaciones;
    var i=0;
        for(i=1;i<=totaldias;i++){

        options.series[0].data.push( registrosnegociaciones[i] );
        options.series[1].data.push( registrosventas[i] );
        options.xAxis.categories.push(i);
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
        if (mes==1){
        mez='enero';
    }
    if (mes==2){
        mez='febrero';
    }
    if (mes==3){
        mez='marzo';
    }
    if (mes==4){
        mez='abril';
    }
    if (mes==5){
        mez='mayo';
    }
    if (mes==6){
        mez='junio';
    }
    if (mes==7){
        mez='julio';
    }
    if (mes==8){
        mez='agosto';
    }
    if (mes==9){
        mez='septiembre';
    }
    if (mes==10){
        mez='octubre';
    }
    if (mes==11){
        mez='noviembre';
    }
    if (mes==12){
        mez='diciembre';
    }
    
    options.title.text='Numero de Ventas/Negociaciones en '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    
    function cargar_grafica_pie_ventas(anio,mes){
    var options={
               chart: {
            renderTo: 'container',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Comparacion entre clientes y prospectos '
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            colorByPoint: true,
            data: []
        }],
        credits: {
                   enabled: false
               },

    }
    $("#div_grafica_pie").html( $("#cargador_empresa").html() );

    var url = "../grafica_total_ventas/"+anio+"/"+mes+"";
    //    console.log("grafica_publicaciones/"+anio+"/"+mes+"");


    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var porcentajeclientes=datos.porcentajeclientes;
        var porcentajeprospectos=datos.porcentajeprospectos;
        var objeto= {name: "negociaciones", y: porcentajeprospectos }; 
        options.series[0].data.push( objeto );  
        var objeto= {name: "ventas", y: porcentajeclientes,sliced: true,
                selected: true }; 
        options.series[0].data.push( objeto );
        if (mes==1){
            mez='enero';
        }
        if (mes==2){
            mez='febrero';
        }
        if (mes==3){
            mez='marzo';
        }
        if (mes==4){
            mez='abril';
        }
        if (mes==5){
            mez='mayo';
        }
        if (mes==6){
            mez='junio';
        }
        if (mes==7){
            mez='julio';
        }
        if (mes==8){
            mez='agosto';
        }
        if (mes==9){
            mez='septiembre';
        }
        if (mes==10){
            mez='octubre';
        }
        if (mes==11){
            mez='noviembre';
        }
        if (mes==12){
            mez='diciembre';
        }

        options.title.text='Comparacion entre Ventas y Clientes '+mez+' de '+anio;
    //    for(i=0;i<=totattipos-1;i++){  
    //    var idTP=parseInt(tipos[i].id);
    //    var objeto= {name: tipos[i].titulo, y:numeropublicaciones[idTP] };     
    //    options.series[0].data.push( objeto );  
    //    }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
     chart = new Highcharts.Chart(options);

    })
}
    
//cargar_grafica_clientes_mes(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_lineas(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_pie(<?= $anio; ?>,<?= intval($mes); ?>);
cargar_grafica_asesor_con_mas_clientes(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_asesor_con_menos_clientes(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_asesor_con_mas_prospectos(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_asesor_con_menos_prospectos(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_asesor_con_mas_ventas(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_asesor_con_menos_ventas(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_asesor_con_mas_negociaciones(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_asesor_con_menos_negociaciones(<?= $anio; ?>,<?= intval($mes); ?>);
//cargar_grafica_asesor_con_mas_perdidas(<?= $anio; ?>,<?= intval($mes); ?>);
    
    
</script>
@endsection
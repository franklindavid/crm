@extends('layouts.app')
@section('title','Estadisticas Asesor')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-bar-chart"></i> Estadísticas <font style="text-transform: capitalize;">{{ Auth::user()->name }}</font> </h2>   
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
            <li><a href="#" onclick="uno()">numero de prospectos/clientes diario</a></li>
            <li><a href="#" onclick="dos()">porcentaje prospectos/clientes en el mes</a></li>
            <li><a href="#" onclick="tres()">Top 5 clientes con mas ventas</a></li>
            <li><a href="#" onclick="cuatro()">Top 5 clientes/prospectos con mas negociaciones</a></li>
            <li><a href="#" onclick="cinco()">Top 5 clientes/prospectos con mas referidos</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Negociaciones/ventas <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="#" onclick="seis()">numero de Negociaciones mensuales</a></li>
            <li><a href="#" onclick="siete()">numero de Ventas mensuales</a></li>
        </ul>
    </li>
    </ul> 
  </div>
</nav>
<!--///////////////////////////////-->
<?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>

<div  class="row" > 
    <div class="col-md-6">
        <select class="form-control" id="anio_sel_uno"  onchange="cambiar_fecha_uno();">
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
        <select class="form-control hidden" id="anio_sel_tres"  onchange="cambiar_fecha_tres();">
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
    </div>
    <div class="col-md-6">
        <select class="form-control" id="mes_sel_uno" onchange="cambiar_fecha_uno();" >
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
        <select class="form-control hidden" id="mes_sel_tres" onchange="cambiar_fecha_tres();" >
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
    }
    function cambiar_fecha_uno(){
        var anio_sel=$("#anio_sel_uno").val();
        var mes_sel=$("#mes_sel_uno").val();
        cargar_grafica_clientes_mes(anio_sel,mes_sel);  
    }
    function dos(){
        var anio_sel=$("#anio_sel_dos").val();
        var mes_sel=$("#mes_sel_dos").val();
        cargar_grafica_pie_ventas(anio_sel,mes_sel);
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
    }
    function cambiar_fecha_dos(){
        var anio_sel=$("#anio_sel_dos").val();
        var mes_sel=$("#mes_sel_dos").val();
        cargar_grafica_pie_ventas(anio_sel,mes_sel);  
    }
    function tres(){
        var anio_sel=$("#anio_sel_tres").val();
        var mes_sel=$("#mes_sel_tres").val();
        cargar_grafica_cliente_con_mas_ventas(anio_sel,mes_sel);
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
    }
    function cambiar_fecha_tres(){
        var anio_sel=$("#anio_sel_tres").val();
        var mes_sel=$("#mes_sel_tres").val();
        cargar_grafica_cliente_con_mas_ventas(anio_sel,mes_sel);  
    }
    function cuatro(){
        var anio_sel=$("#anio_sel_cuatro").val();
        var mes_sel=$("#mes_sel_cuatro").val();
        cargar_grafica_cliente_con_mas_negociaciones(anio_sel,mes_sel);
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
    }
    function cambiar_fecha_cuatro(){
        var anio_sel=$("#anio_sel_cuatro").val();
        var mes_sel=$("#mes_sel_cuatro").val();
        cargar_grafica_cliente_con_mas_negociaciones(anio_sel,mes_sel);  
    }
    function cinco(){
        var anio_sel=$("#anio_sel_cinco").val();
        var mes_sel=$("#mes_sel_cinco").val();
        cargar_grafica_cliente_con_mas_referidos(anio_sel,mes_sel);
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
    }
    function cambiar_fecha_cinco(){
        var anio_sel=$("#anio_sel_cinco").val();
        var mes_sel=$("#mes_sel_cinco").val();
        cargar_grafica_cliente_con_mas_referidos(anio_sel,mes_sel);  
    }
    function seis(){
        var anio_sel=$("#anio_sel_seis").val();
        cargar_grafica_negociaciones_anuales(anio_sel);
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
        $('#anio_sel_siete').addClass('hidden');
        $('#mes_sel_siete').addClass('hidden');
    }
    function cambiar_fecha_seis(){
        var anio_sel=$("#anio_sel_seis").val();
        cargar_grafica_negociaciones_anuales(anio_sel);  
    }
    function siete(){
        var anio_sel=$("#anio_sel_siete").val();
        cargar_grafica_ventas_anuales(anio_sel);
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
        $('#anio_sel_siete').removeClass('hidden');
        $('#mes_sel_siete').removeClass('hidden');
    }
    function cambiar_fecha_siete(){
        var anio_sel=$("#anio_sel_siete").val();
        var mes_sel=$("#mes_sel_siete").val();
        cargar_grafica_ventas_anuales(anio_sel);  
    }
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
    var url = "grafica_clientes_individual/"+anio+"/"+mes+"";


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
    ///////////////////////////////////////////////////////////////////////
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

    var url = "grafica_total_clientes_individual/"+anio+"/"+mes+"";
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

        options.title.text='Comparacion entre Prospectos y Clientes '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    function cargar_grafica_cliente_con_mas_ventas(anio,mes){
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

    $("#div_grafica_cliente_con_mas_ventas").html( $("#cargador_empresa").html() );

    var url = "grafica_cliente_con_mas_ventas_individual/"+anio+"/"+mes+"";
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
    options.title.text='TOP 5 clientes con mas Ventas '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    //////////////////////////////////////////////////////////
    function cargar_grafica_cliente_con_mas_negociaciones(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 clientes con mas negociaciones'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'clientes'
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

    var url = "grafica_cliente_con_mas_negociaciones_individual/"+anio+"/"+mes+"";
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
    options.title.text='TOP 5 clientes con mas negociaciones '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    ///////////////////////////////////////////////////////////////////////////////
function cargar_grafica_cliente_con_mas_referidos(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 clientes con mas referidos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'clientes'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'referidos al mes'
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
                name: 'REFERIDOS',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

//    $("#div_grafica_asesor_con_mas_clientes").html( $("#cargador_empresa").html() );

    var url = "grafica_cliente_con_mas_referidos_individual/"+anio+"/"+mes+"";


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var clientes=datos.clientes;
    var i=0;
        for(i=0;i<=clientes.length-1;i++){
            options.xAxis.categories.push(clientes[i]['nombre']);
            options.series[0].data.push(clientes[i]['numeroreferidos'] )
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
    options.title.text='TOP 5 clientes con mas referidos '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    /////////////////////////////////////////////////
    function cargar_grafica_negociaciones_anuales(anio){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: { 
                text: 'Numero de ventas/negociaciones en el Mes julio'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                 categories: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                    ],
                 title: {
                    text: 'meses'
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

            },
                    {
                name: 'en proceso',
                data: []

            },
                    {
                name: 'perdidas',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "grafica_negociaciones_anuales/"+anio+"";
//        console.log(url);


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalperdidas=datos.totalperdidas;
    var totalenproceso=datos.totalenproceso;
    var totalnegociaciones=datos.totalnegociaciones;
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalnegociaciones[i] );
        options.series[1].data.push( totalenproceso[i] );
        options.series[2].data.push( totalperdidas[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='negociaciones '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    ///////////////////////////////////////////////////////////
    function cargar_grafica_ventas_anuales(anio){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: { 
                text: 'Numero de ventas/negociaciones en el Mes julio'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                 categories: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                    ],
                 title: {
                    text: 'meses'
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
                name: 'ventas',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "grafica_venta_anual/"+anio+"";


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalventas=datos.totalventas;
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalventas[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='Ventas '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
     
    cargar_grafica_clientes_mes(<?= $anio; ?>,<?= intval($mes); ?>);
</script>
@endsection


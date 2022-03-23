@extends('layouts.app')
@section('title','Estadisticas Productos')
@section('content')
<body style="background-color:#E0F2F0">
<div class="panel panel-default">    
    <div class="panel-heading" style="background-color:#8BCEE5; color:white"><h2><i class="fa fa-bar-chart"></i> Estadísticas tickets </h2>   
    </div>
        <div class="panel-body">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#" onclick="uno()">Tickets generales</a></li>  
      <li><a href="#" onclick="dos()">tecnico con mas tickets resueltos</a></li>  
      <li><a href="#" onclick="tres()">tecnico con mas tickets pendientes</a></li>  
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
    </div>
    <div class="col-md-6">
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
        cargar_grafica_tickets_mes(anio_sel);
        $('#anio_sel_uno').removeClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
    }
    function cambiar_fecha_uno(){
        var anio_sel=$("#anio_sel_uno").val();
        cargar_grafica_tickets_mes(anio_sel);  
    }
    function dos(){
        var anio_sel=$("#anio_sel_dos").val();
        var mes_sel=$("#mes_sel_dos").val();
        cargar_grafica_tecnico_con_mas_tickets(anio_sel,mes_sel);
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_dos').removeClass('hidden');
        $('#anio_sel_dos').removeClass('hidden');
    }
    function cambiar_fecha_dos(){
        var anio_sel=$("#anio_sel_dos").val();
        var mes_sel=$("#mes_sel_dos").val();
        cargar_grafica_tecnico_con_mas_tickets(anio_sel,mes_sel);  
    }
    function tres(){
        $('#anio_sel_uno').addClass('hidden');
        $('#mes_sel_dos').addClass('hidden');
        $('#anio_sel_dos').addClass('hidden');
        var anio_sel=$("#anio_sel_dos").val();
        var mes_sel=$("#mes_sel_dos").val();
        cargar_grafica_tecnico_con_mas_tickets_pendientes();
    }
    function cambiar_fecha_tres(){
        var anio_sel=$("#anio_sel_tres").val();
        var mes_sel=$("#mes_sel_tres").val();
        cargar_grafica_tecnico_con_mas_tickets_pendientes();  
    }
    /////////////////////////////////////////////////////////////////
    function cargar_grafica_tickets_mes(anio){
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
                    text: 'tickets al mes'
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
                name: 'total tickets',
                data: []

            },
                    {
                name: 'resueltos',
                data: []

            },
                    {
                name: 'pendientes',
                data: []

            }],
           credits: {
               enabled: false
           },
    }

//    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "../grafica_ticket_anual/"+anio+"";
//        console.log(url);


    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    var totalperdidas=datos.totalpendientes;
    var totalenproceso=datos.totalresueltos;
    var totalnegociaciones=datos.totaltickets;
    var i=0;
        for(i=1;i<=12;i++){
        options.series[0].data.push( totalnegociaciones[i] );
        options.series[1].data.push( totalenproceso[i] );
        options.series[2].data.push( totalperdidas[i] );
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    options.title.text='TICKETS '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    //////////////////////////////////////////////////////////////////////
    function cargar_grafica_tecnico_con_mas_tickets(anio,mes){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 tecnicos con mas Tickets resueltos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'tecnicos'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'tickets al mes'
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
                name: 'Tickets',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_cliente_con_mas_ventas").html( $("#cargador_empresa").html() );

    var url = "../grafica_tecnico_con_mas_tickets_resueltos/"+anio+"/"+mes+"";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var clientes=datos.clientes;
    var i=0;
        for(i=0;i<=clientes.length-1;i++){
            options.xAxis.categories.push(clientes[i]['nombre']);
            options.series[0].data.push(clientes[i]['numerotickets'] )
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
    options.title.text='TOP 5 tecnicos con mas Tickets resueltos '+mez+' de '+anio;
     chart = new Highcharts.Chart(options);

    })
    }
    //////////////////////////////////////////////////////////////////////
    function cargar_grafica_tecnico_con_mas_tickets_pendientes(){
    var options={
         chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'TOP 5 tecnicos con mas Tickets resueltos'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [],
                 title: {
                    text: 'tecnicos'
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'tickets al mes'
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
                name: 'Tickets',
                data: []
            }],
        credits: {
               enabled: false
           },
    }

    $("#div_grafica_cliente_con_mas_ventas").html( $("#cargador_empresa").html() );

    var url = "../grafica_tecnico_con_mas_tickets_pendientes";
        console.log(url);


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var clientes=datos.clientes;
    var i=0;
        for(i=0;i<=clientes.length-1;i++){
            options.xAxis.categories.push(clientes[i]['nombre']);
            options.series[0].data.push(clientes[i]['numerotickets'] )
        }
        
    options.title.text='TOP 5 tecnicos con mas Tickets pendientes ';
     chart = new Highcharts.Chart(options);

    })
    }
    cargar_grafica_tickets_mes(<?= $anio; ?>);
</script>
@endsection
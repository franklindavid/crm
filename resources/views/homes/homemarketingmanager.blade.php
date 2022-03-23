@extends('layouts.app')
@section('title','Eventos')
@section('content')
<div class="panel panel-default">
    <!-- Content Header (Page header) -->
    <div class="panel-heading"><h2> Calendario   </h2>  </div>
    <div class="panel-body">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Eventos</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
                <div class="external-event fc-event" style="background-color: rgb(161, 77, 112); border-color: rgb(161, 77, 112);  color: rgb(255,255,255); ">Campaña publicitaria</div>
                <div class="external-event fc-event" style="background-color: rgb(69, 93, 144); border-color: rgb(69, 93, 144);  color: rgb(255,255,255); ">Reunion</div>
                <div class="external-event fc-event" style="background-color: rgb(78, 144, 69); border-color: rgb(78, 144, 69);  color: rgb(255,255,255); ">Cumpleaños</div>
                <div class='external-event fc-event' style="background-color: rgb(200, 30, 30); border-color: rgb(200, 30, 30);  color: rgb(255,255,255); ">Charla</div>
                <div class='external-event fc-event' style="background-color: rgb(168, 175, 40); border-color: rgb(168, 175, 40);  color: rgb(255,255,255); ">Trabajo de campo</div>
                <div class="checkbox">
                  <label for="drop-remove">
                    <input type="checkbox" id="drop-remove">
                    Eliminar al asignar
                  </label>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Crear evento</h3>
            </div>
            <div class="box-body">
<!--
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-aqua"  href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                </ul>
              </div>
-->
              <!-- /btn-group -->
              <div class="input-group">
                <input id="new-event" type="text" class="form-control" placeholder="Titulo de evento">

                <div class="input-group-btn">
                  <button id="add-new-event" type="button" class="btn btn-primary btn-flat" >Agregar</button>
                </div>
                <!-- /btn-group -->
              </div><br/><br/>
              <!-- /input-group -->
              {!! Form::open(['route'=>'marketingmanager.events.create','method'=>'POST','id' =>'form-calendario']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
   </div><!-- /.panel-body -->
  </div><!-- /.panel -->
  
  <!-- Modal Cierre -->
	<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-red">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="mtitulo"></h4>
	      </div>

	      <div class="modal-body">

	            <!-- form start -->
<!--	            {!! Form::open(['route'=>'marketingmanager.events.update2','method'=>'POST']) !!}-->
	            {!! Form::open(array('route' => ['marketingmanager.events.update2',null], 'method' => 'put')) !!}﻿
                {!! Form::text('id',null,['class'=>'form-control hidden','placeholder'=>'Asunto','required','id'=>'txtid']) !!}
                 <div class="form-group">
                    {!! Form::label('asunto','Asunto') !!}
                    {!! Form::text('asunto',null,['class'=>'form-control','placeholder'=>'Asunto','required','id'=>'txtasunto']) !!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('informacion','Informacion') !!}
                    {!! Form::text('informacion',null,['class'=>'form-control','placeholder'=>'informacion','id'=>'txtinformacion']) !!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('lugar','Lugar') !!}
                    {!! Form::text('lugar',null,['class'=>'form-control','placeholder'=>'lugar','id'=>'txtlugar']) !!}
                 </div>
                 <div class="modal-footer">

                 <div class="form-group">
                    {!! Form::button('Cancelar',['class'=>'btn btn-default','id'=>'btnCerrarModal','data-dismiss'=>'modal']) !!} 	
                    {!! Form::submit('Modificar',['class'=>'btn btn-primary']) !!} 	
                 </div>
                 </div>

                {!! Form::close() !!}
	          <!-- /.box -->
	      </div>

<!--
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" id="btnCerrarModal" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-danger" id="btnUpdEvento">Guardar</button>
	      </div>
-->
	    </div>
	  </div>
	</div>
@endsection
@section('js')
  <script>
  $(function () {  
    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
  //while(reload==false){
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'hoy',
        month: 'mes',
        week: 'semana',
        day: 'dia'
      },

      events: { url:"marketingmanager/cargaEventos"},

      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!

      drop: function (date, allDay) { // this function is called when something is dropped
        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');
        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);
        allDay=true;
        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        //$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }
        //Guardamos el evento creado en base de datos
        var title=copiedEventObject.title;
        var start=copiedEventObject.start.format("YYYY-MM-DD HH:mm");
        var back=copiedEventObject.backgroundColor;

        crsfToken = document.getElementsByName("_token")[0].value;
        $.ajax({
             url: 'marketingmanager/guardaEventos',
             data: 'title='+ title+'&start='+ start+'&allday='+allDay+'&background='+back,
             type: "POST",
             headers: {
                    "X-CSRF-TOKEN": crsfToken
                },
              success: function(events) {
                console.log('Evento creado');      
                $('#calendar').fullCalendar('refetchEvents' );
              },
              error: function(json){
                console.log("Error al crear evento");
              }        
        });        
      },
        eventResize: function(event) {
          var start = event.start.format("YYYY-MM-DD HH:mm");
          var back=event.backgroundColor;
          var allDay=event.allDay;
          if(event.end){
            var end = event.end.format("YYYY-MM-DD HH:mm");
          }else{var end="NULL";
          }
          crsfToken = document.getElementsByName("_token")[0].value;
            $.ajax({
              url: 'marketingmanager/actualizaEventos',
              data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id+'&background='+back+'&allday='+allDay,
              type: "POST",
              headers: {
                    "X-CSRF-TOKEN": crsfToken
                },
                success: function(json) {
                  console.log("Updated Successfully");
                },
                error: function(json){
                  console.log("Error al actualizar evento");
                }
            });
      },
        eventDrop: function(event, delta) {
        var start = event.start.format("YYYY-MM-DD HH:mm");
        if(event.end){
          var end = event.end.format("YYYY-MM-DD HH:mm");
        }else{var end="NULL";
        }
        var back=event.backgroundColor;
        var allDay=event.allDay;
        crsfToken = document.getElementsByName("_token")[0].value;

          $.ajax({  
            url: 'marketingmanager/actualizaEventos',
            data: 'title='+ event.title+'&start='+ start +'&end='+ end+'&id='+ event.id+'&background='+back+'&allday='+allDay ,           
            type: "POST",
            headers: {
              "X-CSRF-TOKEN": crsfToken
            },
            success: function(json) {
              console.log("Updated Successfully eventdrop");
            },
            error: function(json){
              console.log("Error al actualizar eventdrop");
            }
          });
      },
        eventMouseover: function( event, jsEvent, view ) {
//        console.log(event.informacion);
//        console.log(event.lugar);
        var lugar =  event.lugar;
        var informacion = event.informacion;
        var start = (event.start.format("HH:mm"));
        var back=event.backgroundColor;
        if(event.end){
            var end = event.end.format("HH:mm");
        }else{var end="No definido";
        }
        if(event.allDay){
            var allDay = "Si";
        }else{var allDay="No";
        }
        var tooltip = '<div class="tooltipevent" style="width:200px;height:120px;color:white;background:'+back+';position:absolute;z-index:10001;">'+'<center>'+ event.title +'</center>'+'Todo el dia: '+allDay+'<br>'+ 'Inicio: '+start+'<br>'+ 'Fin: '+ end +'<br>'+'Informacion: '+informacion+'<br>'+'Lugar: '+lugar+'</div>';
        $("body").append(tooltip);
        $(this).mouseover(function(e) {
          $(this).css('z-index', 10000);
          $('.tooltipevent').fadeIn('500');
          $('.tooltipevent').fadeTo('10', 1.9);
        }).mousemove(function(e) {
          $('.tooltipevent').css('top', e.pageY + 10);
          $('.tooltipevent').css('left', e.pageX + 20);
        });            
      },
        eventMouseout: function(calEvent, jsEvent) {
        $(this).css('z-index', 8);
        $('.tooltipevent').remove();
      },

      dayClick: function(date, jsEvent, view) {
            if (view.name === "month") {
                $('#calendar').fullCalendar('gotoDate', date);
                $('#calendar').fullCalendar('changeView', 'agendaDay');
            }
      },eventClick: function (event, jsEvent, view) {
            $('#mhdnIdEvento').val(event.id);
            $('#mtitulo').html(event.title);
            $('#txtid').val(event.id);
            $('#txtasunto').val(event.title);
            $('#txtinformacion').val(event.informacion);
            $('#txtlugar').val(event.lugar);
              $('div[class=fc-content]').click(function(e){
                 $('#modalEvento').modal();
              });
            /////////////////////////////
      },eventRender : function(event, element) {
//          $('#modalEvento').modal('hide');
          var el = element.html();
          element.html("<div style='width:77%;float:left;'>"+el+"</div><div style='text-align:right;'><i title='eliminar evento' href='' class='fa fa-remove btn btn-danger btn-xs'></i></div>");
          
          element.find('.btn-danger').click(function(){
             
        crsfToken = document.getElementsByName("_token")[0].value;
        var con=confirm("Esta seguro que desea eliminar el evento");
        if(con){
            $.ajax({
               url: 'marketingmanager/eliminaEvento',
               data: 'id=' + event.id,
               headers: {
                  "X-CSRF-TOKEN": crsfToken
                },
               type: "POST",
               success: function () {
                    $('#calendar').fullCalendar('removeEvents', event._id);
                    console.log("Evento eliminado");
                }
            });
        }else{
           console.log("Cancelado");
        }
          });
        },
        
    });

    /* AGREGANDO EVENTOS AL PANEL */
    var currColor = "#7EC0EE"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>
@endsection

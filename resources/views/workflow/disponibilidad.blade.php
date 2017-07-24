@extends('layouts.app')

@section('content')
    <!-- page content -->
	<div class="right_col" role="main">
      <div class="">
        <div class="page-title"> 
          <div class="title_left">
            <h3>Calendario</h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x_title">
				<!-- <a href="\workflow\create_agenda" class="btn btn-dark" role="button">Nuevo Agendamiento</a>-->
				@if (count($puede_importar_agenda))
					<a href="\workflow\create_cargamasiva" class="btn btn-warning" role="button">Importar Agenda</a>
				@endif
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
				<div id="calendar2"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Nuevo Turno</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
				<form id="antoform" class="form-horizontal calender" role="form" method="POST" action="{{ url('/workflow/nuevo_turno') }}" autocomplete=off>
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_servicio">Fecha</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" id="fecha_servicio" name="fecha_servicio" class="form-control" data-date-format="mm-dd-yyyy"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hora<span class="required"></span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select id="hora_servicio" name="hora_servicio" class="select2_single form-control" tabindex="-1">
								<option value="1">09:00 - 12:00</option>
								<option value="2">12:00 - 15:00</option>
								<option value="3">15:00 - 18:00</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Actividades / Usuarios</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
						<select id="usuario_accion" name="usuario_accion" class="select2_single form-control" tabindex="-1">
							@foreach($acciones_disponibles as $accion_disponible)
								<option value="{{ $accion_disponible->username }}-{{ $accion_disponible->cod_acc }}">{{ $accion_disponible->usr_act}}</option>
							@endforeach
						</select>
						</div>
					</div>											  
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary antosubmit">Seleccionar Cita</button>
          </div>
		  </form>
        </div>
      </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title2" name="title2">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                  </div>
                </div>

              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
          </div>
        </div>
      </div>
	  
    </div>
	<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->
	
	<script>
		window.onload = function(){				

			@if(Session::has('message'))
				alert('{{ Session::get('message') }}');
			@endif
		
			if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
			console.log('init_calendar');
			var date = new Date(),
				d = date.getDate(),
				m = date.getMonth(),
				y = date.getFullYear(),
				started,
				categoryClass;

			var calendar = $('#calendar2').fullCalendar({
			  header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,listMonth'
			  },
			  selectable: true,
			  selectHelper: true,
			  editable: false,
			  @if (count($puede_agendar))
				select: function(start, end, allDay) {
					var check = moment(start).format('MM-DD-YYYY'); //server
					//var check = moment(start).format('DD-MM-YYYY'); //local
					//var today = moment(date).format('DD-MM-YYYY'); //local
					var today = moment(date).format('MM-DD-YYYY'); //server
					if(check >= today){
						$('#fc_create').click();
						document.getElementById("fecha_servicio").value = check;
						started = start;
						ended = end;
					}
					
						
/*          	
						$(".antosubmit").on("click", function() {
						var title = $("#title").val();
						if (end) {
							ended = end;
						}
				
						categoryClass = $("#event_type").val();
				
						if (title) {
							calendar.fullCalendar('renderEvent', {
								title: title,
								start: started,
								end: end,
								allDay: allDay
							},
							true // make the event "stick"
							);
						}
				
						$('#title').val('');
				
						calendar.fullCalendar('unselect');
				
						$('.antoclose').click();
				
						return false;
						});
*/					  },
			  @endif
			  events: [
				@foreach($procesos as $proceso)
                {
					@if ($proceso->campo3_19_ !== '')
						title : 'Cita agendada',
					@else
						title : 'Cita seleccionada',
					@endif
                    start : '{{ $proceso->startdate }}',
					end : '{{ $proceso->enddate }}',
					@foreach(Session::get('empresas') as $obj)
						@if ($obj->dsc_emp == $proceso->dsc_emp)
							url : '{{route('workflow.show', $proceso->id19_) }}'
							@break;
						@endif
					@endforeach
                },
                @endforeach
			   ]
			});
			
			$('input[name="fecha_servicio"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				minDate: moment(),
				locale: {
					//format: "DD-MM-YYYY" // local
					format: "MM-DD-YYYY" //server
				}
			});
		};
	

    </script>
@stop
    

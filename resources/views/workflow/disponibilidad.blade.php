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
				<a href="\workflow\create_agenda" class="btn btn-dark" role="button">Nuevo Agendamiento</a>
				<a href="\workflow\create_cargamasiva" class="btn btn-warning" role="button">Importar Agenda</a>
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
            <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
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
			  events: [
				@foreach($procesos as $proceso)
                {
                    title : '{{ $proceso->campo3_19_ . ' ' . $proceso->campo4_19_ }}',
                    start : '{{ $proceso->startdate }}',
					end : '{{ $proceso->enddate }}',
                    url : '{{route('workflow.show', $proceso->id19_) }}'
                },
                @endforeach
			   ]
			});
			
		};
   

    </script>
@stop
    

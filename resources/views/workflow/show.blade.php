@extends('layouts.app')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          
		  
		  
       

        <div class="row" role="main">
            <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="dashboard_graph">

					<div class="row x_title">
						  <div class="col-md-4">
							<h3>Workflow Seguros  <!--<small>Graph title sub-title</small>--></h3>
						  </div>
					</div>
				<!------------------------------------------------>
				
					<div class="col-md-12 col-sm-12 col-xs-12"><br>
						<!---------->	

					<div class="x_panel">
						<div class="x_title">
							<h2>Seguimiento</h2>
							<ul class="nav navbar-right panel_toolbox">
							  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							  </li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
						  
							<div class="panel panel-default">
								
								<table class="table table-bordered table-hover vmiddle">
									<thead>
										<tr>
											<div class=" panel-heading text-center">
											<th>Fecha</th>
											<th>Accion</th>
											<th>Actividad</th>
											<th>Usuario</th>
											<th>Comentario</th>
											</div>
										</tr>
									</thead>
									<tbody>
										@foreach($logs as $log)
										<tr>
											
											<td>{{$log->fec_log}}</td>
											<td>{{$log->cod_acc}}</td>																
											<td>REGISTRO CLIENTE</td>
											<td>{{$log->username}}</td>
											<td>{{$log->obs_log}}</td>
											
										</tr>
										@endforeach
									
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<!-- Smart Wizard -->
					
					
					<!------------->
					 <div class="x_panel">
						<div class="x_title">
						  <h2>Actividad <small>Registro Cliente</small></h2>
						  <ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						  </ul>
						  <div class="clearfix"></div>
						</div>
						<div class="x_content">
							<fieldset disabled>
								<ul class="list-unstyled timeline">
							<li>
							  <div class="block">
								<div class="tags">
								  <a href="" class="tag">
									<span>Paso 1</span>
								  </a>
								</div>
								<div class="block_content">
								  <h2 class="title"> <a>Registro terceros</a> </h2>
									<div class="form-group"><br>
										<div class="x_panel">
											 <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

											  <div class="form-group"><br>
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">IDENTIFICACION <span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											  </div>
											  <div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">TERCERO<span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											  </div>
											  <div class="form-group">
												<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">OTRO</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
												</div>
											  </div>						 

											</form>
										</div>
									</div>
								</div>
							</li>
							<li>
							  <div class="block">
								<div class="tags">
								  <a href="" class="tag">
									<span>Paso 2</span>
								  </a>
								</div>
								<div class="block_content">
								  <h2 class="title"> <a>Registrar servicios</a> </h2>
									<div class="form-group"><br>
										<div class="x_panel"><br>			 
											<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"><br>
											  <div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TIPO SERVICIO<span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											  </div>
											  <div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NUMERO SOLICITUD<span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											  </div>
											  
											  <div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">PROCESO</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <div id="gender" class="btn-group" data-toggle="buttons">
													<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
													  <input type="radio" name="gender" value="male"> &nbsp; Rechazado &nbsp;
													</label>
													<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
													  <input type="radio" name="gender" value="female">  Aprobado 
													</label>
												  </div>
												</div>
											  </div>
											</form>
										</div>
									</div>
								</div>
							  </div>
							</li>
							<li>
							  <div class="block">
								<div class="tags">
								  <a href="" class="tag">
									<span>Paso 3</span>
								  </a>
								</div>
								<div class="block_content">
								  <h2 class="title">  <a>Asignar actividad</a> </h2>
									<div class="form-group"><br>
										<div class="x_panel">					  
											<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"><br>									  
											  <div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">USUARIOS</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <select class="select2_single form-control" tabindex="-1">
													<option></option>
													<option value="AK">Alaska</option>
													<option value="HI">Hawaii</option>
													<option value="CA">California</option>
													<option value="NV">Nevada</option>
													<option value="OR">Oregon</option>
													<option value="WA">Washington</option>
													<option value="AZ">Arizona</option>
													<option value="CO">Colorado</option>
													<option value="ID">Idaho</option>
												  </select>
												</div>
											  </div>
											   <div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">OBSERVACIONES </label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <textarea id="message" required="required" class="form-control" name="message"></textarea>
												</div>
											  </div>
											</form>
										</div>
									</div>
								</div>
							  </div>
							</li>
						  </ul>
							
							</fieldset>
						</div>
					</div>
					<!---------->	

					<div class="x_panel">
						<div class="x_title">
							<h2>Dodumentos<small>Asociados de Captura</small></h2>
							<ul class="nav navbar-right panel_toolbox">
							  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							  </li>
							  <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<ul class="dropdown-menu" role="menu">
								  <li><a href="#">Settings 1</a>
								  </li>
								  <li><a href="#">Settings 2</a>
								  </li>
								</ul>
							  </li>
							  <li><a class="close-link"><i class="fa fa-close"></i></a>
							  </li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
						  
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<span><strong><span class="glyphicon glyphicon-folder-open"> </span> Archivos</strong></span>
								</div>
								<table class="table table-bordered table-hover vmiddle">
									<thead>
										<tr>
											
											<th></th>	
											<th>Archivos</th>
											<th>Tipo Documento</th>
											<th>Tamaño</th>
											<th>Fecha</th>
											<th>Acciones</th>
											
											
										</tr>
									</thead>
									<tbody>
										<tr>
											
											<td>001</td>
											<td>doc_6_doc_3_Egreso.pdf</td>
											<td>Listado General de Personas</td>																
											<td>523.0 KB </td>
											<td>16-sep-16 09:48:2</td>
											<td class="text-center">
												<a href="#"><span class="btn btn-sm btn-primary glyphicon glyphicon-file"></span></a>
											</td>
										</tr>
										<tr>
											
											<td>001</td>
											<td>doc_6_doc_3_Egreso.pdf</td>
											<td>Listado General de Personas</td>																
											<td>523.0 KB </td>
											<td>16-sep-16 09:48:2</td>
											<td class="text-center">
												<a href="#"><span class="btn btn-sm btn-primary glyphicon glyphicon-file"></span></a>
											</td>
										</tr>
										<tr>
											
											<td>001</td>
											<td>doc_6_doc_3_Egreso.pdf</td>
											<td>Listado General de Personas</td>																
											<td>523.0 KB </td>
											<td>16-sep-16 09:48:2</td>
											<td class="text-center">
												<a href="#"><span class="btn btn-sm btn-primary glyphicon glyphicon-file"></span></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<!-- Smart Wizard -->	
			  </div>
										
						
					</div>
				
				<!------------------------------------------------------->


				</div>
			</div>
          <br />
        </div>
        <!-- /page content -->
@stop
    
<!--
    jQuery
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
	Bootstrap
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    FastClick
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    NProgress
    <script src="../vendors/nprogress/nprogress.js"></script>
    Chart.js
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    gauge.js
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    bootstrap-progressbar
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    iCheck
    <script src="../vendors/iCheck/icheck.min.js"></script>
    Skycons
    <script src="../vendors/skycons/skycons.js"></script>
    Flot
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    Flot plugins
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    DateJS
    <script src="../vendors/DateJS/build/date.js"></script>
    JQVMap
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    bootstrap-daterangepicker
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    Custom Theme Scripts
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
-->
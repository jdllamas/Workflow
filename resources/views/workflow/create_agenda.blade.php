@extends('layouts.app')
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>Nuevo Agendamiento</h2>
					<ul class="nav navbar-right panel_toolbox">
					   <li><p data-placement="top" data-toggle="tooltip" title="Regresar"><a href="/workflow/disponibilidad" class="btn btn-default btn-xs" data-title="Ver"><span class="glyphicon glyphicon-arrow-left"></span></a></p>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
				  <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/workflow') }}" autocomplete=off>
				  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
						<!-- Smart Wizard -->
						<div id="" class="form_wizard wizard_horizontal">
						  <ul class="wizard_steps">
							<li>
							  <a href="#step-1"><span class="step_no">1</span>
							  <span class="step_descr">
								Paso 1<br />
								<small> Asignar turno</small>
								</span>
							  </a>
							</li>
						  </ul>	
							<div id="step-1">
							<!------>
								<div class="col-md-1"></div>
								<div class="col-md-10"><br><br>
									<div class="x_panel">
									  <div class="x_title">
										<h2>Asignar turno</h2>                  
										<div class="clearfix"></div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">FECHA</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div id="datetime-local" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
													<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
													<span></span> <b class="caret"></b>
												</div>
											</div>
										</div>
										 <div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">HORA<span class="required"></span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<select id="tipo_servicio" name="tipo_servicio" class="select2_single form-control" tabindex="-1">
													<option></option>
													<option value="1">9-12</option>
													<option value="2">12-15</option>
													<option value="3">15-18</option>
												</select>
											</div>
										  </div>
										
									</div>
									<div class="text-right">
										<button type="button" class="btn btn-primary">Finish</button>
									</div>
									
								</div>
							<!-----> 						
							</div>
						</div>                   
					</div> 									
				</div>
			</div>	
		</div>
	<!---------->
	</div>
</div>
    
@stop

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
                    <h2>Agendamiento</h2>
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
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1"><span class="step_no">1</span>
						  <span class="step_descr">
							Paso 1<br />
                            <small>Paso 1 Registro de terceros</small>
							</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Paso 2<br />
                                              <small>Paso 2 Registro de servicios</small>
                                          </span>
                          </a>
                        </li><!--
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Paso 3<br />
                                              <small>Paso 3 Asignación de actividades</small>
                                          </span>
                          </a>
                        </li>-->
                      </ul>
						<div id="step-1">
							<!------>
								<div class="col-md-1"></div>
								<div class="col-md-10"><br><br>
									<div class="x_panel">
									  <div class="x_title">
										<h2>Manejo de Archivo</h2>                  
										<div class="clearfix"></div>
										</div>
												<div class="container-fluid adm-archivos">
										<div class="row">
											<div class="col-md-12">						
												<div class="panel-body">
													<div class="col-md-2 "></div>
													<div class="col-md-8 subir-archivos">
														
														<div class="panel-heading text-center">
															<span><strong><span class="glyphicon glyphicon-file"> </span> Importar Agendamiento</strong></span>
														</div>
														<br>
													
														<div class="form-group">
															<label>Subir archivos</label>
															<div class="input-group">
																<input placeholder="" id="upload-file-info" type="text" class="form-control carga-archivo-filename" disabled="disabled">
																<span class="input-group-btn"> 
																	<!-- image-preview-input -->
																	<div class="btn btn-default carga-archivo-input"> 
																		<span class="glyphicon glyphicon-folder-open"></span>
																		<span class="carga-archivo-input-title">Seleccionar archivo</span>
																		<input type="file" name="archivo" onchange="$('#upload-file-info').val($(this).val().split(/(\\|\/)/g).pop());"/>
																		<!-- rename it -->
																	</div>
																 </span>
															</div>
														</div>
											
													</div>                   
												</div>  													                
											</div>
										</div>	
							
									</div>
										
									</div>
								</div>
							<!----->         
						</div>
					<!--
						<div id="step-2">							
							<!------><!--
								<div class="col-md-1"></div>
								<div class="col-md-10"><br><br>
									<div class="x_panel">
									  <div class="x_title">
										<h2>Vista previa</h2>                  
										<div class="clearfix"></div>
									  </div>
										<div class="table-responsive">
											<table name="datatable-buttons" id="datatable-buttons" class="table table-striped table-bordered ">
											<thead>
											<tr>
													<th>FECHA AGENDAMIENTO</th>
													<th>N° Póliza PRIMER MEDIO PAGO</th>
													<th>N° Póliza SEGUNDO MEDIO PAGO</th>
													<th>Fecha venta</th>
													<th>Nombre del Cliente</th>
													<th>RUT<th>
													<th>TELEFONOS</th>
													<th>e-mail</th>
													<th>DIRECCION</th>
													<th>COMUNA</th>
													<th>EMISOR 1</th>
													<th>EMISOR 2</th>
													<th>obs.</th>
													<th>CANTIDAD CREDENCIALES CRUZ VERDE </th>
													<th>gestión </th>
													<th>FECHA DE VISITA POR CLIENTE </th>
													<th>POLIZAS (muerte accidental - hospitalizacion)</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>01/06/2017</td>
													<td>1ADM138279766</td>
													<td>2ADM138279766</td>
													<td>980034289</td>
													<td>6MARIA RIVAS GONZALEZ</td>
													<td>SEGURO DE VIDA</td>
													<td>14</td>
													<td>0</td>		
													<td>4</td>
													<td>Operacion Workflow</td>
													<td>Inicio / Preparación</td>
													<td>980034289</td>
													<td>6MARIA RIVAS GONZALEZ</td>
													<td>SEGURO DE VIDA</td>
													<td>14</td>
													<td>0</td>	
													<td>14</td>
													<td>0</td>
												</tr>
												
											</tbody>
											</table>
										</div>
									</div>
								</div>
							<!-----><!--
							
						</div>-->
						<div id="step-2">						   
							
							<!------>
								<div class="col-md-1"></div>
								<div class="col-md-10"><br><br>
									<div class="x_panel">
									  <div class="x_title">
										<h2>Asignar actividad</h2>                  
										<div class="clearfix"></div>
									  </div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ACTIVIDADES / USUARIOS</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											<select id="usuario_accion" name="usuario_accion" class="select2_single form-control" tabindex="-1">
												@foreach($acciones_disponibles as $accion_disponible)
													<option value="{{ $accion_disponible->username }}-{{ $accion_disponible->cod_acc }}">{{ $accion_disponible->usr_act}}</option>
												@endforeach
											</select>
											</div>
										</div>											  
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">OBSERVACIONES </label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<textarea id="observaciones" required="required" class="form-control" name="observaciones"></textarea>
											</div>
										</div>
											
									</div>
								</div>
							<!----->
						</div>
                     
				
						</div>
                    <!-- End SmartWizard Content -->
					</form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		<!--
		<script type="text/javascript">
			$(document).ready(function(){
				function onFinishCallback(){
				$('#wizard').smartWizard('showMessage','Finish Clicked');
			} 
			});
		</script>
		-->
@stop
<!--6581128-->
<!--229392650-->
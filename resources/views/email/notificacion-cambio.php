@extends('layouts.app')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
			<div class="row" role="main">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="">
						<div class="row">
							<div class="col-md-4"><br>
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
									<li><p data-placement="top" data-toggle="tooltip" title="Regresar"><a href="/workflow/proceso" class="btn btn-default btn-xs" data-title="Ver"><span class="glyphicon glyphicon-arrow-left"></span></a></p>
									</li>
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="panel panel-default">
									</div>
									<div class="table-responsive">
										<table class="table table-bordered table-hover vmiddle">
												<thead>
													<tr>
														<div class=" panel-heading text-center">
														<th>Fecha</th>
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
														<td>{{$log->des_act}}</td>
														<td>{{$log->username}}</td>
														<td>{{$log->obs_log}}</td>
													</tr>
													@endforeach
												
												</tbody>
											</table>
									</div>
								</div>
							</div>
						</div>
						<!-- Smart Wizard -->
						<!------------->
						<div class="x_panel">
							<div class="x_title">
							<h2>Actividad Realizada</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
												<h2 class="title"> <a>Registro de terceros</a> </h2>
												<div class="form-group"></br>
													<div class="x_panel"></br>
														<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"><br>
															@foreach($campos as $key => $campo)
																@if($loop->index <=5)
																<div class="form-group">
																	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="campo{{ $loop->index }}">{{$campo->descripcion}}</label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		<input type="text" id="campo{{ $loop->index }}" name="campo{{ $loop->index }}" value="{{ $registros-> {'campo'.$loop->index } }}" class="form-control col-md-7 col-xs-12"/>
																	</div>
																</div>
																@else
																	@break
																@endif
															@endforeach
														</form>
													</div>
												</div>
											</div>
										</div>
									</li>
								@if($key < count($campos) - 1)
									<li>
										<div class="block">
											<div class="tags">
												<a href="" class="tag">
													<span>Paso 2</span>
												</a>
											</div>
											<div class="block_content">
												<h2 class="title"> <a>Registro de terceros</a> </h2>
												<div class="form-group"></br>
													<div class="x_panel"></br>
													<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"><br>
													@foreach($campos as $key => $campo)
														@if($loop->index > 5)
														<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12" for="campo{{ $loop->index }}">{{$campo->descripcion}}</label>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<input type="text" id="campo{{ $loop->index }}" name="campo{{ $loop->index }}" value="{{ $registros-> {'campo'.$loop->index } }}" class="form-control col-md-7 col-xs-12"/>
															</div>
														</div>
														@endif
													@endforeach
													</form>
													</div>
												</div>
											</div>
										</div>
									</li>
								@endif
									<li>
										<div class="block">
											<div class="tags">
												<a href="" class="tag">
													<span>Paso 3</span>
												</a>
											</div>
											<div class="block_content">
												<h2 class="title"> <a>Registrar servicios</a> </h2>
												<div class="form-group"><br>
													<div class="x_panel"><br>			 
														<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"><br>
															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_servicio">FECHA AGENDAMIENTO</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<input type="text" id="fecha_servicio" name="fecha_servicio" value="{{ date($registros->fec_rev)}}" class="form-control" data-date-format="dd-mm-yyyy"/> <!-- local -->
																	<!-- <input type="text" id="fecha_servicio" name="fecha_servicio" value="{{$registros->fec_rev}}" class="form-control" data-date-format="mm-dd-yyyy"/> --> <!-- server -->
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hora_servicio">HORA AGENDAMIENTO<span class="required"></span></label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<select id="hora_servicio" name="hora_servicio" class="select2_single form-control" tabindex="-1" autocomplete="off">
																		<option value="1"
																		@if($registros->num_rev == 1)
																			selected
																		@endif
																			>09:00 - 12:00</option>
																		<option value="2"
																		@if($registros->num_rev == 2)
																			selected
																		@endif
																		>
																		12:00 - 15:00</option>
																		<option value="3"
																		@if($registros->num_rev == 3)
																			selected
																		@endif
																		>
																		15:00 - 18:00</option>
																	</select>
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
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="panel panel-default">
									<div class="panel-heading text-center">
										<span><strong><span class="glyphicon glyphicon-folder-open"> </span> Archivos</strong></span>
									</div>
									<div class="table-responsive">
										<table class="table table-bordered table-hover vmiddle">
											<thead>
												<tr>
													<th>Consecutivo</th>	
													<th>Archivos</th>
													<th>Tipo Documento</th>
													<th>Acciones</th>
													
													
												</tr>
											</thead>
											<tbody>
												@foreach($documentos as $doc)
												<tr>
													
													<td>{{$doc->consecutivo}}</td>
													<td>{{$doc->archivo}}</td>
													<td>{{$doc->nom_tp_doc}}</td>
													<td class="text-center">
														<a href="/workflow/downloadfile/{{$doc->codigo}}/{{$doc->consecutivo}}"><span class="btn btn-sm btn-primary glyphicon glyphicon-file"></span></a>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
	
						<!-- Smart Wizard -->	
				</div>
											
							
				</div>
					
					<!------------------------------------------------------->
	
	
			</div>
		<br />
        </div>
        <!-- /page content -->
@stop
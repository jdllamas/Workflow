@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Curso</div>
                <div class="panel-body">
					<div class="row form-group">
						<label for="codigo" class="col-md-4 control-label">Nombre</label>
						<div class="col-md-6">
							<input id="nombre" type="text" class="form-control" name="nombre" value="{{ $curso->nombre }}" disabled="disabled" required>
						</div>
					</div>
					<div class="row form-group">
                        <label for="descripcion" class="col-md-4 control-label">Descripcion</label>
                        <div class="col-md-6">
                            <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ $curso->descripcion }}" disabled="disabled" required>
                        </div>
                    </div>
					<div class="row form-group">
                        <label for="anio" class="col-md-4 control-label">Año</label>
                        <div class="col-md-6">
                            <input id="anio" type="text" class="form-control" name="anio" value="{{ $curso->anio }}" disabled="disabled" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="periodo" class="col-md-4 control-label">Periodo</label>
                        <div class="col-md-6">
                            <input id="periodo" type="text" class="form-control" name="periodo" value="{{ $curso->periodo }}" disabled="disabled" required>
                        </div>
                    </div>
					<div class="row form-group">
                        <label for="fecha_inicio" class="col-md-4 control-label">Fecha Inicio</label>
                        <div class="col-md-6">
                            <input id="fecha_inicio" type="date" class="form-control" name="fecha_inicio" value="{{ $curso->fecha_inicio }}" disabled="disabled" required>
                        </div>
                    </div>
				</div>
				@if(!$profesores->isEmpty())
					<div class="panel-heading">Profesores Asociados</div>
					<div class="panel-body">
						<table class="table table-striped table-hover table-bordered" style="font-size:83%;overflow-x:scroll">
							<tr style="text-align:center">
								<th style="vertical-align:middle; text-align:center">
									Código
								</th>
								<th style="vertical-align:middle; text-align:center">
									Nombres
								</th>
								<th style="vertical-align:middle; text-align:center">
									Apellidos
								</th>
								<th style="vertical-align:middle; text-align:center">
									E-Mail
								</th>
							</tr>
							@foreach($profesores as $profesor)
								<tr style="text-align:center">
									<td style="vertical-align:middle; text-align:center">
										{{ $profesor->codigo }}
									</td>
									<td style="vertical-align:middle; text-align:center">
										{{ $profesor->nombre }}
									</td>
									<td style="vertical-align:middle; text-align:center">
										{{ $profesor->apellido }}
									</td>
									<td style="vertical-align:middle; text-align:center">
										{{ $profesor->email }}
									</td>
								</tr>
							@endforeach
						</table>
					</div>
				@endif
            </div>
        </div>
    </div>
</div>
@endsection

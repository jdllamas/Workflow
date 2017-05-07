@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Curso</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/curso/'.$curso->id) }}">
                        {{ csrf_field() }}
						<input name="_method" type="hidden" value="PUT">						
						<input id="id" name="id" type="hidden" value="{{ $curso->id }}">
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $curso->nombre }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" class="col-md-4 control-label">Descripción</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ $curso->descripcion }}" required autofocus>

                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('anio') ? ' has-error' : '' }}">
                            <label for="anio" class="col-md-4 control-label">Año</label>

                            <div class="col-md-6">
                                <input id="anio" type="text" class="form-control" name="anio" value="{{ $curso->anio }}" required autofocus>

                                @if ($errors->has('anio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('anio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('periodo') ? ' has-error' : '' }}">
                            <label for="periodo" class="col-md-4 control-label">Periodo</label>

                            <div class="col-md-6">
                                <input id="periodo" type="text" class="form-control" name="periodo" value="{{ $curso->periodo }}" required autofocus>

                                @if ($errors->has('periodo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('periodo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">
                            <label for="fecha_inicio" class="col-md-4 control-label">Fecha Inicio</label>

                            <div class="col-md-6">
                                <input id="fecha_inicio" type="date" class="form-control" name="fecha_inicio" value="{{ $curso->fecha_inicio }}" required>

                                @if ($errors->has('fecha_inicio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_inicio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group">
                            <label for="profesores" class="col-md-4 control-label">Profesores</label>
                            <div class="col-md-6">
                                @if(!$profesoresGeneral->isEmpty())
									<select multiple="multiple" name="profesores[]" id="profesores" class="form-control">
										@foreach($profesoresGeneral as $profesor)
										<option value="{{$profesor->id}}" @if(in_array($profesor->id,$profesores))selected="selected"@endif>{{$profesor->nombre}} {{$profesor->apellido}}</option>
										@endforeach
									</select>
								@endif
                            </div>
                        </div>
						
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

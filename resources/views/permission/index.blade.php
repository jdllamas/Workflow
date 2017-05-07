@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading">
					Listado de Cursos
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover table-bordered" style="font-size:83%;overflow-x:scroll">
							<tr style="text-align:center">
								<th style="vertical-align:middle; text-align:center">
									Nombre
								</th>
								<th style="vertical-align:middle; text-align:center">
									Descripcion
								</th>
								<th style="vertical-align:middle; text-align:center">
									Anio
								</th>
								<th style="vertical-align:middle; text-align:center">
									Periodo
								</th>        
								<th style="vertical-align:middle; text-align:center">
									Fecha Inicio
								</th>
								<th style="vertical-align:middle; text-align:center">
									Detalles
								</th>
							</tr>
							@foreach($cursos as $curso)
								<tr style="text-align:center">
									<td style="vertical-align:middle; text-align:center">
										{{ $curso->nombre }}
									</td>
									<td style="vertical-align:middle; text-align:center">
										{{ $curso->descripcion }}
									</td>
									<td style="vertical-align:middle; text-align:center">
										{{ $curso->anio }}
									</td>
									<td style="vertical-align:middle; text-align:center">
										{{ $curso->periodo }}
									</td>        
									<td style="vertical-align:middle; text-align:center">
										{{ $curso->fecha_inicio }}
									</td>
									<td style="vertical-align:middle; text-align:center">
										<a href="{{ url('/curso/'.$curso->id) }}">Ver</a>
										<br/>
										<a href="{{ url('/curso/'.$curso->id.'/edit') }}">Editar</a>
									</td>
								</tr>
							@endforeach
						</table>
				</div>
			</div>
        </div>
    </div>
</div>
@stop
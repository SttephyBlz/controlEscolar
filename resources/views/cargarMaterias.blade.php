@extends('master')

@section('contenido')
<h2>Nombre: {{$alumno->nombre}}</h2>
<hr>
<form action="{{url('/cargarGrupo')}}/{{$alumno->id}}" method="POST">
<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<label>Selecciona la materia:</label>
		<select name="grupo_id" class="form-control">
			<option value="0">Selecciona la materia</option>
			@foreach($lista as $m)
				<option value="{{$m->id}}">{{$m->nombre}} {{$m->clave}} {{$m->hora}}</option>
			@endforeach
		</select>
	</div>
	<button class="btn btn-primary">Cargar</button>
</form>
<h2>Materias Cargadas</h2>
<hr>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Nombre</th>
					<th>Grupo</th>
					<th>Aula</th>
					<th>Horario</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($materias as $mt)
				<tr>
					<td>{{$mt->mc}}</td>
					<td>{{$mt->nombre}}</td>
					<td>{{$mt->clave}}</td>
					<td>{{$mt->aula}}</td>
					<td>{{$mt->hora}}</td>
					<td>
						<a href="{{url('/bajaGrupo')}}/{{$alumno->id}}/{{$mt->id}}" class="btn btn-xs btn-danger">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop














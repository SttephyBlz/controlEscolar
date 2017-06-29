@extends('master')

@section('contenido')
<h2>Grupo: {{$datos->clave}} Materia: {{$datos->nombre}}</h2>
<hr>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
		<form action="{{url('/guardarCalificaciones')}}/{{$datos->id}}" method="POST">
		<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
		<table class="table table-bordered">
		<thead>
			<tr>
				<th>Alumno</th>
				<th>Calificación</th>
			</tr>
		</thead>
		<tbody>
			@foreach($alumnosGrupo as $ag)
				<tr>
					<td>{{$ag->nombre}}</td>
					<td>
						<input class="form-control" type="number" name="calificaciones[{{$ag->id}}]" required value="{{$ag->calificacion}}">
					</td>
				</tr>
			@endforeach
		</tbody>
		</table>
		<div class="text-center">
			<button type="submit" class="btn btn-primary">Guardar</button>
		</div>
		</form>
		</div>
	</div>
</div>
@stop






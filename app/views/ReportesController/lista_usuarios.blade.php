@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop
@section('content')
		<table class="table table-condensed">

			<thead>
				<tr>
					<th>Nombre de Usuario</th>
					<th>Usuario</th>
					<th>Email</th>
					<th>Nivel de Usuario</th>
				</tr>
			</thead>
			<tbody>
				@foreach($usuarios as $user)
					<tr>
						<td>{{$user->nombre_usuario}}</td>
						<td>{{$user->usuario}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->nivel_acceso}}</td>
					</tr>
				@endforeach

			</tbody>
		</table>



@stop


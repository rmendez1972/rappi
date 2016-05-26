@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop
@section('content')


		<table class="table table-condensed">


			<thead>
				<tr>
					<th>RFC</th>
					<th>Nombre/Razón social</th>
					<th>Tipo de persona</th>
					<th>CP</th>
					<th>Teléfono</th>
					<th>Celular</th>
					<th>E-mail</th>
				</tr>
			</thead>
			<tbody>
				@foreach($asesores as $asesor)
					<tr>
						<td>{{$asesor['rfc']}}</td>
						<td>{{$asesor['nombre_razon']}}</td>
						<td>{{$asesor->tipoPersona()->first()->descripcion_tipo_persona}}</td>
						<td>{{$asesor['codigo_postal']}}</td>
						<td>{{$asesor['telefono']}}</td>
						<td>{{$asesor['celular']}}</td>
						<td>{{$asesor['email']}}</td>
					</tr>
				@endforeach

			</tbody>
		</table>
@stop
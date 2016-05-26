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
					<th>Municipio</th>
					<th>CP</th>
					<th>Teléfono</th>
					<th>Celular</th>
					<th>E-mail</th>
				</tr>
			</thead>
			<tbody>
				@foreach($asesores as $ases)
					<tr>
						<td>{{$ases->rfc}}</td>
						<td>{{$ases->nombre_razon." ".$ases->apellido_paterno." ".$ases->apellido_materno}}</td>
						<td>{{$ases->tipoPersona()->first()->descripcion_tipo_persona}}</td>
						<td>{{$ases->municipio()->first()->nombre_municipio}}</td>
						<td>{{$ases->codigo_postal}}</td>
						<td>{{$ases->telefono}}</td>
						<td>{{$ases->celular}}</td>
						<td>{{$ases->email}}</td>
					</tr>
				@endforeach

			</tbody>
		</table>
@stop
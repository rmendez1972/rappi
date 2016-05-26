@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop
@section('content')


		<table class="table table-condensed">

			<thead>
				<tr>
					<th>Descripción de Tipo de Persona</th>


				</tr>
			</thead>
			<tbody>
				@foreach($tipopersona as $tipo)
					<tr>
						<td>{{$tipo->descripcion_tipo_persona}}</td>


					</tr>
				@endforeach

			</tbody>
		</table>

@stop
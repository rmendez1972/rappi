@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop
@section('content')


		<table class="table table-condensed">

			<thead>
				<tr>
					<th>Descripción del Curso</th>
					<th>Año de impartición</th>
				</tr>
			</thead>
			<tbody>
				@foreach($curso as $c)
					<tr>
						<td>{{$c->descripcion}}</td>
						<td>{{$c->año}}</td>


					</tr>
				@endforeach

			</tbody>
		</table>


@stop

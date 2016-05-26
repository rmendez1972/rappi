@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop
@section('content')


		<table class="table table-condensed">

			<thead>
				<tr>
					<th>Descripción del Requisito</th>


				</tr>
			</thead>
			<tbody>
				@foreach($requisitos as $requisito)
					<tr>
						<td>{{$requisito->descripcion}}</td>


					</tr>
				@endforeach

			</tbody>
		</table>

@stop
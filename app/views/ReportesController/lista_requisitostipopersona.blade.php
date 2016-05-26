@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop
@section('content')


		<table class="table table-condensed">

			<thead>
				<tr>
					<th>Requisito</th>


				</tr>
			</thead>
			<tbody>

				@foreach($tipopersona->requisitos as $requisito)
					<tr>
						<td>{{++$contador.'.-'}}{{$requisito->descripcion}}</td>


					</tr>
				@endforeach

			</tbody>
		</table>

@stop
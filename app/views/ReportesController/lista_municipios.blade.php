@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop

@section('content')


		<table class="table table-condensed">
			<!--<caption class="tituloreporte">{{$titulo_reporte}}</caption>-->
			<thead>
				<tr>
					<th>Clave Municipio</th>
					<th>Nombre Municipio</th>

				</tr>
			</thead>
			<tbody>
				@foreach($municipios as $mun)
					<tr>
						<td>{{$mun->cve_municipio}}</td>
						<td>{{$mun->nombre_municipio}}</td>

					</tr>
				@endforeach

			</tbody>
		</table>

@stop
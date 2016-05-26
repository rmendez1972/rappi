@extends('layouts.bootstrap')

@section('content')
	<div style="margin-top:20px;color:black">
		<div>
			{{ HTML::link('/municipios/nuevo','',array('class' =>'hi-perfil glyphicon-file','title'=>'Nuevo',)) }}
			{{ HTML::link('/reportes/municipios','',array('class' =>'hi-perfil glyphicon-print','title'=>'Imprimir','target'=>'_blank')) }}
			{{Session::get("mensage")}}
		</div>
		<div style="float:right">
			{{Form::open(array

				(
					'action'=>'MunicipiosController@mostrarMunicipios',
					'method'=>'GET',
					'role'=>'form',
					'class'=>'form-inline'
					/*'files'=>'true'*/
				))

			}}
				{{Form::input('text','buscar',Input::get('buscar'), array('class'=>'form-control'))}}
				{{Form::input('submit',null,'Buscar', array('class'=>'btn btn-primary'))}}
			{{Form::close()}}


		</div>
	</div>

	<hr></hr>
	<div class="panel panel-default" style="width:50%">
		<div class="panel-heading">{{$titulo_reporte}}</div>
		<div class="panel-body">
			<table class="table">
				<thead>
					<th>Clave</th>
					<th>Nombre</th>
					<th>Acciones</th>
				</thead>
				<tbody>
					@foreach($municipios as $mun)
						<tr>
							<td>{{ $mun->cve_municipio }}</td>
							<td>{{ $mun->nombre_municipio }}</td>
							<td>
								{{ HTML::link('/municipios/editar/'.$mun->cve_municipio,   '',array('class' =>'hi-perfil glyphicon-pencil width:10px')) }}
								{{ HTML::link('/municipios/eliminar/'.$mun->cve_municipio, '',array('class' =>'hi-perfil  glyphicon-trash width:10px')) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div>
				{{$municipios->appends(array("buscar"=>Input::get("buscar")))->links()}}


			</div>
		</div>
	</div>

@stop
@extends('layouts.bootstrap')

@section('content')
	<div style="margin-top:20px;color:black">
		<div>
			{{ HTML::link('/asesores/nuevocurso/'.$asesor['id'],'',array('class' =>'hi-perfil glyphicon-file','title'=>'Nuevo')) }}
			{{ HTML::link('/reportes/cursos_asesor/'.$asesor['id'],'',array('class' =>'hi-perfil glyphicon-print','title'=>'Imprimir','target'=>'_blank')) }}

		</div>
		{{Session::get("mensage")}}
		<div style="float:right">
			{{Form::open(array

				(
					'url'=>'/asesores/listarcursos/'.$asesor['id'],
					'method'=>'Post',
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
	<hr>

	<div class="panel panel-default" style="margin-top:20px">
	<div class="panel-heading">Cursos de Capacitación para el Asesor: {{$asesor['nombre_razon'].''.$asesor['apellido_paterno'].' '.$asesor['apellido_materno']}} </div>
	<div class="panel-body">

	<table class="table">
		<thead>
			<th>Curso</th>
			<th>Año</th>
			<th>Acciones</th>
		</thead>
		<tbody>
			@foreach($cursos as $cur)
				<tr>
					<td>{{ $cur->descripcion}}</td>
					<td>{{ $cur->año}}</td>
					<td>
						{{ HTML::link('/asesores/eliminarcurso/'.$cur->id_curso.'/'.$asesor['id'], '',array('class' =>'hi-perfil  glyphicon-trash width:10px','title'=>'eliminar')) }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div>
		{{$cursos->appends(array("buscar"=>Input::get("buscar")))->links()}}


	</div>
	<div>

	</div>


@stop
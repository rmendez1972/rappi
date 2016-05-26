@extends('layouts.bootstrap')

@section('content')
	<div style="margin-top:20px;color:black">
		<div>
			{{ HTML::link('/cursos/nuevo','',array('class' =>'hi-perfil glyphicon-file','title'=>'Nuevo')) }}
			{{ HTML::link('/reportes/cursos','',array('class' =>'hi-perfil glyphicon-print','title'=>'Imprimir','target'=>'_blank')) }}
			{{Session::get("mensage")}}
		</div>
		<div style="float:right">
			{{Form::open(array

		(
			'action'=>'CursoController@mostrarCurso',
			'method'=>'GET',
			'role'=>'form',
			'class'=>'form-inline'
			/*'files'=>'true'*/
		))

			}}
			{{Form::input('text','buscar',Input::get('buscar'), array('class'=>'form-control'))}}
			{{Form::input('submit',null,'Buscar', array('class'=>'btn btn-primary'))}}
			{{Form::close()}}
			<hr>
		</div>
	</div>
	<hr>

	<div class="panel panel-default" style="width:70%">
		<div class="panel-heading">{{$titulo_reporte}} </div>
		<div class="panel-body">
			<table class="table">
				<thead>
					<th>Descripción del Curso</th>
					<th>Año</th>
					<th>Acciones</th>
				</thead>
				<tbody>
					@foreach($curso as $c)
						<tr>
							<td>{{ $c->descripcion }}</td>
							<td>{{ $c->año }}</td>
							<td>
								{{ HTML::link('/cursos/editar/'.$c->id_curso, '',array('class' =>'hi-perfil glyphicon-pencil width:10px','title'=>'editar')) }}
								{{ HTML::link('/cursos/eliminar/'.$c->id_curso, '',array('class' =>'hi-perfil  glyphicon-trash width:10px','title'=>'eliminar')) }}

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div>
				{{$curso->appends(array("buscar"=>Input::get("buscar")))->links()}}


			</div>

		</div>
	</div>


@stop
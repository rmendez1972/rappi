@extends('layouts.bootstrap')

@section('content')
	<div style="margin-top:20px;color:black">
		<div>
			{{ HTML::link('/tipo_persona/nuevorequisito/'.$tipopersona['id_tipo_persona'],'',array('class' =>'hi-perfil glyphicon-file','title'=>'Nuevo')) }}
			{{ HTML::link('/reportes/requisitos_tipopersona/'.$tipopersona['id_tipo_persona'],'',array('class' =>'hi-perfil glyphicon-print','title'=>'Imprimir','target'=>'_blank')) }}

		</div>
		{{Session::get("mensage")}}
		<div style="float:right">
			{{Form::open(array

		(
			'url'=>'/tipo_persona/listarrequisitos/'.$tipopersona['id_tipo_persona'],
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
	<div class="panel-heading">Requisitos para el tipo de Razón Social: {{$tipopersona['descripcion_tipo_persona']}} </div>
	<div class="panel-body">

	<table class="table">
		<thead>
			<th>Requisito</th>
			<th>Acciones</th>
		</thead>
		<tbody>
			@foreach($requisitos as $requisito)
				<tr>
					<td>{{ $requisito->descripcion}}</td>
					<td>
						{{ HTML::link('/tipo_persona/eliminarrequisito/'.$requisito->id_requisito.'/'.$tipopersona['id_tipo_persona'], '',array('class' =>'hi-perfil  glyphicon-trash width:10px','title'=>'eliminar')) }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div>
		{{$requisitos->appends(array("buscar"=>Input::get("buscar")))->links()}}


	</div>
	<div>

	</div>


@stop
@extends('layouts.bootstrap')

@section('content')
	<div style="margin-top:20px;color:black">
		<div>
			{{ HTML::link('/tipo_persona/nuevo','',array('class' =>'hi-perfil glyphicon-file','title'=>'Nuevo')) }}
			{{ HTML::link('/reportes/tipopersona','',array('class' =>'hi-perfil glyphicon-print','title'=>'Imprimir','target'=>'_blank')) }}
			{{Session::get("mensage")}}
		</div>
		<div style="float:right">
			{{Form::open(array

		(
			'action'=>'TipopersonaController@mostrarTipopersona',
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
					<th>Descripción tipo persona</th>
					<th>Acciones</th>
				</thead>
				<tbody>
					@foreach($tipo_persona as $tipo)
						<tr>
							<td>{{ $tipo->descripcion_tipo_persona }}</td>
							<td>
								{{ HTML::link('/tipo_persona/editar/'.$tipo->id_tipo_persona, '',array('class' =>'hi-perfil glyphicon-pencil width:10px','title'=>'editar')) }}
								{{ HTML::link('/tipo_persona/eliminar/'.$tipo->id_tipo_persona, '',array('class' =>'hi-perfil  glyphicon-trash width:10px','title'=>'eliminar')) }}
								{{ HTML::link('/tipo_persona/listarrequisitos/'.$tipo->id_tipo_persona, '',array('class' =>'hi-perfil glyphicon-th-list width:10px','title'=>'listar requisitos para este tipo de persona')) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div>
				{{$tipo_persona->appends(array("buscar"=>Input::get("buscar")))->links()}}


			</div>

		</div>
	</div>


@stop
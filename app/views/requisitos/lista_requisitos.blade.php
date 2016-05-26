@extends('layouts.bootstrap')

@section('content')
	<div style="margin-top:20px;color:black">
		<div>
			{{ HTML::link('/requisitos/nuevo','',array('class' =>'hi-perfil glyphicon-file','title'=>'Nuevo',)) }}
			{{ HTML::link('/reportes/requisitos','',array('class' =>'hi-perfil glyphicon-print','title'=>'Imprimir','target'=>'_blank')) }}
			{{Session::get("mensage")}}
		</div>
		<div style="float:right">
			{{Form::open(array

				(
					'action'=>'RequisitosController@mostrarRequisitos',
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
	<br>
	<hr>

	<div class="panel panel-default" style="margin-top:20px;width:80%">
		<div class="panel-heading">Requisitos para el matriculado de asesores inmobiliarios</div>
		<div class="panel-body">
			<table class="table">
				<thead>
					<th>Descripción del Requisito</th>

				</thead>
				<tbody>
					@foreach($requisitos as $req)
						<tr>
							<td width="80%">{{ $req->descripcion }}</td>
							<td width="20%">
								{{ HTML::link('/requisitos/editar/'.$req->id_requisito,   '',array('class' =>'hi-perfil glyphicon-pencil width:10px','title'=>'editar')) }}
								{{ HTML::link('/requisitos/eliminar/'.$req->id_requisito, '',array('class' =>'hi-perfil  glyphicon-trash width:10px','title'=>'eliminar')) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div>
				{{$requisitos->appends(array("buscar"=>Input::get("buscar")))->links()}}


			</div>
		</div>
	</div>

@stop
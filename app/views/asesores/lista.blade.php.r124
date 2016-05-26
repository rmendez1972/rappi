@extends('layouts.bootstrap')

@section('content')

	<div style="margin-top:20px;color:black">
			{{ HTML::link('/asesores/nuevo', '',array('class' =>'hi-perfil glyphicon-file','title'=>'Nuevo')) }}
			{{ HTML::link('/reportes/asesores', '',array('class' =>'hi-perfil glyphicon-print','title'=>'Imprimir','target' => '_blank')) }}
			{{Session::get("mensage")}}
		<div style="float:right">
			{{Form::open(array

					(
						'action'=>'AsesoresController@mostrarAsesores',
						'method'=>'GET',
						'role'=>'form',
						'class'=>'form-inline'
						/*'files'=>'true'*/
				))}}
				{{Form::input('text','buscar',Input::get('buscar'), array('class'=>'form-control'))}}
				{{Form::input('submit',null,'Buscar', array('class'=>'btn btn-primary'))}}
			{{Form::close()}}

		</div>
	</div>
	<hr>
	<div class="panel panel-default" style="margin-top:20px">
		<div class="panel-heading">Asesores Inmobiliarios</div>
		<div class="panel-body">
			<table class="table">
				<thead>
					<th width=15%>Nombre/Razón social</th>
					<th width=5%>RFC</th>
					<th width=5%>Tipo de persona</th>
					<th width=5%>Municipio</th>
					<th width=5%>Colonia/región</th>
					<th width=5%>C.P.</th>
					<th width=5%>Tel.</th>
					<th width=55%>Acciones</th>
				</thead>
				<tbody>
					@foreach($asesores as $asesor)
						<tr>
							<td width=15%>{{ $asesor->nombre_razon." ".$asesor->apellido_paterno." ".$asesor->apellido_materno }}</td>
							<td width=5%>{{ $asesor->rfc }}</td>
							<td width=5%>{{ $asesor->tipoPersona()->first()->descripcion_tipo_persona }}</td>
							<td width=5%>{{ $asesor->municipio()->first()->nombre_municipio }}</td>
							<td width=5%>{{ $asesor->colonia_region }}</td>
							<td width=5%>{{ $asesor->codigo_postal }}</td>
							<td width=5%>{{ $asesor->telefono." ".$asesor->celular }}</td>
							<td width=55%>
								{{ HTML::link('/asesores/editar/'.$asesor->id, '', array('class' =>'hi-perfil glyphicon-pencil','title'=>'editar asesor')) }}
								{{ HTML::link('/asesores/eliminar/'.$asesor->id, '',array('class' =>'hi-perfil  glyphicon-trash','title'=>'eliminar asesor')) }}
								{{ HTML::link('/reportes/requisitos_asesor/'.$asesor->id,'',array('class' =>'hi-perfil glyphicon-th-list','title'=>'Acuse de Recibo de Requisitos entregados','target'=>'_blank')) }}
								{{ HTML::link('/asesores/listarcursos/'.$asesor->id, '',array('class' =>'hi-perfil  glyphicon-book','title'=>'listado de cursos')) }}
								{{ HTML::link('/reportes/matricula_asesor/'.$asesor->id, '',array('class' =>'hi-perfil  glyphicon-barcode','title'=>'Imprimir matrícula con firma Secretario','target' => '_self')) }}
								{{ HTML::link('/reportes/matricula_asesor_subsecretaria/'.$asesor->id, '',array('class' =>'hi-perfil  glyphicon-export','title'=>'Imprimir matrícula con firma de Subsecretaria','target' => '_self')) }}
								{{ HTML::link('/reportes/credencial_asesor/'.$asesor->id, '',array('class' =>'hi-perfil  glyphicon-user','title'=>'Imprimir credencial','target' => '_self')) }}
								{{ HTML::link('/reportes/acuserecibo_asesor/'.$asesor->id, '',array('class' =>'hi-perfil  glyphicon-list-alt','title'=>'Acuse de recibo de Documentos entregados','target' => '_blank')) }}
							</td>
							<td></td>
						</tr>
					@endforeach
				</tbody>

			</table>
			<div>
				{{$asesores->appends(array("buscar"=>Input::get("buscar")))->links()}}

			</div>
		</div>
	</div>
@stop
@extends('layouts.bootstrap')

@section('content')


	<div style="margin-top:20px;color:black">
		<div>
			{{ HTML::link('/usuarios/nuevo','',array('class' =>'hi-perfil glyphicon-file','title'=>'Nuevo')) }}
			{{ HTML::link('/reportes/usuarios','',array('class' =>'hi-perfil glyphicon-print','title'=>'Imprimir','target'=>'_blank')) }}
			{{Session::get("mensage")}}
		</div>
		<div style="float:right">
			{{Form::open(array

		(
			'action'=>'HomeController@mostrarUsuarios',
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
	<hr>


	<div class="panel panel-default" style="width:70%">

		<div class="panel-heading">Usuarios de Sistema </div>
		<div class="panel-body">
			<table class="table">
				<thead>
					<th>Nombre de Usuario</th>
					<th>Usuario</th>
					<th>Email</th>
					<th>Nivel de Usuario</th>
					<th>Acciones</th>
				</thead>
				<tbody>
					@foreach($usuarios as $usuario)
						<tr>
							<td>{{ $usuario->nombre_usuario }}</td>
							<td>{{ $usuario->usuario }}</td>
							<td>{{ $usuario->email }}</td>
							<td>{{ $usuario->nivel_acceso }}</td>
							<td>
								{{ HTML::link('/usuarios/editar/'.$usuario->id,   '',array('class' =>'hi-perfil glyphicon-pencil width:10px')) }}
								{{ HTML::link('/usuarios/eliminar/'.$usuario->id, '',array('class' =>'hi-perfil  glyphicon-trash width:10px')) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
	<br>
	<div>
		{{$usuarios->appends(array("buscar"=>Input::get("buscar")))->links()}}

	</div>
	</<div>
	</<div>

@stop
@extends('layouts.bootstrap')

@section('content')
<div class="panel panel-default" style="width:65%">
	<div class="panel-heading">Edición de Usuarios de Sistema</div>
	<div class="panel-body" style="width:90%; margin: 0 auto 0 auto">


		{{ Form::open(array('url' => '/usuarios/editar',
	            "enctype" => "multipart/form-data", 'role'=>'form')) }}

		<div class="form-group" style="float:left">
			{{ Form::label('nombre_usuario', 'Nombre:') }}
			{{ Form::text('nombre_usuario', $usuario->nombre_usuario, array('required' => 'required','class' => 'form-control')) }}
			<div class="bg-danger">{{$errors->first('nombre_usuario')}}</div>
			
		</div>

		<div class="form-group" style="float:left">
			{{ Form::label('usuario', 'Usuario:') }}
			{{ Form::text('usuario', $usuario->usuario, array('required' => 'required', 'class' => 'form-control')) }}
	        <div class="bg-danger">{{$errors->first('usuario')}}</div>
	    </div>

		<div class="form-group" style="float:left">
			{{ Form::label('email', 'Email:') }}
			{{ Form::email('email', $usuario->email, array('required' => 'required', 'class' => 'form-control')) }}
	        <div class="bg-danger">{{$errors->first('email')}}</div>
	    </div>

	    <div class="form-group" style="float:left">
			{{ Form::label('password', 'Password:') }}
			{{ Form::input('password','password', $usuario->password, array('required' => 'required', 'class' => 'form-control')) }}
	        <div class="bg-danger">{{$errors->first('password')}}</div>
	    </div>

	    <div class="form-group" style="float:left">
			{{ Form::label('repetir_password', 'Repetir Password:') }}
			{{ Form::input('password','repetir_password', $usuario->password, array('required' => 'required', 'class' => 'form-control')) }}
	        <div class="bg-danger">{{$errors->first('repetir_password')}}</div>
	    </div>

	    <div class="form-group" style="float:left">
			{{ Form::label('nivel_acceso', 'Nivel de acceso:') }}
			{{ Form::text('nivel_acceso', $usuario->nivel_acceso, array('required' => 'required', 'class' => 'form-control')) }}
	        <div class="bg-danger">{{$errors->first('nivel_acceso')}}</div>
	    </div>

		
	    <div class="form-group" style="float:left">
	    	
	    	<p>Avatar actual:</p><div style="float:left">
	    	<img src="{{URL::to('/').'/'. $usuario->src }}" alt="Avatar" width="150" hight="150">
			</div>
			<div style="float:left;width:150px;">
				<hr>
				<small>Si incluyes un nuevo avatar, <br>este reemplará al anterior!</small>
				<hr>
			</div>
			<div style="float:left">
			{{Form::label("Nuevo avatar:")}}
	        {{Form::input('file','src')}}
	        <div class="bg-danger">{{$errors->first('src')}}</div>
			</div>

	    </div>

	    <div style="clear:left">
			{{Form::input("hidden", "_token", csrf_token())}}
			{{Form::input("hidden", "id", $usuario->id)}}
	        {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
	        <a href="{{ URL::to('/usuarios') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
		{{ Form::close() }}
		</divS
	</div>
	
</div>
@stop
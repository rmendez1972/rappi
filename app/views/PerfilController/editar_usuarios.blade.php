@extends('layouts.bootstrap')

@section('content')
	{{Session::get("mensage")}}
	<div class="panel panel-default" style="width:60%">
		<div class="panel-heading">Edición de Perfil de Usuario</div>
		<div class="panel-body">

			{{ Form::open(array('url' => '/perfil/editar', "method"=>"post",
		            "enctype" => "multipart/form-data", 'role'=>'form')) }}

			<div class="form-group">
				{{ Form::label('email', 'Email:') }}
				{{ Form::email('email', $usuario->email, array('required' => 'required', 'class' => 'form-control')) }}
		        <div class="bg-danger">{{$errors->first('email')}}</div>
		    </div>

		    <div class="form-group">
				{{ Form::label('password', 'Password:') }}
				{{ Form::input('password','password', '', array('required' => 'required', 'class' => 'form-control')) }}
		        <div class="bg-danger">{{$errors->first('password')}}</div>
		    </div>

		    <div class="form-group">
				{{ Form::label('repetir_password', 'Repetir Password:') }}
				{{ Form::input('password','repetir_password', '', array('required' => 'required', 'class' => 'form-control')) }}
		        <div class="bg-danger">{{$errors->first('repetir_password')}}</div>
		    </div>
		     
			
			<div style="float:left">
				<span style="font-weight: bold">Avatar actual:</span><br>
				<img src="{{URL::to('/').'/'. $usuario->src }}" alt="Avatar" width="100" hight="100"			style="float:left;border-radius:50%;border:solid red">
				<div style="float:right" class="label label-info">
					<hr>
					<h4><label style="color:black;font-size:12px">Si incluyes un nuevo avatar, <br>este reemplazará al anterior!<br> Procura que tu imagen sea cuadrada </br></label></h4>
					<hr>
				</div>
				<div class="form-group" style="float:left">
				{{Form::label("Nuevo avatar:")}}
		        {{Form::input('file','src')}}
		        	<div class="bg-danger">{{$errors->first('src')}}</div>
		    	</div>
			    {{Form::input("hidden", "_token", csrf_token())}}
				{{Form::input("hidden", "id", $usuario->id)}}
			    {{ Form::submit('Modificar', array('class' => 'btn btn-primary')) }}
			    <a href="{{ URL::to('/') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
				{{ Form::close() }}
			</div>
    
		</div>
		
	</div>
@stop
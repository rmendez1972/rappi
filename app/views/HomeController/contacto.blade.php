@extends('layouts.bootstrap')

@section('head')
<title>Pagina de Contacto</title>
<meta name="description" content="pagina de contacto">
<meta name="keywords" content="palabras, clave, contacto">
@stop

@section('content')
	<h1>Contacto</h1>

	<div id="mensaje" class="bg-info">{{$message}}</div>
	
	{{Form::open(array
		(
			'action'=>'HomeController@contacto',
			'method'=>'POST',
			'role'=>'form',
		))

	}}
	
	
	<div class"form-group">
		{{Form::label('Nombre:')}}
		{{Form::input('text','name',Input::old('name'), array('class'=>'form-control'))}}
		<div class="bg-danger">{{$errors->first('name')}}</div>
	</div>
	<div class"form-group">
		{{Form::label('Email:')}}
		{{Form::input('email','email',Input::old('email'), array('class'=>'form-control'))}}
		<div class="bg-danger">{{$errors->first('email')}}</div>
	</div>
	<div class"form-group">
		{{Form::label('Asunto:')}}
		{{Form::input('text','subject',Input::old('subject'), array('class'=>'form-control'))}}
		<div class="bg-danger">{{$errors->first('subject')}}</div>
	</div>
	<div class"form-group">
		{{Form::label('Mensaje:')}}
		{{Form::textarea('msg',Input::old('msg'), array('class'=>'form-control'))}}
		<div class="bg-danger">{{$errors->first('msg')}}</div>
	</div>
		{{Form::input('hidden','contacto')}}
		{{Form::input('submit','','Enviar', array('class'=>'btn btn-primary'))}}

{{Form::close()}}
@stop


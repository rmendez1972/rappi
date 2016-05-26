@extends('layouts.bootstrap')

@section('head')
<title>Registro de Usuarios</title>
<meta name='description' content='Registro'>
<meta name='keywords' content='palabras, clave'>
<meta name='robots' content='noindex,nofollow'>
@stop

@section('content')

<!--<h1>Registro de usuarios</h1>-->


<div id="mensaje" class="bg-info"><h3>{{$mensage}}</h3></div>
<div class="panel panel-default" style="width:65%">
    <div class="panel-heading">Registro de Usuarios</div>
    <div class="panel-body" style="width:80%">

    {{Form::open(array(
                "method" => "POST",
                "url" => "/usuarios/nuevo",
                "enctype" => "multipart/form-data",
                "role" => "form",
                ))}}
     
                <div class="form-group" style="float:left">
                    {{Form::label("Nombre:")}}
                    {{Form::input("text", "nombre_usuario", null, array("class" => "form-control"))}}
                    <div class="bg-danger">{{$errors->first('nombre_usuario')}}</div>
                </div>

                <div class="form-group"style="float:left">
                    {{Form::label("Usuario:")}}
                    {{Form::input("text", "usuario", null, array("class" => "form-control"))}}
                    <div class="bg-danger">{{$errors->first('user')}}</div>
                </div>           
                
                <div class="form-group"style="float:left">
                    {{Form::label("Email:")}}
                    {{Form::input("email", "email", null, array("class" => "form-control"))}}
                    <div class="bg-danger">{{$errors->first('email')}}</div>
                </div> 
                
                <div class="form-group"style="float:left">
                    {{Form::label("Password:")}}
                    {{Form::input("password", "password", null, array("class" => "form-control"))}}
                    <div class="bg-danger">{{$errors->first('password')}}</div>
                </div>
                
                <div class="form-group"style="float:left">
                    {{Form::label("Repetir password:")}}
                    {{Form::input("password", "repetir_password", null, array("class" => "form-control"))}}
                    <div class="bg-danger">{{$errors->first('repetir_password')}}</div>
                </div>

                <div class="form-group"style="float:left">
                    {{Form::label("Nivel de acceso:")}}
                    {{Form::input("text", "nivel_acceso", "1", array("class" => "form-control"))}}
                    <div class="bg-danger">{{$errors->first('nivel_acceso')}}</div>
                </div>

                <div class="form-group"style="float:left">
                    {{Form::label("Avatar:")}}
                    {{Form::input("file", "src")}}
                    <div class="bg-danger">{{$errors->first('src')}}</div>
                </div>
                
                <div class="form-group"style="float:left">
                    {{Form::label("Aceptar los términos:")}}
                    {{Form::input("checkbox", "terminos", "On")}}
                    <div class="bg-danger">{{$errors->first('terminos')}}</div>
                </div>
                
                <div class="form-group"style="float:left">
                    {{Form::input("hidden", "_token", csrf_token())}}
                    {{Form::input("submit", null, "Registrarme", array("class" => "btn btn-primary"))}}
                    <a href="{{ URL::to('/usuarios') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
                </div>
                
    {{Form::close()}}
    </<div>

    </<div>
@stop
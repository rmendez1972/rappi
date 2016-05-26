@extends('layouts.bootstrap')

@section('head')
<title>Login</title>
<meta name='title' content='Login'>
<meta name='description' content='Login'>
<meta name='keywords' content='palabras, clave'>
<meta name='robots' content='noindex,nofollow'>
@stop

@section('perfil')
    <div class="hi-icon hi-icon-locked" ></div>

@stop

@section('content')
{{Session::get("message")}}
<div class="panel panel-default" style="width:50%">
<div class="panel-heading" style="border-bottom:1px solid red"><h4>Inicio de Sesión</h4></div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/login/nuevo",
            "role" => "form",
            ))}}
 
            <div class="form-group">
                {{Form::label("Email:")}}
                {{Form::input("text", "email", null, array("class" => "form-control"))}}
            </div> 
            
            <div class="form-group">
                {{Form::label("Password:")}}
                {{Form::input("password", "password", null, array("class" => "form-control"))}}
            </div>
            
            <div class="form-group">
                {{Form::label("Recordar sesión:")}}
                {{Form::input("checkbox", "remember", "On")}}
            </div>
            
            <div class="form-group">
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("submit", null, "Iniciar sesión", array("class" => "btn btn-primary"))}}
            </div>
            
{{Form::close()}}
</div>
</div>
</div>
@stop

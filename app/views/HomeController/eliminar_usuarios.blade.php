@extends('layouts.bootstrap')

@section('head')
<title>Eliminar Usuarios</title>
<meta name='description' content='Eliminar artículo'>
<meta name='keywords' content='palabras, clave'>
<meta name='robots' content='noindex,nofollow'>
@stop

@section('content')

<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Eliminación del Usuario: <strong>{{$usuario->nombre_usuario}}</strong></div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/usuarios/eliminar/$usuario->id",
            "role" => "form",
            ))}}

            <div class="form-group">
                {{Form::label("","¿Estás seguro de que quieres eliminar al Usuario?",array("class"=>"control-label"))}}
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id", $usuario->id, array("class"=>"form-control"))}}
            </div>
                {{Form::input("submit", null, "Eliminar", array("class" => "btn btn-danger"))}}
                <a href="{{ URL::to('/usuarios') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
{{Form::close()}}
</<div>
</<div>
</div>
@stop


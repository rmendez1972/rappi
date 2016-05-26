@extends('layouts.bootstrap')

@section('head')
<title>Eliminar Usuarios</title>
<meta name='description' content='Eliminar curso'>
<meta name='keywords' content='palabras, clave'>
<meta name='robots' content='noindex,nofollow'>
@stop

@section('content')

<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Eliminación del Curso: <strong>{{$curso->descripcion}}</strong></div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/cursos/eliminar/$curso->id_curso",
            "role" => "form",
            ))}}

            <div class="form-group">
                {{Form::label("","¿Estás seguro de que quieres eliminar el Curso?",array("class"=>"control-label"))}}
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id", $curso->id_curso, array("class"=>"form-control"))}}
            </div>
                {{Form::input("submit", null, "Eliminar", array("class" => "btn btn-danger"))}}
                <a href="{{ URL::to('/cursos') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
{{Form::close()}}
</<div>
</<div>
</div>
@stop


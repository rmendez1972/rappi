@extends('layouts.bootstrap')

@section('head')
<title>Eliminar Usuarios</title>
<meta name='description' content='Eliminar artículo'>
<meta name='keywords' content='palabras, clave'>
<meta name='robots' content='noindex,nofollow'>
@stop

@section('content')

<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Eliminación del Municipio: <strong>{{$municipio->nombre_municipio}}</strong></div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/municipios/eliminar/$municipio->cve_municipio",
            "role" => "form",
            ))}}

            <div class="form-group">
                {{Form::label("","¿Estás seguro de que quieres eliminar al Municipio?",array("class"=>"control-label"))}}
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id", $municipio->cve_municipio, array("class"=>"form-control"))}}
            </div>
                {{Form::input("submit", null, "Eliminar", array("class" => "btn btn-danger"))}}
                <a href="{{ URL::to('/municipios') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
{{Form::close()}}
</<div>
</<div>
</div>
@stop


@extends('layouts.bootstrap')

@section('content')

<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Eliminación del Requisito: <strong>{{$requisito->descripcion}}</strong></div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/requisitos/eliminar/$requisito->id_requisito",
            "role" => "form",
            ))}}

            <div class="form-group">
                {{Form::label("","¿Estás seguro de que quieres eliminar este Requisito?",array("class"=>"control-label"))}}
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id_requisito", $requisito->id_requisito, array("class"=>"form-control"))}}
            </div>
                {{Form::input("submit", null, "Eliminar", array("class" => "btn btn-danger"))}}
                <a href="{{ URL::to('/requisitos') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
{{Form::close()}}
</<div>
</<div>

@stop


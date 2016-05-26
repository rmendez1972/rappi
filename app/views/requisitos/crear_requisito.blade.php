@extends('layouts.bootstrap')

@section('content')
<div id="mensaje" class="bg-info"><h3>{{$mensage}}</h3></div>
<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Registro de Requisitos para el Matriculado de Asesores Inmobiliarios</div>
<div class="panel-body">

{{Form::open(array(
            "method" => "POST",
            "url" => "/requisitos/nuevo",
            "role" => "form",
            ))}}

            <div class="form-group">
                {{Form::label("Descripción:")}}
                {{Form::textarea("descripcion", Input::old('descripcion'), array('required' => 'required',"class" => "form-control","rows"=>"5"))}}
                <div class="bg-danger">{{$errors->first('descripcion')}}</div>
            </div>

            <div class="form-group">
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("submit", null, "Grabar", array("class" => "btn btn-primary"))}}
                <a href="{{ URL::to('/requisitos') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
            </div>

{{Form::close()}}
</<div>
</<div>

@stop
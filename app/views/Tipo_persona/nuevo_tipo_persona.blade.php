@extends('layouts.bootstrap')

@section('head')
<!-- <title>Registro de Tipo de Razón Social</title> -->
<meta name='description' content='Registro'>
<meta name='keywords' content='palabras, clave'>
<meta name='robots' content='noindex,nofollow'>
@stop

@section('content')
    <div id="mensaje" class="bg-info"><h3>{{$mensage}}</h3></div>
    <div class="panel panel-default" style="width:50%">
        <div class="panel-heading">Registro de Tipo de Razón Social</div>
        <div class="panel-body">
            {{Form::open(array(
                        "method" => "POST",
                        "url" => "/tipo_persona/nuevo",
                        "role" => "form",
                        ))}}

                        <div class="form-group">
                            {{Form::label("Descripción:")}}
                            {{Form::input("text", "descripcion_tipo_persona", null, array("class" => "form-control","place holder"=>"Ingresa la descripcion del tipo persona"))}}
                            <div class="bg-danger">{{$errors->first('descripcion_tipo_persona')}}</div>
                        </div>

                        <div class="form-group">
                            {{Form::input("hidden", "_token", csrf_token())}}
                            {{Form::input("submit", null, "Grabar", array("class" => "btn btn-primary"))}}
                            <a href="{{ URL::to('/tipo_persona') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
                        </div>

            {{Form::close()}}
        </<div>

    </div>
@stop
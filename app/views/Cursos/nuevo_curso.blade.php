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
        <div class="panel-heading">Registro de Cursos</div>
        <div class="panel-body">
            {{Form::open(array(
                        "method" => "POST",
                        "url" => "/cursos/nuevo",
                        "role" => "form",
                        ))}}

                        <div class="form-group">
                            <div class="col-sm-12">
                                {{Form::label("Descripción:")}}
                            </div>
                            <div class="col-sm-12">
                            {{Form::input("text", "descripcion", null, array("class" => "form-control","placeholder"=>"Ingresa la descripcion del curso"))}}
                                <div class="bg-danger">{{$errors->first('descripcion')}}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                {{Form::label("Año de impartición:")}}
                            </div>
                            <div class="col-sm-3">
                                {{Form::input("number", "año", 2015, array("class" => "form-control","min"=>"2015","max"=>"2100","step"=>"1","size"=>"6"))}}
                                <div class="bg-danger">{{$errors->first('año')}}</div>
                            </div>

                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {{Form::input("hidden", "_token", csrf_token())}}
                                {{Form::input("submit", null, "Grabar", array("class" => "btn btn-primary"))}}
                                <a href="{{ URL::to('/cursos') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
                            </div>
                        </div>

            {{Form::close()}}
        </<div>

    </div>
@stop
@extends('layouts.bootstrap')

@section('head')

@section('content')
<div id="mensaje" class="bg-info"><h3>{{$mensage}}</h3></div>
<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Nuevo Requisito para la persona: {{$tipopersona->descripcion_tipo_persona}}</div>
<div class="panel-body">

{{Form::open(array(
            "method" => "POST",
            "url" => "/tipo_persona/nuevorequisito/".$tipopersona->id_tipo_persona,
            "role" => "form",
            ))}}

            <div class="form-group">
                <div class="col-sm-12">
                    {{ Form::label('id_requisito', 'Requisito', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-6">
                    <select id="id_requisito" name="id_requisito" class="form-control" >
                        <option value="">- Seleccione una opción -</option>
                        @foreach($requisitos as $requisito)
                            <option value="{{ $requisito->id_requisito }}">{{ $requisito->descripcion }}</option>
                        @endforeach
                    </select>
                    <div class="bg-danger">{{$errors->first('id_requisito')}}</div>
                </div>


            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="col-sm-12">
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id_tipo_persona", $tipopersona->id_tipo_persona)}}
                {{Form::input("submit", null, "Grabar", array("class" => "btn btn-primary"))}}
                <a href="{{ URL::to('/tipo_persona/listarrequisitos/'.$tipopersona->id_tipo_persona) }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
            </div>

{{Form::close()}}
</<div>
</<div>
@stop
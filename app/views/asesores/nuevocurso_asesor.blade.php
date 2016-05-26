@extends('layouts.bootstrap')

@section('head')

@section('content')
<div id="mensaje" class="bg-info"><h3>{{$mensage}}</h3></div>
<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Nuevo Curso de Capacitación acreditado para el asesor: {{$asesor->nombre_razon.' '.$asesor->apellido_paterno.' '.$asesor->apellido_materno}}</div>
<div class="panel-body">

{{Form::open(array(
            "method" => "POST",
            "url" => "/asesores/nuevocurso/".$asesor->id,
            "role" => "form",
            ))}}

            <div class="form-group">
                <div class="col-sm-12">
                    {{ Form::label('id_curso', 'Curso', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-6">
                    <select id="id_curso" name="id_curso" class="form-control" >
                        <option value="">- Seleccione una opción -</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id_curso }}">{{ $curso->descripcion.'-'.$curso->año }}</option>
                        @endforeach
                    </select>
                    <div class="bg-danger">{{$errors->first('id_curso')}}</div>
                </div>


            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="col-sm-12">
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id", $asesor->id)}}
                {{Form::input("submit", null, "Grabar", array("class" => "btn btn-primary"))}}
                <a href="{{ URL::to('/asesores/listarcursos/'.$asesor->id) }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
            </div>

{{Form::close()}}
</<div>
</<div>
@stop
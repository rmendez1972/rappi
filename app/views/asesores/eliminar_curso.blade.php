@extends('layouts.bootstrap')

@section('content')

<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Eliminación del Curso de Capacitación: <strong>{{$curso->descripcion}}</strong> para el Asesor<strong> {{$asesor->nombre_razon.' '.$asesor->apellido_paterno.' '.$asesor->apellido_materno}} </strong></div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/asesores/eliminarcurso/$curso->id_curso/$asesor->id",
            "role" => "form",
            ))}}

            <div class="form-group">
                {{Form::label("","¿Estás seguro de que quieres eliminar este curso para este asesor?",array("class"=>"control-label"))}}
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id", $asesor->id, array("class"=>"form-control"))}}
                {{Form::input("hidden", "id_curso", $curso->id_curso, array("class"=>"form-control"))}}
            </div>
                {{Form::input("submit", null, "Eliminar", array("class" => "btn btn-danger"))}}
                <a href="{{ URL::to('/asesores/listarcursos/'.$asesor->id) }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
{{Form::close()}}
</<div>
</<div>
</div>
@stop


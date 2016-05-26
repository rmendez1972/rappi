@extends('layouts.bootstrap')

@section('content')

<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Eliminación del requisito: <strong>{{$requisito->descripcion}}</strong> para el tipo de persona<strong> {{$tipopersona->descripcion_tipo_persona}} </strong></div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/tipo_persona/eliminarrequisito/$requisito->id_requisito/$tipopersona->id_tipo_persona",
            "role" => "form",
            ))}}

            <div class="form-group">
                {{Form::label("","¿Estás seguro de que quieres eliminar este requisito?",array("class"=>"control-label"))}}
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id_tipo_persona", $tipopersona->id_tipo_persona, array("class"=>"form-control"))}}
                {{Form::input("hidden", "id_requisito", $requisito->id_requisito, array("class"=>"form-control"))}}
            </div>
                {{Form::input("submit", null, "Eliminar", array("class" => "btn btn-danger"))}}
                <a href="{{ URL::to('/tipo_persona/listarrequisitos/'.$tipopersona->id_tipo_persona) }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
{{Form::close()}}
</<div>
</<div>
</div>
@stop


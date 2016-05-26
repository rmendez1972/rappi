@extends('layouts.bootstrap')

@section('content')

<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Eliminación del Asesor: <strong>{{$asesor->nombre_razon." ".$asesor->apellido_paterno." ".$asesor->apellido_materno}}</strong></div>
<div class="panel-body">
{{Form::open(array("url" => "/asesores/eliminar"))}}

            <div class="form-group">
                {{Form::label("","¿Estás seguro de que quieres eliminar al asesor?",array("class"=>"control-label"))}}
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("hidden", "id", $asesor->id)}}
            </div>
                {{Form::input("submit", null, "Eliminar", array("class" => "btn btn-danger"))}}
                <a href="{{ URL::to('/asesores') }}">{{ Form::button('Cancelar', array('class' => 'btn btn-default')) }}</a>
{{Form::close()}}
</<div>
</<div>
</div>
@stop
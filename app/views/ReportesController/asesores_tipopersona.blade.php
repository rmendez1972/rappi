@extends('layouts.bootstrap')

@section('content')

<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Reporte de Asesores Inmobiliarios por Tipo de Razón Social </div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/reportes/asesores_tipopersona",
            "role" => "form",
            ))}}

            <div class="form-group">
                <div class="col-sm-12">
                    {{Form::label("id_tipo_persona","Tipo de Razón Social",array("class"=>"control-label"))}}
                </div>
                <div class="col-sm-3">
                    <select id="id_tipo_persona" name="id_tipo_persona" class="form-control" >
                        <option value="">- Seleccione una opción -</option>
                        @foreach($tipopersonas as $tipopersona)
                            <option value="{{ $tipopersona->id_tipo_persona }}">{{ $tipopersona->descripcion_tipo_persona }}</option>
                        @endforeach
                    </select>
                    <div class="bg-danger">{{$errors->first('id_tipo_persona')}}</div>
                </div>


                <div class="col-sm-12">
                    {{Form::input("hidden", "_token", csrf_token())}}
                    {{Form::input("submit", null, "Imprimir", array("class" => "btn btn-primary"))}}
                    <a href="{{ URL::to('/') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
                </div>
            </div>
{{Form::close()}}
</<div>
</<div>
</div>
@stop


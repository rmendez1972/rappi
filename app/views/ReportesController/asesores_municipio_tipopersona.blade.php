@extends('layouts.bootstrap')

@section('content')

<div class="panel panel-default" style="width:50%">
<div class="panel-heading">Reporte de Asesores Inmobiliarios por Municipio y Tipo de Razón Social </div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/reportes/asesores_municipio_tipopersona",
            "role" => "form",
            ))}}

            <div class="form-group">
                <div class="col-sm-12">
                    {{Form::label("cve_municipio","Municipio",array("class"=>"control-label"))}}
                </div>
                <div class="col-sm-6">
                    <select id="cve_municipio" name="cve_municipio" class="form-control" >
                        <option value="">- Seleccione una opción -</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->cve_municipio }}">{{ $municipio->nombre_municipio }}</option>
                        @endforeach
                    </select>
                    <div class="bg-danger">{{$errors->first('cve_municipio')}}</div>
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    {{Form::label("id_tipo_persona","Tipo de Persona",array("class"=>"control-label"))}}
                </div>
                <div class="col-sm-6">
                    <select id="id_tipo_persona" name="id_tipo_persona" class="form-control" >
                        <option value="">- Seleccione una opción -</option>
                        @foreach($tipopersona as $tipopersonas)
                            <option value="{{ $tipopersonas->id_tipo_persona }}">{{ $tipopersonas->descripcion_tipo_persona }}</option>
                        @endforeach
                    </select>
                    <div class="bg-danger">{{$errors->first('id_tipo_persona')}}</div>
                </div>

            </div>
            <div class="col-sm-12">
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("submit", null, "Imprimir", array("class" => "btn btn-primary"))}}
                <a href="{{ URL::to('/') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
            <div class="col-sm-12">
{{Form::close()}}
</<div>
</<div>
</div>
@stop


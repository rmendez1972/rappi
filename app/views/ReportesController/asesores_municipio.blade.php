@extends('layouts.bootstrap')

@section('content')

<div class="panel panel-default" style="width:50%">
<div class="panel-heading">Reporte de Asesores Inmobiliarios por Municipio </div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/reportes/asesores_municipio",
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


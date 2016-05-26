@extends('layouts.bootstrap')

@section('content')
	<h1>Nuevo municipio</h1>

	{{ Form::open(array('url' => '/municipios/nuevo')) }}
	<div class="form-group row">
		{{ Form::label('cve_municipio', 'Clave', array('class' => 'col-sm-1 control-label')) }}
		<div class="col-sm-1">
			{{ Form::text('cve_municipio', '', array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Ingrese la clave del municipio')) }}
		</div>
	</div>
	<div class="form-group row">
		{{ Form::label('nombre_municipio', 'Nombre', array('class' => 'col-sm-1 control-label')) }}
		<div class="col-sm-3">
            {{ Form::text('nombre_municipio', '', array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Ingrese el nombre del municipio')) }}
        </div>
    </div>
        {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::to('/municipios') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
	{{ Form::close() }}
@stop
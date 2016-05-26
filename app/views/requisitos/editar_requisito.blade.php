@extends('layouts.bootstrap')

@section('content')
<div class="panel panel-default" style="margin-top:20px">
<div class="panel-heading">Edición del Requisito para matriculado de asesores inmobiliarios</div>
<div class="panel-body">


	{{ Form::open(array('url' => '/requisitos/editar', 'role'=>'form')) }}
	<div class="form-group">
		{{ Form::label('descripcion', 'Descripción:') }}
		{{ Form::textarea('descripcion', $requisito->descripcion, array('required' => 'required','class' => 'form-control',"rows"=>"5")) }}
		<div class="bg-danger">{{$errors->first('descripcion')}}</div>

	</div>

		{{Form::input("hidden", "_token", csrf_token())}}
		{{Form::input("hidden", "id_requisito", $requisito->id_requisito)}}
        {{ Form::submit('Modificar', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::to('/requisitos') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
	{{ Form::close() }}
</div>
</div>
@stop
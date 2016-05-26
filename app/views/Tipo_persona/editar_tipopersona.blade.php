@extends('layouts.bootstrap')

@section('content')
	<div class="panel panel-default" style="width:50%">
		<div class="panel-heading">Edición de Tipo de Persona</div>
		<div class="panel-body">


			{{ Form::open(array('url' => '/tipo_persona/editar', 'role'=>'form')) }}
			<div class="form-group">
				{{ Form::label('descripcion_tipo_persona', 'Descripción:') }}
				{{ Form::text('descripcion_tipo_persona', $tipopersona->descripcion_tipo_persona, array('required' => 'required','class' => 'form-control')) }}
				<div class="bg-danger">{{$errors->first('descripcion_tipo_persona')}}</div>

			</div>

				{{Form::input("hidden", "_token", csrf_token())}}
				{{Form::input("hidden", "id_tipo_persona", $tipopersona->id_tipo_persona)}}
		        {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
		        <a href="{{ URL::to('/tipo_persona') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
			{{ Form::close() }}
		</div>
	
	</div>
@stop
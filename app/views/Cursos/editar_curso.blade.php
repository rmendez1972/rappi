@extends('layouts.bootstrap')

@section('content')
	<div class="panel panel-default" style="width:50%">
		<div class="panel-heading">Edición del Curso de Capacitación</div>
		<div class="panel-body">


			{{ Form::open(array('url' => '/cursos/editar', 'role'=>'form')) }}
			<div class="form-group">
				<div class="col-sm-12">
					{{ Form::label('descripcion', 'Descripción:') }}
				</div>
				<div class="col-sm-12">
					{{ Form::text('descripcion', $curso->descripcion, array('required' => 'required','class' => 'form-control','placeholder'=>'ingresa la descripcion del curso')) }}
					<div class="bg-danger">{{$errors->first('descripcion')}}</div>
				</div>
			</div>

			<div class="form-group">
                <div class="col-sm-12">
                        {{Form::label("Año de impartición:")}}
                </div>
                <div class="col-sm-3">
                    {{Form::input("number", "año", $curso->año, array("class" => "form-control","min"=>"2015","max"=>"2100","step"=>"1","size"=>"6"))}}
                     <div class="bg-danger">{{$errors->first('año')}}</div>
                </div>

            </div>
            <br>
            <br>
            <br>
			<div class="col-sm-12">
				{{Form::input("hidden", "_token", csrf_token())}}
				{{Form::input("hidden", "id_curso", $curso->id_curso)}}
		        {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
		        <a href="{{ URL::to('/cursos') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
		    </div>
			{{ Form::close() }}
		</div>

	</div>
@stop
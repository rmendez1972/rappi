@extends('layouts.bootstrap')

@section('head')
<title>Error Matriculado</title>
<meta name='description' content='Eliminar artículo'>
<meta name='keywords' content='palabras, clave'>
<meta name='robots' content='noindex,nofollow'>
@stop

@section('content')

<div class="panel panel-default" style="margin-top:100px;margin-bottom:100px;width:50%">
<div class="panel-heading">Error Matriculado </div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "",
            "role" => "form",
            ))}}

            <div class="text-danger" style="text-align:center" >
                <h4><strong>{{$mensaje_error}}</strong></h4>
                {{Form::input("hidden", "_token", csrf_token())}}
                <a href="{{ URL::to('/asesores') }}"  target="_self">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
            </div>
            
{{Form::close()}}
</<div>
</<div>
</div>
@stop


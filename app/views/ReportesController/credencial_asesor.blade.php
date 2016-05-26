@extends('layouts.bootstrapcredencial')

@section('fechaactual')
    {{$fechaactual}}
@stop

@section('solicitante')
    {{$asesor->nombre_razon.' '.$asesor->apellido_paterno.' '.$asesor->apellido_materno}}
@stop

@section('matricula')
    <strong>{{$asesor->matricula}}</strong>
@stop

@section('foto')

    <img src="{{URL::to('/').'/'. $asesor->src }}" wihth="80" height="100" alt="">
@stop
@section('nombre_razon')
    {{$asesor->nombre_razon.' '.$asesor->apellido_paterno.' '.$asesor->apellido_materno}}
@stop

@section('tipo_persona')
        {{$nombre_tipopersona}}

@stop

@section('afiliado')
        {{$asesor->afiliado}}

@stop

@section('rfc')
    <strong>{{$asesor->rfc}}</strong>
@stop

@section('domicilio')
    {{$asesor->calle.' NUMERO '.$asesor->numero_exterior_lote.', MANZANA '.$asesor->manzana.' Y COLONIA O REGION '.$asesor->colonia_region.' DE LA CIUDAD DE '.$asesor->localidad.'.'}}
@stop

@section('fecha_expedicion')
    {{$fecha_expedicion}}
@stop

@section('qr_code')
<img src="{{URL::to('/').'/'.'assets/imagenes/qr_code/'.'Secretaria_de_Desarrollo_Urbano_y_Vivienda_'.strtoupper(trim($asesor->matricula)).'.png'}}" width="45" height="45">


@stop
@section('fecha_matriculacion')
        <strong>
            {{$fechamatricula}}
        </strong>
@stop
@section('vigencia')
        <strong>
            {{$vigencia}}
        </strong>
@stop

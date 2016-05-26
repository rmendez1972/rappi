<!--Plantilla para poblar el documento que se expide como
    acreditación como asesor inmobiliario en el estado.
-->
@extends('layouts.bootstrapmatricula')

    @section('num_ref')
        {{$asesor->id.'/'.$año_referencia}}
   @stop

   @section('matricula_referencia')
        {{$asesor->matricula}}
    @stop

    @section('fechaactual')
        {{$fechaactual}}
    @stop

    @section('solicitante')
        {{$nombre_asesor}}
    @stop

    @section('localidad')
        {{$asesor->localidad}}
    @stop

    @section('municipio')
        {{$municipio->nombre_municipio}}
    @stop

    @section('matricula')
        <strong>{{$asesor->matricula}}</strong>
    @stop

    @section('fecha_expedicion')
        {{$fecha_expedicion}}
    @stop

    @section('rfc')
        <strong>{{$asesor->rfc}}</strong>
    @stop

    @section('nombre_tipopersona')
    <strong>{{$nombre_tipopersona}}</strong>
    @stop


    @section('fecha_matriculacion')
            <strong>
                {{$fechamatricula}}
            </strong>
    @stop


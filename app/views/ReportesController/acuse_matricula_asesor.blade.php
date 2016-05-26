<!--Plantilla para poblar el documento que se genera como
    acuse de recibo de la matrícula.
-->
@extends('layouts.bootstrapacusematricula')

    @section('fechaactual')
        {{$fechaactual}}
    @stop

    @section('nombre_tipopersona')
        {{$nombre_tipopersona}}
    @stop

    @section('solicitante')
        {{$nombre_asesor}}
    @stop




@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop
@section('content')

        <br>
        <table border="0px" width="100%" padding="10px">
            <tr>
                <td width="75%"><p><strong>PERSONA {{$tipopersona->descripcion_tipo_persona}} :</strong>{{$asesor->nombre_razon.' '.$asesor->apellido_paterno.' '.$asesor->apellido_materno}}</p></td>
                <td width="25%"><p><strong>Fecha: </strong>{{date("d/m/Y")}}</p></td>
            </tr>

        </table>
		<table class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>Requisito</th>
                    <th>Entregado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipopersona->requisitos as $requisito)
                    <tr>
                        <td >{{++$contador.'.- '}}{{$requisito->descripcion}}</td>
                        @if (in_array($requisito->id_requisito,$x))
                            <td><div class="bien"></div></td>
                        @else
                            <td><div class="mal"></div></td>
                        @endif


                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="position:absolute;z-index:0;bottom:50">
        <table border="0px" width="100%">
            <thead>
                <tr>
                    <th width="40%" align="center">RECIBIO</th>
                    <th width="20%">&nbsp;</th>
                    <th width="40%" align="center">ENTREGA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td style="border-top:2px solid #black" align="center"><p><strong>NOMBRE Y FIRMA</strong></p></td>
                    <td>&nbsp;</td>
                    <td style="border-top:2px solid #black" align="center"><p><strong>{{Auth::user()->get()->nombre_usuario}}</strong></p></td>
                </tr>
            </tbody>
        </table>
    </div>



@stop
@extends('layouts.bootstrapreportes')

@section('titulo')
{{$titulo_reporte}}
@stop
@section('content')



        <table border="0px" width="100%" padding="10px">
            <tr>
                <td width="75%"><p><strong>PERSONA {{$tipopersona->descripcion_tipo_persona}} :</strong>{{$asesor->nombre_razon.' '.$asesor->apellido_paterno.' '.$asesor->apellido_materno}}</p></td>
                <td width="25%"><p><strong>Fecha: </strong>{{date("d/m/Y")}}</p></td>
            </tr>

        </table>
		<table class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Año</th>
                    <th>Acreditado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listacursos as $curso)
                    <tr>
                        <td >{{++$contador.'.-'}}{{$curso->descripcion}}</td>
                        <td >{{$curso->año}}</td>
                        @if (in_array($curso->id_curso,$x))
                            <td><div class="bien"></div></td>
                        @else
                            <td><div class="mal"></div></td>
                        @endif


                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <table border="0px" width="100%">
            <thead>
                <tr>
                    <th width="30%" align="center">&nbsp;</th>
                    <th width="40%" align="center">Revisó</th>
                    <th width="30%" align="center">&nbsp;</th>
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
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td >&nbsp;</td>
                    <td style="border-top:2px solid #0000FF" align="center"><p><strong>NOMBRE Y FIRMA</strong></p></td>
                    <td >&nbsp;</td>
                </tr>
            </tbody>
        </table>



@stop
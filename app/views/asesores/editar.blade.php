@extends('layouts.bootstrap')

@section('content')

    <script>
        function cargar(){
            cambiarTipo($("#id_tipo_persona").val());
        }

        function cambioReferencia(valor){
            if(valor.length==17)
                $("#dmatricula").removeClass("oculto");
            else
                $("#dmatricula").addClass("oculto");
        }

        function cambiarTipo(id){
            $.get("{{URL::to('requisitos/tipopersona/')}}/"+id, null, function(datos){
                $("#tabody").empty();
                for(var i=0; i<datos.length; i++)
                    $("#tabody").append("<tr><td>"+datos[i].descripcion+"</td><td>" +
                    "<input type='checkbox' id='req"+datos[i].id_requisito+"' name='req"+datos[i].id_requisito+"' value='1' />" +
                    "</td></tr>");

                seleccionarCheck();
            },"json");
        }

        function seleccionarCheck(){
            for(var i=0; i<reqmark.length; i++)
                $("#req"+reqmark[i]).prop('checked', true);
        }

        var reqmark=[
                @foreach($requisitos as $req)
            {{$req->id_requisito}},
                @endforeach
        ];
    </script>

    <div class="panel panel-default">
	   <div class="panel-heading">Edición de Asesores Inmobiliarios</div>
        <div class="panel-body">

    	{{ Form::open(array('url' => '/asesores/editar',
                "enctype" => "multipart/form-data", 'role'=>'form')) }}
    		{{Form::hidden('id', $asesor->id)}}
            <div id="dmatricula" class="form-group {{$asesor->referencia!=""?"":"oculto"}}">
                <div>
                    {{Form::label('matricula', 'Matricula')}}
                </div>
                <div class="col-sm-20">
                    {{Form::text('matricula', $asesor->matricula, array('class' => 'form-control', 'readonly' => 'readonly', 'style' => 'width:240px'))}}
                </div>
            </div>
    		<div class="form-group" style="float:left">
    			<div>
    				{{ Form::label('nombre_razon', 'Nombre / Razón social', array('class' => 'control-label')) }}
    			</div>
            	<div class="col-sm-30">
            		{{ Form::text('nombre_razon', $asesor->nombre_razon, array('required' => 'required', 'class' => 'form-control')) }}
            	</div>
            </div>

            <div class="form-group"style="float:left">
                <div>
            	    {{ Form::label('apellido_paterno', 'Apellido paterno', array('class' => 'control-label')) }}
            	</div>
                <div class="col-sm-30">
                    {{ Form::text('apellido_paterno', $asesor->apellido_paterno, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('apellido_materno', 'Apellido materno', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-30">
                    {{ Form::text('apellido_materno', $asesor->apellido_materno, array('class' => 'form-control')) }}
                 </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('rfc', 'RFC', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-30">
                    {{ Form::text('rfc', $asesor->rfc, array('class' => 'form-control', 'required' => 'required')) }}
                </div>
            </div>


            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('id_tipo_persona', 'Tipo de persona', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-13">
                    <select id="id_tipo_persona" name="id_tipo_persona" class="form-control" required="required" onchange="cambiarTipo(this.value)">
                        <option value="">- Seleccione una opción -</option>
                        @foreach($tipos_personas as $tpersona)
    						<option value="{{ $tpersona->id_tipo_persona }}" {{$tpersona->id_tipo_persona==$asesor->id_tipo_persona?"selected":""}}>{{ $tpersona->descripcion_tipo_persona }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('cve_municipio', 'Municipio', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-15">
                    <select id="cve_municipio" name="cve_municipio" class="form-control" required="required">
                        <option value="">- Seleccione una opción -</option>
                        @foreach($municipios as $municipio)
    						<option value="{{ $municipio->cve_municipio }}" {{$municipio->cve_municipio==$asesor->cve_municipio?"selected":""}}>{{ $municipio->nombre_municipio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('colonia_region', 'Colonia / Región', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-15">
                    {{ Form::text('colonia_region', $asesor->colonia_region, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('localidad', 'Localidad', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-15">
                    {{ Form::text('localidad', $asesor->localidad, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('calle', 'Dirección', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-5">
                    {{ Form::text('calle', $asesor->calle, array('class' => 'form-control', 'placeholder' => 'Calle')) }}
                </div>
                <div class="col-sm-3">
                    {{ Form::text('manzana', $asesor->manzana, array('class' => 'form-control', 'placeholder' => 'Mza.')) }}
                </div>
                <div class="col-sm-2">
                    {{ Form::text('numero_interior', $asesor->numero_interior, array('class' => 'form-control', 'placeholder' => '# Int')) }}
                </div>
                <div class="col-sm-2">
                    {{ Form::text('numero_exterior_lote', $asesor->numero_exterior_lote, array('class' => 'form-control', 'placeholder' => '# Ext')) }}
                </div>


            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('codigo_postal', 'Código postal')}}
                </div>
                <div class="col-sm-15">
                    {{Form::text('codigo_postal', $asesor->codigo_postal, array('class' => 'form-control'))}}
                </div>
            </div>




            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('telefono', 'Teléfono')}}
                </div>
                <div class="col-sm-15">
                    {{Form::text('telefono', $asesor->telefono, array('class' => 'form-control'))}}
                </div>
            </div>


            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('celular', 'Celular')}}
                </div>
                <div class="col-sm-15">
                    {{Form::text('celular', $asesor->celular, array('class' => 'form-control'))}}
                </div>
            </div>


            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('email', 'E-mail')}}
                </div>
                <div class="col-sm-15">
                    {{Form::text('email', $asesor->email, array('class' => 'form-control'))}}
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('referencia', 'Referencia de pago')}}
                </div>
                <div class="col-sm-20">
                    {{Form::text('referencia', $asesor->referencia, array('class' => 'form-control', "onkeyup" => "cambioReferencia(this.value)"))}}
                </div>
            </div>

            <div class="row">

                    <div class="col-md-10">
                        {{Form::label('afiliado', 'Afiliación')}}


                        {{Form::text('afiliado', $asesor->afiliado, array('class' => 'form-control'))}}
                    </div>



                    <div class="col-md-2">
                        {{Form::label('fecha_impresion', 'Fecha de Matrículado')}}


                        {{Form::input('date','fecha_impresion', $asesor->fecha_impresion, array('class' => 'form-control'))}}
                    </div>

            </div>


            <div class="form-group" style="float:left">

                <p>Fotografía actual:</p>
                <div style="float:left">
                    <img src="{{URL::to('/').'/'. $asesor->src }}" alt="Fotografía" width="150" hight="150">
                </div>
                <div style="float:left;width:200px;margin:10px;" class="label label-info">
                    <hr>
                    <h4><label style="color:black;font-size:12px">Si incluyes una nueva fotografía, <br>esta reemplará a la anterior!<br> Preferentemente en formato<br> .png, .jpg o .svg</label></h4>
                    <hr>
                </div>
                <div style="float:left">
                    {{Form::label("Nueva Fotografía:")}}
                    {{Form::input('file','src')}}
                    <!-- <div class="bg-danger">{{$errors->first('src')}}</div> -->
                </div>

            </div>

            <div class="form-group" style="float:right">
                <div>
                    {{Form::label('doctos_faltantes', 'Observaciones')}}
                </div>
                <div class="col-sm-20">
                    {{Form::textarea('doctos_faltantes', $asesor->doctos_faltantes, array('class' => 'form-control'))}}
                </div>
            </div>



            <div style="float:left; width: 600px">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                    <tr class=".req-tab">
                        <th>Requisito</th>
                        <th>Entregado</th>
                    </tr>
                    </thead>
                    <tbody id="tabody"></tbody>
                </table>
            </div>





            <div style="clear: left; padding:10px;margin-left:30%">
                {{Form::submit("Guardar", array('class' => 'btn btn-primary'))}}
                <a href="{{URL::route('asesores')}}">{{Form::button("Cancelar", array('class' => 'btn btn-default'))}}</a>
            </div>
    	{{ Form::close() }}
    </div>
</div>

    <script>cargar()</script>
@stop
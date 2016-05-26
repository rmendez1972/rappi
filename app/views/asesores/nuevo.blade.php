@extends('layouts.bootstrap')

@section('content')

    <script>
        function cambiarTipo(id){
            $.get("{{URL::to('requisitos/tipopersona/')}}/"+id, null, function(datos){
                $("#tabody").empty();
                for(var i=0; i<datos.length; i++)
                    $("#tabody").append("<tr><td>"+datos[i].descripcion+"</td><td>" +
                       "<input type='checkbox' id='req"+datos[i].id_requisito+"' name='req"+datos[i].id_requisito+"' value='1' />" +
                   "</td></tr>");
            },"json");
        }
    </script>

    <div class="panel panel-default">
        <div class="panel-heading">Registro de nuevo Asesor Inmobiliario</div>

    	    <div class="panel-body">
    	       {{ Form::open(array('url' => '/asesores/nuevo',"enctype" => "multipart/form-data",
                "role" => "form", )) }}

    		    <div class="form-group" style="float:left">
    		        <div>
    			     {{ Form::label('nombre_razon', 'Nombre / Razón social', array('class' => 'control-label')) }}
    	            </div>
                    <div class="col-sm-30">
            		  {{ Form::text('nombre_razon', '', array('required' => 'required', 'class' => 'form-control')) }}
            	    </div>
                </div>

                <div class="form-group" style="float:left">
                <div >
            	    {{ Form::label('apellido_paterno', 'Apellido paterno', array('class' => 'control-label')) }}
            	</div>
                <div class="col-sm-30" >
                    {{ Form::text('apellido_paterno', '', array('class' => 'form-control')) }}
                </div>
           </div>

           <div class="form-group" style="float:left">
                <div >
                    {{ Form::label('apellido_materno', 'Apellido materno', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-30">
                    {{ Form::text('apellido_materno', '', array('class' => 'form-control')) }}
                 </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('rfc', 'RFC', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-30">
                    {{ Form::text('rfc', '', array('class' => 'form-control', 'required' => 'required')) }}
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
    						<option value="{{ $tpersona->id_tipo_persona }}">{{ $tpersona->descripcion_tipo_persona }}</option>
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
    						<option value="{{ $municipio->cve_municipio }}">{{ $municipio->nombre_municipio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('colonia_region', 'Colonia / Región', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-15">
                    {{ Form::text('colonia_region', '', array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('localidad', 'Localidad', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-15">
                    {{ Form::text('localidad', '', array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{ Form::label('calle', 'Dirección', array('class' => 'control-label')) }}
                </div>
                <div class="col-sm-6">
                    {{ Form::text('calle', '', array('class' => 'form-control', 'placeholder' => 'Calle')) }}
                </div>
                <div class="col-sm-2">
                    {{ Form::text('manzana', '', array('class' => 'form-control', 'placeholder' => 'Mza.2')) }}
                </div>
                <div class="col-sm-2">
                    {{ Form::text('numero_interior', '', array('class' => 'form-control', 'placeholder' => '# Int')) }}
                </div>
                <div class="col-sm-2">
                    {{ Form::text('numero_exterior_lote', '', array('class' => 'form-control', 'placeholder' => '# Ext')) }}
                </div>

            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('codigo_postal', 'Código postal')}}
                </div>
                <div class="col-sm-20">
                    {{Form::text('codigo_postal', '', array('class' => 'form-control'))}}
                </div>
            </div>


            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('telefono', 'Teléfono')}}
                </div>
                <div class="col-sm-15">
                    {{Form::text('telefono', '', array('class' => 'form-control'))}}
                </div>
            </div>


            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('celular', 'Celular')}}
                </div>
                <div class="col-sm-15">
                    {{Form::text('celular', '', array('class' => 'form-control'))}}
                </div>
            </div>


            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('email', 'E-mail')}}
                </div>
                <div class="col-sm-20">
                    {{Form::text('email', '', array('class' => 'form-control'))}}
                </div>
            </div>


            <div class="form-group" style="float:right">
                <div>
                    {{Form::label('doctos_faltantes', 'Observaciones')}}
                </div>
                <div class="col-sm-20">
                    {{Form::textarea('doctos_faltantes', '', array('class' => 'form-control'))}}
                </div>
            </div>

            <div class="form-group" style="float:left">
                <div>
                    {{Form::label('src', 'Fotografía:')}}
                </div>
                <div class="col-sm-20">
                    {{Form::file('src', '', array('class' => 'form-control'))}}
                </div>
            </div>

            <div class="row">

                    <div class="col-md-10">
                        {{Form::label('afiliado', 'Afiliación')}}


                        {{Form::text('afiliado', '', array('class' => 'form-control'))}}
                    </div>



                    <div class="col-md-2">
                        {{Form::label('fecha_impresion', 'Fecha de Matrículado')}}


                        {{Form::input('date','fecha_impresion', '', array('class' => 'form-control'))}}
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
@stop
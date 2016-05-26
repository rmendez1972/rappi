<?php

class ReportesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	public function reporteUsuarios(){
        $usuarios=Usuario::all();
        // variable con html renderizado
        $html= View::make('ReportesController.lista_usuarios', array('usuarios' => $usuarios,'titulo_reporte'=>'Listado de Usuarios'));
        return PDF::load($html, 'letter', 'portrait')->show();
    }

    public function reporteMunicipios(){
        $municipios=Municipio::all();

        $html= View::make('ReportesController.lista_municipios', array('municipios' => $municipios,'titulo_reporte'=>'Listado de Municipios'));
        return PDF::load($html,'letter','portrait')->show();
    }


    public function reporteTipopersona(){
        $tipopersona=TipoPersona::all();

        $html= View::make('ReportesController.lista_tipopersona', array('tipopersona' => $tipopersona,'titulo_reporte'=>'Listado de Tipos de Persona'));
        return PDF::load($html, 'letter', 'portrait')->show();
    }

    public function reporteCursos(){
        $curso=Curso::orderBy('año','desc')->get();

        $html= View::make('ReportesController.lista_cursos', array('curso' => $curso,'titulo_reporte'=>'Listado de Cursos de Capacitación para Asesores Inmobiliarios'));
        return PDF::load($html, 'letter', 'portrait')->show();
    }

    public function reporterequisitosTipopersona($id_tipo_persona){
        $tipopersona=TipoPersona::find($id_tipo_persona);
        $nombre_tipo_persona=$tipopersona['descripcion_tipo_persona'];
        $html= View::make('ReportesController.lista_requisitostipopersona', array('tipopersona' => $tipopersona,'titulo_reporte'=>'Listado de Requisitos para el tipo de persona:'. $nombre_tipo_persona,'contador'=>0));
        return PDF::load($html, 'letter', 'portrait')->show();
    }

    public function reportecursosAsesor($id){
        $asesor=Asesor::find($id);
        $listacursos=Curso::orderBy('año','desc')->get();
        $nombre_asesor=$asesor['nombre_razon'].' '.$asesor['apellido_paterno'].' '.$asesor['apellido_materno'];
        $id_tipo_persona=$asesor['id_tipo_persona'];
        $tipopersona=TipoPersona::find($id_tipo_persona);
        $cursos=$asesor->cursos()->get(); //cursos acreditas por el asesor
        $x=array(); //vector con los id de cursos acreditados por el asesor (tabla pivote)
        foreach ($cursos as $cur)
        {
            array_push($x, $cur->id_curso);
        }
        $html= View::make('ReportesController.lista_cursosasesor', array('asesor' => $asesor,'titulo_reporte'=>'Cursos de Capacitación acreditados por el Asesor '. $nombre_asesor,'contador'=>0,'listacursos'=>$listacursos,'tipopersona'=>$tipopersona,'x'=>$x));
        return PDF::load($html, 'letter', 'portrait')->show();
    }

    public function reportematriculaAsesor($id){
        $asesor=Asesor::find($id);
        $municipio=Municipio::find($asesor->cve_municipio);
        $nombre_asesor=$asesor['nombre_razon'].' '.$asesor['apellido_paterno'].' '.$asesor['apellido_materno'];
        $id_tipo_persona=$asesor['id_tipo_persona'];
        $tipo_persona=TipoPersona::find($id_tipo_persona);

        switch ($tipo_persona->descripcion_tipo_persona) {
            case 'FISICA':
                $nombre_tipopersona='Asesor Inmobiliario acreditado en Quintana Roo';
                break;
            case 'MORAL':
                $nombre_tipopersona='Empresa Inmobiliaria con Matrícula Estatal';
                break;
            case 'ASOCIACION INMOBILIARIA':
                $nombre_tipopersona='Asociación Inmobiliaria con Matrícula Estatal';
                break;
        }


        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fechaactual= "Chetumal Quintana Roo a".' '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        $año_referencia=date('Y');
        $fecha_expedicion='Se expide la presente a los '.date('d').' días del mes de '.$meses[date('n')-1].' del año '.date('Y').', en la ciudad de Chetumal, Quintana Roo';
        //Construir dirección
            $domicilio=$asesor['calle'].' número '.$asesor['numero_exterior_lote'];
            if ($asesor->numero_interior<>""){
                $domicilio=$domicilio.' int. '.$asesor->numero_interior;
                }
            if ($asesor->manzana<>""){
                $domicilio=$domicilio.', mza. '.$asesor->manzana;
                }
            $domicilio=$domicilio.', '.$asesor->colonia_region.' de la localidad de '.$asesor->localidad.',';
        //Fin direccion

        //Construyendo la fecha de matriculación
            $fechamatricula='a los '.date("d",strtotime($asesor->fecha_matriculacion)).' días del mes de '
            .$meses[date("n",strtotime($asesor->fecha_matriculacion))-1].' del año '.date("Y",strtotime($asesor->fecha_matriculacion)).'.';
        //Fin fecha matriculación
        if (!empty($asesor->referencia))
        {
            $html= View::make('ReportesController.matricula_asesor', array('asesor' => $asesor,'fechaactual'=>$fechaactual,'meses'=>$meses,'fechamatricula'=>$fechamatricula,'año_referencia'=>$año_referencia,'domicilio'=>$domicilio,'nombre_asesor'=>$nombre_asesor,'municipio'=>$municipio,'fecha_expedicion'=>$fecha_expedicion,'nombre_tipopersona'=>$nombre_tipopersona));
            return PDF::load($html, 'letter', 'portrait')->show();
        }else
        {
            return View::make('ReportesController.matriculado_error', array('mensaje_error'=>'No se generó el documento de Matricula por que no se cuenta con la referencia de pago'));

        }
    }


    public function reportematriculaAsesor_subsecretaria($id){
        $asesor=Asesor::find($id);
        $municipio=Municipio::find($asesor->cve_municipio);
        $nombre_asesor=$asesor['nombre_razon'].' '.$asesor['apellido_paterno'].' '.$asesor['apellido_materno'];
        $id_tipo_persona=$asesor['id_tipo_persona'];
        $tipo_persona=TipoPersona::find($id_tipo_persona);

        switch ($tipo_persona->descripcion_tipo_persona) {
            case 'FISICA':
                $nombre_tipopersona='Asesor Inmobiliario acreditado en Quintana Roo';
                break;
            case 'MORAL':
                $nombre_tipopersona='Empresa Inmobiliaria con Matrícula Estatal';

                break;
            case 'ASOCIACION INMOBILIARIA':
                $nombre_tipopersona='Empresa Inmobiliaria con Matrícula Estatal';
                break;
        }


        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fechaactual= "Chetumal Quintana Roo a".' '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        $año_referencia=date('Y');
        $fecha_expedicion='Se expide la presente a los '.date('d').' días del mes de '.$meses[date('n')-1].' del año '.date('Y').', en la ciudad de Chetumal, Quintana Roo';
        //Construir dirección
            $domicilio=$asesor['calle'].' número '.$asesor['numero_exterior_lote'];
            if ($asesor->numero_interior<>""){
                $domicilio=$domicilio.' int. '.$asesor->numero_interior;
                }
            if ($asesor->manzana<>""){
                $domicilio=$domicilio.', mza. '.$asesor->manzana;
                }
            $domicilio=$domicilio.', '.$asesor->colonia_region.' de la localidad de '.$asesor->localidad.',';
        //Fin direccion

        //Construyendo la fecha de matriculación
            $fechamatricula='a los '.date("d",strtotime($asesor->fecha_matriculacion)).' días del mes de '
            .$meses[date("n",strtotime($asesor->fecha_matriculacion))-1].' del año '.date("Y",strtotime($asesor->fecha_matriculacion)).'.';
        //Fin fecha matriculación
        if (!empty($asesor->referencia))
        {
            $html= View::make('ReportesController.matricula_asesor_subsecretaria', array('asesor' => $asesor,'fechaactual'=>$fechaactual,'meses'=>$meses,'fechamatricula'=>$fechamatricula,'año_referencia'=>$año_referencia,'domicilio'=>$domicilio,'nombre_asesor'=>$nombre_asesor,'municipio'=>$municipio,'fecha_expedicion'=>$fecha_expedicion,'nombre_tipopersona'=>$nombre_tipopersona));
            return PDF::load($html, 'letter', 'portrait')->show();
        }else
        {
            return View::make('ReportesController.matriculado_error', array('mensaje_error'=>'No se generó el documento de Matricula por que no se cuenta con la referencia de pago'));

        }
    }

    public function reportecredencialAsesor($id){
        $asesor=Asesor::find($id);
        $nombre_asesor=$asesor['nombre_razon'].' '.$asesor['apellido_paterno'].' '.$asesor['apellido_materno'];
        $id_tipo_persona=$asesor['id_tipo_persona'];
        $tipo_persona=TipoPersona::find($id_tipo_persona);

        switch ($tipo_persona->descripcion_tipo_persona) {
            case 'FISICA':
                $nombre_tipopersona='ASESOR INMOBILIARIO ACREDITADO EN QUINTANA ROO';
                break;
            case 'MORAL':
                $nombre_tipopersona='EMPRESA INMOBILIARIA CON MATRÍCULA ESTATAL';
                break;
            case 'ASOCIACION INMOBILIARIA':
                $nombre_tipopersona='ASOCIACION INMOBILIARIA ACREDITADA EN QUINTANA ROO';
                break;
        }



        //Construyendo las fechas actual, matricula y vigencia
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fechaactual= "Chetumal Quintana Roo a".' '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            $fechamatricula='a los '.date("d",strtotime($asesor->fecha_matriculacion)).' días del mes de '
            .$meses[date("n",strtotime($asesor->fecha_matriculacion))-1].' del año '.date("Y",strtotime($asesor->fecha_matriculacion)).'.';
            $vigencia=''.date("d",strtotime($asesor->fecha_impresion)).' de '.$meses[date("n",strtotime($asesor->fecha_impresion))-1].' de '.((int)date("Y",strtotime($asesor->fecha_impresion))+1).'.';
        //Fin fechas...
            $fecha_expedicion='Se expide la presente a los '.date('d').' días del mes de '.$meses[date('n')-1].' del año '.date('Y').', en la ciudad de Chetumal, Quintana Roo.';
        if (!empty($asesor->referencia) && !empty($asesor->src))
        {
            $html= View::make('ReportesController.credencial_asesor', array('asesor' => $asesor,'fechaactual'=>$fechaactual,'meses'=>$meses,'fechamatricula'=>$fechamatricula,'tipopersona'=>$tipo_persona,'vigencia'=>$vigencia,'fecha_expedicion'=>$fecha_expedicion,'nombre_tipopersona'=>$nombre_tipopersona));
            return PDF::load($html, 'credencial')->show();
            //return $html;
        }else
        {

            return View::make('ReportesController.matriculado_error', array('mensaje_error'=>'No se generó la credencial de la Matricula por que no se cuenta con la referencia de pago o no cuenta con fotografía','target'=>'_self'));
        }
    }


    public function reporteacusereciboAsesor($id){
        $asesor=Asesor::find($id);
        $municipio=Municipio::find($asesor->cve_municipio);
        $nombre_asesor=$asesor['nombre_razon'].' '.$asesor['apellido_paterno'].' '.$asesor['apellido_materno'];
        $id_tipo_persona=$asesor['id_tipo_persona'];
        $tipo_persona=TipoPersona::find($id_tipo_persona);

        switch ($tipo_persona->descripcion_tipo_persona) {
            case 'FISICA':
                $nombre_tipopersona='Asesor Inmobiliario acreditado en Quintana Roo';
                break;
            case 'MORAL':
                $nombre_tipopersona='Empresa Inmobiliaria con Matrícula Estatal';
                break;
            case 'ASOCIACION INMOBILIARIA':
                $nombre_tipopersona='Empresa Inmobiliaria con Matrícula Estatal';
                break;
        }


        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fechaactual= "Chetumal Quintana Roo a".' '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        $año_referencia=date('Y');

        if (!empty($asesor->referencia))
        {
            $html= View::make('ReportesController.acuse_matricula_asesor', array('asesor' => $asesor,'fechaactual'=>$fechaactual,'nombre_asesor'=>$nombre_asesor,'nombre_tipopersona'=>$nombre_tipopersona));
            return PDF::load($html, 'letter', 'portrait')->show();
        }else
        {
            return View::make('ReportesController.matriculado_error', array('mensaje_error'=>'No se generó el documento de Acuse de Recibo por que no se cuenta con la referencia de pago'));

        }
    }


    public function reporterequisitosAsesor($id){
        $asesor=Asesor::find($id);
        $nombre_asesor=$asesor['nombre_razon'];
        $id_tipo_persona=$asesor['id_tipo_persona'];
        $tipopersona=TipoPersona::find($id_tipo_persona);
        $requisitos=$asesor->requisitos()->get();
        $x=array(); //vector con los id de requisitos entregados por el asesor (tabla pivote)
        foreach ($requisitos as $req)
        {
            array_push($x, $req->id_requisito);
        }
        $html= View::make('ReportesController.lista_requisitosasesor', array('asesor' => $asesor,'titulo_reporte'=>'RECEPCION DE DOCUMENTOS PARA INSCRIPCION A LA MATRICULA Y ACREDITACION COMO ASESOR INMOBILIARIO EN EL ESTADO DE QUINTANA ROO','contador'=>0,'requisitos'=>$requisitos,'tipopersona'=>$tipopersona,'x'=>$x));
        return PDF::load($html, 'letter', 'portrait')->show();
    }


    public function reporteRequisitos(){
        $requisitos=Requisito::all();

        $html= View::make('ReportesController.lista_requisitos', array('requisitos' => $requisitos,'titulo_reporte'=>'Listado de Requisitos para el Matriculado de Asesores Inmobiliarios'));
        return PDF::load($html, 'letter', 'portrait')->show();
    }


    public function reporteAsesores_municipio()
    {

        if (isset($_POST['_token']))
        {
            $rules = array
            (
                'cve_municipio' => 'required|min:1',

            );

            $messages = array
            (
                'cve_municipio.required' => 'El campo de municipio es requerido',
                'cve_municipio.min' => 'Debes seleccionar una opción del catálogo de municipios',

            );

            $validator = Validator::make(Input::All(), $rules, $messages);

            if ($validator->passes())
            {
                //recuperamos datos del formulario
                $cve_municipio = Input::get('cve_municipio');
                $asesores=Municipio::find($cve_municipio)->asesores;
                $municipio=Municipio::find($cve_municipio);
                $nombre_municipio=$municipio['nombre_municipio'];
                $html= View::make('ReportesController.lista_asesores_municipio', array('asesores' => $asesores,'titulo_reporte'=>'Reporte de asesores del Municipio '.$nombre_municipio));
                return PDF::load($html, 'letter', 'landscape')->show();
            }
            else
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }

        }
        $mensage=null;
        $municipios=Municipio::all();
        return View::make('ReportesController.asesores_municipio',array('mensage'=>$mensage,'municipios'=>$municipios));
    }


    public function reporteAsesores_municipio_referencia()
    {

        if (isset($_POST['_token']))
        {
            $rules = array
            (
                'cve_municipio' => 'required|min:1',
                'referencia_pago' => 'required|min:1',

            );

            $messages = array
            (
                'cve_municipio.required' => 'El campo de municipio es requerido',
                'cve_municipio.min' => 'Debes seleccionar una opción del catálogo de municipios',
                'referencia_pago.required' => 'El campo de referencia de pago es requerido',
                'referencia_pago.min' => 'Debes seleccionar una opción',

            );

            $validator = Validator::make(Input::All(), $rules, $messages);

            if ($validator->passes())
            {
                //recuperamos datos del formulario
                $cve_municipio = Input::get('cve_municipio');
                $referencia_pago = Input::get('referencia_pago');
                $municipio=Municipio::find($cve_municipio);
                $nombre_municipio=$municipio['nombre_municipio'];
                if ($referencia_pago==1)
                {
                    $asesores=Asesor::where("cve_municipio","LIKE",'%'.$cve_municipio.'%')->where("referencia",">","0")->get();
                    $titulo_reporte='Reporte de asesores del Municipio '.$nombre_municipio.' que ya pagaron su referencia';
                }
                if ($referencia_pago==2)
                {
                    $asesores=Asesor::where("cve_municipio","LIKE",'%'.$cve_municipio.'%')->where("referencia","="," ")->get();
                    $titulo_reporte='Reporte de asesores del Municipio '.$nombre_municipio.' que no han pagado su referencia';
                }


                $html= View::make('ReportesController.lista_asesores_municipio_referencia', array('asesores' => $asesores,'titulo_reporte'=>$titulo_reporte));
                return PDF::load($html, 'letter', 'landscape')->show();
            }
            else
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }

        }
        $mensage=null;
        $municipios=Municipio::all();
        return View::make('ReportesController.asesores_municipio_referencia',array('mensage'=>$mensage,'municipios'=>$municipios));
    }


    public function reporteAsesores_municipio_tipopersona()
    {

        if (isset($_POST['_token']))
        {
            $rules = array
            (
                'cve_municipio' => 'required|min:1',
                'id_tipo_persona' => 'required|min:1',

            );

            $messages = array
            (
                'cve_municipio.required' => 'El campo de municipio es requerido',
                'cve_municipio.min' => 'Debes seleccionar una opción del catálogo de municipios',
                'id_tipo_persona.required' => 'El campo de tipo de persona es requerido',
                'id_tipo_persona.min' => 'Debes seleccionar una opción del catálogo de tipos de persona',

            );

            $validator = Validator::make(Input::All(), $rules, $messages);

            if ($validator->passes())
            {
                //recuperamos datos del formulario
                $cve_municipio = Input::get('cve_municipio');
                $id_tipo_persona = Input::get('id_tipo_persona');
                $municipio=Municipio::find($cve_municipio);
                $nombre_municipio=$municipio['nombre_municipio'];
                $tipopersona=TipoPersona::find($id_tipo_persona);
                $nombre_tipopersona=$tipopersona['descripcion_tipo_persona'];

                $asesores=Asesor::where("cve_municipio","LIKE",'%'.$cve_municipio.'%')->where("id_tipo_persona","=",$id_tipo_persona)->get();
                $titulo_reporte='Reporte de asesores del Municipio '.$nombre_municipio.' y con razón social '.$nombre_tipopersona;

                $html= View::make('ReportesController.lista_asesores_municipio_tipopersona', array('asesores' => $asesores,'titulo_reporte'=>$titulo_reporte));
                return PDF::load($html, 'letter', 'landscape')->show();
            }
            else
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }

        }
        $mensage=null;
        $municipios=Municipio::all();
        $tipopersona=TipoPersona::all();
        return View::make('ReportesController.asesores_municipio_tipopersona',array('mensage'=>$mensage,'municipios'=>$municipios,'tipopersona'=>$tipopersona));
    }


    public function reporteAsesores_tipopersona()
    {

        if (isset($_POST['_token']))
        {
            $rules = array
            (
                'id_tipo_persona' => 'required|min:1',

            );

            $messages = array
            (
                'id_tipo_persona.required' => 'El campo de tipo de persona es requerido',
                'id_tipo_persona.min' => 'Debes seleccionar una opción del catálogo de tipo de personas',

            );

            $validator = Validator::make(Input::All(), $rules, $messages);

            if ($validator->passes())
            {
                //recuperamos datos del formulario
                $id_tipo_persona = Input::get('id_tipo_persona');
                $asesores=TipoPersona::find($id_tipo_persona)->asesores;
                $tipopersona=TipoPersona::find($id_tipo_persona);
                $nombre_tipopersona=$tipopersona['descripcion_tipo_persona'];
                $html= View::make('ReportesController.lista_asesores_tipopersona', array('asesores' => $asesores,'titulo_reporte'=>'Reporte de asesores del tipo de razón social '.$nombre_tipopersona));
                return PDF::load($html, 'letter', 'landscape')->show();
            }
            else
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }

        }
        $mensage=null;
        $tipopersonas=TipoPersona::all();
        return View::make('ReportesController.asesores_tipopersona',array('mensage'=>$mensage,'tipopersonas'=>$tipopersonas));
    }


    public function reporteAsesores(){
        $asesores=Asesor::orderBy("cve_municipio","asc")->get();
        $html= View::make('ReportesController.lista_asesores', array('asesores' => $asesores,'titulo_reporte'=>'Listado de Asesores'));
        return PDF::load($html, 'letter', 'landscape')->show();
    }

}

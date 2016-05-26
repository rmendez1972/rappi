<?php
class AsesoresController extends BaseController{
    public function mostrarAsesores(){

        if (isset($_GET['buscar']) && ($_GET['buscar']!="") )
        {
            $buscar=htmlspecialchars(Input::get("buscar"));
            $asesores=Asesor::where("nombre_razon","LIKE",'%'.$buscar.'%')->orwhere("apellido_paterno","LIKE",'%'.$buscar.'%')->orwhere("apellido_materno","LIKE",'%'.$buscar.'%')->orwhere("rfc","LIKE",'%'.$buscar.'%')->orwhere("colonia_region","LIKE",'%'.$buscar.'%')->orderBy("id","desc")->simplePaginate(1);
        }
        else
        {
            $asesores=Asesor::orderBy('nombre_razon')->orderBy('apellido_paterno')->orderBy('apellido_materno')->simplePaginate(10);
        }
        return View::make('asesores.lista')->withAsesores($asesores);
    }

    public function nuevo(){
        $tpersonas=TipoPersona::all();
        $municipios=Municipio::all();
        return View::make('asesores.nuevo', array('tipos_personas' => $tpersonas, 'municipios' => $municipios));
    }

    public function guardarNuevo(){
        $asesor=new Asesor();
        $asesor->nombre_razon=strtoupper(Input::get('nombre_razon'));
        $asesor->apellido_paterno=strtoupper(Input::get('apellido_paterno'));
        $asesor->apellido_materno=strtoupper(Input::get('apellido_materno'));
        $asesor->rfc=strtoupper(Input::get('rfc'));
        $asesor->id_tipo_persona=Input::get('id_tipo_persona');
        $asesor->cve_municipio=Input::get('cve_municipio');
        $asesor->colonia_region=strtoupper(Input::get('colonia_region'));
        $asesor->calle=strtoupper(Input::get('calle'));
        $asesor->manzana=Input::get('manzana');
        $asesor->numero_interior=Input::get('numero_interior');
        $asesor->numero_exterior_lote=Input::get('numero_exterior_lote');
        $asesor->codigo_postal=Input::get('codigo_postal');
        $asesor->telefono=Input::get('telefono');
        $asesor->celular=Input::get('celular');
        $asesor->email=Input::get('email');
        $asesor->doctos_faltantes=Input::get('doctos_faltantes');
        $asesor->fecha_impresion=Input::get('fecha_impresion');
        $asesor->afiliado=strtoupper(Input::get('afiliado'));
        $asesor->id_usuario=Auth::user()->get()->id;
        $asesor->referencia='';
        $asesor->matricula='';
        $asesor->localidad=strtoupper(Input::get('localidad'));
        $asesor->fecha_matriculacion=date('Y-m-d');
        $src = $_FILES['src']; //recuperamos imagen de variable global en formato vector

        if ($src["size"] >0 )
        {
            $ruta_imagen = "assets/imagenes/asesores/";
            //$imagen = rand(1000, 9999)."-".$src["name"];
            $imagen = $src["name"];
            //subimos la imagen a la ruta absoluta /public/assets/imagenes/asesores
            move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);
            $asesor->src=$ruta_imagen.$imagen;
        }else
        {
            $asesor->src='';
        }

        $asesor->save();

        $tipopersona=TipoPersona::find($asesor->id_tipo_persona);
        $tipos=array('', 'FS', 'MR', 'AI');
        $asesor->matricula=strtoupper($asesor->rfc.$tipos[$tipopersona->id_tipo_persona].$asesor->cve_municipio.$this->acompletarClave($asesor->id));

        $asesor->save();

        $requisitos=TipoPersona::find($asesor->id_tipo_persona)->requisitos()->get();
        foreach($requisitos as $req)
            if(Input::has('req'.$req->id_requisito))
                $asesor->requisitos()->attach($req->id_requisito);

        return Redirect::to('asesores');
    }

    public function acompletarClave($valor){
        $cadena="".$valor;
        while(strlen($cadena)<6)
            $cadena="0".$cadena;
        return $cadena;
    }

    public function editar($id){
        $asesor=Asesor::find($id);
        $tpersonas=TipoPersona::all();
        $municipios=Municipio::all();
        $requisitos=$asesor->requisitos()->get();
        return View::make('asesores.editar', array('asesor' => $asesor,'tipos_personas' => $tpersonas, 'municipios' => $municipios, 'requisitos' => $requisitos));
    }

    public function guardarEditar(){
        $asesor=Asesor::find(Input::get('id'));
        $asesor->nombre_razon=strtoupper(Input::get('nombre_razon'));
        $asesor->apellido_paterno=strtoupper(Input::get('apellido_paterno'));
        $asesor->apellido_materno=strtoupper(Input::get('apellido_materno'));
        $asesor->rfc=strtoupper(Input::get('rfc'));
        $asesor->id_tipo_persona=Input::get('id_tipo_persona');
        $asesor->cve_municipio=Input::get('cve_municipio');
        $asesor->colonia_region=strtoupper(Input::get('colonia_region'));
        $asesor->calle=strtoupper(Input::get('calle'));
        $asesor->manzana=Input::get('manzana');
        $asesor->numero_interior=Input::get('numero_interior');
        $asesor->numero_exterior_lote=Input::get('numero_exterior_lote');
        $asesor->codigo_postal=Input::get('codigo_postal');
        $asesor->telefono=Input::get('telefono');
        $asesor->celular=Input::get('celular');
        $asesor->email=Input::get('email');
        $asesor->doctos_faltantes=Input::get('doctos_faltantes');
        $asesor->fecha_impresion=Input::get('fecha_impresion');
        $asesor->afiliado=strtoupper(Input::get('afiliado'));
        $asesor->id_usuario=Auth::user()->get()->id;
        $asesor->referencia=Input::get('referencia');
        $asesor->localidad=strtoupper(Input::get('localidad'));

        $tipopersona=TipoPersona::find($asesor->id_tipo_persona);
        $tipos=array('', 'FS', 'MR', 'AI');
        $asesor->matricula=strtoupper($asesor->rfc.$tipos[$tipopersona->id_tipo_persona].$asesor->cve_municipio.$this->acompletarClave($asesor->id));

        //si la referencia no está vacía generamos el qr_code para el asesor
        if (!empty($asesor->referencia))
        {
            //salvamos la imagen
            //los parametros son, data, tipo de código, ancho, alto y un array con el color en formato rgb

                DNS2D::getBarcodePngPath('Secretaria_de_Desarrollo_Urbano_y_Vivienda_'.trim($asesor->matricula), "QRCODE", 7, 7, array(0,0,0));

            //echo "<img src='unodepiera.png' />";

        }

        $src = $_FILES['src']; //recuperamos imagen de variable global en formato vector

        if ($src["size"] >0 )
        {
            $ruta_imagen = "assets/imagenes/asesores/";
            //$imagen = rand(1000, 9999)."-".$src["name"];
            $imagen = $src["name"];
            //subimos la imagen a la ruta absoluta /public/assets/imagenes/asesores
            move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);
            $asesor->src=$ruta_imagen.$imagen;
        }else
        {
            //no hacemos nada y se queda la fotografía anterior
        }

        $asesor->save();



        $requisitos=TipoPersona::find($asesor->id_tipo_persona)->requisitos()->get();
        $asesor->requisitos()->detach();
        foreach($requisitos as $req)
            if(Input::has('req'.$req->id_requisito))
                $asesor->requisitos()->attach($req->id_requisito);

        return Redirect::to('asesores');
    }

    public function eliminar($id){
        $asesor=Asesor::find($id);
        return View::make('asesores.eliminar')->withAsesor($asesor);
    }


    public function eliminarAsesor(){
        Asesor::destroy(Input::get('id'));
        $mensaje = "<h3><label class='label label-info'>El Asesor ha sido eliminado con exito</label></h3>";
        return Redirect::route("asesores")->with('mensage', $mensaje);
    }

    public function listarCursos($id){
        if (isset($_POST['buscar']) && ($_POST['buscar']!="") )
        {
            $buscar=htmlspecialchars(Input::get("buscar"));
            $cursos=Asesor::find($id)->cursos()->where("descripcion","LIKE",'%'.$buscar.'%')->simplePaginate(3);

            $asesor=Asesor::find($id);
        }

        else
        {
             $asesor=Asesor::find($id);
             $cursos=Asesor::find($id)->cursos()->where("id_curso",">",'0')->orderBy("año","desc")->simplePaginate(5);


        }
        return View::make('Asesores.lista_cursosasesor', array('asesor' => $asesor,'cursos'=>$cursos,'contador'=>'0'));
    }

    public function nuevocursoAsesor($id)
    {

        if (isset($_POST['_token']))
        {
            $rules = array
            (
                'id_curso' => 'required|min:1',
            );

            $messages = array
            (
                'id_curso.required' => 'El campo descripción de curso es requerido',
                'id_curso.min' => 'Debes seleccionar una opción',


            );

            $validator = Validator::make(Input::All(), $rules, $messages);

            if ($validator->passes())
            {
                //Guardar los datos en la tabla pivote requisito_tipo_persona
                $id_usuario=Auth::user()->get()->id;
                $id=Input::get('id');  //id del asesor
                $id_curso=Input::get('id_curso');
                $asesor=Asesor::find($id);
                $curso=Curso::find($id_curso);
                $asesor->cursos()->attach($curso); //creamos relacion en pivote asesor_curso

                $mensage="<h3><label class='label label-info'>Curso agregado exitosamente  para el asesor </label><h3>";
                return Redirect::to('/asesores/listarcursos/'.$id)->with("mensage", $mensage);
            }
            else
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }

        }
        $mensage=null;
        $asesor=Asesor::find($id);
        $cursos_asesor=Asesor::find($id)->cursos()->get()->lists('id_curso');
        if (!empty($cursos_asesor) && is_array($cursos_asesor))
        {
            $cursos=Curso::select('id_curso','descripcion','año','id_usuario')->whereNotIn('id_curso',$cursos_asesor)->get();
        }else
        {
            $cursos=Curso::all();
        }
        return View::make('Asesores.nuevocurso_asesor',array('mensage'=>$mensage,'asesor'=>$asesor,'cursos'=>$cursos));
    }


    public function eliminarcurso($id_curso,$id){
        if (isset($_POST['_token']))
        {
            $id_user = Auth::user()->get()->id;

            if (!empty($id_user))
            {
                //eliminamos la relación de la tabla pivote asesor_curso
                $asesor=Asesor::find($id);
                $curso=Curso::find($id_curso);
                $asesor->cursos()->detach($curso);
                $mensage = "<h3><label class='label label-info'>El curso  $curso->descripcion para asesor $asesor->nombre_razon eliminado con éxito</label><h3>";
                return Redirect::to('/asesores/listarcursos/'.$id)->with('mensage', $mensage);
            }
            else
            {
                $mensage = "<h3><label class='label label-danger'>Ha ocurrido un error al intentar eliminar el tipo de persona con descripcion $tipopersona->descripcion_tipo_persona </label><h3>";
                return Redirect::route("usuarios")->with('mensage', $mensage);
            }
        }else
        {
            $asesor=Asesor::find($id);
            $curso=Curso::find($id_curso);
            return View::make('Asesores.eliminar_curso', array('asesor' => $asesor,'curso' => $curso));
        }
    }

}

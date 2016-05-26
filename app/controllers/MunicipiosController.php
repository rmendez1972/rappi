<?php
class MunicipiosController extends BaseController {
    public function mostrarMunicipios(){
        if (isset($_GET['buscar']) && ($_GET['buscar']!="") )
        {
            $buscar=htmlspecialchars(Input::get("buscar"));
            $municipios=Municipio::where("nombre_municipio","LIKE",'%'.$buscar.'%')->simplePaginate(1);
        }
        else
        {
            $municipios=Municipio::orderBy("cve_municipio")->simplePaginate(5);

        }
        return View::make('municipios.lista', array('municipios' => $municipios, 'titulo_reporte'=>'Listado de Municipios'));
    }


    public function nuevoMunicipio(){
        return View::make('municipios.crear');
    }

    public function crearMunicipio(){
        $id_usuario=Auth::user()->get()->id;
        $municipio=new Municipio;
        $municipio->cve_municipio=Input::get("cve_municipio");
        $municipio->nombre_municipio=Input::get("nombre_municipio");
        $municipio->id_usuario=$id_usuario;
        $municipio->save();
        //Municipio::create(Input::all());
        return Redirect::to('municipios');
    }


    public function editarMunicipio($id){
        $municipio=Municipio::find($id);
        return View::make('municipios.editar', array('municipio' => $municipio));
    }

    public function guardarMunicipio(){
        $id_usuario=Auth::user()->get()->id;
        $municipio=Municipio::find(Input::get("cve_municipio"));
        $municipio->nombre_municipio=Input::get("nombre_municipio");
        $municipio->id_usuario=$id_usuario;
        $municipio->save();
        return Redirect::to('municipios');
    }
    public function eliminarMunicipio($cve_municipio){
        if (isset($_POST['_token']))
        {
            $id_user = Auth::user()->get()->id;

            if (!empty($id_user))
            {
                //borramos el municipio
                $municipio=Municipio::find($cve_municipio);
                $nombre_municipio=$municipio->nombre_municipio;
                $municipio->delete();
                $mensage = "<h3><label class='label label-info'>El Municipio con nombre $nombre_municipio eliminado con exito</label></h3>";
                return Redirect::route("municipios")->with('mensage', $mensage);
            }
            else
            {
                $mensage = "<h3><label class='label label-danger'>Ha ocurrido un error al intentar eliminar el municipio</label></h3>";
                return Redirect::route("municipios")->with('mensage', $mensage);
            }
        }else
        {
            $municipio=Municipio::find($cve_municipio);
            return View::make('municipios.eliminar_municipios', array('municipio' => $municipio));
        }
    }

}

<?php
class RequisitosController extends BaseController {
    public function mostrarRequisitos(){
        if (isset($_GET['buscar']) && ($_GET['buscar']!="") )
        {
            $buscar=htmlspecialchars(Input::get("buscar"));
            $requisitos=Requisito::where("descripcion","LIKE",'%'.$buscar.'%')->simplePaginate(1);
        }
        else
        {
            $requisitos=Requisito::orderBy("id_requisito")->simplePaginate(5);

        }
        return View::make('requisitos.lista_requisitos', array('requisitos' => $requisitos));
    }

    public function porTipoPersona($id_tipo){
        $requisitos=TipoPersona::find($id_tipo)->requisitos()->get();
        return Response::json($requisitos);
    }


    public function nuevoRequisito()
    {

        if (isset($_POST['_token']))
        {
            $rules = array
            (
                'descripcion' => 'required|regex:/^[a-z0-9áéíóúñ\s\,\.]+$/i|min:5|max:300',
            );

            $messages = array
            (
                'descripcion.required' => 'El campo descripción del requisito es requerido',
                'descripcion.regex' => 'Sólo se aceptan letras y números',
                'descripcion.min' => 'El mínimo permitido son 5 caracteres',
                'descripcion.max' => 'El máximo permitido son 300 caracteres',

            );

            $validator = Validator::make(Input::All(), $rules, $messages);

            if ($validator->passes())
            {
                //Guardar los datos en el modelo requisito
                $id_usuario=Auth::user()->get()->id;
                $requisito=new Requisito;
                $requisito->descripcion=strtoupper(Input::get("descripcion"));
                $requisito->id_usuario=$id_usuario;
                $requisito->save();

                $mensage="<h3><label class='label label-info'>Requisito agregado exitosamente</label><h3>";
                return Redirect::route('requisitos')->with("mensage", $mensage);
            }
            else
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }

        }
        $mensage=null;
        return View::make('requisitos.crear_requisito',array('mensage'=>$mensage));
    }



    public function editarRequisito($id_requisito){
        $requisito=Requisito::find($id_requisito);
        return View::make('requisitos.editar_requisito', array('requisito' => $requisito));
    }

    public function guardarRequisito(){
        if (isset($_POST['_token']))
        {
            $rules = array
            (
                'descripcion' => 'required|regex:/^[a-z0-9áéíóúñ\s\,\.]+$/i|min:5|max:300',
            );

            $messages = array
            (
                'descripcion.required' => 'El campo descripcion de requisito es requerido',
                'descripcion.regex' => 'Sólo se aceptan letras y números',
                'descripcion.min' => 'El mínimo permitido son 5 caracteres',
                'descripcion.max' => 'El máximo permitido son 300 caracteres',

            );

            $validator = Validator::make(Input::All(), $rules, $messages);

            if ($validator->passes())
            {
                //recuperamos el id de usuario que hace la actualización
                $id_usuario=Auth::user()->get()->id;
                //recuperamos los datos del formulario
                $id_requisito=Input::get("id_requisito");
                $descripcion = strtoupper(Input::get("descripcion"));

                $requisito=Requisito::find($id_requisito);
                $requisito->descripcion=$descripcion;
                $requisito->id_usuario=$id_usuario;
                $requisito->save();

                $mensage="<h3><label class='label label-info'>Requisito modificado exitosamente</label><h3>";
                return Redirect::route('requisitos')->with("mensage", $mensage);

            }
            else
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }

        }

    }
    public function eliminarRequisito($id_requisito){
        if (isset($_POST['_token']))
        {
            $id_user = Auth::user()->get()->id;

            if (!empty($id_user))
            {
                //borramos el requisito
                $requisito=Requisito::find($id_requisito);
                $nombre_requisito=$requisito->descripcion;
                $requisito->delete();
                $mensage = "<h3><label class='label label-info'>El Requisito con descripcion $nombre_requisito eliminado con exito</label></h3>";
                return Redirect::route("requisitos")->with('mensage', $mensage);
            }
            else
            {
                $mensage = "<h3><label class='label label-danger'>Ha ocurrido un error al intentar eliminar el requisito</label></h3>";
                return Redirect::route("requisitos")->with('mensage', $mensage);
            }
        }else
        {
            $requisito=Requisito::find($id_requisito);
            return View::make('requisitos.eliminar_requisito', array('requisito' => $requisito));
        }
    }

}
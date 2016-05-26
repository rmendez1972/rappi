<?php

class CursoController extends BaseController {

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

	public function mostrarCurso(){
        if (isset($_GET['buscar']) && ($_GET['buscar']!=""))
        {
            $buscar=htmlspecialchars(Input::get("buscar"));
            $curso=Curso::where("descripcion","LIKE",'%'.$buscar.'%')->orderBy("descripcion","asc")->simplePaginate(1);
        }else
        {
            $curso=Curso::orderBy("año","desc")->simplePaginate(5);

        }
        return View::make('Cursos.lista_curso', array('curso' => $curso,'titulo_reporte'=>'Listado de Cursos de capacitación'));
    }




	public function nuevo()
	{

		if (isset($_POST['_token']))
		{
			$rules = array
		    (
		    	'descripcion' => 'required|regex:/^[a-z0-9áéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:80',
		    	'año' => 'required|regex:/^[0-9]+$/i|min:4',
		    );

		    $messages = array
		    (
		        'descripcion.required' => 'El campo descripción de curso es requerido',
		        'descripcion.regex' => 'Sólo se aceptan letras y números',
		        'descripcion.min' => 'El mínimo permitido son 3 caracteres',
		        'descripcion.max' => 'El máximo permitido son 80 caracteres',
		        'año.required' => 'El campo año de curso es requerido',
		        'año.regex' => 'Sólo se aceptan números',
		        'año.min' => 'El formato del año es a 4 digitos (ej. 2015)'

		    );

		    $validator = Validator::make(Input::All(), $rules, $messages);

		    if ($validator->passes())
		    {
		        //Guardar los datos en el modelo TipoPersona
		        $id_usuario=Auth::user()->get()->id;
		        $curso=new Curso;
		        $curso->descripcion=strtoupper(Input::get("descripcion"));
		        $curso->año=Input::get("año");
		        $curso->id_usuario=$id_usuario;
		        $curso->save();

		        $mensage="<h3><label class='label label-info'>Curso agregado exitosamente</label><h3>";
		        return Redirect::route('cursos')->with("mensage", $mensage);
		    }
		    else
		    {
		        return Redirect::back()->withInput()->withErrors($validator);
		    }

		}
		$mensage=null;
		return View::make('Cursos.nuevo_curso',array('mensage'=>$mensage));
	}

	public function editarCurso($id_curso){
        $curso=Curso::find($id_curso);
        return View::make('Cursos.editar_curso', array('curso' => $curso));
    }

    public function guardarCurso(){
    	if (isset($_POST['_token']))
		{
			$rules = array
		    (
		    	'descripcion' => 'required|regex:/^[a-z0-9áéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:80',
		    	'año' => 'required|regex:/^[0-9]+$/i|min:4',
		    );

		    $messages = array
		    (
		        'descripcion.required' => 'El campo descripción de curso es requerido',
		        'descripcion.regex' => 'Sólo se aceptan letras y números',
		        'descripcion.min' => 'El mínimo permitido son 3 caracteres',
		        'descripcion.max' => 'El máximo permitido son 80 caracteres',
		        'año.required' => 'El campo año de curso es requerido',
		        'año.regex' => 'Sólo se aceptan números',
		        'año.min' => 'El formato del año es a 4 digitos (ej. 2015)'

		    );

		    $validator = Validator::make(Input::All(), $rules, $messages);

		    if ($validator->passes())
		    {
		        //recuperamos el id de usuario que hace la actualización
		        $id_usuario=Auth::user()->get()->id;
		        //recuperamos los datos del formulario
		        $id_curso=Input::get("id_curso");
		        $descripcion = strtoupper(Input::get("descripcion"));
		        $año = Input::get("año");

		        $curso=Curso::find($id_curso);
		        $curso->descripcion=$descripcion;
		        $curso->año=$año;
			    $curso->id_usuario=$id_usuario;
			    $curso->save();

		        $mensage="<h3><label class='label label-info'>Curso modificado exitosamente</label><h3>";
		        return Redirect::route('cursos')->with("mensage", $mensage);

		    }
		    else
		    {
		        return Redirect::back()->withInput()->withErrors($validator);
		    }

		}

    }

    public function eliminarCurso($id_curso){
    	if (isset($_POST['_token']))
		{
			$id_user = Auth::user()->get()->id;

		    if (!empty($id_user))
		    {
				//borramos el curso del modelo
		        $curso=Curso::find($id_curso);
		        $curso->delete();
		        $mensage = "<h3><label class='label label-info'>El curso con descripcion $curso->descripcion eliminado con éxito</label><h3>";
		        return Redirect::route("cursos")->with('mensage', $mensage);
		    }
		    else
		    {
		        $mensage = "<h3><label class='label label-danger'>Ha ocurrido un error al intentar eliminar el curso con descripcion $curso->descripcion </label><h3>";
		        return Redirect::route("cursos")->with('mensage', $mensage);
		    }
		}else
        {
        	$curso=Curso::find($id_curso);
        	return View::make('Cursos.eliminar_curso', array('curso' => $curso));
        }
    }



}

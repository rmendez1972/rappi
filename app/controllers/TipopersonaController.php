<?php

class TipopersonaController extends BaseController {

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

	public function mostrarTipopersona(){
        if (isset($_GET['buscar']) && ($_GET['buscar']!="") )
        {
            $buscar=htmlspecialchars(Input::get("buscar"));
            $tipo_persona=TipoPersona::where("descripcion_tipo_persona","LIKE",'%'.$buscar.'%')->orderBy("id_tipo_persona","desc")->simplePaginate(1);
        }
        else
        {
            $tipo_persona=TipoPersona::orderBy("id_tipo_persona","desc")->simplePaginate(3);

        }
        return View::make('Tipo_persona.lista_tipo_persona', array('tipo_persona' => $tipo_persona,'titulo_reporte'=>'Listado de Tipos de Personas'));
    }


    public function listarrequisitosTipopersona($id_tipo_persona){
        if (isset($_POST['buscar']) && ($_POST['buscar']!="") )
        {
            $buscar=htmlspecialchars(Input::get("buscar"));
            $requisitos=TipoPersona::find($id_tipo_persona)->requisitos()->where("descripcion","LIKE",'%'.$buscar.'%')->simplePaginate(3);

            $tipopersona=TipoPersona::find($id_tipo_persona);

        }
        else
        {
             $tipopersona=TipoPersona::find($id_tipo_persona);
             $requisitos=TipoPersona::find($id_tipo_persona)->requisitos()->where("id_requisito",">",'0')->simplePaginate(5);


        }
        return View::make('Tipo_persona.lista_requisitostipo_persona', array('tipopersona' => $tipopersona,'requisitos'=>$requisitos,'contador'=>'0'));
    }



    public function nuevorequisitoTipopersona($id_tipo_persona)
	{

		if (isset($_POST['_token']))
		{
			$rules = array
		    (
		    	'id_requisito' => 'required|min:1',
		    );

		    $messages = array
		    (
		        'id_requisito.required' => 'El campo descripción de requisito es requerido',
		        'id_requisito.min' => 'Debes seleccionar una opción',


		    );

		    $validator = Validator::make(Input::All(), $rules, $messages);

		    if ($validator->passes())
		    {
		        //Guardar los datos en la tabla pivote requisito_tipo_persona
		        $id_usuario=Auth::user()->get()->id;
		        $id_tipo_persona=Input::get('id_tipo_persona');
		        $id_requisito=Input::get('id_requisito');
		        $tipopersona=TipoPersona::find($id_tipo_persona);
			    $requisito=Requisito::find($id_requisito);
			    $tipopersona->requisitos()->attach($requisito);

		        $mensage="<h3><label class='label label-info'>Requisito agregado exitosamente para este tipo de persona</label><h3>";
		        return Redirect::to('/tipo_persona/listarrequisitos/'.$id_tipo_persona)->with("mensage", $mensage);
		    }
		    else
		    {
		        return Redirect::back()->withInput()->withErrors($validator);
		    }

		}
		$mensage=null;
		$tipopersona=TipoPersona::find($id_tipo_persona);
		$requisitos_tipo_persona=TipoPersona::find($id_tipo_persona)->requisitos()->get()->lists('id_requisito');
		if (!empty($requisitos_tipo_persona) && is_array($requisitos_tipo_persona))
		{
			$requisitos=Requisito::select('id_requisito','descripcion','id_usuario')->whereNotIn('id_requisito',$requisitos_tipo_persona)->get();
		}else
		{
			$requisitos=Requisito::all();
		}
		return View::make('Tipo_persona.nuevorequisito_tipo_persona',array('mensage'=>$mensage,'tipopersona'=>$tipopersona,'requisitos'=>$requisitos));
	}

	public function nuevo()
	{

		if (isset($_POST['_token']))
		{
			$rules = array
		    (
		    	'descripcion_tipo_persona' => 'required|regex:/^[a-záéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:80',
		    );

		    $messages = array
		    (
		        'descripcion_tipo_persona.required' => 'El campo descripción de tipo de persona es requerido',
		        'descripcion_tipo_persona.regex' => 'Sólo se aceptan letras',
		        'descripcion_tipo_persona.min' => 'El mínimo permitido son 3 caracteres',
		        'descripcion_tipo_persona.max' => 'El máximo permitido son 80 caracteres',

		    );

		    $validator = Validator::make(Input::All(), $rules, $messages);

		    if ($validator->passes())
		    {
		        //Guardar los datos en el modelo TipoPersona
		        $id_usuario=Auth::user()->get()->id;
		        $tipopersona=new TipoPersona;
		        $tipopersona->descripcion_tipo_persona=strtoupper(Input::get("descripcion_tipo_persona"));
		        $tipopersona->id_usuario=$id_usuario;
		        $tipopersona->save();

		        $mensage="<h3><label class='label label-info'>Tipo de persona agregado exitosamente</label><h3>";
		        return Redirect::route('tipo_persona')->with("mensage", $mensage);
		    }
		    else
		    {
		        return Redirect::back()->withInput()->withErrors($validator);
		    }

		}
		$mensage=null;
		return View::make('Tipo_persona.nuevo_tipo_persona',array('mensage'=>$mensage));
	}

	public function editarTipopersona($id_tipo_persona){
        $tipopersona=TipoPersona::find($id_tipo_persona);
        return View::make('Tipo_persona.editar_tipopersona', array('tipopersona' => $tipopersona));
    }

    public function guardarTipopersona(){
    	if (isset($_POST['_token']))
		{
			$rules = array
		    (
		    	'descripcion_tipo_persona' => 'required|regex:/^[a-záéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:80',
		    );

		    $messages = array
		    (
		        'descripcion_tipo_persona.required' => 'El campo descripcion de tipo de persona es requerido',
		        'descripcion_tipo_persona.regex' => 'Sólo se aceptan letras',
		        'descripcion_tipo_persona.min' => 'El mínimo permitido son 3 caracteres',
		        'descripcion_tipo_persona.max' => 'El máximo permitido son 80 caracteres',

		    );

		    $validator = Validator::make(Input::All(), $rules, $messages);

		    if ($validator->passes())
		    {
		        //recuperamos el id de usuario que hace la actualización
		        $id_usuario=Auth::user()->get()->id;
		        //recuperamos los datos del formulario
		        $id_tipo_persona=Input::get("id_tipo_persona");
		        $descripcion_tipo_persona = strtoupper(Input::get("descripcion_tipo_persona"));

		        $tipopersona=TipoPersona::find($id_tipo_persona);
		        $tipopersona->descripcion_tipo_persona=$descripcion_tipo_persona;
			    $tipopersona->id_usuario=$id_usuario;
			    $tipopersona->save();

		        $mensage="<h3><label class='label label-info'>Tipo de persona modificado exitosamente</label><h3>";
		        return Redirect::route('tipo_persona')->with("mensage", $mensage);

		    }
		    else
		    {
		        return Redirect::back()->withInput()->withErrors($validator);
		    }

		}

    }

    public function eliminarTipopersona($id_tipo_persona){
    	if (isset($_POST['_token']))
		{
			$id_user = Auth::user()->get()->id;

		    if (!empty($id_user))
		    {
				//borramos el tipo de persona del modelo
		        $tipopersona=TipoPersona::find($id_tipo_persona);
		        $tipopersona->delete();
		        $mensage = "<h3><label class='label label-info'>El tipo de persona con descripcion $tipopersona->descripcion_tipo_persona eliminado con éxito</label><h3>";
		        return Redirect::route("tipo_persona")->with('mensage', $mensage);
		    }
		    else
		    {
		        $mensage = "<h3><label class='label label-danger'>Ha ocurrido un error al intentar eliminar el tipo de persona con descripcion $tipopersona->descripcion_tipo_persona </label><h3>";
		        return Redirect::route("usuarios")->with('mensage', $mensage);
		    }
		}else
        {
        	$tipopersona=TipoPersona::find($id_tipo_persona);
        	return View::make('Tipo_persona.eliminar_tipopersona', array('tipopersona' => $tipopersona));
        }
    }

    public function eliminarrequisitoTipopersona($id_requisito,$id_tipo_persona){
    	if (isset($_POST['_token']))
		{
			$id_user = Auth::user()->get()->id;

		    if (!empty($id_user))
		    {
				//eliminamos la relación de la tabla pivote requisito_tipopersona
		        $tipopersona=TipoPersona::find($id_tipo_persona);
		        $requisito=Requisito::find($id_requisito);
		        $tipopersona->requisitos()->detach($requisito);
		        $mensage = "<h3><label class='label label-info'>El requisito  $requisito->descripcion para el tipo de persona $tipopersona->descripcion_tipo_persona eliminado con éxito</label><h3>";
		        return Redirect::to('/tipo_persona/listarrequisitos/'.$id_tipo_persona)->with('mensage', $mensage);
		    }
		    else
		    {
		        $mensage = "<h3><label class='label label-danger'>Ha ocurrido un error al intentar eliminar el tipo de persona con descripcion $tipopersona->descripcion_tipo_persona </label><h3>";
		        return Redirect::route("usuarios")->with('mensage', $mensage);
		    }
		}else
        {
        	$tipopersona=TipoPersona::find($id_tipo_persona);
        	$requisito=Requisito::find($id_requisito);
        	return View::make('Tipo_persona.eliminar_requisitotipopersona', array('tipopersona' => $tipopersona,'requisito' => $requisito));
        }
    }


	public function salir()
	{
		Auth::user()->logout();
		return Redirect::to('login');
	}

	public function contacto()
	{
		$mensaje=null;
		if (isset($_POST['contacto']))
		{
			$rules=array(
				'name'=> 'required|min:3|max:80|regex:/^[a-záéóúaeiouñ\s]+$/i',
				'email'=> 'required|email|between:3,80',
				'subject'=> 'required|regex:/^[a-z0-9áéóúaeiouñ\s]+$/i|min:3|max:80',
				'msg'=> 'required|between:3,500',
			);

			$messages=array(
				'name.required'=> 'El nombre es obligatorio',
				'name.min'=> 'El nombre dede ser min. de 3 letras',
				'name.max'=> 'El nombre debe ser max. de 80 letras',
				'name.regex'=> 'El nombre solo acepta letras',
				'email.required'=> 'El email es obligatorio',
				'email.email'=> 'El email dede tener @',
				'email.between'=> 'El email tener entre 3 y 80 letras',
				'subject.required'=> 'El subject es obligatorio',
				'subject.min'=> 'El subject dede ser min. de 3 letras',
				'subject.max'=> 'El subject debe ser max. de 80 letras',
				'subject.regex'=> 'El subject debe ser de letras',
				'msg.required'=> 'El msg es obligatorio',
				);
			$validador= Validator::make(Input::All(), $rules, $messages);
			if ($validador->passes())
			{
				$data=array(
					'name'=>Input::get('name'),
					'email'=>Input::get('email'),
					'subject'=>Input::get('subject'),
					'msg'=>Input::get('msg')
				);
				$fromEmail='soporte@soporteorganizacional.com.mx';
				$fromName='Rafael Méndez';
				Mail::send('emails.contacto',$data,function($message) use ($fromName,$fromEmail)
				{
					$message->to($fromEmail,$fromName);
					$message->from('rmendez1972@hotmail.com','Rafael Mendez Asencio');
					$message->subject('Email de prueba desde laravel');
				});
				$mensaje="<div class='text-info'>Correo enviado con éxito</div>";
			}
			else{

				return Redirect::back()->withInput()->withErrors($validador);
			}

		}
		return View::make('HomeController.contacto',array('mensaje'=>$mensaje));
	}
}

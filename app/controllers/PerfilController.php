<?php

class PerfilController extends BaseController {

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



	public function editarPerfil($id){
        $usuario=Usuario::find($id);
        return View::make('PerfilController.editar_usuarios', array('usuario' => $usuario));
    }

    public function guardarPerfil(){
    	if (isset($_POST['_token']))
		{
			$rules = array
		    (
			    'email' => 'required|email|between:3,80',
			    'password' => 'required|regex:/^[a-z0-9]+$/i|min:8|max:16',
			    'repetir_password' => 'required|same:password',
			    "src" => "max:10000", //10000 kb
		    );

		    $messages = array
		    (
		        'email.required' => 'El campo email es requerido',
		        'email.email' => 'El formato de email es incorrecto',
		        'email.between' => 'El email debe contener entre 3 y 80 caracteres',
		        'password.required' => 'El campo password es requerido',
		        'password.regex' => 'El campo password sólo acepta letras y números',
		        'password.min' => 'El mínimo permitido son 8 caracteres',
		        'password.max' => 'El máximo permitido son 16 caracteres',
		        //"src.required" => "Es requerido subir una imagen",
		        "src.max" => "El tamaño máximo de la imagen son 10000kb",
		        //"src.mimes" => "El archivo que pretendes subir debe ser tipo .jpg/.png/.gif/.svg",
		        'repetir_password.required' => 'El campo repetir password es requerido',
		        'repetir_password.same' => 'Los passwords no coinciden',

		    );

		    $validator = Validator::make(Input::All(), $rules, $messages);

		    if ($validator->passes())
		    {
		        //Guardar los datos en la tabla usuarios
		        $id_usuario=Auth::user()->get()->id;
		        $id = Input::get("id");
		        $email = Input::get("email");
		        $password = Hash::make(Input::get("password"));
		        $src = $_FILES['src']; //recuperamos imagen de variable global en formato vector

		        //actualizando en el modelo Usuarios
		        $usuarios=Usuario::find($id);

		        if ($src["size"] >0 )
		        {
		        	$ruta_imagen = "assets/imagenes/avatars/";
            		//$imagen = rand(1000, 9999)."-".$src["name"];
            		$imagen = $src["name"];
					//subimos la imagen a la ruta /public/assets/imagenes/avatars
					move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);

					$usuarios->email=$email;
			        $usuarios->password=$password;
			        $usuarios->src=$ruta_imagen.$imagen;
		        }else
		        {
		        	$usuarios->email=$email;
			        $usuarios->password=$password;
			    }
		        $usuarios->save();
		        $usuario=Usuario::find($id);
		        $mensage = "<h3><label class='label label-info'>Perfil de Usuario modificado exitosamente</label></h3>";
		        return Redirect::route('index');

		    }
		    else
		    {
		        return Redirect::back()->withInput()->withErrors($validator);
		    }

		}

    }


}

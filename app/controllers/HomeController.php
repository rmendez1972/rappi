<?php

class HomeController extends BaseController {

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



	public function index()
	{

		return View::make('HomeController.index');
	}

	public function login()
	{

		return View::make('HomeController.login');
	}

	/**
	 * [privado description]
	 * @return [type]
	 */
	public function privado()
	{

		return View::make('HomeController.privado');
	}

	public function mostrarUsuarios(){
        if (isset($_GET['buscar']) && ($_GET['buscar']!="") )
        {
            $buscar=htmlspecialchars(Input::get("buscar"));
            $usuarios=Usuario::where("nombre_usuario","LIKE",'%'.$buscar.'%')->orwhere("usuario","LIKE",'%'.$buscar.'%')->orderBy("id","desc")->simplePaginate(1);
        }
        else
        {
            $usuarios=Usuario::orderBy("id","desc")->simplePaginate(2);


        }

        return View::make('HomeController.lista_usuarios', array('usuarios' => $usuarios));
    }

	public function register()
	{

		if (isset($_POST['_token']))
		{
			$rules = array
		    (
		    'nombre_usuario' => 'required|regex:/^[a-záéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:80',
		    'usuario' => 'required|unique:usuarios|regex:/^[a-z0-9áéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:20',
		    'email' => 'required|email|unique:usuarios|between:3,80',
		    'password' => 'required|regex:/^[a-z0-9]+$/i|min:8|max:16',
		    'nivel_acceso' => 'required|regex:/^[0-9]+$/i|min:1|max:2',
		    'repetir_password' => 'required|same:password',
		    "src" => "required|max:10000|mimes:jpg,jpeg,png,gif,svg", //10000 kb
		    'terminos' => 'required',
		    );

		    $messages = array
		    (
		        'nombre_usuario.required' => 'El campo nombre de usuario es requerido',
		        'nombre_usuario.regex' => 'Sólo se aceptan letras y números',
		        'nombre_usuario.min' => 'El mínimo permitido son 3 caracteres',
		        'nombre_usuario.max' => 'El máximo permitido son 80 caracteres',
		        'usuario.required' => 'El campo nombre es requerido',
		        'usuario.regex' => 'Sólo se aceptan letras',
		        'usuario.min' => 'El mínimo permitido son 3 caracteres',
		        'usuario.max' => 'El máximo permitido son 20 caracteres',
		        'usuario.unique' => 'El usuario ya se encuentra registrado',
		        'email.required' => 'El campo email es requerido',
		        'email.email' => 'El formato de email es incorrecto',
		        'email.unique' => 'El email ya se encuentra registrado',
		        'email.between' => 'El email debe contener entre 3 y 80 caracteres',
		        'password.required' => 'El campo password es requerido',
		        'password.regex' => 'El campo password sólo acepta letras y números',
		        'password.min' => 'El mínimo permitido son 8 caracteres',
		        'password.max' => 'El máximo permitido son 16 caracteres',
		        'nivel_acceso.required' => 'El campo nivel de acceso es requerido',
		        'nivel_acceso.regex' => 'Sólo se aceptan  números',
		        'nivel_acceso.min' => 'El mínimo permitido es 1 digito',
		        'nivel_acceso.max' => 'El máximo permitido son 2 digitos',
		        'repetir_password.required' => 'El campo repetir password es requerido',
		        'repetir_password.same' => 'Los passwords no coinciden',
		        "src.required" => "Es requerido subir una imagen",
		        "src.max" => "El tamaño máximo de la imagen son 10000kb",
		        "src.mimes" => "El archivo que pretendes subir debe ser tipo .jpg/.png/.gif/.svg",
		        'terminos.required' => 'Tienes que aceptar los términos',
		    );

		    $validator = Validator::make(Input::All(), $rules, $messages);

		    if ($validator->passes())
		    {
		        //Guardar los datos en la tabla usuarios
		        $nombre_usuario = input::get('nombre_usuario');
		        $user = input::get('usuario');
		        $email = input::get('email');
		        $password = Hash::make(input::get('password'));
		        $nivel_acceso =  input::get('nivel_acceso');
		        $src = $_FILES['src']; //recuperamos imagen de variable global en formato vector

		        $ruta_imagen = "assets/imagenes/avatars/";
            	//$imagen = rand(1000, 9999)."-".$src["name"];
            	$imagen = $src["name"];
				//subimos la imagen a la ruta /public/assets/imagenes/avatars
				move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);


		        $conn = DB::connection('mysql');
		        $sql = "INSERT INTO usuarios(nombre_usuario,usuario, email, password, nivel_acceso,active,src) VALUES (?, ?, ?, ?, ?, ?, ?)";
		        $conn->insert($sql, array($nombre_usuario,$user, $email, $password, $nivel_acceso,1,$ruta_imagen.$imagen));


		        $mensage = "<h3><label class='label label-info'>Usuario registrado exitosamente</label></h3>";
		        return Redirect::route('usuarios')->with("mensage", $mensage);
		        //return View::make('HomeController.register',array('mensage'=>$mensage));
		    }
		    else
		    {
		        return Redirect::back()->withInput()->withErrors($validator);
		    }

		}
		$mensage=null;
		return View::make('HomeController.register',array('mensage'=>$mensage));
	}

	public function editarUsuarios($id){
        $usuario=Usuario::find($id);
        return View::make('HomeController.editar_usuarios', array('usuario' => $usuario));
    }

    public function guardarUsuarios(){
    	if (isset($_POST['_token']))
		{
			$rules = array
		    (
		    'nombre_usuario' => 'required|regex:/^[a-záéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:80',
		    'usuario' => 'required|regex:/^[a-z0-9áéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:20',
		    'email' => 'required|email|between:3,80',
		    'password' => 'required|regex:/^[a-z0-9]+$/i|min:8|max:16',
		    'nivel_acceso' => 'required|regex:/^[0-9]+$/i|min:1|max:2',
		    "src" => "max:10000", //10000 kb
		    'repetir_password' => 'required|same:password',

		    );

		    $messages = array
		    (
		        'nombre_usuario.required' => 'El campo nombre de usuario es requerido',
		        'nombre_usuario.regex' => 'Sólo se aceptan letras y números',
		        'nombre_usuario.min' => 'El mínimo permitido son 3 caracteres',
		        'nombre_usuario.max' => 'El máximo permitido son 80 caracteres',
		        'usuario.required' => 'El campo nombre es requerido',
		        'usuario.regex' => 'Sólo se aceptan letras',
		        'usuario.min' => 'El mínimo permitido son 3 caracteres',
		        'usuario.max' => 'El máximo permitido son 20 caracteres',
		        'email.required' => 'El campo email es requerido',
		        'email.email' => 'El formato de email es incorrecto',
		        'email.between' => 'El email debe contener entre 3 y 80 caracteres',
		        'password.required' => 'El campo password es requerido',
		        'password.regex' => 'El campo password sólo acepta letras y números',
		        'password.min' => 'El mínimo permitido son 8 caracteres',
		        'password.max' => 'El máximo permitido son 16 caracteres',
		        'nivel_acceso.required' => 'El campo nivel de acceso es requerido',
		        'nivel_acceso.regex' => 'Sólo se aceptan  números',
		        'nivel_acceso.min' => 'El mínimo permitido es 1 digito',
		        'nivel_acceso.max' => 'El máximo permitido son 2 digitos',
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
		        $id = Input::get("id");
		        $nombre_usuario = Input::get("nombre_usuario");
		        $user = Input::get("usuario");
		        $email = Input::get("email");
		        $password = Hash::make(Input::get("password"));
		        $nivel_acceso =  Input::get('nivel_acceso');
		        $src = $_FILES['src']; //recuperamos imagen de variable global en formato vector

		        //grabando en el modelo Usuarios
		        $usuarios=Usuario::find($id);

		        if ($src["size"] >0 )
		        {
		        	$ruta_imagen = "assets/imagenes/avatars/";
            		//$imagen = rand(1000, 9999)."-".$src["name"];
            		$imagen = $src["name"];
					//subimos la imagen a la ruta /public/assets/imagenes/avatars
					move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);

					$usuarios->nombre_usuario=$nombre_usuario;
			        $usuarios->usuario=$user;
			        $usuarios->email=$email;
			        $usuarios->password=$password;
			        $usuarios->nivel_acceso=$nivel_acceso;
			        $usuarios->src=$ruta_imagen.$imagen;
		        }else
		        {
		        	$usuarios->nombre_usuario=$nombre_usuario;
			        $usuarios->usuario=$user;
			        $usuarios->email=$email;
			        $usuarios->password=$password;
			        $usuarios->nivel_acceso=$nivel_acceso;
			        //$usuarios->src=$ruta_imagen.$imagen;
		        }
		        $usuarios->save();

		        $mensage = "<h3><label class='label label-info'>Usuario modificado exitosamente</label></h3>";
		        return Redirect::route('usuarios')->with("mensage", $mensage);

		    }
		    else
		    {
		        return Redirect::back()->withInput()->withErrors($validator);
		    }

		}

    }

    public function eliminarUsuarios($id){
    	if (isset($_POST['_token']))
		{
			$id_user = Auth::user()->get()->id;

		    if (!empty($id_user))
		    {
				//borramos el usuario
		        $usuario=Usuario::find($id);
		        $usuario->delete();
		        $mensage = "<h3><label class='label label-info'>El usuario con id $id eliminado con exito</label></h3>";
		        return Redirect::route("usuarios")->with('mensage', $mensage);
		    }
		    else
		    {
		        $mensage = "<h3><label class='label label-danger'>Ha ocurrido un error al intentar eliminar el usuario con id $id</label></h3>";
		        return Redirect::route("usuarios")->with('mensage', $mensage);
		    }
		}else
        {
        	$usuario=Usuario::find($id);
        	return View::make('HomeController.eliminar_usuarios', array('usuario' => $usuario));
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

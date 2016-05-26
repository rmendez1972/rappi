<?php
class CuboController extends BaseController {

    /**
     * Mustra la lista con todos los usuarios
     */
    private $cubo;
    private $sum;

    public function index()
    {
        if (isset($_POST['_token']))
        {
            $rules = array
            (
            /*'nombre_usuario' => 'required|regex:/^[a-záéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:80',
            'usuario' => 'required|unique:usuarios|regex:/^[a-z0-9áéóóúàèìòùäëïöüñ\s]+$/i|min:3|max:20',
            'email' => 'required|email|unique:usuarios|between:3,80',
            'password' => 'required|regex:/^[a-z0-9]+$/i|min:8|max:16',
            'nivel_acceso' => 'required|regex:/^[0-9]+$/i|min:1|max:2',
            'repetir_password' => 'required|same:password',
            "src" => "required|max:10000|mimes:jpg,jpeg,png,gif,svg", //10000 kb
            'terminos' => 'required',*/
            );

            $messages = array
            (
                /*'nombre_usuario.required' => 'El campo nombre de usuario es requerido',
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
                'terminos.required' => 'Tienes que aceptar los términos',*/
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
        return View::make('CuboController.index',array('mensage'=>$mensage));

    }

    public function inicializar()
    {
        $x=1;
        $y=1;
        $z=1;
        $fx=4;
        $fy=4;
        $fz=4;
        for($x=1;$x<$fx;$x++)
        {
            for($y=1;$y<$fy;$y++){

                for($z=1;$z<$fz;$z++)
                {
                    $this->cubo[$x][$y][$z]=0;

                }

            }

        }

    }


    public function getcubo(){

        return $this->cubo;
    }

    public function setcubo($x,$y,$z,$w)
    {
        $this->cubo[$x][$y][$z]=$w;

    }

    public function update($x,$y,$z,$w)
    {
        $this->cubo[$x][$y][$z]=$w;

    }
    public function query($i,$f){
        $this->sum=0;

        $x=$i[0];
        $y=$i[1];
        $z=$i[2];
        $fx=$f[0];
        $fy=$f[1];
        $fz=$f[2];

        for($x=$i[0];$x<=$fx;$x++)
        {

            for($y=$i[0];$y<=$fy;$y++){


                for($z=$i[0];$z<=$fz;$z++)
                {
                    $this->sum=$this->cubo[$x][$y][$z]+$this->sum;



                }

            }

        }



    return $this->sum;
    }


}
?>
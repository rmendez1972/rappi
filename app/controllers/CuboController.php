<?php
class CuboController extends BaseController {



    public function post_confirm()
    {
        $id=Input::get('service_id'); //recibo por get el id de un servicio
        $servicio=Service::find($id); //llamo a un método estático de la clase Service para localizar el servicio
        if ($servicio != NULL){   //si el objeto devuelto es nulo
            if ($servicio->status_id=='6'){ // si la propiedad  status_id del objeto servicio devuelto tiene valor 6 devuelvo json error con valor 2
                return Response::json(array('error'=>'2'));
            }

            if ($servicio->driver_id == NULL && $servicio->status_id=='1'){ //si  la propiedad driver_id del objeto servicio devuelto es NULO y además la propiedad status_id del objeto tiene valor 1
                $servicio = Service::update($id, array( // llamo al método estático update de la clase Service y actualizo las propiedades driver_id con el valor recuperado por get driver_id y actualizo la propiedad status_id con el valor 2
                        'driver_id' => Input::get('driver_id'),
                        'status_id' => '2'
                ));
                Driver::update(Input::get('driver_id'), array( // como ya actualice la propiedad driver_id de la clase Service, tambien tengo que actualizar la propiedad available de la clase Driver, llamo al metodo estático update y actualizo la propiedad a valor 0
                        "available"=>'0'
                    ));
                $driverTmp = Driver::find(Input::get('driver_id')); // vuelvo a localizar el driver llamando al metodo estatico find de la clase Driver pasandole el parámetro driver_id
                Service::update($id,array(
                        "car_id" =>$driverTmp->car_id //llamo al metodo estatico update de la clase Service para actualizar la propiedad car_id  con el valor de la propiedad car_id del objeto driverTmp
                ));
                $pushMessage= 'Tu servicio ha sido confirmado!';
                $servicio= Service::find($id);
                $push=Push::make();
                if ($servicio->user->uuid==''){
                    return Response::json(array('error'=>'0'));
                }
                if($servicio->user->type=='1'){//iphone
                    $result=$push->ios($servicio->user->uuid,$pushMessage,1,'honk.wav','Open',array('serviceIid'=>$servicio->id));
                }else{
                    $result=$push->android2($servicio->user->uuid,$pushMessage,1,'default','Open',array('serviceIid'=>$servicio->id));
                }
                return Response::json(array('error'=>'0'));
            }else{
                return Response::json(array('error'=>'1'));
            }
        }else{
            return Response::json(array('error'=>'3')); //si el objeto devuelto servicio es nulo devuelvo por json un error con valor 3
        }

    }




    //refactoring the above code
    public function post_confirm_refactorized(){

        private $pushMessage= 'Tu servicio ha sido confirmado!';
        private $service_id;
        private $driver_id;
        private $id_usuario;
        private $servicio;
        private $driver;

        //primero validamos si existe entre los datos recibidos por post una variable _token para proteccion CSRF
        if (isset($_POST['_token']))
        {
            //declaramos arrray con reglas de validación de los datos recibidos por método POST
            $rules = array
            (

                'service_id' => 'required|regex:/^[0-9]+$/i|min:1',
                'driver_id' => 'required|same:service_id'

            );

            //declaramos un array con mensajes personalizados a las reglas de validacion
            $messages = array
            (
                'service_id.required' => 'El service_id es requerido',
                'service_id.regex' => 'El dato service_id sólo acepta números',
                'service_id.min' => 'El mínimo permitido es 1',

                'driver_id.required' => 'El service_id es requerido',
                'driver_id.regex' => 'El dato service_id sólo acepta números',
                'driver_id.min' => 'El mínimo permitido es 1'


            );

            //llamamos al metodo estatico de la clase Validator de laravel, para validar todos los input pasados por métodos POST, se le aplican las reglas de validacion recientemente creados, y los mensajes para cada violación a cada regla de validacion
            $validator = Validator::make(Input::All(), $rules, $messages);

            if ($validator->passes()) // si la validacion es exitosa el metodo passes() devolvera true y por lo tanto continuara la ejecución
            {
                //recuperamos el id de usuario authenticado , el service_id  y el driver_id pasados por método POST
                $id_usuario=Auth::user()->get()->id;
                $service_id = Input::get("service_id");
                $driver_id = Input::get("driver_id");

                $servicio=Service::find($service_id); //recuperamos una instancia del modelo Service cuyo service_id tiene el valor anteriormente recuperado, llamando al método estatico find
                $driver=Driver::find($driver_id); //recuperamos una instancia del modelo Driver cuyo driver_id tiene el valor anteriormente recuperado

                if ($servicio != NULL && $driver != NULL){
                    if ($servicio->status_id=='6'){ // si la propiedad  status_id del objeto servicio devuelto tiene valor 6 devuelvo json error con valor 2
                         return Response::json(array('error'=>'2'));
                    }

                    if ($servicio->driver_id == NULL && $servicio->status_id=='1'){ //si  la propiedad driver_id del objeto servicio devuelto es NULO y además la propiedad status_id del objeto tiene valor 1
                        $servicio = Service::update($service_id, array( // llamo al método estático update de la clase Service y actualizo las propiedades driver_id con el valor recuperado por get driver_id y actualizo la propiedad status_id con el valor 2
                                'driver_id' => $driver_id,
                                'status_id' => '2',
                                "car_id" =>$driver->car_id
                        ));
                        Driver::update($driver_id, array( // como ya actualice la propiedad driver_id de la clase Service, tambien tengo que actualizar la propiedad available de la clase Driver, llamo al metodo estático update y actualizo la propiedad a valor 0
                                "available"=>'0'
                            ));
                        //$driverTmp = Driver::find(Input::get('driver_id')); // vuelvo a localizar el driver llamando al metodo estatico find de la clase Driver pasandole el parámetro driver_id


                        $servicio= Service::find($service_id);  //recuperamos el modelo Servicio con los nuevo datos recien actualizados
                        $push=Push::make(); //llamamos al metodo estatico make de la clase Push, y recuperamos un objeto de tiop push
                        if ($servicio->user->uuid==''){ //si el usuario del modelo user relacionado con el modelo $servicio tiene en su propiedad uuid vacio retornamos un json con propiedad error con valor 0
                            return Response::json(array('error'=>'0'));
                        }
                        if($servicio->user->type=='1'){//iphone
                            $result=$push->ios($servicio->user->uuid,$pushMessage,1,'honk.wav','Open',array('serviceIid'=>$servicio->id));
                        }else{
                            $result=$push->android2($servicio->user->uuid,$pushMessage,1,'default','Open',array('serviceIid'=>$servicio->id));
                        }
                        return Response::json(array('error'=>'0'));
                    }else{
                        return Response::json(array('error'=>'1'));
                    }



                }else{
                    return Response::json(array('error'=>'3')); //si el objeto devuelto servicio es nulo por no existir el id devuelvo por json un error con valor 3
                }



        }

    }


}
?>
# rappi
code challage for rappi

For this code challange i use php5 stack with Laravel Framework (release 4.2)

Tools:
1.- wamp server 2.5 with php5 ver 5.5.12, apache web server ver 2.4.9, mysql database ver 5.6.17
2.- Bootstrap v3.3.1
3.- jquery v1.10.2
3.- twitter-bootstrap-hover-dropdown for the menu
4.- angular.js ver 1.4.x

Instruccions to clone the app:

1.- open Git Bash and go to your root web folder
2.- git clone https://github.com/rmendez1972/rappi.git
3.- cd rappi, and then you can see the code
4.- go to your browser, open localhost/rappi, and then laravel redirect to rappi/public folder and render the index.php
5.- when you see the main page of the app, you can click in the login menu to sign in with emmail: user@mail.com and password: password
6.- whe you sign in, you seee a menu with inicio, catalogos, cubo and reportes options
7.- the cubo option, redirect you to a view when you can set/query the cube summation challange
8.- in the public/db_sql folder there is a .sql file with the mysql database to restore or do a migration


Explination of created classes

1.- For the views, i use the templating engine of laravel Blade, also i use blade layouts for extends layouts for the views. In the views/layouts you can found two layouts for the index.php page and for the reports views. In the rest of the views i extend from one of these layouts. In the layouts i load bootstrap, jquery, angular.js and anyone tool i need.
2.- In the cubo menu, i redirect to Public/vista.php view. This view contain the logic for the cube summation challage.
i use jquery to manipulate de DOM and validate the form, also i do serialize for the fields of the form and send the data in a POST way.
3.- in the Public/vista.php view, i include a cubo.php file with the class cubo (view layer)
4.- the class cubo, has the inicializar, getcubo, setcubo, updatecubo and query methods. bellow the explination (logic layer)
	inicializar method: initilizes a 3d array to 0
	getcubo method: return the cubo array property of the class
	setcubo method: set the value of a position of the array with x,y,z coords. with a input value (w in the view)
	updatecubo method: update the value of a position of the array with x,y,z coords. with a input value (w in the view)
	query method: performs the summation for the values stored in the 3d array from the x1,y1,z1 coord. to x2,y2,z3 coord.
5.-in the catalogos menu, you can get the view for the users list, where you can edit, delete or add new users for the app. I use a Usuario model extending Eloquent class and declaring primarykey, table name, and setting timestamp to false for not use timestamp in the table of the database. (model layer)
6.- for the users control, i create a usuariosController controller. following the laravel structure, this file is located in app/controllers folder. this class inherit from BaseController class, the parent class of all controllers. this class has mostrarUsuarios, nuevoUsuario,crearUsuario,verUsuario methods.
7,- for the login control, i use de Auth feature of Laravel. In the app.php file of config folder, i override //'Illuminate\Auth\AuthServiceProvider' with "Ollieread\Multiauth\MultiauthServiceProvider" and //'Illuminate\Auth\Reminders\ReminderServiceProvider' with 'Ollieread\Multiauth\Reminders\ReminderServiceProvider' for remember the authentication.


Refactoring Code Challange

in the app/controllers folder has a CuboController.php file, with  two methods post_confirm()_and post_confirm_refactorized(). the second one, with my refactorization.

the file has documentation about how i think shuld be the code of the method of the controller.

in the begin of my method i use private vars, following the good practices for encapsulate the propoerties of the class only to be used for the controller.

	private $pushMessage= 'Tu servicio ha sido confirmado!';
    private $service_id;
    private $driver_id;
    private $id_usuario;
    private $servicio;
    private $driver;

then i use a CRSF validation, for security of data send it throught the form (servicio_id,driver_id,_token)

if (isset($_POST['_token']))
        {

then _token var, should be send it from the form like below can see

	<div class="form-group">
        {{Form::input("hidden", "_token", csrf_token())}}
        {{Form::input("submit", null, "Iniciar sesión", array("class" => "btn btn-primary"))}}
    </div>

then i use a Validator class, like helper to validate all the input data like below can see

$validator = Validator::make(Input::All(), $rules, $messages);

then i populate the private vars $id_usuario,$service_id,$driver_id of the class like below can see

 	$id_usuario=Auth::user()->get()->id;
    $service_id = Input::get("service_id");
    $driver_id = Input::get("driver_id");

then i recover a Service and Driver objects, from the static methods. Both of then store a service and driver object if exists the given id

$servicio=Service::find($service_id);
$driver=Driver::find($driver_id);


in the relation one to one between model servicio and user, when i recover the property type of user model to validate iphone or android2 i pass like second parameter of ios or android2 method a private var of the class $pushMessage, only available for methods of the class. It can not be accessed outside the class

if($servicio->user->type=='1'){//iphone
    $result=$push->ios($servicio->user->uuid,$pushMessage,1,'honk.wav','Open',array('serviceIid'=>$servicio->id));
}else{
    $result=$push->android2($servicio->user->uuid,$pushMessage,1,'default','Open',array('serviceIid'=>$servicio->id));
}


Answers to the Quiz.

1.- The principle of single responsability, is the core of the MVC pattern. Do only a thing, but do it very well. Low coupling between the layer view, controller and model. For example de blade templating in laravel don´t use spaguetti code, instead of use tags like {{}} for data binding.

2.- I think in cleand code, like follow the principe "don´t repeat yourself".create classes using a correct hierarchy of classes. Extend clasess instead of create huge clases. Declare static methods, when instantiating objects is not required to access those methods. Protect properties of the clases using private vars instead of public vars, equal with the methods of the class. Use interfaces to declare methods or equal behavior in different classes.
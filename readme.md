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


Explination of created classes

1.- For the views, i use the templating engine of laravel Blade, also i use blade layouts for extends layouts for the views. In the views/layouts you can found two layouts for the main page and for the reports views. In the rest of the views i extend from one of these layouts. In the layouts i load bootstrap, jquery, angular.js and anyone tool i need.
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
8.-



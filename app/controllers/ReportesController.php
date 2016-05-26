<?php

class ReportesController extends BaseController {

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


	public function reporteUsuarios(){
        $usuarios=Usuario::all();
        // variable con html renderizado
        $html= View::make('ReportesController.lista_usuarios', array('usuarios' => $usuarios,'titulo_reporte'=>'Listado de Usuarios'));
        return PDF::load($html, 'letter', 'portrait')->show();
    }



}

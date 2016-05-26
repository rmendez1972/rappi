<?php

Route::get('/', array('as'=>'index','uses'=>'HomeController@index'));

//agrupadas todas la rutas para usuarios guest
Route::group(array('before'=>'guest_user'),function(){
	Route::group(array('prefix' => '/login'), function(){
        Route::get('/', array('as'=>'login','uses'=>'HomeController@login'));
		Route::post('/nuevo', array('before'=>'csrf', function(){
		 				$user=array(
		 					'email'=>Input::get('email'),
		 					'password'=>Input::get('password'),
		 					'active'=>1,
		 				);
		 				$remember=Input::get('remember');
		 				$remember=='on'?$remember=true: $remember=false;
		 				//aqui se controla la autenticacion a traves de auth.php de laravel (libreríamultiauth)
		 				if(Auth::user()->attempt($user,$remember))
		 				{
		 					return Redirect::route('privado');
		 				}
		 				else
		 				{
		 					return Redirect::route('login');

		 				}
		}));
	});
});




//agrupadas todas las rutas para usuarios autenticados
Route::group(array('before'=>'auth_user'),function(){
    Route::get('/salir', array('as'=>'salir','uses'=>'HomeController@salir'));
	Route::get('/privado', array('as' => 'privado', 'uses' => 'HomeController@privado'));

    //ruta para registro de usuarios con password Hash
	Route::group(array('prefix' => '/usuarios'), function(){
    	Route::get('/', array('as'=>'usuarios', 'uses' => 'HomeController@mostrarUsuarios'));
    	Route::get('/nuevo', 'HomeController@register');
		Route::post('/nuevo', 'HomeController@register');
		Route::get('/editar/{id}', 'HomeController@editarUsuarios');
	    Route::post('/editar', 'HomeController@guardarUsuarios');
	    Route::get('/eliminar/{id}', 'HomeController@eliminarUsuarios');
	    Route::post('/eliminar/{id}', 'HomeController@eliminarUsuarios');
    });

    Route::group(array('prefix' => '/cubo'), function(){
        Route::get('/', array('as'=>'cubo','uses'=>'CuboController@index'));
		Route::post('/', 'CuboController@index');
	});

    //ruta para edición del perfil de usuario con password Hash
	Route::group(array('prefix' => '/perfil'), function(){
    	Route::get('/editar/{id}', array('as'=>'/editar/{id}','uses'=>'PerfilController@editarPerfil'));
	    Route::post('/editar', 'PerfilController@guardarPerfil');

    });

    //ruta para generación de reportes en formato pdf
	Route::group(array('prefix' => '/reportes'), function(){
    	Route::get('/usuarios',array('as'=>'/reportes/usuarios', 'uses'=>'ReportesController@reporteUsuarios'));
    	Route::get('/municipios',array('as'=>'/reportes/municipios', 'uses'=>'ReportesController@reporteMunicipios'));
    	Route::get('/tipopersona',array('as'=>'/reportes/tipopersona', 'uses'=>'ReportesController@reporteTipopersona'));
    	Route::get('/requisitos',array('as'=>'/reportes/requisitos', 'uses'=>'ReportesController@reporteRequisitos'));
    	Route::get('/cursos',array('as'=>'/reportes/cursos', 'uses'=>'ReportesController@reporteCursos'));
        Route::get('/asesores',array('as'=>'reporteAsesores', 'uses'=>'ReportesController@reporteAsesores'));
        Route::get('/asesores_municipio',array('as'=>'/reportes/asesores_municipio', 'uses'=>'ReportesController@reporteAsesores_municipio'));
        Route::post('/asesores_municipio',array('as'=>'/reportes/asesores_municipio', 'uses'=>'ReportesController@reporteAsesores_municipio'));
        Route::get('/asesores_tipopersona',array('as'=>'/reportes/asesores_tipopersona', 'uses'=>'ReportesController@reporteAsesores_tipopersona'));
        Route::post('/asesores_tipopersona',array('as'=>'/reportes/asesores_tipopersona', 'uses'=>'ReportesController@reporteAsesores_tipopersona'));
        Route::get('/requisitos_tipopersona/{id}',array('as'=>'/reportes/requisitos_tipopersona/{id}', 'uses'=>'ReportesController@reporterequisitosTipopersona'));
        Route::get('/requisitos_asesor/{id}',array('as'=>'/reportes/requisitos_asesor/{id}', 'uses'=>'ReportesController@reporterequisitosAsesor'));
        Route::get('/cursos_asesor/{id}'   ,array('as'=>'/reportes/cursos_asesor/{id}'   , 'uses'=>'ReportesController@reportecursosAsesor'));
        Route::get('/matricula_asesor/{id}',array('as'=>'/reportes/matricula_asesor/{id}', 'uses'=>'ReportesController@reportematriculaAsesor'));
        Route::get('/matricula_asesor_subsecretaria/{id}',array('as'=>'/reportes/matricula_asesor_subsecretaria/{id}', 'uses'=>'ReportesController@reportematriculaAsesor_subsecretaria'));
        Route::get('/credencial_asesor/{id}',array('as'=>'/reportes/credencial_asesor/{id}', 'uses'=>'ReportesController@reportecredencialAsesor'));
        Route::get('/acuserecibo_asesor/{id}',array('as'=>'/reportes/acuserecibo_asesor/{id}', 'uses'=>'ReportesController@reporteacusereciboAsesor'));
        Route::get('/asesores_municipio_referencia',array('as'=>'/reportes/asesores_municipio_referencia', 'uses'=>'ReportesController@reporteAsesores_municipio_referencia'));
        Route::post('/asesores_municipio_referencia',array('as'=>'/reportes/asesores_municipio_referencia', 'uses'=>'ReportesController@reporteAsesores_municipio_referencia'));
        Route::get('/asesores_municipio_tipopersona',array('as'=>'/reportes/asesores_municipio_tipopersona', 'uses'=>'ReportesController@reporteAsesores_municipio_tipopersona'));
        Route::post('/asesores_municipio_tipopersona',array('as'=>'/reportes/asesores_municipio_tipopersona', 'uses'=>'ReportesController@reporteAsesores_municipio_tipopersona'));

    });





});


Route::any('/', array('as'=>'index','uses'=>'HomeController@index'));


/*redireccionamiento error 404 de forma personalizada*/
App::missing(function($exception)
{
	return Response::view('error.error404',array(),404);
});

?>

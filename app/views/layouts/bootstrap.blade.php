<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/imagenes/asesores.ico" />
      {{ HTML::style('assets/css/bootstrap.min.css'); }}
      {{ HTML::style('assets/css/bootstrap-theme.min.css'); }}
      {{ HTML::script('assets/js/jquery-1.10.2.min.js'); }}
      {{ HTML::script('assets/js/bootstrap.min.js'); }}
      {{ HTML::style('assets/css/component.css'); }} <!--Efecto del menu principal-->
      {{ HTML::script('assets/js/twitter-bootstrap-hover-dropdown.min.js'); }}<!--igh menu desplegable-->
      @yield('head')
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->
    <!--<base href="http://example.com/" target="_blank, _self, _parent, _top">-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <body>
    <header width="100%"style="background-color:white"> <!--igh1 Cabecera-->
      <!--<div class="container cabecera" style="background-color:white"></div>-->
    </header> <!-- Fin seccion cabecera-->



    <nav class="menu">

      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <!--menú de los dispositivos móviles-->
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--<a class="navbar-brand" href="#">Asesores Inmobiliarios</a>-->
           <div style="margin-right: 2em"> {{ HTML::image('assets/imagenes/rappi.png', "Imagen no encontrada", array('id' => 'asesores', 'title' => 'code challange')) }}</div>
        </div>


        <div class="btn-group">
          <div class="hi-icon-wrap hi-icon-effect-8">
            <!--<ul class="nav navbar-nav">-->
            <ul> <!--Menu horizontal iconos con efecto-->
              <?php
                $vista=Route::currentRouteName();
                $current=array
                  (
                    'index'=>'',
                    'catalogos'=>'',
                    'registro'=>'',
                    'reportes'=>'',
                    'login'=>''
                   );
                  if ($vista=="" || $vista=="index")
                  {
                    $current['index']='active';
                  }
                  else if ($vista=='catalogos')
                  {
                    $current['catalogos']='active';
                  }
                  else if ($vista=='reportes')
                  {
                    $current['reportes']='active';
                  }
                  else if($vista=='login')
                  {
                    $current['login']='active';
                  }
              ?>

                <!--we validate the user type, here guest user-->
                @if (Auth::user()->guest())

                  <li class="{{$current['login']}}"><a class="hi-icon hi-icon-user" href="{{URL::route('login')}}">Login</a></li>



                @else

                <!--we validate the user type, here register user-->
                <div class="btn-group">
                  <li class="{{$current['catalogos']}}">    <a class="hi-icon hi-icon-cog" href="{{URL::route('index')}}">Inicio</a></li>
                  <li class="{{$current['catalogos']}}"><a class="hi-icon hi-icon-archive" data-toggle="dropdown" data-hover="dropdown">Catálogos</a>
                    <ul class="dropdown-menu"  >

                      <li><a href="{{URL::route('usuarios')}}">Usuarios</a></li>


                    </ul>
                  </li>
                </div>

                <div class="btn-group">
                  <li class="{{$current['registro']}}"><a  class="hi-icon hi-icon-pencil" data-toggle="ropown" data-hover="dropdown">Cubo</a>
                    <ul class="dropdown-menu"  >
                      <li><a href="/rappi/vista.php">Suma de Cubo</a></li>

                    </ul>
                  </li>
                </div>

                <div class="btn-group">
                  <li class="{{$current['reportes']}}"><a  class="hi-perfil glyphicon-print" data-toggle="ropown" data-hover="dropdown">Reportes</a>
                    <ul class="dropdown-menu"  >
                      <li><a href="{{URL::route('/reportes/asesores_municipio')}}" target="_blank">Usuarios</a></li>



                    </ul>
                  </li>
                </div>




            </ul> <!--Menu horizontal-->
          </div> <!--hi icon wrap-->
        </div> <!--button group-->

        <div class="btn-group" style="float:right;margin-top:10px">
                  <li class="{{$current['catalogos']}}">
                    <a href="{{URL::to('/').'/perfil/editar/'.Auth::user()->get()->id}}"><img src=" {{URL::to('/').'/'. Auth::user()->get()->src }}" title="modificar perfil" class="foto"></a>


                  </li>
                  <div style="float:right">{{Auth::user()->get()->nombre_usuario}}<br>
                    <a href="salir" title="cerrar sesión"><span  class="avatar hi-icon-locked"></span></a>
                  </div>
        </div>
        @endif
          <!--<div style="float:right;margin-top:10px">
            @yield('perfil')
          </div>-->
      </div> <!--container-->

    </nav> <!--Sección de navegacion-->


    <section>
      <div class="container" style="background-color:white" >
        @yield('content')

      </div><!-- /.container -->
    </section>

    <!--<footer style="background-color:#8A0808" >-->
    <footer>
      <div class="pie container">
        <div>Aplicación:
            <br>Code Challange para Rappi<br>
            <!--<IMG SRC="assets/imagenes/inmobiliarias.png" width="100" height="100">-->
              {{ HTML::image('assets/imagenes/inmobiliarias.png') }}
        </div>
        <div>

        </div>
        <div>Desarrollador Front-end y Back-end<br>Rafael Méndez Asencio<br><br>

          Copyright (c) Rappi</div>
      </div>
    </footer>
  </body>
</html>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style>
    @import url(//fonts.googleapis.com/css?family=Lato:700);

      body {
        margin:-50px 10px 10px -45px;
        font-family: helvetica, sans-serif;
        font-size: 12px;
        height: 1000px;
      }


      #frente{ position: absolute;
        width: 213px;height: 346px;
        background-image: url('assets/imagenes/Credenciales Asesores Inmobiliarios FRENTE1x.png');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

        text-align: center;

      }

     #reverso {
        width: 213px;height: 346px;
        background-image: url('assets/imagenes/Credenciales Asesores Inmobiliarios DETRAS1x.png');

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

        text-align: center;


      }

      #foto {
        border-color: black;
        /*border-style: solid;margin-top:50px;*/
        margin-top:55px;
        margin-left:70px;
        /*background-image: url('assets/imagenes/avatars/foto_perfil1.jpg');*/
        background-position: 0% 0%;
        background-size: 10 10;
        background-repeat: no-repeat;
        width: 80px;height: 100px;
        /*position: absolute;left: 200px;top:200px*/
      }

      .texto1 {
        margin-top: 5px;
        font-size: 9px;
        font-weight: bolder;
      }

      .texto2 {
        font-size: 9px;
        font-weight: bolder;
        color: #666666; /*tono de gris*/
        margin-right: 5px;
        margin-left: 5px;
      }

      .texto3 {
        font-size: 7px;
        margin-right: 5px;
        margin-left: 5px;
      }

    </style>

  </head>

  <body>

    <div id="frente">
      <div id="foto" >@yield('foto')</div>
      <div class="texto1">@yield('nombre_razon')</div>
      <div class="texto2">@yield('tipo_persona')<br><br></div>
      <div class="texto3">
        @yield('afiliado')<br><br><br>
        __________________________<br>Firma<br><br>
      </div>

      <div style="font-size:12px">
        MATRICULA:<br> @yield('matricula')<br><br>

      </div>
      </small>

    </div>

    <div id="reverso">
      <div style="margin-top:50px;">
        <small>

          <div style=   "text-align:left;padding:10px">

          RFC: @yield('rfc')<br><br>
            <strong >
              DOMICILIO:
            </strong>
            <div class="texto1" style="text-align:justify;font-size:8px;">
              @yield('domicilio')
            </div>

            <div style="font-size:9px;text-align:justify;">
              <br>
              @yield('fecha_expedicion')
            </div>
          </div>

            <div style="width:300px;height:50px;position:fixed; bottom:0;left:-120;font-size:3px;margin-right:-120px">
              @yield('qr_code')<br><br><br><small><br></small>
              <div style="font-size:11px;color:white;width:500px;margin-left:-33px;padding-top:2px">Vencimiento:@yield('vigencia')</div>

            </div>
          </div>

        </small>

        <!--<div style="position:fixed; z-index:999999;font-size:10px;margin-left:-30px;color:black;bottom:-9px;">
          Vencimiento:
          @yield('vigencia')
        </div>-->
      <div>
      </div>


  </body>

</html>
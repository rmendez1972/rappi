<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />




    <style>
      @import url(//fonts.googleapis.com/css?family=Lato:700);


    body {

      margin:105px 10px 80px 10px;
      font-family:'Lato', sans-serif;
      font-size: 12px;
      /*color: #999;*/
      font-size: 12px;
    }
    .container
    {
      padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto;
      font-size:14px;
    }
    .cabecera {top:-20px; left:-20px;
      border-bottom-style: solid;

      /*background-image: url('assets/imagenes/logos.jpg');*/

      height: 78px; background-repeat: no-repeat; width: 100%; margin:0 auto;position:fixed;
    }

  .pie {

    /*background-image: url('assets/imagenes/cintillareportes.png');*/

    width: 100%;
    height: 78px;




    background-position: center;



    margin:0 auto;
    color: white;
    position:fixed; bottom:0; z-index:999999;
  }

 .pie .page:after {
    content: "Página " counter(page);
 }
 .pie .page{
    text-align: center;
            color:#000;
            width: 100%;
    position:relative;
    top:50px;
 }

  .tituloreporte{ font-size: 16px;
    background-color: #ddd;
    text-align: center;margin-right: -20px;
    border:1px solid; margin-top:0px; 
    border-radius: 20px;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;}




    table, table td, table tr {padding:0px;border-spacing: 0px;}

  table {
    border:1px black solid;
    border-radius:5px;
    min-width:400px;
    font-family: Helvetica,Arial;
    margin:0 auto;
  }

  .table {
      border-collapse: collapse !important;
  }
    .table td,  .table th {
      background-color: #fff !important;
  }
    .table-bordered th,
    .table-bordered td {
      border: 1px solid #ddd !important;
  }


  table {
    background-color: transparent;
  }
  caption {
    padding-top: 8px;
    padding-bottom: 8px;
    color: #777;
    text-align: left;
  }
  th {
  text-align: left;
  }
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
  }
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
  }

.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd;
}

.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}

.table > tbody + tbody {
  border-top: 2px solid #ddd;

}
.table .table {
  background-color: #fff;
}
.table-condensed > thead > tr > th,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > tbody > tr > td,
.table-condensed > tfoot > tr > td {
  padding: 5px;
  border: 2px solid #ddd;
  /* */
}

.table-bordered {
  border: 1px solid #ddd;
}

.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
}

.table-bordered > thead > tr > th,
.table-bordered > thead > tr > td {
  border-bottom-width: 2px;
}
.table-striped > tbody > tr:nth-child(odd) {
  background-color: #f9f9f9;
}

.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
}

table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none;
}

table td[class*="col-"],
table th[class*="col-"] {
  position: static;
  display: table-cell;
  float: none;
}

.table > thead > tr > td.active,
.table > tbody > tr > td.active,
.table > tfoot > tr > td.active,
.table > thead > tr > th.active,
.table > tbody > tr > th.active,
.table > tfoot > tr > th.active,
.table > thead > tr.active > td,
.table > tbody > tr.active > td,
.table > tfoot > tr.active > td,
.table > thead > tr.active > th,
.table > tbody > tr.active > th,
.table > tfoot > tr.active > th {
  background-color: #f5f5f5;
}

.table-hover > tbody > tr > td.active:hover,
.table-hover > tbody > tr > th.active:hover,
.table-hover > tbody > tr.active:hover > td,
.table-hover > tbody > tr:hover > .active,
.table-hover > tbody > tr.active:hover > th {
  background-color: #e8e8e8;
}

.table > thead > tr > td.success,
.table > tbody > tr > td.success,
.table > tfoot > tr > td.success,
.table > thead > tr > th.success,
.table > tbody > tr > th.success,
.table > tfoot > tr > th.success,
.table > thead > tr.success > td,
.table > tbody > tr.success > td,
.table > tfoot > tr.success > td,
.table > thead > tr.success > th,
.table > tbody > tr.success > th,
.table > tfoot > tr.success > th {
  background-color: #dff0d8;
}

.table-hover > tbody > tr > td.success:hover,
.table-hover > tbody > tr > th.success:hover,
.table-hover > tbody > tr.success:hover > td,
.table-hover > tbody > tr:hover > .success,
.table-hover > tbody > tr.success:hover > th {
  background-color: #d0e9c6;
}

.table > thead > tr > td.info,
.table > tbody > tr > td.info,
.table > tfoot > tr > td.info,
.table > thead > tr > th.info,
.table > tbody > tr > th.info,
.table > tfoot > tr > th.info,
.table > thead > tr.info > td,
.table > tbody > tr.info > td,
.table > tfoot > tr.info > td,
.table > thead > tr.info > th,
.table > tbody > tr.info > th,
.table > tfoot > tr.info > th {
  background-color: #d9edf7;
}

.table-hover > tbody > tr > td.info:hover,
.table-hover > tbody > tr > th.info:hover,
.table-hover > tbody > tr.info:hover > td,
.table-hover > tbody > tr:hover > .info,
.table-hover > tbody > tr.info:hover > th {
  background-color: #c4e3f3;
}

.table > thead > tr > td.warning,
.table > tbody > tr > td.warning,
.table > tfoot > tr > td.warning,
.table > thead > tr > th.warning,
.table > tbody > tr > th.warning,
.table > tfoot > tr > th.warning,
.table > thead > tr.warning > td,
.table > tbody > tr.warning > td,
.table > tfoot > tr.warning > td,
.table > thead > tr.warning > th,
.table > tbody > tr.warning > th,
.table > tfoot > tr.warning > th {
  background-color: #fcf8e3;
}

.table-hover > tbody > tr > td.warning:hover,
.table-hover > tbody > tr > th.warning:hover,
.table-hover > tbody > tr.warning:hover > td,
.table-hover > tbody > tr:hover > .warning,
.table-hover > tbody > tr.warning:hover > th {
  background-color: #faf2cc;
}

.table > thead > tr > td.danger,
.table > tbody > tr > td.danger,
.table > tfoot > tr > td.danger,
.table > thead > tr > th.danger,
.table > tbody > tr > th.danger,
.table > tfoot > tr > th.danger,
.table > thead > tr.danger > td,
.table > tbody > tr.danger > td,
.table > tfoot > tr.danger > td,
.table > thead > tr.danger > th,
.table > tbody > tr.danger > th,
.table > tfoot > tr.danger > th {
  background-color: #f2dede;
}

.table-hover > tbody > tr > td.danger:hover,
.table-hover > tbody > tr > th.danger:hover,
.table-hover > tbody > tr.danger:hover > td,
.table-hover > tbody > tr:hover > .danger,
.table-hover > tbody > tr.danger:hover > th {
  background-color: #ebcccc;
}

.aplicacion{
  text-align: right;
  /*width:430px;*/
  margin-left: 41%;
  margin-top: 60px;

  }


#caja{ position: absolute;
left: 0;
top: 0;
height: 78px;
width: 100%;
}

#caja img { width: 100%;
height: 78%;
}

.texto { color: #f00;
font-size: 30px;
position: relative;
}

.mal{
  width:16px;
  height: 16px;
  background-image: url('assets/imagenes/mal.png');
  background-position: center;
  background-repeat: no-repeat;
  margin:auto;
  opacity: 0.5;

}
.bien{
  width:16px;
  height: 16px;
  background-image: url('assets/imagenes/ok.png');
  background-position: center;
  background-repeat: no-repeat;
  margin:auto;
  opacity: 0.5;


}
  </style>

  </head>


  <body>

<!--<img src='assets/imagenes/logos.jpg'></img>-->

  <div class="cabecera" style="background-color:white; width:100%">
    <div id="caja img"> <img src='data:image/png;base64,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'></img></div>
    <div class="aplicacion"> Sistema para el registro de asesores inmobiliarios</div>

    <section>
    <div class="tituloreporte">
       @yield('titulo')
    </div>
  </section>
  </div>


  <div class="pie">
  <div id="caja img"> <img src='data:image/jpeg;base64,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'></img></div>


     <div> <p class="page"></p></div>


  </div>


  <section>
    <div>
       @yield('content')
    </div>
  </section>



  </body>


</html>
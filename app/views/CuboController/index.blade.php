@extends('layouts.bootstrap')

@section('head')
<title>Cubo</title>
<meta name='title' content='Login'>
<meta name='description' content='Login'>
<meta name='keywords' content='palabras, clave'>
<meta name='robots' content='noindex,nofollow'>
@stop

@section('perfil')
    <div class="hi-icon hi-icon-locked" ></div>

@stop

@section('content')

<?php
//cubo[4][4][4]
//include "cubo.php";
if(!$_POST)
    {
    $cubo= new CuboController();
    $cubo->inicializar();
    session_start();
    $_SESSION["cubo"]=$cubo;
    }
    else
    {
        session_start();
        $cubo=$_SESSION["cubo"];

        if($_POST["dropdown"]=="Set")
        {
            $cubo->setcubo($_POST["set1"],$_POST["set2"],$_POST["set3"],$_POST["set4"]);

            echo "Set ok (".$_POST["set1"].",".$_POST["set2"].",".$_POST["set3"].")=".$_POST["set4"];

        }

        if($_POST["dropdown"]=="Query")
        {

        $i[0]=$_POST["query1"];
        //y
        $i[1]=$_POST["query2"];
        //z
        $i[2]=$_POST["query3"];
        $f[0]=$_POST["query4"];
        $f[1]=$_POST["query5"];
        $f[2]=$_POST["query6"];
        echo "Query:".$r=$cubo->query($i,$f);


        }

        $_SESSION["cubo"]=$cubo;


}
if(!$_POST)
{
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
<script>
$( document ).ready(function() {



    $('#dropdown').change(function(){

    var valor=$('#dropdown').val();
    if(valor=="Set")
    {
        $('#setdiv').show();
        $('#querydiv').hide();

    }
    if(valor=="Query")
    {
        $('#querydiv').show();
        $('#setdiv').hide();
    }

});

    $('#boton').click(
        function(){



            var valorselect=$('#dropdown').val();

            if(valorselect=="")
            {
                alert("Seleccione una opción")
                return false;
            }

            if(valorselect=="Set")
            {
                var set1=$('#set1').val();
                var set2=$('#set2').val();
                var set3=$('#set3').val();
                var set4=$('#set4').val();

                if(set1=="")
                {
                    alert("Campo requerido x")
                    return false;
                }
                if(set2=="")
                {
                    alert("Campo requerido y")
                    return false;
                }
                if(set3=="")
                {
                    alert("Campo requerido z")
                    return false;
                }
                if(set4=="")
                {
                    alert("Campo requerido w")
                    return false;
                }
            }
            if(valorselect=="Query")
            {
                var query1=$('#query1').val();
                var query2=$('#query2').val();
                var query3=$('#query3').val();
                var query4=$('#query4').val();
                var query5=$('#query5').val();
                var query6=$('#query6').val();

                if(query1=="")
                {
                    alert("Campo requerido x1")
                    return false;
                }
                if(query2=="")
                {
                    alert("Campo requerido y1")
                    return false;
                }
                if(query3=="")
                {
                    alert("Campo requerido z1")
                    return false;
                }
                if(query4=="")
                {
                    alert("Campo requerido x2")
                    return false;
                }
                if(query5=="")
                {
                    alert("Campo requerido y2")
                    return false;
                }
                if(query6=="")
                {
                    alert("Campo requerido z2")
                    return false;
                }


            }




        $.post('index.php', $('#miform').serialize(), function(data) {
            alert('dentro de post ',data);
         $("#respuesta" ).html(data);
       }

    );

});
});
</script>

<div id="mensaje" class="bg-info"><h3>{{$mensage}}</h3></div>
{{Form::open(array(
                "method" => "POST",
                "url" => "/cubo",
                "enctype" => "multipart/form-data",
                "role" => "form",
                ))}}

<!-- <form id="miform" action="index.php" method="post" > -->
<fieldset>
    <select id="dropdown" name="dropdown">
    <option value="" selected>Seleccione</option>
    <option value="Set">Set/update</option>
    <option value="Query">Query</option>
    </select>

    <br><br><br><br>
    <div id="setdiv">
    <label for="set">Set/update:</label><br>
    <input id="set1" type="text" name="set1" placeholder="x" /><br>
    <input id="set2" type="text" name="set2" placeholder="y" /><br>
    <input id="set3" type="text" name="set3" placeholder="z" /><br>
    <input id="set4" type="text" name="set4" placeholder="w" /><br>
    </div>
    <br><br><br><br><br>
    <div id="querydiv">
    <label for="query">Query:</label><br>
    <input id="query1" type="text" name="query1" placeholder="x1" /><br>
    <input id="query2" type="text" name="query2" placeholder="y1" /><br>
    <input id="query3" type="text" name="query3" placeholder="z1" /><br>
    <input id="query4" type="text" name="query4" placeholder="x2" /><br>
    <input id="query5" type="text" name="query5" placeholder="y2" /><br>
    <input id="query6" type="text" name="query6" placeholder="z2" /><br>

    </div>
    <br><br><br><br><br>
</fieldset>

<div class="form-group"style="float:left">
    {{Form::input("hidden", "_token", csrf_token())}}
    {{Form::input("submit", null, "Enivar", array("class" => "btn btn-primary"))}}
    <a href="{{ URL::to('/cubo') }}">{{ Form::button('Cancelar', array('class' => 'btn')) }}</a>
</div>
 <input id="boton" type="button" name="boton" value="Enviar"/>

<!-- </form> -->
{{Form::close()}}

<div id="respuesta">
    Resultados
</div>
<?php
}
?>




{{Session::get("message")}}
<div class="panel panel-default" style="width:50%">
<div class="panel-heading" style="border-bottom:1px solid red"><h4>Inicio de Sesión</h4></div>
<div class="panel-body">
{{Form::open(array(
            "method" => "POST",
            "url" => "/login/nuevo",
            "role" => "form",
            ))}}

            <div class="form-group">
                {{Form::label("Email:")}}
                {{Form::input("text", "email", null, array("class" => "form-control"))}}
            </div>

            <div class="form-group">
                {{Form::label("Password:")}}
                {{Form::input("password", "password", null, array("class" => "form-control"))}}
            </div>

            <div class="form-group">
                {{Form::label("Recordar sesión:")}}
                {{Form::input("checkbox", "remember", "On")}}
            </div>

            <div class="form-group">
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("submit", null, "Iniciar sesión", array("class" => "btn btn-primary"))}}
            </div>

{{Form::close()}}
</div>
</div>
</div>
@stop

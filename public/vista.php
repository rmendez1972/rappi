<?php
//cubo[4][4][4]
include "cubo.php";

if(!$_POST)
	{
	$cubo= new cubo();

	$cubo->inicializar();
	session_start();
	$_SESSION["cubo"]=$cubo;

	}else
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
				alert("Seleccione opción")
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




		$.post('vista.php', $('#miform').serialize(), function(data) {
         $("#respuesta" ).html(data);
       }

    );

});

});
</script>

<form id="miform" action="index.php" method="post" >
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


<input id="boton" type="button" name="boton" value="Enviar"/>
<a href="/rappi">Cancelar</a>

</form>
<div id="respuesta">

</div>
<?php
}
?>







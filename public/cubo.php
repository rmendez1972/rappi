<?php

Class cubo{

private $cubo;
private $sum;

public function inicializar()
{
	$x=1;
	$y=1;
	$z=1;
	$fx=50;
	$fy=50;
	$fz=50;
	for($x=1;$x<$fx;$x++)
	{
		for($y=1;$y<$fy;$y++){

			for($z=1;$z<$fz;$z++)
			{
				$this->cubo[$x][$y][$z]=0;

			}

		}

	}

}


public function getcubo(){

	return $this->cubo;
}

public function setcubo($x,$y,$z,$w)
{
	$this->cubo[$x][$y][$z]=$w;

}

public function update($x,$y,$z,$w)
{
	$this->cubo[$x][$y][$z]=$w;

}

public function query($i,$f){
	$this->sum=0;

	$x=$i[0];
	$y=$i[1];
	$z=$i[2];
	$fx=$f[0];
	$fy=$f[1];
	$fz=$f[2];

	for($x=$i[0];$x<=$fx;$x++)
	{

		for($y=$i[0];$y<=$fy;$y++){


			for($z=$i[0];$z<=$fz;$z++)
			{
				$this->sum=$this->cubo[$x][$y][$z]+$this->sum;



			}

		}

	}



return $this->sum;

}

}

?>
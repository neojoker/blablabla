<?php
function separador_miles($var)
{
	$respuesta = '';
	$caracter = explode('.',$var);
	$var = $caracter[0];
	$resto = $caracter[1];
	
	$caminador  = strlen($var);
	
	
	while($caminador > 3)
	{
	$respuesta = ','. substr($var,$caminador-3,3).$respuesta;
	$caminador = $caminador-3;
	}
	
	$respuesta = substr($var,0,$caminador) . $respuesta . '.' .$resto;
		
	return $respuesta;
	}
	
	

$monto = '6109913353.545';

echo separador_miles($monto);
	
?>
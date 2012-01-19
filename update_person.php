<?php

$username = "root";
$password = "critical";
$hostname = "localhost"; 


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");

$empleados = array();
$mes = date('m');
$dia = date('d');
$message = '';

$sql = 'select user,fechaEntrada,saldo from Empleados';

$result = mysql_query($sql,$dbhandle);

while($row = mysql_fetch_array($result))
  		{
			$empleados[count($empleados)] = array( 'login' => $row[0], 'ingreso' => $row[1], 'saldo' => $row[2], 'bandera' => 0);
		}

foreach($empleados as $emp)
{
	$dia_persona = date('d',strtotime($emp['ingreso']));
	echo $emp['login'].'-'.$emp['ingreso'] . '<BR/>';
	$message .= $emp['login'].'-'.$emp['ingreso'] . '<BR/>';
	
	if($dia == 31 && $dia_persona == 30)
	{
		$sql = 'update Empleados set saldo = saldo + 1 where user = "'.$emp['login'].'"';
		$message .= $sql.'<BR/>';
		echo $sql.'<BR/>';
		mysql_query($sql,$dbhandle);
		}
	else if($dia == $dia_persona)
 	{
		$sql = 'update Empleados set saldo = saldo + 1 where user = "'.$emp['login'].'"';
		echo $sql.'<BR/>';
		$message .= $sql.'<BR/>';
		mysql_query($sql,$dbhandle);
		
		}
	
	
	

	
	
	//echo $emp['login'],'-',$emp['ingreso'];
//	
//	$mes_persona = date('m',strtotime($emp['ingreso']));
//	
//	$diferencias_dias = abs($dia_persona - $dia);
//	$diferencia_mes = abs($mes_persona - $mes);
//	echo '-+-',$diferencia_mes,'*',$diferencias_dias, '<BR/>';
//	
//	if($diferencia_mes == 0 && $diferencias_dias == 0)
//	{
//		$sql = 'update Empleados set saldo = saldo + 1 where user = "'.$emp['login'].'"';
//		echo $sql;
//		mysql_query($sql,$dbhandle);
//		}
//	
	}
	
$correoResolucion = 'rloaiza@criticalcolocation.com';
$subject = 'Movimientos de vacaciones diarios';

$body = $message;
 /* Additional Headers */
  	$headers = 'From: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'Return-Path: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   



		if(mail ('<'.$correoResolucion.'>', $subject, $body,$headers)){
		  echo "<h2>Solicitud $decision</h2>";
		}



 ?>

<?php
session_start();
$user = $_SESSION['userblanco'];

$username = "root";
$password = "critical";
$hostname = "localhost"; 


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  $selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");
  
  
 $parametro = $_POST['par'];

 
 switch($parametro)
 {
	 
	 case 0 :  //MANTENIMIENTO DE EMPLEADOS, ACTUALIZAR TABLA EMPLEADO Y GENEREAR REGISTRO DEL CAMBIO PARA LA BITAROCA
		 	
		$fecha = $_POST['fec'];
		$nombre = $_POST['nom'];
		$dias = $_POST['dia'];
		$observaciones = trim($_POST['com']);
		$mysqldate = date( 'Y-m-d H:i:s');
			
	
		$sql_select = "select fechaEntrada,saldo,nombre from Empleados where user = '$nombre'";
		
		
		$result  = mysql_query($sql_select);
		
		$row = mysql_fetch_array($result);
		
		$saldo_anterior = $row[1];
		$fecha_anterior = $row[0];
		$nombre_completo = $row[2];
		
		$sql_update = "UPDATE Empleados set fechaEntrada = $fecha, saldo = $dias where user = '$nombre'";
		
		$sql_insert = "insert into bitacora(user,observaciones,cambio, fecha_creacion) values('$user','$observaciones','Se realizo un cambio de la informacion del empleado $nombre_completo fecha anterior : $fecha_anterior | fecha actual : $fecha y saldo anterior : $saldo_anterior | saldo actual : $dias','$mysqldate')";
				
		if(mysql_query($sql_update))
		{
			mysql_query($sql_insert);
			echo 'Cambio realizado';
			
			}
		else
		{
			echo 'error en la transaccion';
			}
			
	
			 	
		
		
	 
	 
	 	break;
	 
	 }



?>
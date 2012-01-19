<?php

function modificar_fecha($var)
{
	$respuesta = '';
	
	$year = substr($var,0,4);
	
	$mounth = cambiar_mes(substr($var,5,2));
	
	$days = substr($var,8);
	
	$respuesta = $days . ' / ' . $mounth . ' / ' . $year;  
	
	return $respuesta;
	}
	
function cambiar_mes($mes)
{
	
	$respuesta = '';
	
	switch($mes)
	{
		case 1:
			$respuesta = 'Ene';
			break;
		case 2:
			$respuesta = 'Feb';
			break;
		case 3:
			$respuesta = 'Mar';
			break;
		case 4:
			$respuesta = 'Abr';
			break;
		case 5:
			$respuesta = 'May';
			break;
		case 6:
			$respuesta = 'Jun';
			break;
		case 7:
			$respuesta = 'Jul';
			break;
		case 8:
			$respuesta = 'Ago';
			break;
		case 9:
			$respuesta = 'Set';
			break;
		case 10:
			$respuesta = 'Oct';
		break;
		case 11:
			$respuesta = 'Nov';
			break;
		case 12:
			$respuesta = 'Dic';
			break;
		}
	
	
	return $respuesta;
	}
	
$username = "root";
$password = "critical";
$hostname = "localhost"; 


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");
  

if(isset($_GET['for']))
{
	$parametro = $_GET['var'];
	$id = $_GET['for'];
	
	/*Consulta, informacion del empleado para el informe   */
	
	
	
	$sqlfullfill = "SELECT nombre, saldo, fechaInicial, fechaFinal, dias, correoJefe, comentario, aceptadoJefe , user
	FROM Empleados as E, Movimientos as M
	WHERE M.idEmpleado = E.idEmpleado and  M.idMovimiento = " .$id;
	
	$result = mysql_query($sqlfullfill,$dbhandle);
	
	while($row = mysql_fetch_array($result))
  		{
		 	$nombreEmpleado = $row[0];
			$saldo = $row[1];
			$fechaInicial = $row[2];
			$fechaFinal = $row[3];
			$cantidad = $row[4];
			$correoJefe = $row[5];
			$comentario = $row[6];
			$estado = $row[7];
			$correoEmpleado = $row[8]."@grupoelectrotecnica.com";
			$empleado = $row[8];
			
		  
		 }
		 
	

	

	
	
if($estado == 0)
{	
	 switch ($parametro){
 	 case 0:
	 
	 //Acepta
	 
	//cambiar variables y correo para la persona q le va a llegar el correo, con variables y solo    escribir un solo correo y mandar un solo correo, la direccion aqui se cambia.
	$decision = "Solicitud aprobada" ;
	$dibujo = "<img src=\"http://portal.grupoelectrotecnica.com/img/check.png\" alt=\"estado\">";
	$correoRH = 'tlonghi@grupoelectrotecnica.com';
	$correoResolucion = $correoRH;
	$bandera = 1;
	$variableActualizacion = 1 ;
	
	$sql = 'UPDATE Empleados set saldo = '. ($saldo - $cantidad). ' where user = '."'$empleado'";
	
	$insert = mysql_query($sql,$dbhandle);
	$insert = mysql_query($sql);
	
	$saldo = $saldo - $cantidad;
	 
	 break;
	 case 1:
	 
	 //Rechaza
	 
	 $decision = "Solicitud declinada";
	 $dibujo = "<img src=\"http://portal.grupoelectrotecnica.com/img/wrong.png\" alt=\"estado\">";
	 $correoResolucion = $correoEmpleado;
	 $variableActualizacion = 2 ;
	 $bandera = 0;
	 break;
	 
	 
	 }
	 
	 
	  /* Setup your Subject and Message Body */
  $subject='Solicitud de vacaciones de ' . $nombreEmpleado;  
  /* Especifica el contenido del correo  */


$contador_dias = $saldo - $cantidad;
$fechaInicial = modificar_fecha($fechaInicial);
$fechaFinal = modificar_fecha($fechaFinal);

/******************************************************************************************/	  

$body="
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>Untitled Document</title>
<style>

body{
	background:#CBCBCB;
	
}
.gris{
	background:#eee;
	border-top-right-radius: 5px;
	border-bottom-right-radius: 5px;
	text-transform: uppercase;
	font-weight: 100;
		}
.simbolo{
	background:#eee;
	border-top-left-radius: 5px;
	border-bottom-left-radius: 5px;
}

table{
	background:white;
	height:20px;
	border-color:red;
	border-collapse: collapse;
	width: 400px; 
	/*border:thin white;*/
	font-family: Helvetica, Arial, sans-serif;
	font-size:12px;
	
	}

 td{	
 	width:30px;
	height:15px; 
	}
.blanco{
	color:white;
	}
.cabecera{
	margin:0 auto 0 auto;
	background:white;
	width:410px;
	height:auto;
	border-radius:5px;
	padding-top:15px;
	padding-left:15px;
	font-family: Helvetica, Arial, sans-serif;
	}
.semi_logo{
	paddin-top:10px;
	font-size:14px;
	text-transform: uppercase;
	}
	
.logo_movible{
	margin-top:-30px;
	margin-left:70px;
	}
	
	
.cuerpo{
	background:white;
	width:400px;
	height:800px;
	border-radius:5px;
	padding-left:10px;
	margin-top:5px;
	padding-left:10px;
	padding-top:10px;
	}
.contenido{
	margin-top:40px;
	font-size:12px
	}
.titulos{
	float:left;
	}
.contenidos{
	margin-left:150px;
	}
.secundario{
	margin-top:20px;
	}	
.botones{
	margin-top:40px;
	margin-left:280px;
	}
.estado{
		font: 20px;
    text-transform: uppercase;
    font-weight: none;
    font-weight: 100;
    margin: 30px 0px auto 131px;
    border: 1px solid #D0D0D0;
    background: #EEE;
    width: 210px;
    height: 40px;
    border-radius: 5px;
	}
.texto_estado{
	position: absolute;
    top: 14px;
    left: 50px;
	}
.izquierda{
	margin-top: 8px;
	margin-left: 7px;
	}
.derecha{
    height: 17px;
    width: 145px;
    margin-left: 38px;
    margin-top: -20px;
		}
.titulo {
	font-size: 16px;
}
</style>
</head>

<body>
<div  class=\"cabecera\">
<table width=\"500\" border=\"0\" cellspacing=\"0\">
  <tr>
    <td><img src=\"http://portal.grupoelectrotecnica.com/img/logo_mini.png\" alt=\"logo\"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"11\"><span class=\"titulo\">Servicio de vacaciones</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan=\"20\">&nbsp;</td>
    </tr>
  <tr>
    <td colspan=\"20\">Solicitud de vacaciones de $nombreEmpleado</td>
    </tr>
  <tr>
    <td colspan=\"20\">&nbsp;</td>
    </tr>
  <tr>
    <td colspan=\"5\"><a>D&iacute;a de Inicio : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\">$fechaInicial</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan=\"5\"><a>D&iacute;a Final : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\">$fechaFinal</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan=\"5\"><a>Cantidad de d&iacute;as : </a></td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\">$cantidad</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan=\"20\">&nbsp;</td>
    </tr>
  <tr>
    <td colspan=\"5\"><a>Saldo disponible : </a></td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\">$saldo</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"20\">&nbsp;</td>
    </tr>
  <tr>
    <td colspan=\"5\"><a>Comentarios : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\" rowspan=\"3\">$comentario</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
  
  <table border=\"0\">
  <tr>
  <td width=\"20px;\">&nbsp;</td>
	<td class=\"simbolo\">$dibujo</td>
    <td  class=\"gris\">$decision</td>
	<td>&nbsp;</td>
  </tr>
  <tr height=\"10px\">
		<td>&nbsp;</td>
	</tr>
</table>

</div>
</body>
";



 /* Additional Headers */
  	$headers = 'From: Sistema de vacaciones <no-reply@grupoelectrotecnica.com>' . "\r\n" .
   'Return-Path: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   



		if(mail ('<'.$correoResolucion.'>', $subject, $body,$headers)){
		  echo "<h2>$decision</h2>";
		  mail ('<'.$correoJefe.'>', $subject, $body,$headers);
		  if($bandera == 1)
		{
			mail ('<'.$correoEmpleado.'>', $subject, $body,$headers);
			}	
		 }
		 else{
			echo "<font color='red'><h2>Transaccion</h2></font>";		
			  
			echo "<font color='red'><h2>Your Message Was Not Sent!</h2></font>";
		 }
		 
		 

		 
		 	
	$sql="UPDATE Movimientos set AceptadoJefe=$variableActualizacion"." where idMovimiento=".$id;
	
	
	$insert = mysql_query($sql);
	$insert = mysql_query($sql,$dbhandle);
	
	
}

else
{
	echo '<h2>Solicitud ya se encuentra procesada</h2>';
	}
}
?>

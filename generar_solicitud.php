<?php
session_start();

////////////////////////////////////////////////////////////////////
function modificar_fecha($var)
{
	$respuesta = '';
	
	$year = substr($var,0,4);
	
	$mounth = cambiar_mes(substr($var,5,2));
	
	$days = substr($var,8);
	
	$respuesta = $days . ' / ' . $mounth . ' / ' . $year;  
	
	return $respuesta;
	}
	
	
	function quitar_caracteres($var)
{
	$respuesta = '';
	
	$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
	$replac = "abcdeeghijklaaoiqosuunwNyzabcdeeghijklmioiqosuunwxyza";
	
	$respuesta = strtr($var,$tofind,$replac);
		
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
	

////////////////////////////////////////////////////////////////////




$username = "root";
$password = "critical";
$hostname = "localhost"; 


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");
  

//variables globales

$fechaInicial = $_POST['fecha_inicio']; 
$fechaFinal = $_POST['fecha_final'];
$medio_dia = $_POST['half_day'];
$cometario = $_POST['texto_observaciones'];
$cometario = quitar_caracteres($cometario);
if($fechaInicial != '' && $fechaFinal != '')
{
	//variables del sistema
	$dias_solicitados = calcular_dias($medio_dia,$fechaInicial,$fechaFinal);
	$idempleado = $_SESSION['idEmpleado'];
	$nombreEmpleado = $_SESSION['name'];
	$correoEmpleado =$_SESSION['employmail'];
	$saldo = $_SESSION['saldo'];
	$correoJefe = $_SESSION['bossmail'];
	$aceptadoJefe = 0;
	
	$sqlstring = "INSERT INTO Movimientos (idEmpleado,fechaInicial,fechaFinal,dias,correoJefe,comentario,aceptadoJefe) VALUES (";

	$sqlstring = $sqlstring."'".$idempleado."','".$fechaInicial."','".$fechaFinal."','".$dias_solicitados."','".			$correoJefe."','".$cometario."',".$aceptadoJefe.")";
	
	
		if (!mysql_query($sqlstring, $dbhandle))
 		 {
  		  echo "Solicitud no enviada";
         } 
   else
        {
		 $ultimo_id = mysql_insert_id($dbhandle); 
	    }


	 // Setup your Subject and Message Body 
  	$subject = "Solicitud de vacaciones de $nombreEmpleado" ;
  	$body = 'Fecha Inicio:  ' . $fechaInicial. '<BR> Fecha final ' .$fechaFinal.  '<BR> Saldo de dias : ' .$_SESSION['saldo'] . '<BR> Comentarios : <BR> ' . $cometario;
  
 $contador_dias = $saldo - $dias_solicitados;
 $fechaInicial = modificar_fecha($fechaInicial);
 $fechaFinal = modificar_fecha($fechaFinal);

$body = "
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
    <td colspan=\"12\">$dias_solicitados</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan=\"20\">&nbsp;</td>
    </tr>
  <tr>
    <td colspan=\"5\"><a>Saldo Actual : </a></td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\">$saldo</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"5\"><a>Saldo Resultante : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\">$contador_dias</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"20\">&nbsp;</td>
    </tr>
  <tr>
    <td colspan=\"5\"><a>Comentarios : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\" rowspan=\"3\">$cometario</td>
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
    <td><a class=\"blanco\" href=\"http://portal.grupoelectrotecnica.com/procesar_respuesta.php?for=$ultimo_id&amp;var=0\">
						<img src=\"http://portal.grupoelectrotecnica.com/img/aprobar.png\" alt=\"aceptar\">			</a>
                    </a>
                    
                    <td colspan=\"2\">
                    <a  class=\"blanco\" href=\"http://portal.grupoelectrotecnica.com/procesar_respuesta.php?for=$ultimo_id&amp;var=1\">&nbsp;
						<img src=\"http://portal.grupoelectrotecnica.com/img/declinar.png\" alt=\"declinar\">.
                    </a>
                    </td>
  </tr>
</table>

</div>
</body>
</html>


";    


$body_propio = "
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
    <td colspan=\"12\">$dias_solicitados</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan=\"20\">&nbsp;</td>
    </tr>
  <tr>
    <td colspan=\"5\"><a>Saldo Actual : </a></td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\">$saldo</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"5\"><a>Saldo Resultante : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\">$contador_dias</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"20\">&nbsp;</td>
    </tr>
  <tr>
    <td colspan=\"5\"><a>Comentarios : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"12\" rowspan=\"3\">$cometario</td>
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
	<td class=\"simbolo\"><img src=\"http://portal.grupoelectrotecnica.com/img/informacion.png\" alt=\"estado\"></td>
    <td  class=\"gris\">Solicitud en proceso</td>
	<td>&nbsp;</td>
  </tr>
    <tr height=\"10px\">
		<td>&nbsp;</td>
	</tr>
</table>

</div>
</body>
";    
  
  
    // Additional Headers 
  	$headers = 'From: Sistema de vacaciones <no-reply@grupoelectrotecnica.com>' . "\r\n" .
   'Return-Path: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   
 
   
   
	$mai =$_SESSION['bossmail'];
	$nam =$_SESSION['bossname'];


  	if(mail ($nam.'<'.$mai.'>', $subject, $body,$headers)){
      echo "Solicitud completada";
	  $my_mail =$_SESSION['employmail'];
	  $my_nombre =$_SESSION['name'];
	  mail ($my_nombre.'<'.$my_mail.'>', $subject,$body_propio,$headers);
  }
  else{
      echo "Solicitud no se pudo realizar por el momento";
  }
	
	}
else
{
	echo 'Favor completar los campos';
	}
//preguntar si los valores vienen vacios.??
mysql_close($dbhandle);


function calcular_dias($half_day,$date_i,$date_f)
{
	$cantidad = 0;
	if($half_day == 'true')
		{
			$cantidad = $cantidad - 0.5; 
		}
		
	$sql="SELECT dia FROM Feriados";
			
	$result = mysql_query($sql);
	$k=0;
	$diasferiados = array();
			
			
	while($row = mysql_fetch_array($result))
		{
		  $diasferiados[$k] = $row[0];
		  $k++;			  
		}
	////////////
	$check_date = $date_i;
	$end_date = $date_f;	
			
	while ($check_date <= $end_date)
		 { 
			if((date('w',strtotime($check_date)) == 0 )||  (in_array($check_date,$diasferiados))  || (date('w',strtotime($check_date)) == 6 ))
				{}
			else {
					$cantidad = ++$cantidad;
				 }	 
			$check_date = date ("Y-m-d", strtotime ("+1 day", strtotime($check_date))); 
		}
	return $cantidad;
	}



?>


<?php


$bandera = $_POST['bandera'];

session_start();

	$username = "root";
	$password = "critical";
	$hostname = "localhost"; 


	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password) 
  		or die("Unable to connect to MySQL+++".mysql_error());
  
	$selected = mysql_select_db("Blog",$dbhandle) 
  		or die("Could not select examples");
$contenido = '';
$id = $_POST['id'];
		
	//VALORES a INSERTAR
	date_default_timezone_set('America/Costa_Rica');

switch ($bandera)
{
	case 1: //BANDERA DE GUARDAR POST
	
	
	
	$fecha = date("Y-m-d H:i:s"); 
	$empleado = $_SESSION['userblanco'];
	$id = $_POST['id'];
	$contenido = $_POST['con'];
	$empleado_email = $_SESSION['userblanco'].'@grupoelectrotecnica.com';
	
	
	
	$sql = 'Insert into actividades values('.$id.',"'.$contenido.'","'.$empleado_email.'","'.$empleado.'","'.$fecha.'")';
	
	if( mysql_query($sql,$dbhandle))
	{
		echo '1';
		}
	else
	echo	'0';
	
	break;
	
	case 2: //BANDERA DE CAMBIAR ADMINISTRADOR
	$id = $_POST['id'];
	
	$sql = 'select encargado from Solicitud where  id_solicitud = ' . $id;
	$result = mysql_query($sql,$dbhandle);
	
	while($row = mysql_fetch_row($result))
	{
		$encargado_anterior = $row[0];
		}
		
	$nombre_mail = '';	
	
	$sql = 'insert into participantes values('.$id.',"'.$encargado_anterior.'","'.$nombre_mail.'")';
	mysql_query($sql,$dbhandle);
	echo 'inser dentro de participantes para bandera de cambiar administrador';
	$nuevo_Encargado = $_POST['par'];
	
	$sql =  'update Solicitud set encargado = "' .$nuevo_Encargado .'" where id_solicitud = ' . $id ;
	mysql_query($sql,$dbhandle);
	
	$contenido = 'Se ha cambiado a '.$encargado_anterior .' por ' . $nuevo_Encargado;
	$empleado_email = $_SESSION['userblanco'].'@grupoelectrotecnica.com';
	$empleado = $_SESSION['userblanco'];
	$fecha = date("Y-m-d H:i:s"); 
	
	$sql = 'Insert into actividades values('.$id.',"'.$contenido.'","'.$empleado_email.'","'.$empleado.'","'.$fecha.'")';
	echo $sql;
	if(mysql_query($sql,$dbhandle))
		echo '1';
	else
		echo '0';
	break;
	
	case 3: //BANDERA DE AGREGAR INVOLUCRADOS
	$id = $_POST['id'];
	$par = $_POST['par'];
	$correo = '';
	foreach($par as $registro)
	{
		$sql = 'insert into participantes values('.$id.',"'.$registro.'","'.$correo.'")';
		mysql_query($sql,$dbhandle);
		}
	break;
	
	case 4://BANDERA DE CERRAR CASO
	$id = $_POST['id'];
$empleado_email = $_SESSION['userblanco'].'@grupoelectrotecnica.com';
	$fecha = date("Y-m-d H:i:s"); 
	$empleado = $_SESSION['userblanco'];
	
	$contenido = $empleado.' a cerrado la solicitud';
	
	$sql = 'update Solicitud set estado = 1 where id_solicitud = '.$id; 

	
	if(mysql_query($sql,$dbhandle))
		echo '1';
	else
		echo '0';
	
	$sql = 'Insert into actividades values('.$id.',"'.$contenido.'","'.$empleado_email.'","'.$empleado.'","'.$fecha.'")';
	mysql_query($sql,$dbhandle);
	echo 'insercion en actividades para cerrar el caso';
	break;
	
	case 5://BANDERA DE DISVINCULARSE
	
	$id = $_POST['id'];
	$empleado_email = $_SESSION['userblanco'].'@grupoelectrotecnica.com';
	$fecha = date("Y-m-d H:i:s"); 
	$empleado = $_SESSION['userblanco'];
	
	$contenido = $empleado.' se desvinculado de la solicitud';
	$sql = 'delete from participantes where id_post = '.$id . ' and nombre_empleado = "' . $empleado .'"'; 
	echo $sql;
	
	if(true)//mysql_query($sql,$dbhandle))
		echo '1';
	else
		echo '0';
	
	$sql = 'Insert into actividades values('.$id.',"'.$contenido.'","'.$empleado_email.'","'.$empleado.'","'.$fecha.'")';
	mysql_query($sql,$dbhandle);
	echo 'inserto en actividades para desvincularse';
	
	break;
	}
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ENVIAR CORREO, INFORMACION ESTABLECIDA EN UN POST Y LOS DIV Y UN CONTADOR MENOR A 3 PARA Y ESTABLECER EL MENSAJE COMO PRINCIPALO EL ULTIMO DE LA LISTA	




$body = '<html>';
$body .= '<head>';
$body .= '<style type="text/css">';
$body .= '.principal{';
$body .= 'background: #EEE;
		  font: 11px/1.231 sans-serif;
		font-family: Helvetica, Arial, sans-serif;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-khtml-border-radius: 5px;
		border-radius: 5px;                 
		border: 1px solid #DDD;
		padding: 20px;
		width: 600px;pre
		margin: 20px auto;';
$body .= '	}';
$body .= '.secundario{';
$body .= 'background: #EEE;
		  font: 11px/1.231 sans-serif;
		font-family: Helvetica, Arial, sans-serif;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-khtml-border-radius: 5px;
		border-radius: 5px;
		border: 1px solid #DDD;
		padding: 20px;
		width: 600px;
		margin: 20px auto;';
$body .= '	}';
$body .= '</style>';
$body .= '</head>';
$body .= '<body>';

$sql_actividades = 'select nombre_empleado,fecha,contenido from actividades where id_post = '.$id.' order by fecha DESC LIMIT 4';
$result = mysql_query($sql_actividades,$dbhandle);
$comentarios = array();

while($row = mysql_fetch_row($result))
{
	$comentarios[count($comentarios)] = $row;
	}

$body .= '<div class="principal">';
$body .= '<div id="header_post" class="header_post">';
	$body .= '<span id="nombre" class="nombre">'.$comentarios[0][0].'</span><span class="fecha"> '.calcular_tiempo($comentarios[0][1]).'</span>';
	$body .= '<br />';
	$body .= '<span class="departamento">'.$comentarios[0][0].'</span>';
	$body .= '</div>';
	$body .= '<div id="body_post">';
	$body .= '<p>'.$comentarios[0][2].'</p>';
	$body .= '</div>';



$body .= '</div>';
$body .= '<img src="http://nike.electrotecnica.local/blog_pendientes/img/line.jpg" alt="Angry face" />';
$body .= '<BR/>';
$body .= '<span>Post recientes</span>';


$contador = 1;




while($contador < count($comentarios))
{
	$body .= '<div class="secundario">';
	$body .= '<div id="header_post" class="header_post">';
	$body .= '<span id="nombre" class="nombre">'.$comentarios[$contador][0].'</span><span class="fecha"> '.calcular_tiempo($comentarios[$contador][1]).'</span>';
	$body .= '<br />';
	$body .= '<span class="departamento">'.$comentarios[$contador][0].'</span>';
	$body .= '</div>';
	$body .= '<div id="body_post">';
	$body .= '<p>'.$comentarios[$contador][2].'</p>';
	$body .= '</div>';
	$body .= '</div>';
 	$contador += 1;
	}
$body .= '<a href="'.$id.'">Ver todos los post</a>';
$body .= '</body>';
$body .= '<footer>';
$body .= '</footer>';
$body .= '</html>';
$subject='';
$headers = '';
$involucrados = array(); 



foreach($involucrados as $involucrado)
{
	$headers .='Cc: "'.$involucrado['nombre'].'" <'.$involucrado['correo'].'>' . "\r\n"; 	
}
$headers .='From: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'Return-Path: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";



$nombre_para_email = 'Randall';
$correo_para_email = 'rloaiza@criticalcolocation.com'; 

if(mail ($nombre_para_email.'<'.$correo_para_email.'>', $subject, $body,$headers)){
      //echo "Solicitud completada";
  }
  else{
      echo "<font color='red'><h2>Solicitud no se pudo realizar por el momento</h2></font>";
  }



function calcular_tiempo($date)
		{
			date_default_timezone_set('America/Costa_Rica');
			$fecha_actual = strtotime(date("Y-m-d H:i:s"));
			$date = strtotime($date);
			if(date("Y",$date) != date("Y",$fecha_actual))
			{
				$cantidad =  date("Y",$fecha_actual) - date("Y",$date);
				return 'Hace '.$cantidad. ' a&ntilde;os';
				}
			if(date("m",$date) != date("m",$fecha_actual))
			{
				$cantidad =  date("m",$fecha_actual) - date("m",$date);
				return 'Hace '.$cantidad. ' meses';
				}
			if(date("d",$date) != date("d",$fecha_actual))
			{
				$cantidad =  date("d",$fecha_actual) - date("d",$date);
				return 'Hace '.$cantidad. ' dias';
				}
			if(date("H",$date) != date("H",$fecha_actual))
			{
				$cantidad =  date("H",$fecha_actual) - date("H",$date);
				return 'Hace '.$cantidad. ' horas';
				}
			if(date("i",$date) != date("i",$fecha_actual))
			{
				$cantidad =  date("i",$fecha_actual) - date("i",$date);
				return 'Hace '.$cantidad. ' minutos';
				}
			if(date("s",$date) != date("s",$fecha_actual))
			{
				$cantidad =  date("s",$fecha_actual) - date("s",$date);
				return 'Hace '.$cantidad. ' segundos';
				}
			}

?>
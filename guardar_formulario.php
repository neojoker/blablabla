<?php
session_start();

$cliente = $_POST['cli'];
$departamento = $_POST['dep'];
$asunto = $_POST['asu'];
$texto = $_POST['tex'];
$encargado = $_POST['enc'];
$involucrados = $_POST['inv'];

$prioridad = $_POST['pri'];

if($prioridad == 'normal')
{
	$prioridad = 0;
	}
else
{
	$prioridad = 1;
	}
$estado = 0;

date_default_timezone_set('America/Costa_Rica');
$fecha = date("Y-m-d H:i:s"); 

///
$by = $_SESSION['userblanco'];

	
$username = "root";
$password = "critical";
$hostname = "localhost"; 


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
$selected = mysql_select_db("Blog",$dbhandle) 
  or die("Could not select examples");
  
  
  
  $sql = 'insert into Solicitud (contenido,solicitante,estado,fecha_inicio,prioridad,departamento,cliente,encargado,asunto) values("'.$texto.'","'.$by.'",'.$estado.',"'.$fecha.'",'.$prioridad.',"'.$departamento.'","'.$cliente.'","'.$encargado.'","'.$asunto.'")';

if (!mysql_query($sql, $dbhandle))
 		 {
  		  echo "1";
         } 
   else
        {
			echo '0';
		    $ultimo_id = mysql_insert_id($dbhandle);
			unset($_SESSION['ultimo_id']); 
			$_SESSION['ultimo_id'] = $ultimo_id;
	    }
	
	

$user = $_SESSION['userblanco'];
$ldappass = $_SESSION['pass'];
	
	
$ldaprdn = "electrotecnica\\".$user;	
$adServer = "pegasus.electrotecnica.local"; #replace with your AD server ip/hostname	
	
	
$ldapconn = ldap_connect($adServer) 
		  or die("Couldn't connect to AD!"); 
		
	
// Bind to the directory server. 
$ldapbind = ldap_bind($ldapconn, $ldaprdn,$ldappass) or 
	  die("Couldn't bind to AD!"); 
	
$dn ='OU=Electrotecnica,dc=electrotecnica,dc=local';
	$correos = array();

	$filter = '(displayname='.$encargado.')';

	$result = ldap_search($ldapconn, $dn, $filter); 
	$entries = ldap_get_entries($ldapconn, $result); 
	$mail = '';
	for ($i=0; $i<$entries["count"]; $i++) 
		   {
			  try {
				  	$mail = $entries[$i]['mail'][0];
					$correos[count($correos)] = array('nombre' => $encargado,'correo' => $mail);
					
					}
			 catch (Exception $e) {
						echo 'error';
					}	
			} 
	
	foreach($involucrados as $inv)
	{

	$filter = '(displayname='.$inv.')';

	$result = ldap_search($ldapconn, $dn, $filter); 
	$entries = ldap_get_entries($ldapconn, $result); 
	$mail = '';
	for ($i=0; $i<$entries["count"]; $i++) 
		   {
			  try {
				  	$mail = $entries[$i]['mail'][0];
					$correos[count($correos)] = array('nombre' => $inv,'correo' => $mail);
					
					}
			 catch (Exception $e) {
						echo 'error';
					}	
			} 
			
	$sql = 'insert into participantes values ('.$ultimo_id.',"'.$inv.'","'.$mail.'")';
	mysql_query($sql, $dbhandle);
	
	}
	
/////CORREO DE INVITACION A LA SOLICITUD

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
	$body .= '.cliente{
		font-size:9px;
		font-weight:bold;
		font-family: Helvetica, Arial, sans-serif;
		}';
	$body .= '	}';
	$body .= '</style>';
	$body .= '</head>';
	$body .= '<body>';
	$body .= '<div class ="principal">';
	$body .= '<span class="cliente">'.$cliente.'</span>';
	$body .= '<BR/>';
	$body .= '<span class="solicitado"> Solicitado por:'.$by.'</span>';
	$body .= '<BR/>';
	$body .= '<span>'.$texto.'</span>';
	$body .= '</div>';
	$body .= '</body>';
	
	$body .='</html?';
	
	
	
//CAMBIAR PARA QUE LOS INVOLUCRADOS RECIVAN UN EMAIL	
$headers ='From: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'Return-Path: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$subject = 'Solicitud #'.$ultimo_id.':'.$asunto;
	foreach($correos as $cor)
{
	//$nombre_para_email = 'Randall';
	 $nombre_para_email = $cor['nombre'];
	 $correo_para_email = $cor['correo'];
	//$correo_para_email = 'rloaiza@criticalcolocation.com'; 

	if(mail ($nombre_para_email.'<'.$correo_para_email.'>', $subject, $body,$headers))
	{
		echo 'ready';
		}
	else{
		echo 'send mail fail';
	}

}			
?>

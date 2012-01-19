<?php
$username = "root";
$password = "critical";
$hostname = "localhost";

			$adServer = "pegasus.electrotecnica.local"; #replace with your AD server ip/hostname
			$ldapconn = ldap_connect($adServer)
			or $this->msg = "Could not connect to LDAP server.";
	
			$ldaprdn = "electrotecnica\\rloaiza";
			//echo $ldaprdn;
			$ldappass = 'portalxp6';

	$message = '';
	$message .= "<html>\n"; 
	$message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:14px; color:#666666;\">\n"; 
	$message .= "<table width=\"1200\" height=\"300\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" >";
	$message .="<tr>";
	$message .="<td height=\"66\" colspan=\"8\" bgcolor=\"#CCCCCC\">Ultimas solicitudes</td>";
	$message .="</tr>";
	$message .="<tr>";
	$message .="<td width=\"2%\"></td>";
	$message .="<td colspan=\"8\">&nbsp;</td>";
	$message .="</tr>";
	$message .="<tr>";
	$message .="<td><b>#Solicitud</b></td>";
	$message .="<td><b>Nombre empleado</b></td>";
	$message .="<td><b>Fecha Inicial</b></td>";
	$message .="<td><b>Fecha Final</b></td>";
	$message .="<td><b>Cantidad dias solicitados</b></td>";
	$message .="<td><b>Comentarios</b></td>";
	$message .="<td><b>Resolucion</b></td>";
	$message .="<td><b>Saldo actual</b></td>";
	$message .="</tr>";
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");

$sql="select M.idMovimiento,E.nombre,M.fechaInicial,M.fechaFinal,M.dias,M.comentario,M.aceptadoJefe,E.saldo  from Movimientos as M, Empleados as E where M.idEmpleado = E.idEmpleado";		

$varible = mysql_query($sql);



$result = mysql_query($sql,$dbhandle);
while ($row = mysql_fetch_array($varible)) 
{
	$identificador = $row[0];
	$nombre = $row[1];	
	$fechaI = $row[2];
	$fechaF = $row[3];
	$dias = $row[4];
	$comentario = $row[5];
	if($row[6] == 0)
	$solucion = 'en proceso';
	else if($row[6] == 1)
	$solucion = 'Aprobada';
	else
	$solucion = 'Rechazada';
	$saldo = $row[7];
	
	$message .="<tr>";
	$message .="<td>$identificador</td>";
	$message .="<td>$nombre</td>";
	$message .="<td>$fechaI</td>";
	$message .="<td>$fechaF</td>";
	$message .="<td>$dias</td>";
	$message .="<td>$comentario</td>";
	$message .="<td>$solucion</td>";
	$message .="<td>$saldo</td>";
	$message .="</tr>";
	
	
	
				
}
	
	$message .="</table>";

echo $message;
?>

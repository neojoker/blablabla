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
	$message .="<td height=\"66\" colspan=\"5\" bgcolor=\"#CCCCCC\">Informacion maestra del empleado</td>";
	$message .="</tr>";
	$message .="<tr>";
	$message .="<td width=\"2%\"></td>";
	$message .="<td colspan=\"4\">&nbsp;</td>";
	$message .="</tr>";
	$message .="<tr>";
	$message .="<td><b>Nombre</b></td>";
	$message .="<td><b>Saldo</b></td>";
	$message .="<td><b>Fecha entrada</b></td>";
	$message .="<td><b>Departamento</b></td>";
	$message .="<td><b>Jefe</b></td>";
	$message .="</tr>";
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");

$sql="SELECT user,Saldo,fechaEntrada   
		FROM Empleados";		

$varible = mysql_query($sql);



$result = mysql_query($sql,$dbhandle);
while ($row = mysql_fetch_array($varible)) 
{
	$user = $row[0];
	$saldo = $row[1];
	$fecha = $row[2];
		
		try
		{		
				$ldapbind = ldap_bind($ldapconn, $ldaprdn,$ldappass);
				if ($ldapbind) {
					$dn = "OU=Electrotecnica,dc=electrotecnica,dc=local"; 
					$filter = '(samaccountname='.$user.')';
					$result = ldap_search($ldapconn, $dn, $filter); 
					$entries = ldap_get_entries($ldapconn, $result); 
							
				for ($i=0; $i<$entries["count"]; $i++) 
					{
						$Nombre = $entries[$i]['name'][0];
						$manager = $entries[$i]['manager'][0];
						$departmen =  $entries[$i]['department'][0];
						$employmail =  $entries[$i]['mail'][0];
						
						$manager = explode(',',$manager);
						
						//Buscando informacion del jefe
						
						$manager = $manager[0];
						$filter = $manager; 
					
						$result = ldap_search($ldapconn, $dn, $filter); 
						$entries = ldap_get_entries($ldapconn, $result); 
						
						$bossname =  $entries[$i]['displayname'][0];
						$bossacount = $entries[$i]['samaccountname'][0];
						$bossmail = $entries[$i]['mail'][0];

					}
				}
		}
		 catch (Exception $e) 
		{
			}
	$message .="<tr>";
	$message .="<td>$Nombre</td>";
	$message .="<td>$saldo</td>";
	$message .="<td>$fecha</td>";
	$message .="<td>$departmen</td>";
	$message .="<td>$bossname</td>";
	$message .="</tr>";
	
	
	
				
}
	
	$message .="</table>";

echo $message;
?>

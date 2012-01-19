<?php
include 'resol.php';

$empleados_sql = array();
$empleados_ldap = array();
$empleados_insert = array();
$empleados_marcados = array();

//obtener lista de empleados 
$sql = 'select user from Empleados';

$result = mysql_query($sql,$dbhandle);

while($row = mysql_fetch_array($result))
  		{
			$empleados_sql[count($empleados_sql)] = $row[0];
		}
		
$sql = 'select login from Marcados';

$result = mysql_query($sql,$dbhandle);

while($row = mysql_fetch_array($result))
  		{
			$empleados_marcados[count($empleados_marcados)] = $row[0];
		}
		

//Obtener lista de empleados de ldap
$user = 'rloaiza';
$ldappass = 'portalxp6';
$ldaprdn = "electrotecnica\\".$user;	
$adServer = "pegasus.electrotecnica.local"; #replace with your AD server ip/hostname


 $ldapconn = ldap_connect($adServer) 
          or die("Couldn't connect to AD!"); 
    

    // Bind to the directory server. 
    $ldapbind = ldap_bind($ldapconn, $ldaprdn,$ldappass) or 
          die("Couldn't bind to AD!"); 

$dn ='OU=Electrotecnica,dc=electrotecnica,dc=local';


//$filter = 'samaccountname='.$ldaprdn; 
  
$filter = '(samaccountname=*)';


    $result = ldap_search($ldapconn, $dn, $filter); 
    $entries = ldap_get_entries($ldapconn, $result); 
	

    for ($i=0; $i<$entries["count"]; $i++) 
       {
		 $empleados_ldap[count($empleados_ldap)] = $entries[$i];	
	   }
   // Close the connection 
    ldap_unbind($ldapconn);

foreach($empleados_ldap as $emp)
{
	if(!in_array($emp['samaccountname'][0],$empleados_sql) && !in_array($emp['samaccountname'][0],$empleados_marcados))
		$empleados_insert[count($empleados_insert)] = $emp;	
	}
	
	
$body = 'Las siguientes personas fueron agregadas al sistema: <BR/>';

foreach($empleados_insert as $emp)
{
	$login = $emp['samaccountname'][0];
	$departamento = $emp['department'][0];
	$nombre =  $emp['displayname'][0];
	
	$sql = 'insert into Empleados(user,nombre,saldo,fechaEntrada,departamento) values("';
	$sql .= $login.'","';
	$sql .= $nombre.'",';
	$sql .= '0'.',"';
	$sql .= date('y-m-d').'","';
	$sql .= $departamento.'"';
	$sql .= ')';
	mysql_query($sql,$dbhandle);
	$body .= $nombre;
}
	

$correoResolucion = 'rloaiza@criticalcolocation.com';

$subject = 'Update lista de empleados';



$headers = 'From: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'Return-Path: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if(mail ('<'.$correoResolucion.'>', $subject, $body,$headers)){
		  echo "<h2>Solicitud </h2>";
}


?>

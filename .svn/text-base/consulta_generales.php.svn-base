<?php

$bandera = $_POST['bandera'];
$id = $_POST['id'];


$username = "root";
$password = "critical";
$hostname = "localhost"; 

$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
$replac = "abcdeeghijklaaoiqosuunwxyzabcdeeghijklmaoiqosuunwxyza";

	
	session_start();
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
	
	//$filter = '(samaccountname='.$user.')';
	$filter = '(objectClass=user)';
	
	$result = ldap_search($ldapconn, $dn, $filter); 
	$entries = ldap_get_entries($ldapconn, $result); 
	
	$empleados_totales = array();
	
	
	for ($i=0; $i<$entries["count"]; $i++) 
		   {
			   
			  try {
				  	$empleados_totales[count($empleados_totales)] = strtr($entries[$i]['displayname'][0],$tofind,$replac);
					}
			 catch (Exception $e) {
						echo 'error';
						
					}	
			}
	


		




//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
$selected = mysql_select_db("Blog",$dbhandle) 
  or die("Could not select examples");

switch($bandera)
{
	case 0:
	$sql = 'select encargado from Solicitud where id_solicitud = ' . $id; //OBtiene el nombre del encargado
	$result = mysql_query($sql,$dbhandle);
	$row = mysql_fetch_row($result);
	echo $row[0];				
	break;
	
	 
	case 1:
	
	$sql = 'select encargado from Solicitud where id_solicitud = ' . $id; //OBtiene el nombre del encargado
	$result = mysql_query($sql,$dbhandle);
	$row = mysql_fetch_row($result);
	
	$empleado_actual = $row[0];
	echo '<BR>';
		echo '<SELECT NAME="candidatos" id="candidatos" MULTIPLE SIZE=11>';
		foreach($empleados_totales as $emp)
		{
			if(!strpos($emp,$empleado_actual))
				echo '<option id="'.$emp.'">'.$emp.'</option>';
			}
		echo '</select>';
		break;

	
	
	
	break;
	}


?>
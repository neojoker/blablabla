<?php
if (isset($_POST['q']))
{
	
	$claveBusqueda = $_POST['q'];
	}
else
{	
	$claveBusqueda = '';
	}
	
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
	$cliente = array(); 
	echo '<BR>';
  				echo '<SELECT NAME="key_encargado" id="key_encargado" MULTIPLE SIZE=11>';
	
	for ($i=0; $i<$entries["count"]; $i++) 
		   {
			   
			  try {
				  	$cliente[count($cliente)] = strtr($entries[$i]['displayname'][0],$tofind,$replac);
					//echo "<option VALUE='$cliente'> $cliente </option>";
				 	
					}
			 catch (Exception $e) {
						echo 'error';
						
					}	
			}
	$dn ='OU=PowerSolutions,dc=electrotecnica,dc=local';
	
	//$filter = '(samaccountname='.$user.')';
	$filter = '(objectClass=user)';
	
	$result = ldap_search($ldapconn, $dn, $filter); 
	$entries = ldap_get_entries($ldapconn, $result);
	for ($i=0; $i<$entries["count"]; $i++) 
		   {
			   
			  try {
				  	$cliente[count($cliente)] = strtr($entries[$i]['displayname'][0],$tofind,$replac);
					//echo "<option VALUE='$cliente'> $cliente </option>";
				 	
					}
			 catch (Exception $e) {
						echo 'error';
						
					}	
			}
	
	
		sort($cliente);
		foreach($cliente as $cli)
		{
			echo "<option VALUE='$cli'> $cli </option>";
			}
	
?>
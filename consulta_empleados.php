<?php
if (isset($_POST['q']))
{
	
	$bandera = $_POST['q'];
	}
else
{	
	$bandera = 0;
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
	
	
	
//PARTE DE ELECTRO	
	$dn ='OU=Electrotecnica,dc=electrotecnica,dc=local';
	
	//$filter = '(samaccountname='.$user.')';
	$filter = '(objectClass=user)';
	
	$result = ldap_search($ldapconn, $dn, $filter); 
	$entries = ldap_get_entries($ldapconn, $result); 
	
	$empleados_totales = array();
 	$empleados_con_user = array();
	$department = array();
	$manager = array();
	
	for ($i=0; $i<$entries["count"]; $i++) 
		   {
			   
			  try {
				  	$empleados_totales[count($empleados_totales)] = strtr($entries[$i]['displayname'][0],$tofind,$replac);
					$consulta = strtr($entries[$i]['department'][0],$tofind,$replac);
					$manager[count($manager)] = array('departamento' => $consulta,'manager'=> $entries[$i]['manager'][0]); 
					
					$empleados_con_user[count($empleados_con_user)] = array('nombre' => strtr($entries[$i]['displayname'][0],$tofind,$replac), 'user' => $entries[$i]['samaccountname'][0]);
					if(!in_array($consulta,$department))
					{						
						$department[count($department)] = $consulta; 
						}
					}
			 catch (Exception $e) {
						echo 'error';
						
					}	
			}
			
///PARTE DE POWER SOLUTION 
	$ldaprdn = "electrotecnica\\".$user;	
	$adServer = "pegasus.electrotecnica.local"; #replace with your AD server ip/hostname
	
	
	 $ldapconn = ldap_connect($adServer) 
			  or die("Couldn't connect to AD!"); 
		
	
		// Bind to the directory server. 
		$ldapbind = ldap_bind($ldapconn, $ldaprdn,$ldappass) or 
			  die("Couldn't bind to AD!"); 
	
	$dn ='OU=PowerSolutions,dc=electrotecnica,dc=local';
	
	//$filter = '(samaccountname='.$user.')';
	$filter = '(objectClass=user)';
	
	$result = ldap_search($ldapconn, $dn, $filter); 
	$entries = ldap_get_entries($ldapconn, $result); 
	
	for ($i=0; $i<$entries["count"]; $i++) 
		   {
			   
			  try {
				  	$empleados_totales[count($empleados_totales)] = strtr($entries[$i]['displayname'][0],$tofind,$replac);
					$consulta = strtr($entries[$i]['department'][0],$tofind,$replac);
					$manager[count($manager)] = array('departamento' => $consulta,'manager'=> $entries[$i]['manager'][0]);
					$empleados_con_user[count($empleados_con_user)] = array('nombre' => strtr($entries[$i]['displayname'][0],$tofind,$replac), 'user' => $entries[$i]['samaccountname'][0]); 
					if(!in_array($consulta,$department))
					{						
						$department[count($department)] = $consulta; 
						}
					}
			 catch (Exception $e) {
						echo 'error';
						
					}	
			}
	


switch($bandera)
{
case 0://departamentos
		echo '<BR>';
		echo '<SELECT NAME="outside" id="outside" MULTIPLE SIZE=11>';
		sort($empleados_totales);
		foreach($empleados_totales as $emp)
		{
			echo '<option id="'.$emp.'">'.$emp.'</option>';
			}
		echo '</select>';
		break;
case 1://candidatos
		echo '<BR>';
		echo '<SELECT NAME="candidatos" id="outside" MULTIPLE SIZE=11>';
		sort($empleados_totales);		
		foreach($empleados_totales as $emp)
		{
			echo '<option id="'.$emp.'">'.$emp.'</option>';
			}
		echo '</select>';
		break;
case 2://departamentos
		echo '<SELECT NAME="departamentos" id="departamentos" class="cambiante">';
		sort($department);
		foreach($department as $dep)
		{
			echo '<option id="'.$dep.'">'.$dep.'</option>';
			}
		echo '</select>';
	break;
	
case 3: //obtiene el manager del departamento
$opcion =  $_POST['op'];
$boss_manager = array();
foreach ($manager as $man)
{
	if($man['departamento'] == $opcion)
	{
		$ls = explode(',',$man['manager']);
		$ls = explode('=',$ls[0]);
		$boss_manager[count($boss_manager)] = $ls[1];
		}
	}
echo $boss_manager[count($boss_manager) -1];
break;
	
	
	case 4:
	sort($empleados_con_user);		
	foreach($empleados_con_user as $emp)
	{
			echo '<option value="'.$emp['user'].'">'.$emp['nombre'].'</option>';
		}
	
	break;
	
}
 ?>
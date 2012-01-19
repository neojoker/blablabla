<?php	

$estado = 0;
$user = $_POST['user'];
$pass = $_POST['pass'];

	if($user == '' || $pass == '')
		{
			$estado = 1;
		}
		else
		{
			session_start();
			//echo "Inicia autenticacion";
			$adServer = "pegasus.electrotecnica.local"; #replace with your AD server ip/hostname
			$ldapconn = ldap_connect($adServer)
			or $this->msg = "Could not connect to LDAP server.";
	
			$ldaprdn = "electrotecnica\\".$_POST['user'] ;
			//echo $ldaprdn;
			$ldappass = $_POST['pass'];
			
	
			try
			{
				$ldapbind = ldap_bind($ldapconn, $ldaprdn,$ldappass);
				if ($ldapbind) {
				
				$_SESSION['userblanco'] = $user;
				$_SESSION['user'] = $ldaprdn;
				$_SESSION['pass'] = $ldappass;
				//header('Location: formulario.php');
				$estado = 3;
				
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
					
					$_SESSION['name'] = $Nombre;
					$_SESSION['manager'] = $manager;
					$_SESSION['departmen'] = $departmen ;
					$_SESSION['bossname'] = $bossname;
					$_SESSION['bossacount'] = $bossacount;
					$_SESSION['bossmail'] = $bossmail;
					$_SESSION['employmail'] = $employmail;
					}
		 
				} else {
					
					
				
					
				$estado = 2;
				}
			} catch (Exception $e) {
   				 echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		
		echo $estado;

?>
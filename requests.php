<?php
session_start();
$user = $_SESSION['userblanco'];
include "encabezado.php";
write_header('Solicitudes Pendientes');
write_body('Solicitudes Pendientes',$user);
write_notificacion();


////////////////////////////////////////////////////////ESPACIO PARA EL CODIGO CONSULTOR DE LA INFORMACION, FORMAR TODOS LOS ARRAY AQUI Y SOLO PINTAR EN MAS ADELANTE

 $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
	     		   $replac = "abcdeeghijklaaoiqosuunwxyzabcdeeghijklmaoiqosuunwxyza";
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
						
						$filter = '(samaccountname='.$user.')';
						
						$result = ldap_search($ldapconn, $dn, $filter); 
						$entries = ldap_get_entries($ldapconn, $result); 
						
						
						try
						{
							$nombre_completo = strtr($entries[0]['displayname'][0],$tofind,$replac);
							$departemt_propio = strtr($entries[0]['department'][0],$tofind,$replac);
							}
						catch(Exception $e)
						{
							}			   
					$username = "root";
					$password = "critical";
					$hostname = "localhost"; 
					
					
					//connection to the database
					$dbhandle = mysql_connect($hostname, $username, $password) 
					  or die("Unable to connect to MySQL+++".mysql_error());
					  
					  
					  
					$selected = mysql_select_db("Blog",$dbhandle) 
					  or die("Could not select examples");
					  
					$sql = 'select * from Solicitud where encargado = "'.$nombre_completo.'"'; 
					
					$result = mysql_query($sql,$dbhandle);
					
					$propias = array();
					
					while ($row = mysql_fetch_array($result)) 
						{
							$propias[count($propias)] = $row;
						}
						
					$sql = 'select * from Solicitud where departamento = "'.$departemt_propio.'"'; 

					$result = mysql_query($sql,$dbhandle);
					
					$departamentales = array();
					
					while ($row = mysql_fetch_array($result)) 
						{
							$departamentales[count($departamentales)] = $row;
						}
						
					$sql = 'select * from Solicitud where solicitante = "'.$user.'"'; 

					$result = mysql_query($sql,$dbhandle);
					
					$outsiders = array();
					
					while ($row = mysql_fetch_array($result)) 
						{
							$outsiders[count($outsiders)] = $row;
						}
	
	
				mysql_close($dbhandle);	
				
				
function get_last_update($identificador)
{
	$username = "root";
	$password = "critical";
	$hostname = "localhost"; 
	$dbhandle = mysql_connect($hostname, $username, $password) 
		or die("Unable to connect to MySQL+++".mysql_error());
	$selected = mysql_select_db("Blog",$dbhandle) 
		or die("Could not select examples");
		
		
	$sql = 'select fecha from actividades where id_post = '.$identificador.' order by fecha desc limit 1';
	
	$result = mysql_query($sql,$dbhandle);
	
	$fechas = array();
	
	while ($row = mysql_fetch_array($result)) 
		{
			$fechas[count($fechas)] = $row;
		}
	if(count($fechas) == 0)
	{
		$sql = 'select fecha_inicio from Solicitud where id_solicitud = ' . $identificador;
		$result = mysql_query($sql,$dbhandle);
		$row = mysql_fetch_array($result);
		return $row[0];
		
		}
	else
	{	
		return $fechas[0][0];
	}
}


function imprimir_fecha($dia)
{
	$fechaphp = strtotime($dia);
	$fecha_tramite = date("j M Y, g:i a",$fechaphp);
	return $fecha_tramite;
	}

?>
<div id="main" role="main">
	<div id="tabla_propia" class="item"> 
		<div id="users-contain" class="ui-widget">
  			
            <a class="sobre_titulo">Buzon de entrada</a>
            <h1>Solicitudes Personales:</h1>
				<table id="propios" class="ui-widget ui-widget-content" style="font-size: 1em;margin: 1em 0;margin-top: 1em;margin-right: 0px;margin-bottom: 1em;margin-left: 0px;border-collapse: collapse;width: 250%;">
					<thead>
						<tr class="ui-widget-header ">
							<th class="fila">Cliente</th>
							<th>Solicitado</th>
							<th>Asunto</th>
                			<th>Fecha apertura</th>
                			<th>Fecha ultima actualizacion</th>
		    			</tr>
	    			</thead>
					<tbody>
					
                    
                   <?php 
				  	foreach($propias as $propia)
					{
						echo '<tr class="boton_fila" id="'.$propia['id_solicitud'].'">';
						echo '<td>'.$propia['cliente'].'</td>';
						echo '<td>'.$propia['solicitante'].'</td>';
						echo '<td>'.$propia['asunto'].'</td>';
						//cambiar fecha a un formato mas entendible
						
						$fecha_tramite = imprimir_fecha($propia['fecha_inicio']);
						echo '<td>'.$fecha_tramite.'</td>';
						//funcion para obtener el last update
						
						
						$fecha_ultima_actualizacion = imprimir_fecha(get_last_update($propia['id_solicitud']));
						
						echo '<td>'.$fecha_ultima_actualizacion.'</td>';
						echo '</tr>';
						}
				   
				   
				   ?>
                    </tbody>
                </table>
  </div>
  
  
  	<div id="users-contain" class="ui-widget">
  			<h1>Solicitudes Departamento: <?php echo $departemt_propio?></h1>
				<table id="propios" class="ui-widget ui-widget-content" style="font-size: 1em;margin: 1em 0;margin-top: 1em;margin-right: 0px;margin-bottom: 1em;margin-left: 0px;border-collapse: collapse;width: 250%;">
					<thead>
						<tr class="ui-widget-header ">
							<th class="fila">Cliente</th>
							<th>Solicitado</th>
							<th>Encargado</th>
                            <th>Asunto</th>
                			<th>Fecha apertura</th>
                			<th>Fecha ultima actualizacion</th>
		    			</tr>
	    			</thead>
					<tbody>
					<?php 
						foreach($departamentales as $departamento)
						{
							echo '<tr class="boton_fila" id="'.$departamento['id_solicitud'].'">';
							echo '<td>'.$departamento['cliente'].'</td>';
							echo '<td>'.$departamento['solicitante'].'</td>';
							echo '<td>'.$departamento['encargado'].'</td>';
							echo '<td>'.$departamento['asunto'].'</td>';
							
							$fecha_tramite = imprimir_fecha($departamento['fecha_inicio']);
							echo '<td>'.$fecha_tramite.'</td>';
							
							$fecha_ultima_actualizacion = imprimir_fecha(get_last_update($departamento['id_solicitud']));
							
							echo '<td>'.$fecha_ultima_actualizacion.'</td>';
							echo '</tr>';
							}
					?>
					
                    </tbody>
                </table>
  </div>
  
<br><img src="img/line.jpg" alt="Grupo Electrotecnica" width="740" height="25" border="0"><br>
  	<div id="users-contain" class="ui-widget">
    <a class="sobre_titulo">Buzon de salida</a>
  			<h1>Solicitudes a otros Departamentos:</h1>
				<table id="propios" class="ui-widget ui-widget-content" style="font-size: 1em;margin: 1em 0;margin-top: 1em;margin-right: 0px;margin-bottom: 1em;margin-left: 0px;border-collapse: collapse;width: 250%;">
					<thead>
						<tr class="ui-widget-header ">
                        	<th>Departamento</th>
                            <th>Encargado</th>
							<th class="fila">Cliente</th>
							<th>Solicitado</th>
							<th>Asunto</th>
                			<th>Fecha apertura</th>
                			<th>Fecha ultima actualizacion</th>
		    			</tr>
	    			</thead>
					<tbody>
					<tr>
                    
                    <?php 
						foreach($outsiders as $outsider)
						{
							echo '<tr class="boton_fila" id="'.$outsider['id_solicitud'].'">';
							echo '<td>'.$outsider['departamento'].'</td>';
							echo '<td>'.$outsider['encargado'].'</td>';
							echo '<td>'.$outsider['cliente'].'</td>';
							echo '<td>'.$outsider['solicitante'].'</td>';
							echo '<td>'.$outsider['asunto'].'</td>';
							
							$fecha_tramite = imprimir_fecha($outsider['fecha_inicio']);
							echo '<td>'.$fecha_tramite.'</td>';
							$fecha_ultima_actualizacion = imprimir_fecha(get_last_update($outsider['id_solicitud']));
							
							
							echo '<td>'.$fecha_ultima_actualizacion.'</td>';
							echo '</tr>';
							}
					
					?>
                    	
                    </tbody>
                </table>
  </div>
<?php
include "footer.php";
 write_footer('solicitudes_pendientes');
?>

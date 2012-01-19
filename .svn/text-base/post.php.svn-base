<?php
session_start();

if(isset($_SESSION['ultimo_id']))
{
	$id = $_SESSION['ultimo_id'];
}
else
{
	header('Location: post_pendientes.php');
	}


$user = $_SESSION['userblanco'];
include "encabezado.php";
write_header('Peticion');
write_body('Peticicion',$user);
write_notificacion();

//FUNCION PARA OBTENER TODA LA INFO ACTUAL DEL POST PRINCIPAL, RESTO DE LA CONSULTA EN UN POST DE JQUERY CON UN SET INTERVAR
 

					$username = "root";
					$password = "critical";
					$hostname = "localhost"; 
					
					
					//connection to the database
					$dbhandle = mysql_connect($hostname, $username, $password) 
					  or die("Unable to connect to MySQL+++".mysql_error());
					  
					  
					  
					$selected = mysql_select_db("Blog",$dbhandle) 
					  or die("Could not select examples");
					  
					  
					$sql = 'select * from Solicitud where id_solicitud = ' . $id;
					
					$result = mysql_query($sql,$dbhandle);
					
					$datos_principal = array();
					
					while ($row = mysql_fetch_array($result)) 
						{
							$datos_principal = $row;
	
						}
						
						
						
						
function calcular_tiempo($date)
{
	date_default_timezone_set('America/Costa_Rica');
	$fecha_actual = strtotime(date("Y-m-d H:i:s"));
	$date = strtotime($date);
	if(date("Y",$date) != date("Y",$fecha_actual))
	{
		$cantidad =  date("Y",$fecha_actual) - date("Y",$date);
		return 'Hace '.$cantidad. ' años';
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
<div id="main" role="main">


<div id="post">
<form class="blue">

			<fieldset>
            
            <div id="header_post" class="header_post">
          
					<span id="nombre" class="nombre"><?php echo $datos_principal['solicitante'];?></span><span class="fecha"> <?php echo calcular_tiempo($datos_principal['fecha_inicio']); ?></span>
                    <br />
                    <span class="departamento"><?php echo $datos_principal['departamento'];?></span>
                </div>
                
                <div id="subject_post" class="subject_post">
                <span class="subjet">Asunto : <?php echo $datos_principal['asunto']; ?> </span>
                <br/>
                <span class="cliente"><?php echo $datos_principal['cliente'];?></span>
                </div>
                
                <div id="body_post">
                <p><?php echo $datos_principal['contenido'];?></p>
                </div>
                
                <div id="caso" class="caso">Solicitud # : <span id="id"><?php echo $datos_principal['id_solicitud'];?></span></div>
		
		
			</fieldset>   
		</form>
</div>


<div id="grow"></div>
<div id="post">
          <form class="dashboard">

			<fieldset>
			
				<legend>Ingresar Solicitud al blog</legend>
		
			<ol class="quitar_padding">
               	<li class="quitar_padding">
				  	<label for="solicitud_label">Solicitud</label>
                    <br/>
                    <textarea id='solicitud_area' style='width: 550px; height:150px;'></textarea>
					<br/>
                </li>
             </ol>
			
            	
              <div id="boton_list" class="botton_list"> 
               <button id="enviar" class="icon">Enviar</button>
               <button id="add" class="icon">vincular</button>
               <button id="eliminar" class="icon">desvincularse</button>
               <button id="cerrar" class="icon">Cerrar caso</button>
               <button id="person" class="icon">cambiar encargado</button>
               </div>
			</fieldset>   
		</form>
 <div id="diag_involucrado"></div>
 <div id="diag_eliminar"></div>
 <div id="diag_cerrar"></div>
 <div id="diag_cambiar"></div>
 <span id="contador" class="0"></span>

<?php
include "footer.php";
 write_footer('peticion');
?>
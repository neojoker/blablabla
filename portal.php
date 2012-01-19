<?php 
session_start();
$user = $_SESSION['userblanco'];
include('encabezado.php');
write_header('Grupo Electrot&eacute;cnica');
write_body('Grupo Electrotecnica', $user);
write_notificacion();

include('groups.php');

$grupos = array();
$grupos = generar_lista_grupos();
?>
		<div id="main" role="main" class="blanco espacio_superior">
			<div class="rows">
<div class="row even"><h2>General</h2>
					<a href="blog_request.php"><img src="img/icons/blog-de-ideas.png" alt="Blog" width="70" height="70"/><span>Crear solicitud</span></a>
                	<a href="requests.php"><img src="img/icons/blog-de-ideas.png" alt="Blog" width="70" height="70"/><span>Solicitudes pendientes</span></a>
                    
</div>       

<?php

if(in_array('comercial',$grupos) || in_array('portalmanager',$grupos))
{
	echo "<div class=\"rows\">
<div class=\"row even\"><h2>Comercial</h2>
					<a href=\"menu_servicios.php\"><img src=\"img/icons/busqueda-de-equipos-en-garantia.png\" alt=\"Servicios\" width=\"70\" height=\"70\"/><span>Servicios</span></a>
					</div>   
";
	}

			
                   
?>
                    
<div class="row even"><h2>Gestion Humana</h2>
                    <a href="request_vacation.php"><img src="img/icons/vacaciones.png" alt="Solicitud" width="70" height="70"/><span>Solicitud de vacaciones</span></a>
                    
<?php
if (in_array('portalvacacionesmanager',$grupos))
{
	echo '<a href="datos_maestros.php"><img src="img/icons/vacaciones.png" alt="Informe" width="70" height="70"/><span>Maestro de Empleados</span></a>';
	echo '<a href="last_request.php"><img src="img/icons/vacaciones.png" alt="Informe" width="70" height="70"/><span>Ultimas solicitudes</span></a>';
	echo '<a href="mantenimiento_empleado.php"><img src="img/icons/vacaciones.png" alt="Informe" width="70" height="70"/><span>Manteminiento empleados</span></a>';
	echo '<a href="manteminiento_solicitudes.php"><img src="img/icons/vacaciones.png" alt="Informe" width="70" height="70"/><span>Manteminiento solicitudes</span></a>';
	echo '<a href="mantenimiento_feriados.php"><img src="img/icons/vacaciones.png" alt="Informe" width="70" height="70"/><span>Manteminiento feriados</span></a>';
	}
?>				
         </div>
        </div>
       </div>
<?php
include ('footer.php');
write_footer('portal');
?>

<?php 
session_start();
$user = $_SESSION['userblanco'];
include('encabezado.php');
write_header('busqueda_servicios');
write_body('busqueda_servicios', $user);
write_notificacion();

include('groups.php');
?>
<div id="main" role="main" style="margin-bottom:10px; height:auto;">

<div id="body_principal" class="body_menu"><!--BODY PRINCIPAL-->
	<div id="navegador" class="navegador_bloque">
    	<div id="texto_busqueda" class="textos_busqueda">
        	<span>Elija el m&eacute;todo de b&uacute;squeda : </span>
        </div>
    	<div id="menu_accesos_directos" class="accesos_directos">
        	<ul>
            	<li><a href="clientes.php">Raz&oacute;n Social</a></li>
                <li class="center_menu"><a href="tarjeta.php">Serie Fabricante</a></li>
                <li><a href="contratos.php">C&oacute;digo Contrato</a></li>
            </ul>
        </div>    	
    </div>

</div><!--FIN //BODY PRINCIPAL-->		
        
        
<?php
include ('footer.php');
write_footer('menu_servicios');
?>

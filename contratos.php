<?php 
session_start();
$user = $_SESSION['userblanco'];
include('encabezado.php');
write_header('Contrato de servicio');
write_body('Contrato de servicio', $user);
write_notificacion();

if(isset($_GET['par'])) 
		$parametro_oculto = $_GET['par'];
	else
		$parametro_oculto = '';
?>
<div id="main" role="main" style="margin-bottom:20px;">

<div id="body_principal" class="bloque_principal"><!--BODY PRINCIPAL-->

	<div id="buscador" class="bloque_buscador"><!--BODY DEL BUSCADOR PARA CADA PAGINA-->
    <form class="menu_busqueda">
    <ol class="replace">
    	<li class="filas_problema">
        	<input type="hidden" id="parametro_oculto" style="width:0px; height:0px;" value="<?php echo $parametro_oculto?>"/>
    		<label class="menu_label" for="busqueda";>Codigo de contrato :</label>
    		<input class="menu_input" type="text" id="busqueda"> 
            <img class="menu_imagen" src="img/lupa2.png" id="busqueda_link" width="23" height="20"/>
            
     	</li>
    </ol>
     </form>
    
    </div><!--FIN //BODY DEL BUSCADOR PARA CADA PAGINA-->
    
    <div id="body_dinamico" class="bloque_secundario"><!--Contenedor del menu y el display dinamico-->
    	
        <div id="menu" class="bloque_menu"><!--Contenedor del menu-->
        <?php
		include('menu.php');
		write_menu('contratos');
		?>
        
       	</div><!--FIN //Contenedor del menu-->
        
        
        
        <div id="dinamico" class="bloque_dinamico"><!--Contenedor dinamico no se si iframe o replace JQUERY TOP CHOOSE-->
    	</div><!--FIN //Contenedor dinamico no se si iframe o replace JQUERY TOP CHOOSE-->
   </div><!--FIN //Contenedor del menu y el display dinamico-->


</div><!--FIN //BODY PRINCIPAL-->

<div id="buscador_form" title="Contratos" style="width:auto; height:auto">    
    <div id="tabla_busqueda">
    <form>
    <fieldset>
    <label for="nombre";>Codigo contrato:</label>
    <input type="text" id="nombre_diag">
    </div>
    <div id="remplazo_tabla"></div>
	</fieldset>
    </form>
</div>

<?php
include ('footer.php');
write_footer('contratos');
?>

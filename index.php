<?php 
include "encabezado.php";
write_header('login');
write_body('Login','login');
write_notificacion();
?>
<div id="main" role="main" class="blanco">
			<div id="movimiento_tamano" class="mov_tam">
            <form class="dashboard" id="index_extendido" method="post" action="index.php">
		
			<fieldset>
			
				<legend class="letra_12">Iniciar sesi&oacute;n</legend>
		
				<ol class="mover_izquierda_ol" >
					
					<li>
						<label for="name">Usuario</label>
                        <br/>
						<input type="text" autofocus="" required="" placeholder="" name="name" id="name">
                        <br/>
					</li>
					
					<li>
						<label for="email">Contrase&ntilde;a</label>
                        <br/>
						<input type="password" required="" name="password" id="password">
					</li>
						
				</ol>
			
			</fieldset>
			
			<fieldset class="mover_izquierda_button">
			
				<button type="submit" id="aceptar">Iniciar sesi&oacute;n</button>
              
			</fieldset>
		
		</form>
  </div>
 <?php 
 include "footer.php";
 write_footer('login');
 ?>       
     

<?php
session_start();
$user = $_SESSION['userblanco'];
include "encabezado.php";
write_header('Blog de solicitudes');
write_body('Blog de solicitudes',$user);
write_notificacion();

//ESPACIO PARA OBTENER TODOS LOS DEPARTAMENTOS Y DESPUES AGREGAR METODOS EN EL JQUERY PARA PONER EL MANAGER DEL GRUPO


?>
			
		<div id="main" role="main">
			
			<form class="dashboard">
					
			<fieldset>
			
				<legend>Ingresar Solicitud al blog</legend>
		
			<ol>
				<li>
					<label for="cliente_label">Cliente</label>
					<input type="text" autofocus="" required="" placeholder="Cliente" name="Cliente" id="cliente">
                    <img src="img/lupa2.png" href="#" id="link_clientes" width="23" height="20" />
                    <br/>
				</li>	
				<li>
				  <label for="departamento">Departamento</label>
					<select name="departamentos" id="departamentos">
                       
                        
                    </select>
		
                    
                    <br/>
				</li>
				<li>
					<label for="encargado_label">Encargado</label>
					<input type="text" required="" placeholder="Encargado" name="text_encargado" id="text_encargado" class="make_icon">
                    <br/>
				</li>
                	
                <li>
               		<label for="vinculados_label">Vinculados</label>
                	<img src="img/add.png" href="#" id="plus_involucrados" width="10" height="10" /> 
                    <div id="contenedor_involucrados" class="text_involucrado">
                   		<div id= "grow"></div>
                    </div>
                    <br/>
                </li>
               
                <li>
				  	<label for="asunto_label">Asunto</label>
					<input type="text" required="" placeholder="Asunto" name="text_asunto" id="text_asunto">
                	<br/>
                </li>
                <li>
				  	<label for="prioridad_label">Prioridad</label>
                   
                   	<div id="radio">
                        <input type="radio" id="alta" name="radio" value="alta" /><label for="alta">Alta</label>
                        <input type="radio" id="normal" name="radio" checked="normal" value= "normal"/><label for="normal">Normal</label>
                    </div>
                    
                                
                    <br/>
                </li>
               	   <li>
				  	<label for="solicitud_label">Solicitud</label>
                    <br/>
                    <textarea id='solicitud_area' style='width: 450px; height:300px;'></textarea>
					<br/>
                </li>
             </ol>
			
            
               <button id="boton_aceptar">Aceptar</button>
               <button id="boton_cancelar">Cancelar</button>
			</fieldset>   
            
            
                     
		</form>
     <div id="diag_clientes"></div>
     <div id="diag_encargado"></div>
     <div id="diag_involucrado"></div>
<?php
include "footer.php";
 write_footer('blog');
?>
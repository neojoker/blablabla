<?php
session_start();
$user = $_SESSION['userblanco'];
$departmen = $_SESSION['departmen'];
$manager = $_SESSION['manager'];
include "encabezado.php";

write_header('Mantenimiento empleados');
write_body('Mantenimiento empleados',$user);
write_notificacion();
?>

<div id="main" role="main" class="blanco">
			<div id="movimiento_tamano" class="mov_tam">
			<form class="dashboard" id="index_extendido_manager">
					
			<fieldset>
            
            <legend style="text-align: center; font-size:12px"> Mantenimiento empleados </legend>
            
            <ol>
            	
                <li>
                	<label for="lista_empleados">Lista de empleados : </label>
                    <select id="lista_empleados"></select>
                    <br />
                </li>
                
                
                 <li>
                    <label for="fecha_ingreso">Fecha de Ingreso : </label>
                    <input type="text" id="fecha_ingreso" name="fecha_ingreso" value="">
                    <br />
                </li>
                
                 <li>
                    <label for="saldo">Cantidad de dias disponibles : </label>
                    <input type="text" id="saldo" name="saldo" value="">
                    <br/>
                </li>
                
                <li>
                	<label for="comentarios">Comentarios: </label>
                	<textarea name="comentarios" id="comentarios" cols="45" rows="5">
                    </textarea>
                    <br/>
               	</li>
                
                
                	 <div class="botones_vacaciones_izquierda">
                      <button id="guardar">Guardar</button>
                      <button id= "cancelar">Cancelar</button>
                  </div>
            </ol>
            
            
            </fieldset>
            
            
            </form>
            
        </div>
    




         
<?php
include "footer.php";
 write_footer('mantanimiento_empleados');

?>
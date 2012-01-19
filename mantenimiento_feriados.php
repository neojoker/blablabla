<?php
session_start();
$user = $_SESSION['userblanco'];
$departmen = $_SESSION['departmen'];
$manager = $_SESSION['manager'];
include "encabezado.php";

write_header('Mantenimiento feriados');
write_body('Mantenimiento feriados',$user);
write_notificacion();
?>

<div id="main" role="main" class="blanco">
			<div id="movimiento_tamano" class="mov_tam">
			<form class="dashboard" id="index_extendido_manager">
					
			<fieldset>
            
            <legend style="text-align: center; font-size:12px"> Mantenimiento de dias festivos </legend>
            
            <ol>
            	
                <li>
                	<label for="lista_feriados">Dias festivos : </label>
                  	<div id="dias">
                        <table id="tabla_feriados" border="0" cellspacing="0">
                          <thead>
                              <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Dia</th>
                              </tr>
                         </thead>
                        </table>
					 </div>
                    <br />
                </li>
                
                
                 <li>
                    <label for="nombre">Festividad : </label>
                   <input type="text" id="nombre" name="fecha_ingreso" value="">
                    <br />
                </li>
                
                 <li>
                    <label for="saldo">Fecha : </label>
                    <input type="text" id="saldo" name="saldo" value="">
                    <br/>
                </li>
                
       
                
                
                	 <div class="botones_vacaciones_izquierda">
                      <button id="modificar">Modificar</button>
                      <button id= "agregar">Agregar</button>
                      <button id= "cancelar">Cancelar</button>

                  </div>
            </ol>
            
            
            </fieldset>
            
            
            </form>
            
        </div>
    




         
<?php
include "footer.php";
 write_footer('mantanimiento_feriados');

?>
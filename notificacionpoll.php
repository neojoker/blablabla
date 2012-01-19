<?php
session_start();
$user = $_SESSION['userblanco'];
include "encabezado.php";
write_header();//FALTA PARAMETR0**************
write_body();// FALTA PARAMETRO******************
write_notificacion();
secuencia();

//ESPACIO PARA OBTENER TODOS LOS DEPARTAMENTOS Y DESPUES AGREGAR METODOS EN EL JQUERY PARA PONER EL MANAGER DEL GRUPO

?>

 	<div id="main" role = "main">
     <form class="dashboard">
     	<fieldset>
          <legend>Notification Poll</legend>
        	<ol>
                <li>
                <label for="validez_label">Validez:</label>
                <input type="text" autofocus="" required="" name="Validez" id="validez" maxlength="2" width="20"> 
                <select id="semana_mes" name="Semana_Mes" >
                <option> Mes </option>
                <option> Semana </option>
                </select>
                
					</br>
                </li>
                <li>
                  <label for = "Comentario"></label>
                    <br/>
                    <textarea id='comentario_area' style='width: 450px; height:300px;' ></textarea>
                  </br>
                </li>
            </ol>
            <button id="boton_aceptar">Aceptar</button>
            <button id="boton_cancelar">Cancelar</button>
        </fieldset>
     </form>
    </div>


<?php
include "footer.php";
 write_footer('blog');
?>
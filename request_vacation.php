<?php
session_start();
$user = $_SESSION['userblanco'];
$departmen = $_SESSION['departmen'];
$manager = $_SESSION['manager'];
include "encabezado.php";

write_header('Servicio de vacaciones');
write_body('Servicio de vacaciones',$user);
write_notificacion();
$username = "root";
$password = "critical";
$hostname = "localhost"; 


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");
  
  $sql="SELECT Saldo,idEmpleado,nombre
			FROM Empleados
			WHERE user = '".$user."'";					
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$_SESSION['saldo'] = $row[0];
$_SESSION['idEmpleado'] = $row[1];
$_SESSION['nombre_empleado'] = $row[2];


$departmen = $_SESSION['departmen'];
$manager = $_SESSION['manager'];

?>

<div id="main" role="main" class="blanco">
			<div id="movimiento_tamano" class="mov_tam">
			<form class="dashboard" id="index_extendido_vacaciones">
					
			<fieldset>
            
            <legend style="text-align: center; font-size:12px"> Solicitud de vacaciones </legend>
            
            <ol>
            	
                <li>
                    <label for="nombre_empleado">Nombre: </label>
                    <input type="text" id="nombre_empleado" name="nombre_empleado" readonly="readonly"  disabled="disabled" value="<?php  echo $row[2]?> ">
                    <br/>
                </li>
                
                
                 <li>
                
                    <label for="depa"> Departamento: </label>
                    <input name="Depart" type="text" id='depa' readonly="readonly" disabled="disabled" value="<?php echo $departmen ?>"/> 
                	<br/>
                </li>
                
                
            	<li>
                    <label for="saldo">Saldo de d&iacuteas: </label>
                    <input type="text" id="saldo" name="saldo" readonly="readonly"  disabled="disabled" value="<?php  echo $row[0]?> ">
                    <br/>
                </li>
                
                
                 <li>
                	<label for="fecha_inicio">Fecha de Inicio:</label>
                	<input type="text" id="fecha_inicio" name="fecha_inicio" size="20" disabled="disabled"/>
                    <br/>
                </li>
                
                <li>
                	<label for="fecha_final">Fecha de conclusi&oacuten:</label>
                    <input type="text" id="fecha_final" name ='fecha_final' size="20" disabled="disabled"/> <input type="checkbox" id="medio_dia" name='medio_dia' value="true"/>
                <label for="medio_dia" id="medio_dia_label"style="margin-left: 370px;
margin-top: -65px;width:16px; height:16px;">&frac12;</label>
                </li>
                     
                <li>
                	<label for="dias_solicitados">D&iacuteas solicitados: </label>
                    <input type="text" id='dias_solicitados' size="2" disabled="disabled"/>
                	<br/>
                </li>               
                
                <li>
                	<label for="saldo_estimado">Saldo estimado: </label>
                    <input type="text" id='saldo_estimado' size="2" disabled="disabled"/>
                	<br/>
                </li>     
                
                <li>
                	<label for="jefe">Lider de departamento: </label>
                    <input name="IdJefe" type="text" id="jefe" value="<?php  
				$manager = explode('=',$manager);
				echo $manager[1]; ?>" size="70" readonly="readonly" disabled="disabled"/>
                	<br/>
                </li>

                <li>
                	<label for="textObservaciones">Comentarios: </label>
                	<textarea name="textObservaciones" id="textObservaciones" cols="45" rows="5"></textarea>
                    <br/>
               	</li>
                
                
                
                  <div class="botones_vacaciones_izquierda">
                      <button id="aplicar">Enviar</button>
                      <button id= "cancelar">Cancelar</button>
                  </div>
                    
             </ol>
          </fieldset>
          
         </form>
           </div>

         
<?php
include "footer.php";
 write_footer('request_vacaciones');

?>
<?php
$nombre = $_POST['nom'];

$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	



$tarjetas = array();

$sql = "SELECT manufSN FROM OINS WHERE manufSN like '$nombre%'";
$result = mssql_query($sql,$con);


while ($row = mssql_fetch_array($result)) 
	{
			$tarjetas[count($tarjetas)] = $row[0];
	}
	mssql_close($con);	
	

///////////////////////ESCRIBIR LA TABLA

echo "<div id=\"remplazo_tabla\">";



/*
foreach($clientes as $cli)
{
	echo "<tr id=\"fila\">
            	<td>".$cli['cod']."</td>
				<td>".$cli['nom']."</td>
            </tr>";
	}
echo "</tbody>";
        	
			
	*/
	
echo '<SELECT NAME="key_tarjetas" id="key_tarjetas" multiple="multiple">';
  				foreach ($tarjetas as $tarjeta) 
						{
 							echo "<option VALUE='".$tarjeta."'> ".$tarjeta." </option>";
						}
				echo '</SELECT>
				</div>';		
	

?>
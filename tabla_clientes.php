<?php
$nombre = $_POST['nom'];
$codigo = $_POST['cod'];

$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	

$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
$replac = "abcdeeghijklaaoiqosuunwNyzabcdeeghijklmaoiqosuunwxyza";

$clientes = array();

$sql = "select cardName,cardCode from OCRD where cardType = 'C' and cardName like '%$nombre%'";
$result = mssql_query($sql,$con);


while ($row = mssql_fetch_array($result)) 
	{
			$clientes[count($clientes)] = array('cod' => $row[1],'nom' => strtr($row[0],$tofind,$replac));
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
	
echo '<SELECT NAME="key_clientes" id="key_clientes" multiple="multiple">';
  				foreach ($clientes as $cliente) 
						{
 							echo "<option VALUE='".$cliente['cod']."'> ".$cliente['nom']." </option>";
						}
				echo '</SELECT>
				</div>';		
	

?>
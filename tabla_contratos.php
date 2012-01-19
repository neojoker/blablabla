<?php
$nombre = $_POST['nom'];

$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	

$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
$replac = "abcdeeghijklaaoiqosuunwNyzabcdeeghijklmaoiqosuunwxyza";

$contratos = array();

$sql = "SELECT ContractID,convert(nvarchar(30),U_SCG_CodContrato) FROM OCTR where U_SCG_CodContrato like '%$nombre%'";
$result = mssql_query($sql,$con);


while ($row = mssql_fetch_array($result)) 
	{
			$contratos[count($contratos)] = array('codigo' => $row[1],'numero' => $row[0]);
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
	
echo '<SELECT NAME="key_contratos" id="key_contratos" multiple="multiple">';
  				foreach ($contratos as $contrato) 
						{
 							echo "<option VALUE='".$contrato['numero']."'> ".$contrato['codigo']." </option>";
						}
				echo '</SELECT>
				</div>';		
	

?>
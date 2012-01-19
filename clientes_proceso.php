<?php

$parametro = $_POST['par'];
$clave_busqueda = $_POST['key'];

//$parametro = 1;
//$clave_busqueda = 2419;



$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	
	

switch($parametro)
{
	case 1: //PARAMETRO DE CONTRATOS
	
	
	$clave_busqueda =  explode("\n",$clave_busqueda);
	$clave_busqueda = $clave_busqueda[0];
	
$sql = "SELECT 
	Contrato.ContractID,
	CASE Contrato.status when 'A' THEN 'Autorizado' else 'Terminado' end as 'Status',
	Usuarios.U_NAME,
	Contrato.CntrcTmplt,
	Contrato.StartDate,
	Contrato.EndDate,
	CASE Contrato.SrvcType when 'R' THEN 'Regular' ELSE 'Garantía' end as 'SrvcType',
	 convert(nvarchar(10),Contrato.U_SCG_MonedaContrato),
	 convert(money,Contrato.U_SCG_MontoContrato),
	 convert(nvarchar(30),Contrato.U_SCG_FacturaA),
	 convert(nvarchar(15),Contrato.U_SCG_codcontrato),
	 convert(nvarchar(20),Contrato.U_SCG_Periodicidad),
	 convert(nvarchar(20),Contrato.U_SCG_ModalidadPref)
FROM OCTR Contrato INNER JOIN OUSR Usuarios ON Contrato.Owner=Usuarios.INTERNAL_K
	
WHERE Contrato.CstmrCode  ='$clave_busqueda'
ORDER BY Contrato.Status,Contrato.SrvcType

" ;

$result = mssql_query($sql,$con) or die('Consulta fallida: ' . mssql_get_last_message());


$arreglo_respuesta = array();

while($row = mssql_fetch_array($result))
{
	$arreglo_respuesta[count($arreglo_respuesta)] = $row;
	}	
	
	mssql_close($con);	
//////////////////////////////////////////////////GENERAR UNA TABLA CON EL SIGUIENTE QUERY
	
	echo "
	<div class=\"scrollTable\">
	<table>
    <thead>
	<tr>
    	<th  style=\"width:100px\">No. Contrato</th>
		<th  style=\"width:90px\">Codigo</th>
        <th  style=\"width:120px\">Fecha final</th>
        <th  style=\"width:130px\">Tipo de servicio</th>
		<th  style=\"width:80px\">Status</th>
		<th  style=\"width:110px\">Periodicidad</th>
		<th  style=\"width:130px\">Modalidad</th>
		<th  style=\"width:130px\">Precio</th>
		<th  style=\"width:200px\">Asesor</th>
		
    </tr>    
    </thead>
    <tbody>
	";
	
	
$bandera = 0;	
foreach($arreglo_respuesta as $a)
{
	
	if($bandera  == 0)
	{
		echo "<tr>
    	<td style=\"width:100px\"><a href=\"contratos.php?par=$a[0]\">$a[0]</a></td>
		<td style=\"width:90px\"><a href=\"contratos.php?par=$a[0]\">$a[10]</a></td>
    	<td style=\"width:120px\">".generar_fecha($a[5])."</td>
		<td style=\"width:130px\">$a[6]</td>
		<td style=\"width:80px\">$a[1]</td>
		<td style=\"width:110px\">$a[11]</td>
		<td style=\"width:130px\">$a[12]</td>
		<td style=\"width:130px\"> $a[7] ".separador_miles($a[8])."</td>
		<td style=\"width:200px\">".quitar_caracteres($a[2])."</td>
		</tr>";
		$bandera = 1;
		}
	else
	{
	echo "<tr>
    	<td style=\"width:100px\"><a href=\"contratos.php?par=$a[0]\"> $a[0] </a></td>
		<td style=\"width:90px\"><a href=\"contratos.php?par=$a[0]\">$a[10]</a></td>
		<td style=\"width:120px\">".generar_fecha($a[5])."</td>
		<td style=\"width:130px\">$a[6]</td>
		<td style=\"width:80px\">$a[1]</td>
		<td style=\"width:110px\">$a[11]</td>
		<td style=\"width:130px\">$a[12]</td>
		<td style=\"width:130px\">$a[7] ".separador_miles($a[8]) ."</td>
		<td style=\"width:200px\">".quitar_caracteres($a[2])."</td>
		</tr>";
		$bandera = 0;
		}
	}	    
	
	echo "
    </tbody>
</table>
</div>";

	break;
	
	case 2://PARAMETRO DE ARTICULOS


	$clave_busqueda =  explode("\n",$clave_busqueda);
	$clave_busqueda = $clave_busqueda[0];

$sql = "SELECT 
 		tarjeta.manufSN, 
 		tarjeta.itemName,
 		Contrato.ContractID,
 		convert(nvarchar(20),Contrato.U_SCG_CodContrato), 
 		CASE contrato.srvctype WHEN 'W' THEN 'Garantia' WHEN 'R' THEN 'Contrato' ELSE 'Ninguno' END as [Estado],
 		CASE Contrato.Status WHEN 'A' THEN 'Autorizado' WHEN 'T' THEN 'Terminado' ELSE '-'  end as  status,
 		CASE tarjeta.U_TipoEquipo WHEN 'UP' THEN 'A'  WHEN 'PL' THEN 'B' WHEN 'AA' THEN 'C' ELSE 'D' END AS ordenar,
 		CASE contrato.srvctype WHEN 'W' THEN 'B' WHEN 'R' THEN 'A' ELSE 'C' END as ordenar_estado, 
 		CASE Contrato.Status WHEN 'A' THEN 'A' WHEN 'T' THEN 'B' ELSE 'C'  end as  ordenar_status
 		
  
	FROM 
		OINS tarjeta 
		LEFT JOIN CTR1 Detalle on Tarjeta.InternalSN = Detalle.InternalSN 
		LEFT JOIN OCTR Contrato on  Contrato.ContractID = Detalle.ContractID
WHERE Tarjeta.customer ='$clave_busqueda'
ORDER BY ordenar,ordenar_estado,ordenar_status

" ;


$result = mssql_query($sql,$con) or die('Consulta fallida: ' . mssql_get_last_message());


$arreglo_respuesta = array();

while($row = mssql_fetch_array($result))
{
	$arreglo_respuesta[count($arreglo_respuesta)] = $row;
	}		
	mssql_close($con);	
//////////////////////////////////////////////////GENERAR UNA TABLA CON EL SIGUIENTE QUERY
	
	
	echo "
	<div class=\"scrollTable\">
	<table>
    <thead>
	<tr>
    	<th style=\"width:200px\">Serie de fabricante</th>
        <th style=\"width:340px\">Descripcion del articulo</th>
        <th style=\"width:100px\">No. Contrato</th>
        <th style=\"width:90px\">Cod. Contrato</th>
		<th style=\"width:130px\">Servicio</th>
		<th style=\"width:100px\">Status</th>
    </tr>    
    </thead>
    <tbody>
	";
	
$bandera = 0;	

foreach($arreglo_respuesta as $a)
{
	if($bandera  == 0)
	{
		echo "<tr>
			<td style=\"width:200px\"><a href=\"tarjeta.php?par=$a[0]\"> $a[0] </a></td>
			<td style=\"width:340px\">".quitar_caracteres($a[1])."</td>
			<td style=\"width:100px\"><a href=\"contratos.php?par=$a[2]\"> $a[2] </a></td>
			<td style=\"width:90px\"><a href=\"contratos.php?par=$a[2]\"> $a[3] </a></td>
			<td style=\"width:130px\">$a[4]</td>
			<td style=\"width:100px\">$a[5]</td>

			</tr>";
			$bandera = 1;
		}
	else
	{
		echo "<tr>
    		<td style=\"width:200px\"><a href=\"tarjeta.php?par=$a[0]\"> $a[0] </a></td>
			<td style=\"width:340px\">".quitar_caracteres($a[1])."</td>
			<td style=\"width:100px\"><a href=\"contratos.php?par=$a[2]\"> $a[2] </a></td>
			<td style=\"width:90px\"><a href=\"contratos.php?par=$a[2]\"> $a[3] </a></td>
			<td style=\"width:130px\">$a[4]</td>
			<td style=\"width:100px\">$a[5]</td>
		</tr>";
		$bandera = 0;

		}
	}	    
	
	echo "
    </tbody>
</table>
</div>";
	


	break;
	
	case 3:
	
	
		$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	


		
	$sql = "select cardName,cardCode from OCRD where cardType = 'C' and cardCode = '$clave_busqueda'";
	$result = mssql_query($sql,$con);
	$row = mssql_fetch_row($result);
	
	
	echo $row[0]; 
 	break;
	
	case 4:
	
	
		$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	

	$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
	$replac = "abcdeeghijklaaoiqosuunwxyzabcdeeghijklmaoiqosuunwxyza";
		
	$sql = "select cardName,cardCode from OCRD where cardType = 'C' and cardName = '$clave_busqueda'";
	$result = mssql_query($sql,$con);
	$row = mssql_fetch_row($result);
	echo $row[1]; 
 
 	break;
	
	
	case 5:
	
	
		$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	

	$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
	$replac = "abcdeeghijklaaoiqosuunwxyzabcdeeghijklmaoiqosuunwxyza";
		
	$sql = "select cardName,cardCode from OCRD where cardType = 'C' and cardCode = '$clave_busqueda'";
	$result = mssql_query($sql,$con);
	$row = mssql_fetch_row($result);
	echo $row[0]; 
 
 	break;
	

}

function generar_fecha($var)
{
	$respuesta = '';
	$respuesta = substr($var,0,11);
	
	return $respuesta;
	}

function generar_texto($var,$inicio,$final)
{
	$respuesta = '';
	
	if($var == 'N')
	{
		$respuesta = 'Sin servicio';
		}
	else if( ($var == 'Y') && ( $inicio != '00:00') && ($final != '23:59'))
	{
		$respuesta = "Servicio de las $inicio hasta las $final."  ;
		
		
		}
	else
	{
		$respuesta = 'Servicio 24 horas';
		}
		
	return $respuesta;	
	}
	
function generar_img($var,$inicio,$final)
{
	$respuesta = '';
	
	if($var == 'N')
	{
		$respuesta = 'circle_wrong';
		}
	else if( ($var == 'Y') && ( $inicio != '00:00') && ($final != '23:59'))
	{
		$respuesta = "circle_minus" ;		
		}
	else
	{
		$respuesta = 'circle_check';
		}	
		
		
	return $respuesta;
	}
	
function generar_moneda($monto, $moneda)
{
	$respuesta = '';
	
	if($moneda = 'USD')
		$respuesta =  $monto. ' Dolares';
	else
		$respuesta = $monto . ' Colones';
	
	return $respuesta;
	
	}
	
	
function generar_bandera($var)
{
	$respuesta = '';
	if($var == 'N')
		$respuesta = 'circle_wrong';
	else
		$respuesta = 'circle_check';
		
	return $respuesta;
	}
	
function generar_estado($var)
{
	$respuesta = '';
	
	if($var == 'Cerrado')
		$respuesta = 'circle_wrong';
	else
		$respuesta = 'circle_check';
	return $respuesta;
	}
	
function generar_status($var)
{
	$respuesta = '';
	
	if($var == 'Autorizado')
		$respuesta = 'circle_check';
	else
		$respuesta = 'circle_check';
	return $respuesta;
	}
	
function quitar_caracteres($var)
{
	$respuesta = '';
	
	$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
	$replac = "abcdeeghijklaaoiqosuunwNyzabcdeeghijklmaoiqosuunwxyza";
	
	$respuesta = strtr($var,$tofind,$replac);
		
	return $respuesta;
	}
	
function separador_miles($var)
{
	$respuesta = '';
	$caracter = explode('.',$var);
	$var = $caracter[0];
	
	$posicion = strrpos($var, ".");
	
	
	
	$caminador  = strlen($var);
	
	
	while($caminador > 3)
	{
	$respuesta = ','. substr($var,$caminador-3,3).$respuesta;
	$caminador = $caminador-3;
	}
	
		
	if($posicion)
	{
		$resto = $caracter[1];
		$respuesta = substr($var,0,$caminador) . $respuesta . '.' .$resto;
		}
	else
	{
		$resto = '';
		$respuesta = substr($var,0,$caminador) . $respuesta;
		}	
		
	return $respuesta;
	}
?>



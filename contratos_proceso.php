<?php

$parametro = $_POST['par'];
$clave_busqueda = $_POST['key'];

//$parametro = 1;
//$clave_busqueda = 2419;



$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	
	

switch($parametro)
{
	case 1: //PARAMETRO DE GENERAL
	
$sql = "SELECT 
	Contrato.ContractID, 
	Contrato.CstmrCode,
	Contrato.CstmrName,
	Contactos.Name,	
	Contactos.Tel1,
	Contrato.Descriptio,
	Contrato.TermDate,
	Contrato.status,
	Usuarios.U_NAME,
	Contrato.CntrcTmplt,
	Contrato.StartDate,
	Contrato.EndDate,
	CASE Contrato.SrvcType when 'R' THEN 'Regular' ELSE 'Garantía' end as 'SrvcType',
	(convert(nvarchar(10),contrato.ResponseV)+' '+ contrato.ResponseU)as 'Tiempo Respuesta',
	(convert(nvarchar(10),Contrato.ResponsVal)+' '+ contrato.ResponsUnt)as 'Tiempo Resolución',
	convert(nvarchar(20),Contrato.U_SCG_MonedaContrato),
	convert(money,Contrato.U_SCG_MontoContrato),
	convert(nvarchar(30),Contrato.U_SCG_GrupoContrato),
	convert(nvarchar(100),Contrato.U_SCG_FacturaA),
	convert(nvarchar(30),Contrato.U_SCG_tipofacturacio),
	convert(nvarchar(30),Contrato.U_SCG_empresaFact),
	convert(nvarchar(15),Contrato.U_SCG_CodContrato),
	convert(nvarchar(50),Contrato.U_SCG_intermediario),
	convert(nvarchar(20),Contrato.U_SCG_Periodicidad),
	convert(nvarchar(20),Contrato.U_SCG_TipoContratoEq),
	convert(nvarchar(20),Contrato.U_SCG_ModalidadPref),
	convert(nvarchar(20),Contrato.U_SCG_Modalidad),
	convert(nvarchar(20),Contrato.U_SCG_PrimerPeriodo),
	convert(nvarchar(20),Contrato.U_SCG_ContratoVincu),
	convert(nvarchar(15),Contrato.U_FrecFactura)
FROM 
	OCTR Contrato INNER JOIN OUSR Usuarios ON Contrato.Owner=Usuarios.INTERNAL_K
				  LEFT JOIN OCPR Contactos ON Contrato.CntctCode=Contactos.CntctCode
	
WHERE Contrato.ContractID ='$clave_busqueda'" ;


$result = mssql_query($sql,$con) or die('Consulta fallida: ' . mssql_get_last_message());


$arreglo_respuesta = array();

 $row = mssql_fetch_array($result); 
$arreglo_respuesta = $row;
		
	
	mssql_close($con);	

	
	
	
	
	////////////ECHO 
		echo  
"<!--BLOQUES DE INFORMACION ORDENAR CON EL CSS-->
<!--BLOQUES INFORMACION DEL CLIENTE-->
<div class=\"fila\">
	<div class= \"titulo\" >
		<a style=\"color:white\">Informacion Cliente</a>
	</div>
	<div class=\"contenedor_texto\">
			<div class=\"titulos\">
				<a>Nombre cliente : </a>
				<br />
				<a>Codigo de cliente : </a>
				<br />
				<a>Persona de Contacto : </a>
				<br />
				<a>Numero de telefono : </a>
				<br />
			</div>

			<div class=\"resultados\">
				<span>$arreglo_respuesta[2]</span>
				</br>
				<span><a  href=\"clientes.php?par=$arreglo_respuesta[1]\">$arreglo_respuesta[1]</a></span>
				</br>
				<span>".quitar_caracteres($arreglo_respuesta[3])."</span>
				</br>
				<span>$arreglo_respuesta[4]</span>
				</br>
			</div>
	</div>
</div>
<!--BLOQUES FECHAS DE CONTRATO-->

<div class=\"fila_derecha\">
		<div class= \"titulo\" >
			<a style=\"color:white\">Fechas de contrato</a>
			</br>
		</div>
	<div class=\"contenedor_texto\">
		<div class=\"titulos\">
			<a>Inicio : </a>
			<br />
			<a>Final : </a>
			<br />
			<a>Rescisión de contrato : </a>		
			<br />
			<a>Tiempo de respuesta : </a>
			<br />
			<a>Tiempo de resolución : </a>
			<br />
		</div>
		<div class=\"resultados\">
			<span>".generar_fecha($arreglo_respuesta[10])."</span>
			</br>
			<span>".generar_fecha($arreglo_respuesta[11])."</span>
			</br>
			<span>".generar_fecha($arreglo_respuesta[6])."</span>
			</br>
			<span>$arreglo_respuesta[13]</span>
			</br>
			<span>$arreglo_respuesta[14]</span>
			<br />
		</div>
	</div>
</div>	
		
		
		
<!--BLOQUES CARACTERISTICAS-->
<div class=\"fila creciente\">
	<div class=\"titulo_extendido\">
		<a style=\"color:white\">Caracteristicas</a>
		</br>
	</div>

	<div class=\"contenedor_texto\">
		<div class=\"bloque_izquierda\">
			<div class=\"titulos\">
				<a>Tipo de contrato : </a>
				<br />
				<a>Periodicidad : </a>
				<br />
				<a>Modalidad : </a>
				<br />
				<a>Código Contrato : </a>
				<br />
				<a>Precio : </a>
				<br />
				<a>Facturar a : </a>
			<br />
			</div>
			<div class=\"resultados\">
				<span>$arreglo_respuesta[24]</span>
				</br>
				<span>$arreglo_respuesta[23]</span>
				</br>
				<span>$arreglo_respuesta[25]</span>
				</br>
				<span>$arreglo_respuesta[21]</span>
				</br>
				<span>".generar_moneda($arreglo_respuesta[16],$arreglo_respuesta[15])."</span>
				<br />
				<span>".quitar_caracteres($arreglo_respuesta[18])."</span>
				<br />
				
			</div>
		</div>
	<div class=\"bloque_derecha\">
		<div class=\"titulos\">
			<a>Tipo facturación : </a>
			<br />
			<a>Empresa que factura : </a>
			<br />
			<a>Frecuencia de Facturación : </a>
			<br />
			<a>Intermediario : </a>
			<br />
			<a>Contrato vinculado a : </a>
			<br />
			<a>Modalidad por agrupación : </a>
			<br />
			
		</div>
		<div class=\"resultados\">
			<span>$arreglo_respuesta[19]</span>
			<br />
			<span>".quitar_caracteres($arreglo_respuesta[20])."</span>
			<br />
			<span>$arreglo_respuesta[29]</span>
			</br>
			<span>".quitar_caracteres($arreglo_respuesta[22])."</span>
			<br />
			<span>$arreglo_respuesta[28]</span>
			<br />
			<span>$arreglo_respuesta[26]</span>
			<br />
		</div>
	</div>
</div>
</div>
		
		

<!--BLOQUES FECHAS DE SERVICIO-->
<div class=\"fila_secundaria\">
	<div class=\"titulo\">
		<a style=\"color:white\">Servicio</a>
		</br>
	</div>

	<div class=\"contenedor_texto\">
		<div class=\"titulos\">
			<a>Tipo de servicio : </a>
			<br />
			<a>Modelo : </a>
			<br />
			<a>Titular : </a>
			<br />
			<a>Primer periodo : </a>
			<br />
			<a>Status : </a>
			<br />
		</div>
		<div class=\"resultados\">
		
			<span>$arreglo_respuesta[12]</span>
			</br>
			<span>$arreglo_respuesta[9]</span>
			</br>
			<span>".quitar_caracteres($arreglo_respuesta[8])."</span>
			</br>
			<span>$arreglo_respuesta[27]</span>
			</br>
			<span>$arreglo_respuesta[7]</span>
			<br />
		</div>
	</div>
</div>
			";
	
	break;
	
	case 2://PARAMETRO DE ARTICULOS

$sql = "SELECT 
	Articulos.StartDate,
	Articulos.ItemName,
	Articulos.InternalSN,
	Articulos.ManufSN,
	Articulos.ContractID,
	convert(nvarchar(10),Articulos.U_SCG_MonedaFila),
	convert(money,Articulos.U_SCG_MontoFila)
FROM OCTR Contratos INNER JOIN CTR1 Articulos ON Contratos.ContractID=Articulos.ContractID
	WHERE Contratos.ContractID ='$clave_busqueda'" ;


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
    	<th style=\"width:200px\">Numero de serie</th>
        <th style=\"width:425px\">Descripcion del articulo</th>
        <th style=\"width:135px\">Precio por item</th>
        <th style=\"width:200px\">Serie fabricante</th>
    </tr>    
    </thead>
    <tbody>
	";
	
	
foreach($arreglo_respuesta as $a)
{
	echo "<tr>
    	<td style=\"width:200px\"><a href=\"tarjeta.php?par=$a[2]\"> $a[2] </a></td>
		<td style=\"width:425px\">".quitar_caracteres($a[1])."</td>
		<td style=\"width:135px\">$a[5] ".separador_miles($a[6])."</td>
    	<td style=\"width:200px\">$a[3]</td>
		</tr>";
	}	    
	
	echo "
    </tbody>
</table>
</div>";
	


	break;
	
	case 3://PARAMETRO DE COBERTURA
	
	
	$sql = "
	SELECT 
	   Contratos.MonEnabled,
	   Contratos.MonStart,
	   Contratos.MonEnd,
	   Contratos.TueEnabled,
	   Contratos.TueStart,
	   Contratos.TueEnd,
	   Contratos.WedEnabled,
	   Contratos.WedStart,
	   Contratos.WedEnd,
	   Contratos.ThuEnabled,
	   Contratos.ThuStart,Contratos.ThuEnd,
	   Contratos.FriEnabled,
	   Contratos.FriStart,
	   Contratos.FriEnd,
	   Contratos.SatEnabled,
	   Contratos.SatStart,
	   Contratos.SatEnd,
	   Contratos.SunEnabled,
	   Contratos.SunStrart,
	   Contratos.SunEnd,
	   Contratos.InclParts,
	   Contratos.InclTravel,
	   Contratos.InclWork,
	   Contratos.InclHldays
FROM OCTR Contratos 
	WHERE Contratos.ContractID ='$clave_busqueda'" ;

	
	$result = mssql_query($sql,$con) or die('Consulta fallida: ' . mssql_get_last_message());


	$arreglo_respuesta = array();
	
	$row = mssql_fetch_array($result); 
	$arreglo_respuesta = $row;
				
	mssql_close($con);	
	
	
	echo "
	
<!-- BLOQUE DE HORARIO DE ANTENCION   -->
<div class=\"fila\">
	<div class= \"titulo\" >
		<a style=\"color:white\">Horario de atencion</a>
		<br/>
	</div>
	<div class=\"contenedor_texto\">
		<div class=\"imagenes\">
		
			<img id=\"lunes\" src=\"img/".generar_img($arreglo_respuesta[0],$arreglo_respuesta[1],$arreglo_respuesta[2]).".png\"  height=\"15\" width=\"15\"/>
			<br />
			<img id=\"martes\" src=\"img/".generar_img($arreglo_respuesta[3],$arreglo_respuesta[4],$arreglo_respuesta[5]).".png\"  height=\"15\" width=\"15\"/>
			<br />
			<img id=\"miercoles\" src=\"img/".generar_img($arreglo_respuesta[6],$arreglo_respuesta[7],$arreglo_respuesta[8]).".png\"  height=\"15\" width=\"15\"/>
			<br />
			<img id=\"jueves\" src=\"img/".generar_img($arreglo_respuesta[9],$arreglo_respuesta[10],$arreglo_respuesta[11]).".png\"  height=\"15\" width=\"15\"/>
			<br />
			<img id=\"viernes\" src=\"img/".generar_img($arreglo_respuesta[12],$arreglo_respuesta[13],$arreglo_respuesta[14]).".png\"  height=\"15\" width=\"15\"/>
			<br />
			<img id=\"sabado\" src=\"img/".generar_img($arreglo_respuesta[15],$arreglo_respuesta[16],$arreglo_respuesta[17]).".png\"  height=\"15\" width=\"15\"/>
			<br />	
			<img id=\"domingo\" src=\"img/".generar_img($arreglo_respuesta[18],$arreglo_respuesta[19],$arreglo_respuesta[20]).".png\"  height=\"15\" width=\"15\"/>
			<br />
		</div>
		
		<div class=\"dias\">
			<a>Lunes :</a>
			<br />
			<a>Martes :</a>
			<br />
			<a>Miercoles :</a>
			<br />
			<a>Jueves :</a>
			<br />
			<a>Viernes :</a>
			<br />
			<a>Sabado :</a>
			<br />
			<a>Domingo :</a>
		</div>
		
		<div class=\"texto_cobertura\">
			<span>".generar_texto($arreglo_respuesta[0],$arreglo_respuesta[1],$arreglo_respuesta[2])."</span>
		<br/>
		<span>".generar_texto($arreglo_respuesta[3],$arreglo_respuesta[4],$arreglo_respuesta[5])."</span>
		<br/>
		<span>".generar_texto($arreglo_respuesta[6],$arreglo_respuesta[7],$arreglo_respuesta[8])."</span>
		<br/>
		<span>".generar_texto($arreglo_respuesta[9],$arreglo_respuesta[10],$arreglo_respuesta[11])."</span>
		<br/>
		<span>".generar_texto($arreglo_respuesta[12],$arreglo_respuesta[13],$arreglo_respuesta[14])."</span>
		<br/>
		<span>".generar_texto($arreglo_respuesta[15],$arreglo_respuesta[16],$arreglo_respuesta[17])."</span>
		<br/>
		<span>".generar_texto($arreglo_respuesta[18],$arreglo_respuesta[19],$arreglo_respuesta[20])."</span>
		<br/>
		</div>
		
		
		
	
		
	</div>
</div>
<!--FIN / BLOQUE DE HORARIO DE ATENCION  -->


<!--BLOQUE DE INCLUYE-->

<div class=\"fila_derecha\">
	<div class= \"titulo\" >
		<a style=\"color:white\">Incluye</a>
		<br />
	</div>
<div class=\"contenedor_texto\">

		
	<div class=\"logos_imagenes\">
		<a>Repuestos</a>
		<br />
		<a>Baterias</a>
		<br />
		<a>Viaje</a>
		<br />
		<a>Monitoreo remoto</a>
		<br />	
	</div>
	
	<div class=\"logos_tareas\">
		<img id=\"repuestos\" src=\"img/".generar_bandera($arreglo_respuesta[21]).".png\"  height=\"15\" 	width=\"15\"/>
		<br />
		<img id=\"baterias\" src=\"img/".generar_bandera($arreglo_respuesta[23]).".png\" height=\"15\" width=\"15\" />
		<br />
		<img id=\"viaje\" src=\"img/".generar_bandera($arreglo_respuesta[22]).".png\" height=\"15\" width=\"15\"/>
		<br />
		<img id=\"monitoreo\" src=\"img/".generar_bandera($arreglo_respuesta[24]).".png\" height=\"15\" width=\"15\"/>
	</div>

</div>
</div>

<!--FIN / BLOQUE DE INCLUYE-->
";
	
	
	
	
	
	break;
	
	case 4://PARAMETRO DE LLAMADAS DE SERVICIO
	
	$sql = "SELECT
	Llamadas.callID,
	Llamadas.createDate,
	Llamadas.subject,
	Llamadas.itemName,
	Llamadas.manufSN,
	Llamadas.custmrName,
	Estados.Name
	FROM OCTR Contratos INNER JOIN OSCL Llamadas ON Contratos.ContractID=Llamadas.contractID
				     	INNER JOIN OSCS Estados ON Llamadas.status=Estados.statusID

	WHERE Contratos.ContractID ='$clave_busqueda'" ;


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
    	<th style=\"width:100px\">No. Llamada</th>
        <th style=\"width:100px\">Fecha</th>
        <th style=\"width:200px\">Asunto</th>
        <th style=\"width:175px\">Numero de serie</th>
        <th style=\"width:400px\">Descripcion</th>
		<th style=\"width:50px\">Status</th>

    </tr>    
    </thead>
    <tbody>
	";
	
	foreach($arreglo_respuesta as $a)
	{
		echo "<tr>
			<td style=\"width:100px\">$a[0]</td>
			<td style=\"width:100px\">".generar_fecha($a[1])."</td>
			<td style=\"width:200px\">$a[2]</td>
			<td style=\"width:175px\">$a[4]</td>
			<td style=\"width:400px\">$a[3]</td>
			<td style=\"width:50px\">$a[6]</td>
			</tr>";
		}	    
		
		echo "
		</tbody>
	</table>
	</div>";
		
		
	

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
		$inicio = substr($inicio,0,strlen($inicio) -2) .':' .substr($inicio,strlen($inicio) - 2,strlen($inicio));
		$final = substr($final,0,strlen($final) -2) .':' .substr($final,strlen($final) - 2,strlen($final));
		
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



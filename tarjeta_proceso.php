<?php

$parametro = $_POST['par'];
$clave_busqueda = $_POST['key'];

//$parametro = 1;
//$clave_busqueda = 2419;



$con = mssql_connect ("orion.electrotecnica.local", "sbo_reports","sb0_r3p0rt5") or die("Could not select base");
mssql_select_db ("SBO_Soporte_Critico", $con) or die("Could not select examples");	
	
//

switch($parametro)
{
	case 1: //PARAMETRO DE GENERAL
	
$sql = "SELECT 
	Tarjeta.customer,
	Tarjeta.custmrName,
	Contactos.Name,	
	Contactos.Tel1,
	Tarjeta.manufSN,
	Tarjeta.internalSN,
	Tarjeta.itemCode,
	Tarjeta.itemName,
	CASE Tarjeta.status WHEN 'A' THEN 'Activo' WHEN 'R' THEN 'Devuelto' WHEN 'T' THEN 'Terminado' WHEN 'L' THEN 'Prestado' ELSE 'En taller' end as estado,
	Tarjeta.city,
	Ciudades.Name,
	Tarjeta.county,
	Paises.Name,
	Tarjeta.instLction,
	Territorios.descript,
	(Empleados.firstName+' '+Empleados.middleName+' '+Empleados.lastName) as 'Técnico',
	convert(nvarchar(20),Tarjeta.U_TipoEquipo),
	convert(nvarchar(20),Tarjeta.U_OtroModelo),
	convert(nvarchar(20),Tarjeta.U_SCG_Garanl),
	convert(nvarchar(20),Tarjeta.U_StatusOperacion),
	convert(nvarchar(20),Tarjeta.U_FechaV),
	convert(nvarchar(30),Tarjeta.U_SCG_ClienteFinal)
FROM OINS Tarjeta 
		LEFT JOIN OTER Territorios ON Tarjeta.territory=Territorios.territryID
		LEFT JOIN OHEM Empleados   ON Tarjeta.technician=Empleados.empID
		LEFT JOIN OCPR Contactos   ON Tarjeta.contactCod=Contactos.CntctCode
		LEFT JOIN OCST Ciudades    ON Tarjeta.state = Ciudades.Code
		LEFT JOIN OCRY Paises	   ON Tarjeta.country = Paises.Code
		
WHERE Tarjeta.manufSN ='$clave_busqueda'" ;


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
		</br>
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
			<a>Descripcion del articulo : </a>
			<br />
		</div>
		<div class=\"resultados\">
			<span>".quitar_caracteres($arreglo_respuesta[1])."</span>
			<br />
			<span><a href=\"clientes.php?par=$arreglo_respuesta[0]\">$arreglo_respuesta[0]</a></span>
			<br />
			<span>".quitar_caracteres($arreglo_respuesta[2])."</span>
			<br />
			<span>$arreglo_respuesta[3]</span>
			<br />
			<span>".quitar_caracteres($arreglo_respuesta[7])."</span>
			<br />
		</div>
	</div>
</div>
		

<!--BLOQUES DE INFORMACION EQUIPO-->

	<div class=\"fila_derecha\">
		<div class= \"titulo\" >
			<a style=\"color:white\">Equipo</a>
			</br>
		</div>
		<div class=\"contenedor_texto\">
			<div class=\"titulos\">
				<a>Serie fabricante : </a>
				<br />
				<a>Numero de serie : </a>
				<br />
				<a>Numero de  articulo : </a>
				<br />
				<a>Tipo de equipo : </a>
				<br />
				
			</div>
			<div class=\"resultados\">
				<span>$arreglo_respuesta[4]</span>
				<br />
				<span>$arreglo_respuesta[5]</span>
				<br />
				<span>$arreglo_respuesta[6]</span>
				<br />
				<span id=\"tipo_equipo\">".generar_tipo($arreglo_respuesta[16])."</span>
				<br />
			</div>
		</div>
	</div>
	
	
				



<!--BLOQUES DE DIRECCION-->
<div class=\"fila alargar\">
	<div class= \"titulo\" >
		<a style=\"color:white\">Direccion</a>
		<br />
	</div>
	<div class=\"contenedor_texto\">
		<div class=\"titulos\">	
			<a>Provincia : </a>
			<br />
			<a>Distrito : </a>
			<br />
			<a>Pais : </a>
			<br />
			<a>Localidad : </a>
			<br />
		</div>
		<div class=\"resultados\">
			<span>".quitar_caracteres($arreglo_respuesta[10])."</span>
			<br />
			<span>".quitar_caracteres($arreglo_respuesta[9])."</span>
			<br />
			<span>".quitar_caracteres($arreglo_respuesta[12])."</span>
			<br />
			<span>".quitar_caracteres($arreglo_respuesta[13])."</span>
			<br />
		</div>
</div>

<!--BLOQUES DE ESTADO-->
<div class=\"fila_derecha menos_espacio\">
		<div class= \"titulo\" >
			<a style=\"color:white\">Estado</a>
			<br />
		</div>
		<div class=\"contenedor_texto\">
			<div class=\"titulos\">	
				<a>Estado : </a>
				<br />
				<a>Tecnico : </a>
				<br />
				<a>Ruta/Tecnico : </a>
				<br />
				<a>Garantia : </a>
				<br />
				<a>Fecha de venta : </a>
				<br />
				<a>Estatus operacional : </a>
				<br />
				<a>Otro modeldo : </a>
				<br />
				<a>Cliente final : </a>
				<br />
			</div>
			<div class=\"resultados\">
				<span>$arreglo_respuesta[8]</span>
				<br />
				<span>$arreglo_respuesta[15]</span>
				<br />
				<span>".quitar_caracteres($arreglo_respuesta[14])."</span>
				<br />
				<span>$arreglo_respuesta[18]</span>
				<br />
				<span>".generar_fecha($arreglo_respuesta[20])."</span>
				<br />
				<span>".quitar_caracteres($arreglo_respuesta[19])."</span>
				<br />
				<span>$arreglo_respuesta[17]</span>
				<br />
				<span>".quitar_caracteres($arreglo_respuesta[21])."</span>
				<br />
			</div>
		</div>
</div>
			";
	
	
	
	
	break;
	
	case 2://PARAMETRO DE LLAMADAS 

$sql = "SELECT 
	Llamadas.callID,
	Llamadas.createDate,
	Llamadas.subject,
	Llamadas.itemName,
	Llamadas.manufSN,
	Llamadas.custmrName,
	Contratos.ContractID,
	Estados.Name
 FROM OSCL Llamadas 
		INNER JOIN OINS Tarjeta ON Llamadas.manufSN=Tarjeta.manufSN
		INNER JOIN OSCS Estados ON Llamadas.status=Estados.statusID
		INNER JOIN CTR1 Contratos ON Llamadas.insID=Contratos.InsID
	
WHERE Llamadas.manufSN ='$clave_busqueda'" ;


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
        <th style=\"width:275px\">Asunto</th>
        <th style=\"width:100px\">No. Contrato</th>
        <th style=\"width:400px\">Descripcion</th>
		<th style=\"width:50px\">Estado</th>
    </tr>    
    </thead>
    <tbody>
	";
	
foreach($arreglo_respuesta as $a)
{
	echo "<tr>
    	<td style=\"width:100px\">$a[0]</td>
		<td style=\"width:100px\">".generar_fecha($a[1])."</td>
		<td style=\"width:275px\">".quitar_caracteres($a[2])."</td>
    	<td style=\"width:100px\"><a href=\"contratos.php?par=$a[6]\">$a[6]</a></td>
		<td style=\"width:400px\">".quitar_caracteres($a[3])."</td>
		<td style=\"width:50px\">$a[7]</td>
		</tr>";
	}	    
	
	echo "
    </tbody>
</table>
</div>";
	


	break;
	
	case 3://PARAMETRO DE CONTRATOS
	
	
	$sql = "SELECT 
	Contratos.ContractID,
	Contratos.StartDate,
	Contratos.EndDate,
	CASE Contratos.SrvcType when 'R' THEN 'Regular' ELSE 'Garantía' end as 'SrvcType',
	CASE Contratos.Status WHEN 'A' THEN 'Autorizado'  when 'T' then 'Terminado' when 'F' then 'Bloqueado' else  'Borrador' end as 'Status'

FROM OCTR Contratos INNER JOIN CTR1 Llamadas ON Contratos.ContractID=Llamadas.ContractID

WHERE Llamadas.manufSN ='$clave_busqueda'" ;

	
	$result = mssql_query($sql,$con) or die('Consulta fallida: ' . mssql_get_last_message());


	$arreglo_respuesta = array();
	
	while($row = mssql_fetch_array($result))
	{
		$arreglo_respuesta[count($arreglo_respuesta)] = $row;
		}
	
	
	mssql_close($con);	
	
	
	echo "
	<div class=\"scrollTable\">
	<table>
    <thead>
	<tr>
    	<th>Numero de contrato</th>
        <th>Fecha inicial</th>
        <th>Fecha final</th>
        <th>Tipo de servicio</th>
		<th>Estado</th>
    </tr>    
    </thead>
    <tbody>
	";
	
	foreach($arreglo_respuesta as $a)
	{
		echo "<tr>
			<td><a href=\"contratos.php?par=$a[0]\">$a[0]</a></td>
			<td>".generar_fecha($a[1])."</td>
			<td>".generar_fecha($a[2])."</td>
			<td>".quitar_caracteres($a[3])."</td>
			<td>$a[4]</td>
			</tr>";
		}	    
		
		echo "
		</tbody>
	</table>
	</div>";
		
	
	
	break;
	
	
	
	case 4://PARAMETRO DETALLES
	
	
	/////FUNCION PARA DETERMINAR QUE TIPO DE ARTICULO ES
	
	$tipo = $_POST['tipo'];
	
	
	if($tipo == 'UPS')
	{
		$sql = "SELECT
			convert(nvarchar(15),UDF.Descr),
			convert(nvarchar(15),Tarjeta.U_Marca),
			convert(nvarchar(15),Tarjeta.U_Modelo),
		    convert(nvarchar(15),Tarjeta.U_CapacidadUPS),	
			convert(nvarchar(15),Tarjeta.U_SistemaUPS), 
		    convert(nvarchar(15),Tarjeta.U_ClasifModularUPS),	
	    	convert(nvarchar(15),Tarjeta.U_ModBaterias),
	    	convert(nvarchar(15),Tarjeta.U_TotalBat),
		    convert(nvarchar(15),Tarjeta.U_UltCambBaterias),
		    convert(nvarchar(15),Tarjeta.U_DetalleBancExtUPS),
		    convert(nvarchar(15),Tarjeta.U_VoltajeOperacion)
		FROM
		OINS Tarjeta ,UFD1 UDF 
		
		WHERE Tarjeta.manufSN ='$clave_busqueda'
		AND		UDF.FldValue = Tarjeta.U_Configuracion
		AND		UDF.TableID = 'OINS'" ;

	
		
		}
	else if($tipo == 'Aire Acondicionado')
	{
	$sql = "SELECT	
    	convert(nvarchar(15),Tarjeta.U_MarcaAA),
	    convert(nvarchar(15),Tarjeta.U_ModeloAA),
    	convert(nvarchar(15),Tarjeta.U_TipoAA),
   		convert(nvarchar(15),Tarjeta.U_TipoRefrigerAA),
    	convert(nvarchar(15),Tarjeta.U_FiltroAA),
    	convert(nvarchar(15),Tarjeta.U_ModCompresor),
    	convert(nvarchar(15),Tarjeta.U_TipoHumidificador),
    	convert(nvarchar(15),Tarjeta.U_TipoDescargAA),
    	convert(nvarchar(15),Tarjeta.U_ModCondensador),
    	convert(nvarchar(15),Tarjeta.U_SerieCondensador),
    	convert(nvarchar(15),Tarjeta.U_PaisFabrica),
    	convert(nvarchar(15),Tarjeta.U_ActivarRuta)
	FROM
		OINS Tarjeta 

	WHERE Tarjeta.manufSN ='$clave_busqueda'" ;

		
		}
	else
	{
		$sql = "SELECT
		   	convert(nvarchar(15),Tarjeta.U_PLMarca),
  			convert(nvarchar(15),Tarjeta.U_PLModelo),
    		convert(nvarchar(15),Tarjeta.U_PLCapa),
    		convert(nvarchar(15),Tarjeta.U_PLVolt),
    		convert(nvarchar(15),Tarjeta.U_PLFiltro1),
    		convert(nvarchar(15),Tarjeta.U_PLFiltro2), 
    		convert(nvarchar(15),Tarjeta.U_PLFiltro3), 
    		convert(nvarchar(15),Tarjeta.U_PLFiltro4), 
   			convert(nvarchar(15),Tarjeta.U_PLTrampaA), 
    		convert(nvarchar(15),Tarjeta.U_PLControl), 
    		convert(nvarchar(15),Tarjeta.U_PLTipoBat), 
    		convert(nvarchar(15),Tarjeta.U_PLCantBat), 
    		convert(nvarchar(15),Tarjeta.U_PLFiltro5)
		FROM
			OINS Tarjeta 
		WHERE Tarjeta.manufSN ='$clave_busqueda'" ;
		
		}
	
	
	//////
	
	
	
	
	
	
	
$result = mssql_query($sql,$con) or die('Consulta fallida: ' . mssql_get_last_message());

$arreglo_respuesta = array();

$row = mssql_fetch_array($result);

$arreglo_respuesta = $row;
	
	mssql_close($con);	
	
	
if($tipo == 'UPS')
	{
		echo "
		<!--BLOQUE DE UPS-->
	<div class=\"fila\">
		<div class= \"titulo\" >
			<a style=\"color:white\">UPS</a>
			<br />
		</div>
		
		<div class=\"contenedor_texto\">
			<div class=\"titulos\">
				<a>Configuracion UPS : </a>
				<br />
				<a>Marca UPS : </a>
				<br />
				<a>Modelo : </a>
				<br />
				<a>Capacidad UPS : </a>
				<br />
				<a>Sistema UPS : </a>
				<br />
				<a>Tipo UPS : </a>
				<br />
				<a>Modelo baterias : </a>
				<br />
				<a>Total baterias : </a>
				<br />
				<a>Ultimo cambio de baterias UPS : </a>
				<br />
				<a>Detalle de baterias externas : </a>
				<br />
				<a>Voltaje operacional : </a>
				<br />
			</div>
			<div class=\"resultados\">
				<span>$arreglo_respuesta[0]</span>
				<br />
				<span>$arreglo_respuesta[1]</span>
				<br />
				<span>$arreglo_respuesta[2]</span>
				<br />
				<span>$arreglo_respuesta[3]</span>
				<br />
				<span>$arreglo_respuesta[4]</span>
				<br />
				<span>$arreglo_respuesta[5]</span>
				<br />
				<span>$arreglo_respuesta[6]</span>
				<br />
				<span>$arreglo_respuesta[7]</span>
				<br />
				<span>".generar_fecha($arreglo_respuesta[8])."</span>
				<br />
				<span>$arreglo_respuesta[9]</span>
				<br />
				<span>$arreglo_respuesta[10]</span>
				<br />
			</div>
		</div>
	</div>
			";
		
		
		}
	else if($tipo == 'Aire Acondicionado')
	{
		echo "
		<!--BLOQUE DE AIRE ACONDICIONADOS-->
		<div class=\"fila\">
			<div class= \"titulo\" >
				<a style=\"color:white\">Aire Acondicionado</a>
				<br />
			</div>
			<div class=\"contenedor_texto\">
				<div class=\"titulos\">
					<a>Marca Aire Acondicionado : </a>
					<br />
					<a>Modelo  Aire Acondicionado : </a>
					<br />
					<a>Tipo de  Aire Acondicionado : </a>
					<br />
					<a>Tipo de refrigerante : </a>
					<br />
					<a>Filtro de aire : </a>
					<br />
					<a>Modelo compresor : </a>
					<br />
					<a>Tipo de humidificador : </a>
					<br />
					<a>Tipo de descarga : </a>
					<br />
					<a>Modelo condensador : </a>
					<br />
					<a>Serie condensador : </a>
					<br />
					<a>Pais de fabricacion : </a>
					<br />
					<a>En ruta preventivo : </a>
					<br />
				</div>
				<div class=\"resultados\">					
					<span>$arreglo_respuesta[0]</span>
					<br />
					<span>$arreglo_respuesta[1]</span>
					<br />
					<span>$arreglo_respuesta[2]</span>
					<br />
					<span>$arreglo_respuesta[3]</span>
					<br />
					<span>$arreglo_respuesta[4]</span>
					<br />
					<span>$arreglo_respuesta[5]</span>
					<br />
					<span>$arreglo_respuesta[6]</span>
					<br />
					<span>$arreglo_respuesta[7]</span>
					<br />
					<span>$arreglo_respuesta[8]</span>
					<br />
					<span>$arreglo_respuesta[9]</span>
					<br />
					<span>$arreglo_respuesta[10]</span>
					<br />
					<span>$arreglo_respuesta[11]</span>
					<br />
				</div>
			</div>
		</div>
			";
		
		}
	else
	{
		echo "
		
		<!--BLOQUE DE PLANTAS ELECTRICAS -->
		<div class=\"fila\">
			<div class= \"titulo\" >
				<a style=\"color:white\">Plantas electricas</a>
				<br />
			</div>
			<div class=\"contenedor_texto\">
				<div class=\"titulos\">
					<a>Marca Planta\Transferencia : </a>
					<br />
					<a>Modelo Planta\Transferencia : </a>
					<br />
					<a>Capacidad Planta\Transferencia : </a>
					<br />
					<a>Voltaje de sistema : </a>
					<br />
					<a>Tipo de baterias : </a>
					<br />
					<a>Cantidad de baterias : </a>
					<br />
					<a>Filtro de aire primario : </a>
					<br />
					<a>Filtro de aceite : </a>
					<br />
					<a>Filtro de diesel : </a>
					<br />
					<a>Trampa de agua : </a>
					<br />
					<a>Tipo de controlador : </a>
					<br />
					<a>Capacidad de coolant : </a>
					<br />
				</div>
				<div class=\"resultados\">
					<span>$arreglo_respuesta[0]</span>
					<br />
					<span>$arreglo_respuesta[1]</span>
					<br />
					<span>$arreglo_respuesta[2]</span>
					<br />
					<span>$arreglo_respuesta[3]</span>
					<br />
					<span>$arreglo_respuesta[10]</span> 
					<br />
					<span>$arreglo_respuesta[11]</span>
					<br />
					<span>$arreglo_respuesta[4]</span>
					<br />
					<span>$arreglo_respuesta[5]</span>
					<br />
					<span>$arreglo_respuesta[6]</span>
					<br />	
					<span>$arreglo_respuesta[7]</span>
					<br />
					<span>$arreglo_respuesta[8]</span>
					<br />
					<span>$arreglo_respuesta[9]</span>
					<br />
					<span>$arreglo_respuesta[12]</span>
					<br />
				</div>
			</div>
		</div>
		";		
		}	
		
		
		
//CODIGO PARA EL MONITOREO

$sql = "SELECT 	
			convert(nvarchar(20),Tarjeta.U_MacAddress),
			convert(nvarchar(15),Tarjeta.U_IPAddress),
			convert(nvarchar(15),Tarjeta.U_Gateway),
			convert(nvarchar(15),Tarjeta.U_SubMask),
			convert(nvarchar(15),Tarjeta.U_SCG_TarjMonit),
			convert(nvarchar(15),Tarjeta.U_SCG_Prot1), 
			convert(nvarchar(15),Tarjeta.U_SCG_Prot2), 
			convert(nvarchar(15),Tarjeta.U_SCG_Prot3),
			convert(nvarchar(15),Tarjeta.U_SCG_StMonit),
			convert(nvarchar(15),Tarjeta.U_SCG_ModID),
			convert(nvarchar(15),Tarjeta.U_SCG_SNMPCom),
			convert(nvarchar(15),Tarjeta.U_SCG_Firmware)
		FROM
			OINS Tarjeta 
		WHERE Tarjeta.manufSN ='$clave_busqueda'" ;
		
$result = mssql_query($sql,$con) or die('Consulta fallida: ' . mssql_get_last_message());

$arreglo_respuesta = array();

$row = mssql_fetch_array($result);

$arreglo_respuesta = $row;
	
	mssql_close($con);	
	
echo "
<!--BLOQUE DE MONITOREO-->


	<div class=\"fila_derecha\">
		<div class= \"titulo\" >
			<a style=\"color:white\">Monitoreo</a>
			<br />
		</div>
		
		<div class=\"contenedor_texto\">
			<div class=\"titulos\">
				<a>Mac Address : </a>
				<br />
				<a>Ip Address : </a>
				<br />
				<a>Gateway : </a>
				<br />
				<a>Sub Mascara : </a>
				<br />
				<a>Protocolo 1 : </a>
				<br />
				<a>Protocolo 2 : </a>
				<br />
				<a>Protocolo 3 : </a>
				<br />
				<a>Status monitoreo : </a>
				<br />
				<a>Modbus ID : </a>
				<br />
				<a>Firmware equipo : </a>
				<br />
				<a>SNMP Community : </a>
				<br />
			</div>
			<div class=\"resultados\">
				<span>$arreglo_respuesta[0]</span>
				<br />
				<span>$arreglo_respuesta[1]</span>
				<br />
				<span>$arreglo_respuesta[2]</span>
				<br />
				<span>$arreglo_respuesta[3]</span>
				<br />
				<span>$arreglo_respuesta[5]</span> 
				<br />
				<span>$arreglo_respuesta[6]</span>
				<br />
				<span>$arreglo_respuesta[7]</span>
				<br />
				<span>$arreglo_respuesta[4]</span>
				<br />
				<span>$arreglo_respuesta[8]</span>
				<br />
				<span>$arreglo_respuesta[9]</span>
				<br />
				<span>$arreglo_respuesta[10]</span>
				<br />
				<span>$arreglo_respuesta[11]</span>
				<br />
			</div>
		</div>
	</div>
";

}

function generar_estado($var)
{
	$respuesta = '';
	
	if($var == 'A')
		$respuesta = 'circle_check';
	else
		$respuesta = 'circle_wrong';
	return $respuesta;
	}
	
/*GENERAR FECHA

ENTRADAS: INGRESA UN VALOR DE FECHA
SALIDAS : SALE UN VALOR DE FECHA A TIPO DD / MMM / AA
PROCESOS: CAMBIA EL POSICIONAMIENTO DEL TEXTO XQ  YA VIENE UN TIPO PARECIDO 

*/
function generar_fecha($var)
{
	$respuesta = '';
	$respuesta = substr($var,0,11);
	
	return $respuesta;
	}
function generar_tipo($var)
{
	$respuesta = '';
	
	
	if($var == 'UP')
		$respuesta = 'UPS';
	else if($var == 'AA')
		$respuesta = 'Aire Acondicionado';
	else if($var == 'PL')
		$respuesta = 'Plantas electricas';
	return $respuesta;
	
	}
	
function quitar_caracteres($var)
{
	$respuesta = '';
	
	$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñÍ";
	$replac = "abcdeeghijklaaoiqosuunwNyzabcdeeghijklmaoiqosuunwxyzaI";
	
	$respuesta = strtr($var,$tofind,$replac);
		
	return $respuesta;
	}

?>








<?php
	include "resol.php";
	$empleados = array();
				
	//execute the SQL query and return records
	$result = mysql_query("SELECT nombre,fechaEntrada,saldo,departamento FROM Empleados ORDER BY nombre");
	
	
	//fetch tha data from the database	
	while ($row = mysql_fetch_array($result)) 
	{
		$empleados[count($empleados)] = array('nombre' => $row[0],'fecha' => $row[1],'saldo' => $row[2],'departamento' => $row[3]);	
	}
	
	
if(isset($_GET['Aceptar']))
{
	$sqlUpdate = "UPDATE SET saldo = $saldo, fechaIngreso = $fecha FROM Empleados WHERE nombre = $nombre";
	
	if(mysql_query($sql))
	{
		$estado = 0;
		}
	else
	{
		$estado = 1;
		}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Servicio de vacaciones</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="css/ui-darkness/jquery-ui-1.8.14.custom.css">
<script src="js/jquery-1.6.2.min.js"></script>
</head>
<body>
	<div id="logo">
	  <h1>Grupo Electrotecnica</h1>
		
</div>
	<hr />
	<!-- end #logo -->
	<div id="header">
		<div id="menu">
			<ul>
			</ul>
		</div>
		<!-- end #menu -->
		<div id="search">
			<form method="get" action="">
				<fieldset>
				</fieldset>
			</form>
		</div>
		<!-- end #search -->
</div>
	<!-- end #header -->
	<!-- end #header-wrapper -->
	<div id="page">
		<div id="content">
		  <div class="post">
				<h2 class="title"><a href="#">Manejo de Personal </a></h2>
			<div class="entry">    
            
            <form action="mantenimiento.php" method="get">
             <h4>Empleado: </h4>
             
             <select name="Empleado" id="select_empleados">
                               
    			<?php
				foreach($empleados as $emp)
				{
					echo '<option value="'.$emp['nombre'].'">'.$emp['nombre'];
					}
				
		        ?>
                </select>
                
                <h4> Departamento: </h4>   
				<input type="text" id="departamento" name="departamento" disabled="disabled" />
     
                <h4> Saldo: </h4>   
				<input type="text" id="saldo" name="saldo" />
                
                
                
                 <h4>Fecha de Ingreso: </h4>
                 <input type="text" name="fecha " id="fecha" disabled="disabled"/>
                <br/>
         
                <input type="submit" name="Aceptar" id="cambiar" value="Cambiar" />
            </form>    
            </div>
          </div>
        </div>  
                          		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
</div>
	<!-- end #page -->
	<div id="footer">

	</div>
	<!-- end #footer -->
 	<script src="js/libs/jquery-ui-1.8.14.custom.min.js"></script>
	<script src="js/script_mantenimiento.js"></script>
</body>
</html>

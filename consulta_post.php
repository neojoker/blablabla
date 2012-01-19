<?php

	session_start();
	$user = $_SESSION['userblanco'];
	$id = $_POST['q'];
	$username = "root";
	$password = "critical";
	$hostname = "localhost"; 
	
	
	//Algoritmo para preguntar el departamento del usuario que va a escribir ademas del nombre completo, hacer funciones mejor
	
	
	
	/////


	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password) 
  		or die("Unable to connect to MySQL+++".mysql_error());
  
	$selected = mysql_select_db("Blog",$dbhandle) 
  		or die("Could not select examples");
		
		
	//VALORES a INSERTAR
	date_default_timezone_set('America/Costa_Rica');
	
	$sql = 'select * from actividades where id_post = '.$id.' order by fecha asc';
	
	$valores = array();
	
	$result = mysql_query($sql,$dbhandle);
	
	$respuesta = "";
	$variable_color = 'dashboard';
	$contador = 0;
	
	while ($row = mysql_fetch_array($result)) 
						{
							$respuesta .= '<div id="post">';
							if($row['nombre_empleado'] == $user)
							{ 
								$variable_color = 'blue';
								}
							$respuesta .= '<form class="'.$variable_color.'">';
							$respuesta .= '<fieldset>';
							$respuesta .= '<div id="header_post" class="header_post">';
							$respuesta .= '<span id="nombre" class="nombre">'.$row['nombre_empleado'].'</span><span class="fecha"> '.calcular_tiempo($row['fecha']).'</span>';
							$respuesta .= '<br />';
							$respuesta .= '<span class="departamento">'.$row['nombre_empleado'].'</span>';
							$respuesta .= '</div>';
							$respuesta .= '<div id="body_post">';
							$respuesta .= '<p>'.$row['contenido'].'</p>';
							$respuesta .= '</div>';
            				$respuesta .= '</fieldset>';
							$respuesta .= '</form>';
							$respuesta .= '</div>'; 
							$contador = $contador + 1;
						}
	
						
	$respuesta .= '<div id="grow"></div>';
	
	echo $respuesta;
    $_SESSION['contador'] = $contador;                     
                        
   function calcular_tiempo($date)
		{
			date_default_timezone_set('America/Costa_Rica');
			$fecha_actual = strtotime(date("Y-m-d H:i:s"));
			$date = strtotime($date);
			if(date("Y",$date) != date("Y",$fecha_actual))
			{
				$cantidad =  date("Y",$fecha_actual) - date("Y",$date);
				return 'Hace '.$cantidad. ' años';
				}
			if(date("m",$date) != date("m",$fecha_actual))
			{
				$cantidad =  date("m",$fecha_actual) - date("m",$date);
				return 'Hace '.$cantidad. ' meses';
				}
			if(date("d",$date) != date("d",$fecha_actual))
			{
				$cantidad =  date("d",$fecha_actual) - date("d",$date);
				return 'Hace '.$cantidad. ' dias';
				}
			if(date("H",$date) != date("H",$fecha_actual))
			{
				$cantidad =  date("H",$fecha_actual) - date("H",$date);
				return 'Hace '.$cantidad. ' horas';
				}
			if(date("i",$date) != date("i",$fecha_actual))
			{
				$cantidad =  date("i",$fecha_actual) - date("i",$date);
				return 'Hace '.$cantidad. ' minutos';
				}
			if(date("s",$date) != date("s",$fecha_actual))
			{
				$cantidad =  date("s",$fecha_actual) - date("s",$date);
				return 'Hace '.$cantidad. ' segundos';
				}
			}
?>
<?php
function write_header($persona)
{
	//Encabezado origina
	echo '<!doctype html>', "\r\n";
	echo '<!--[if lte IE 8 ]> <html lang="en" class="no-js oldie"> <![endif]-->', "\r\n";
	echo '<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->', "\r\n";
	//Head
	echo '<head>';	
	echo '<meta charset="UTF-8">', "\r\n";
	echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />', "\r\n";
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">', "\r\n";
	
	//Variable titulo;
	
	if($persona == 'login')
		{
			echo '<title>Iniciar sesi&oacute;n</title>', "\r\n";
			}
		else if($persona == 'busqueda_servicios')
		{
			echo '<title>Busqueda de servici&oacute;s</title>', "\r\n";
			}
		else
		{
			echo '<title>'.$persona.'</title>', "\r\n";
			}
	//Escribir metas
	echo '<meta name="description" content="">', "\r\n";
	echo '<meta name="author" content="">', "\r\n";
		
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">', "\r\n";
	
	//Links de iconos y estilos	
	echo '<link rel="shortcut icon" href="favicon.ico">', "\r\n";
	echo '<link rel="apple-touch-icon" href="apple-touch-icon.png">', "\r\n";

	echo '<link rel="stylesheet" href="css/cupertino/jquery-ui-1.8.12.custom.css">', "\r\n";
	echo '<link rel="stylesheet" href="css/jquery.ui.selectmenu.css"> <!---- Css del select ----->', "\r\n";
	echo '<!--<link rel="stylesheet" href="css/style.css?v=2">-->', "\r\n";
	
	//Variable por si es IE9
	echo '<!--[if lt IE 9]>', "\r\n";
	echo '<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>', "\r\n";
	echo '<script> function() </script>';
	echo '<![endif]-->', "\r\n";
	echo '<link href="css/style.css" rel="stylesheet" type="text/css">', "\r\n";
	
	echo '</head>', "\r\n"; // Cierra funcion HEAD
	}
	
function write_body($titulo_pagina, $persona)
{
	//Body 
	echo '<body>',"\r\n";
	//contenedor
	echo '<div id="container" class="container extendido">', "\r\n";
	//header
	echo '<header>', "\r\n";
	
	//Logo 
	
	echo '<a href="portal.php" class="logo"><img src="img/logo.png" alt="'.$titulo_pagina.'" /></a>', "\r\n";
	
	//Titulo pagina
	if($persona == 'login')
		{
	echo '<h1>Iniciar sesi&oacute;n</h1>', "\r\n";
			}
	else if($titulo_pagina == 'busqueda_servicios')
		{
	echo '<h1>B&uacute;squeda de servicios</h1>', "\r\n";
			}
	else
		{
			echo '<h1>'.$titulo_pagina.'</h1>', "\r\n";
		}
	
			echo '<nav class="main">', "\r\n";
			echo '<ul>', "\r\n";
			
			//Menu, cambiarlo por un menu iterativo 
			if($persona == 'login')
			{
			echo '<li class="last"><a href="#" class="menu5"></a></li>', "\r\n";
			echo '</ul>', "\r\n";
			echo '</ul>', "\r\n";
			
			}
			else
			{
				//echo '<li><a href="#" class="menu1">Solititudes</a></li>', "\r\n";
				//echo '<li><a href="#" class="menu2">Monitoreo</a></li>', "\r\n";
				//echo '<li><a href="#" class="menu3">Portfolio</a></li>', "\r\n";
				//echo '<li><a href="#" class="menu4">aprobar</a></li>', "\r\n";
				echo '<li class="last"><a href="#" class="menu5"></a></li>', "\r\n";
				echo '</ul>', "\r\n";
				echo '</ul>', "\r\n";
				}
			echo '</nav>', "\r\n";
			
			//Sub menu, ver posibles elementos en el, igual son iterativos
			echo '<div id="menu1_menu" class="drop">', "\r\n";
			echo '<ul>', "\r\n";
			echo '<li><a href="#">Submenu 1</a></li>', "\r\n";
			echo '<li><a href="#">Submenu 2</a></li>', "\r\n";
			echo '<li><a href="#">Submenu 3</a></li>', "\r\n";
			echo '<li><a href="#">Submenu 4</a></li>', "\r\n";
			echo '<li><a href="#">Submenu 5</a></li>', "\r\n";
			echo '</ul>', "\r\n";
			echo '</div>', "\r\n";
			
			//Usuario cambiar despues de agregar el login para escribir 
			
			echo '<nav  class="sub">', "\r\n";
			
			echo '';
			if($persona == 'login')
			{
				//echo '<a href="#"></a>', "\r\n";
				echo '<a href="#" class="last"></a>', "\r\n";
			}
			else
			{
				echo '<a id= "persona">'.$persona.'</a>', "\r\n";
				echo '<a id ="salir" class="last">Salir</a>', "\r\n";
				}
			
			echo '</nav>', "\r\n";
			echo '</header>', "\r\n";
	}

function write_notificacion()
{
	$xml = simplexml_load_file('http://www.google.co.cr/ig/api?weather=San Jose, San Jose&oe=utf-8');
	$information = $xml->xpath("/xml_api_reply/weather/forecast_information");
	$current = $xml->xpath("/xml_api_reply/weather/current_conditions");
	$forecast_list = $xml->xpath("/xml_api_reply/weather/forecast_conditions");
	
	$xml_liberia = simplexml_load_file('http://www.google.co.cr/ig/api?weather=costa+rica,liberia&oe=utf-8');
	$information = $xml_liberia->xpath("/xml_api_reply/weather/forecast_information");
	$liberia = $xml_liberia->xpath("/xml_api_reply/weather/current_conditions");
	$forecast_list_liberia = $xml_liberia->xpath("/xml_api_reply/weather/forecast_conditions");
	
	$xml_salvador = simplexml_load_file('http://www.google.co.cr/ig/api?weather=el+salvador,san+salvador&oe=utf-8');
	$information = $xml_salvador->xpath("/xml_api_reply/weather/forecast_information");
	$salvador = $xml_salvador->xpath("/xml_api_reply/weather/current_conditions");
	$forecast_list_liberia = $xml_salvador->xpath("/xml_api_reply/weather/forecast_conditions");


	
	echo "<div id=\"notification\"><marquee SCROLLAMOUNT=4>
			Bienvenido al portal de Grupo Electrot&eacute;cnica".					           "&nbsp;&nbsp;&nbsp;&nbsp;&#8826;&nbsp;&nbsp;&nbsp;&nbsp;".
			"".date("j M Y").
			"&nbsp;&nbsp;&nbsp;&nbsp;&#8826;&nbsp;&nbsp;&nbsp;&nbsp;".
			"".date("H:i").
			"&nbsp;&nbsp;&nbsp;&nbsp;&#8826;&nbsp;&nbsp;&nbsp;&nbsp;".
			"San Jose ".$current[0]->temp_c['data'] ."&deg;C ".
			substr($current[0]->humidity['data'],8,4)." ".
			$current[0]->condition['data'].
			"&nbsp;&nbsp;&nbsp;&nbsp;&#8826;&nbsp;&nbsp;&nbsp;&nbsp;".
			"Liberia ".$liberia[0]->temp_c['data'] ."&deg;C ".
			substr($liberia[0]->humidity['data'],8,4)  ." ".
			$liberia[0]->condition['data'].
			"&nbsp;&nbsp;&nbsp;&nbsp;&#8826;&nbsp;&nbsp;&nbsp;&nbsp;".
			"San Salvador ".$salvador[0]->temp_c['data'] ."&deg;C ".
			substr($salvador[0]->humidity['data'],8,4)  ." ".
			$salvador[0]->condition['data'].
			"</marquee></div>"
										
										
										
										
										, "\r\n";
	}
?>

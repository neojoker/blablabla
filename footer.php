<?php 
function write_footer($who)
{

	echo '</div>', "\r\n";
	echo '<footer align="center" valign="top" style="text-align:center">', "\r\n";
	//TEXTO PARA FINALIZAR LA PAGINA ESPACION EN BLANCO Y TODO
	
	
	echo '<br><img src="img/line.jpg" alt="Grupo Electrotecnica" width="0" height="0" border="0"><br>
         <a align="center">Tel: +506 2010-5000 &#8226; Email: <a href="mailto:info@grupoelectrotecnica.com">info@grupoelectrotecnica.com</a><br>
  Grupo Electrot&eacute;cnica &#8226; Copyright &copy; 2012 
  &#8226; www.grupoelectrotecnica.com </a>';
	
	echo '</footer>', "\r\n";
    echo '<div id="leftbehind"></div>', "\r\n";
	echo '</div>', "\r\n";

	//Llamada del jquery de google
	echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>', "\r\n";
	echo '<script>!window.jQuery && document.write(unescape(\'%3Cscript src="js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E\'))</script>', "\r\n";
    
	
	//Custom ui

	echo '<script src="js/libs/jquery-ui-1.8.12.custom.min.js"></script>', "\r\n";
    //Custom menu
	echo '<script src="js/libs/jquery.ui.selectmenu.js"></script>', "\r\n";
	//custom drop-o-matic
	echo '<script src="js/libs/drop-o-matic-jq.js"></script>', "\r\n";
	//jquery de revision de variables y diferentes cosas del estilo
	echo '<script src="js/script.js"></script>', "\r\n";
	//plug-in 
	echo '<script src="js/plugins.js"></script>', "\r\n";
	echo '<script src="controls.js"></script>', "\r\n";

    
	//espacio para los script creados para las diferentes paginas con su respectivo nombre
	
	if($who == 'login')
	{
		echo '<script type="text/javascript" src="logic_login.js"></script>', "\r\n";
		}
	if($who == 'salida')
	{
		echo '<script type="text/javascript" src="salida_script.js"></script>', "\r\n";
		}
	if($who == 'movimiento')
	{
		echo '<script type="text/javascript" src="movimiento_script.js"></script>', "\r\n";
		}
	if($who == 'blog')
	{
		echo '<script type="text/javascript" src="blog_script.js"></script>', "\r\n";
		
		}
	if($who == 'solicitudes_pendientes')
	{
		echo '<script type="text/javascript" src="pendientes_script.js"></script>', "\r\n";
	}
	if($who == 'peticion')
	{
		echo '<script type="text/javascript" src="post_script.js"></script>', "\r\n";
		
		}
	if($who == 'portal')
	{
		echo '<script type="text/javascript" src="portal_script.js"></script>', "\r\n";
		
		}
		
	if($who == 'request_vacaciones')
	{
		echo '<script type="text/javascript" src="script_vacaciones.js"></script>', "\r\n";
		}
		
	if($who == 'contratos')
	{
		echo '<script type="text/javascript" src="script_contratos.js"></script>', "\r\n";
		}
		
	if($who == 'tarjeta')
	{
		echo '<script type="text/javascript" src="script_tarjeta.js"></script>', "\r\n";
		}
		
	if($who == 'cliente')
	{
		echo '<script type="text/javascript" src="script_clientes.js"></script>', "\r\n";
		}
	if($who != 'login')
	{
		echo '<script type="text/javascript" src="onloads_script.js"></script>', "\r\n";
		}
	if($who == 'mantanimiento_empleados')
	{
		echo '<script type="text/javascript" src="script_mantenimiento_empleados.js"></script>', "\r\n";
		}
	if($who == 'mantanimiento_feriados')
	{
		echo '<script type="text/javascript" src="script_mantenimiento_empleados.js"></script>', "\r\n";
		}		
		
		
	if($who == 'solicitud')
	{
	echo '<script type="text/javascript" src="updateSearch.js"></script>', "\r\n";
    echo '<script type="text/javascript" src="dinamicContent.js"></script>', "\r\n";
	/*echo '<script type="text/javascript" src="jqueryDisplay.js"></script>', "\r\n";*/
	echo '<script type="text/javascript" src="solicitud_script.js"></script>', "\r\n";
		}
	//echo body z
	
	if($who != 'solicitud')
	{
	echo '</body>', "\r\n";
    echo '</html>', "\r\n";
		}
}

function write_end()
{
	echo '</body>', "\r\n";
    echo '</html>', "\r\n";	
	}

?>
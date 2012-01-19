<?php

function write_menu($parametro)
{
	if($parametro == 'contratos')
	{
		echo '<ul class="menu">
				<li id="general"><a  id ="general_activar" class="active"><span >General</span></a></li>
				<li id="articulos"><a id ="articulos_activar"><span>Articulos</span></a></li>
				<li id="cobertura"><a id ="cobertura_activar"><span>Cobertura</span></a></li>
				<li id="llamadas"><a id ="llamadas_activar"><span>Llamadas de servicio</span></a></li>
			</ul>';
	}
	
	if($parametro == 'tarjeta' )
	{
		echo '<ul class="menu">
          		<li id="general"><a id ="general_activar" class="active"><span>General</span></a></li>
          		<li id="llamadas"><a id ="llamadas_activar"><span>Llamada de servicio</span></a></li>
          		<li id="contratos"><a id ="contratos_activar"><span>Contratos de servicio</span></a></li>
          		<li id="detalles"><a id ="detalles_activar"><span>Detalles</span></a></li>
        	 </ul>';
		}
		
		
	if($parametro == 'cliente')
	{
		echo '<ul class="menu">
          		<li id="contratos"><a id ="contratos_activar" class="active"><span>Servicios</span></a></li>
          		<li id="equipos"><a id ="equipos_activar"><span>Equipos</span></a></li>
        	 </ul>';
		}
	
	}
	


?>



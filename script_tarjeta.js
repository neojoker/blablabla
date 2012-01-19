$(function(){
	//VARIABLES GLOBALES
	
	var general = '';
	var contratos = '';
	var detalles = '';
	var llamadas = '';
	var llave_busqueda = $('#busqueda').val();
	var tipo = '';
	var bandera_inicio = false;

	
	
	
	$('#busqueda_link').click(function(e){
		if(bandera_inicio)
			{
		llave_busqueda = $('#busqueda').val();
		general = '';
	 	contratos = '';
		detalles = '';
		llamadas = '';
		
		$('a').removeClass('active'); 
		$('#general_activar').addClass('active');
		
		
		$.post("tarjeta_proceso.php",{par : 1,key : "" + llave_busqueda},
		function(data){
			$('#dinamico').html(data);
			general = data;
			tipo = $('#tipo_equipo').html();
			});
			}
		});
		
		
		
	$('#contratos').click(function(data){
		
		if(bandera_inicio)
			{
		llave_busqueda = $('#busqueda').val();
		$('a').removeClass('active'); 
		$('#contratos_activar').addClass('active');
		
		
		if(contratos == '')
		{
			$.post("tarjeta_proceso.php",{par : 3,key : "" + llave_busqueda},
		function(data){
			$('#dinamico').html(data);
			articulos = data;
			});
		}
		else
		{
			$('#dinamico').html(articulos);
			}
			
			}
		});
		
		
	$('#llamadas').click(function(data){
		if(bandera_inicio)
			{
		
		llave_busqueda = $('#busqueda').val();
		$('a').removeClass('active'); 
		$('#llamadas_activar').addClass('active');
				
		if(llamadas == '')
		{
			$.post("tarjeta_proceso.php",{par : 2,key : "" + llave_busqueda},
		function(data){
			$('#dinamico').html(data);
			llamadas = data;
			});
		}
		else
		{
			$('#dinamico').html(llamadas);
			}	
			
			}
		});
		
		
		
	$('#detalles').click(function(data){
		if(bandera_inicio)
			{
		llave_busqueda = $('#busqueda').val();
		$('a').removeClass('active'); 
		$('#detalles_activar').addClass('active');
		
		if(detalles == '')
		{
			$.post("tarjeta_proceso.php",{par : 4,key : "" + llave_busqueda,tipo : "" + tipo},
		function(data){
			$('#dinamico').html(data);
			detalles = data;
			});
		}
		else
		{
			$('#dinamico').html(detalles);
			}
			}
		});
		
		
	$('#general').click(function(data){
		
		if(bandera_inicio)
			{
		$('a').removeClass('active'); 
		$('#general_activar').addClass('active');
		
		$('#dinamico').html(general);	
			}
		});
		
		
		
	var parametro_oculto = $('#parametro_oculto').val();	
	if(parametro_oculto != '')
	{
		bandera_inicio = true;
		$('#busqueda').val(parametro_oculto);
		llave_busqueda = $('#busqueda').val();
		
		
		$.post("tarjeta_proceso.php",{par : 1,key : "" + parametro_oculto },
						function(data){
							$('#dinamico').html(data);
							general = data;
							tipo = $('#tipo_equipo').html();
						});
						
				$('a').removeClass('active'); 
				$('#general_activar').addClass('active');
		}
		
		
	$('#busqueda').keydown(function(event){
			if(event.which == 13)
				{
					event.preventDefault();
					
					var nombre_busqueda = $('#busqueda').val();
						
					$.post('tabla_tarjetas.php',{nom: ""+ nombre_busqueda},
					function(data){
						$('#remplazo_tabla').replaceWith(data);
					});
			
					$('#nombre_diag').val(nombre_busqueda);
			
					$( "#buscador_form ").dialog( "open" );		
				}			
		});
		
		
		
		
	///////////DIALOGO DE TARJETAS
	
	
		$('#busqueda_link').click(function(data){
			
			var nombre_busqueda = $('#busqueda').val();
						
			$.post('tabla_tarjetas.php',{nom: ""+ nombre_busqueda},
			function(data){
				$('#remplazo_tabla').replaceWith(data);
			
			});
			
			
			

				
			$('#nombre_diag').val(nombre_busqueda);
			
			$( "#buscador_form ").dialog( "open" );
			
			});
			
		$('#nombre_diag').keyup(function(event){
		 if ( event.which == 13 ) {
     			event.preventDefault();
   			}
			
			var nombre_busqueda = $('#nombre_diag').val();
			
			$.post('tabla_tarjetas.php',{nom: ""+ nombre_busqueda},
			function(data){
				$('#remplazo_tabla').replaceWith(data);
			})

 		});			
	
			
		$('#buscador_form').dialog({
			autoOpen: false,
			height: 'auto',
			width:'auto',
			modal:true,
			buttons: {
				Aceptar: function() {
					bandera_inicio = true;
					valor_devuelto = $('#key_tarjetas').val() || [];
					$('#busqueda').val(valor_devuelto);
					
		
					
				$.post("tarjeta_proceso.php",{par : 1,key : "" + valor_devuelto },
						function(data){
							$('#dinamico').html(data);
							general = data;
							tipo = $('#tipo_equipo').html();
						});
						
				$('a').removeClass('active'); 
				$('#general_activar').addClass('active');
					
					
					
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
			
		});	
		
		
	
	});
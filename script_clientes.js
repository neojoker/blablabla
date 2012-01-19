$(function(){
	//VARIABLES GLOBALES
	
	var equipos = '';
	var contratos = '';
	var valor_devuelto = '';
	var fijar_variable = '';		
	var bandera_inicio = false;
		
		$('#equipos').click(function(data)
		{
		
		if(bandera_inicio)
			{
			$('a').removeClass('active'); 
			$('#equipos_activar').addClass('active');
			
			
			if(equipos == '')
			{
				$.post("clientes_proceso.php",{par : 2,key : "" + valor_devuelto },
			function(data){
				$('#dinamico').html(data);
				equipos = data;
				});
			}
			else
			{
				$('#dinamico').html(equipos);
				}	
			}
		});
		
		
		$('#contratos').click(function(data){
		if(bandera_inicio)
		{
			$('a').removeClass('active'); 
			$('#contratos_activar').addClass('active');
			
			$('#dinamico').html(contratos);	
		}
		});
		
		
		
		$('#busqueda_link').click(function(data){
			
			var nombre_busqueda = $('#nombre').val();
			var codigo_busqueda = $('#codigo').val();
						
			$.post('tabla_clientes.php',{nom: ""+ nombre_busqueda,cod:""+codigo_busqueda},
			function(data){
				$('#remplazo_tabla').replaceWith(data);
			
			});	
			
			$('#nombre_diag').val(nombre_busqueda);
						
			alert(los);
			
			$( "#buscador_form ").dialog( "open" );
			
			});
			
		
			
		$('#buscador_form').dialog({
			autoOpen: false,
			height: 'auto',
			width:'auto',
			modal:true,
			buttons: {
				Aceptar: function() {
					bandera_inicio = true;
					valor_devuelto = $('#key_clientes').val() || [];
					$('#parametro_oculto').val(valor_devuelto);
					
					$.post("clientes_proceso.php",{par : 5, key : "" + valor_devuelto},
						function(data){
							$('#nombre').val(data);
							 parametro_oculto = valor_devuelto;
							 valor_devuelto = valor_devuelto;
							 
							 $.post("clientes_proceso.php",{par : 1,key : "" + valor_devuelto },
								function(data){
									$('#dinamico').html(data);
									contratos = data;
									equipos = '';
								});
						});
					
					
					//////CODIGO DE RECARGA DE PAGINAS					
					
				$('a').removeClass('active'); 
				$('#contratos_activar').addClass('active');			
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
			
		});
		
		
		$('#nombre').keydown(function(event){
			if(event.which == 13)
				{
					event.preventDefault();
					
					var nombre_busqueda = $('#nombre').val();
					var codigo_busqueda = $('#codigo').val();
						
					$.post('tabla_clientes.php',{nom: ""+ nombre_busqueda,cod:""+codigo_busqueda},
					function(data){
						$('#remplazo_tabla').replaceWith(data);
					
					});
					$('#nombre_diag').val(nombre_busqueda);
				
					$( "#buscador_form ").dialog( "open" );
				}
		});
		
		$('#nombre_diag').keyup(function(event){
		 if ( event.which == 13 ) {
     			event.preventDefault();
   			}
			
			var nombre_busqueda = $('#nombre_diag').val();
			var codigo_busqueda = $('#codigo').val();
			
			$.post('tabla_clientes.php',{nom: ""+ nombre_busqueda,cod:""+codigo_busqueda},
			function(data){
				$('#remplazo_tabla').replaceWith(data);
			})

 		});			
		
		var parametro_oculto = $('#parametro_oculto').val();

	if(parametro_oculto != '')
	{
		bandera_inicio = true;
		$.post("clientes_proceso.php",{par : 3,key : "" + parametro_oculto },
						function(data){
							$('#nombre').val(data);
							valor_devuelto = parametro_oculto;
						});
		
		
		$.post("clientes_proceso.php",{par : 1,key : "" + parametro_oculto },
						function(data){
							$('#dinamico').html(data);
							contratos = data;
							equipos = '';
						});
						
				$('a').removeClass('active'); 
				$('#contratos_activar').addClass('active');
		}
	else
	{
		}	
	
	});
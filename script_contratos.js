$(function(){
	//VARIABLES GLOBALES
	
	var general = '';
	var articulos = '';
	var cobertura = '';
	var llamadas = '';
	var llave_busqueda = $('#busqueda').val();
	var bandera_inicio = false;

	
	
	$('#buscador_form').dialog({
			autoOpen: false,
			height: 'auto',
			width:'auto',
			modal:true,
			buttons: {
				Aceptar: function() {
					bandera_inicio = true;
					valor_devuelto = $('#key_contratos').val() || [];
					llave_busqueda = valor_devuelto;
					$('#nombre').val(valor_devuelto);
					
					$.post("contratos_proceso.php",{par : 1, key : "" + valor_devuelto},
						function(data){
							$('#dinamico').html(data);
							general = data;	
						});
					
					//////CODIGO DE RECARGA DE PAGINAS 
						
				$('a').removeClass('active'); 
				$('#general_activar').addClass('active');				
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
			
		});
	
	
	
	
	
	$('#busqueda_link').click(function(e){
		llave_busqueda = $('#busqueda').val();
		general = '';
	 	articulos = '';
		cobertura = '';
		llamadas = '';
		
		$('a').removeClass('active'); 
		$('#general_activar').addClass('active');
		
		
		var nombre_busqueda = $('#busqueda').val();
							
		$.post('tabla_contratos.php',{nom: ""+ nombre_busqueda},
			function(data){
				$('#remplazo_tabla').replaceWith(data);
			});
					
				
		$('#nombre_diag').val(nombre_busqueda);
			
		$( "#buscador_form ").dialog( "open" );
		
		});
		
		
	
		
		
	$('#articulos').click(function(data){
		
		
		if(bandera_inicio)
			{
		$('a').removeClass('active'); 
		$('#articulos_activar').addClass('active');
		
		if(articulos == '')
		{
			$.post("contratos_proceso.php",{par : 2,key : "" + llave_busqueda},
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
		
		$('a').removeClass('active'); 
		$('#llamadas_activar').addClass('active');
				
		if(llamadas == '')
		{
			$.post("contratos_proceso.php",{par : 4,key : "" + llave_busqueda},
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
		
		
		
		
		$('#cobertura').click(function(data){
		
		if(bandera_inicio)
			{
		$('a').removeClass('active'); 
		$('#cobertura_activar').addClass('active');
		
		if(cobertura == '')
		{
			$.post("contratos_proceso.php",{par : 3,key : "" + llave_busqueda},
		function(data){
			$('#dinamico').html(data);
			cobertura = data;
			});
		}
		else
		{
			$('#dinamico').html(cobertura);
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
		
		
		$.post("contratos_proceso.php",{par : 1,key : "" + parametro_oculto },
						function(data){
							$('#dinamico').html(data);
							general = data;
						});
						
				$('a').removeClass('active'); 
				$('#general_activar').addClass('active');
		}
		
		
	$('#busqueda').keydown(function(event){
			if(event.which == 13)
				{
					event.preventDefault();
					var nombre_busqueda = $('#busqueda').val();
					$.post('tabla_contratos.php',{nom: ""+ nombre_busqueda},
						function(data){
							$('#remplazo_tabla').replaceWith(data);
						});
					general = '';
	 				articulos = '';
					cobertura = '';
					llamadas = '';
					$('#nombre_diag').val(nombre_busqueda);
					$( "#buscador_form ").dialog( "open" );
					$('a').removeClass('active'); 
					$('#general_activar').addClass('active');
					}			
	});
		
		
	
	});
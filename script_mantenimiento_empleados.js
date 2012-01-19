$(function(){
	
	$.post("consulta_empleados.php",{q:"" +4 }, 
		function(data)
		{
			$("#lista_empleados").html(data);
			$('#lista_empleados').selectmenu();
			
			$("#lista_empleados").change(function(data){
		    	var nombre = $("#lista_empleados").val();
			$.post("tabla_empleado.php", { name: "" +nombre, q:0},
			function(data)
			{	
				var fecha = $( data ).val();
				var dias = $( data ).next().val();
				$('#fecha_ingreso').val(fecha);
				$('#saldo').val(dias);		
			},'html'
				);
			
			});
			}
		);
		
	$('#guardar').click(function(data)
		{
			data.preventDefault();
			
			var nombre = $("#lista_empleados").val();
			
			var dias = $('#saldo').val();
			var fecha = $('#fecha_ingreso').val();
			var comentario = $('#comentarios').val();					
			
			$.post('mantenimientos_proceso.php',{par: 0,nom: "" + nombre,dia : ""+ fecha, fec: "" + dias,com : "" + comentario},
				function (data)
				{
					alert(data);
					
					});
			var direccion = 'portal.php';
			$(window.location).attr('href', direccion);	
			
			});
		
	$('#cancelar').click(function(data)
		{
			data.preventDefault();
			var direccion = 'portal.php';
			$(window.location).attr('href', direccion);	
			
			});
		
		
	});
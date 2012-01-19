$(function(){
	
	$.post("llenar_empleado.php",{q:"" +3 },//consulta de le la solicitud de movimiento 
		function(data)
		{
			$("#lista_empleados").html(data);
			$('#lista_empleados').selectmenu();
	$("#lista_empleados").change(function(data){
		    	var nombre = $("#lista_empleados").val();
				alert(nombre);
			$.post("llenar_empleado.php", { name: "" +nombre, q:""+1},
		    function(data)
			{
			}
				);
			
			});		
			
			
			});	

	$( "#fecha_final" ).datepicker({
			dateFormat: 'yy-mm-dd',
			showOn: "button",
			defaultDate: null,
			buttonImage: "img/iconCalendar.gif",
			buttonImageOnly: true
		});
	$( "#fecha_inicio" ).datepicker({
			showOn: "button",
			buttonImage: "img/iconCalendar.gif",
			buttonImageOnly: true
		});
		
		
     $.post("llenar_empleado.php", { name: "" +nombre, q:""+1},
		    function(data)
			{
				alert(data);
			}
				);		
		
	});// JavaScript Document
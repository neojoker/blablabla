$(function(){
	$.datepicker.setDefaults( $.datepicker.regional["es"] );
	$( "#fecha_inicio" ).datepicker({
			dateFormat: 'yy-mm-dd',
			showOn: "button",
			defaultDate: null,
			buttonImage: "img/iconCalendar.gif",
			buttonImageOnly: true
		});
		
	$( "#medio_dia" ).button();
	
	$('#medio_dia_label').find('span').css('padding-left','4px');
	$('#medio_dia_label').find('span').css('padding-top','2px');

	$( "#fecha_final" ).datepicker({
			dateFormat: 'yy-mm-dd',
			showOn: "button",
			defaultDate: null,
			buttonImage: "img/iconCalendar.gif",
			buttonImageOnly: true
		});
	$( "#fecha_ingreso" ).datepicker({
			showOn: "button",
			buttonImage: "img/iconCalendar.gif",
			buttonImageOnly: true
		});
		
		
	$("#fecha_inicio").change(function(event){
		var date_b = $("#fecha_inicio").val(); 
		var date_e = $("#fecha_final").val();
		var half_d = $('#medio_dia').is(':checked');
		$.post("calculo_dias.php", { date_inicio: "" + date_b , date_final: "" + date_e, half_day : "" + half_d},
  					function(data){
					$('#dias_solicitados').val(data);
					var saldo = Number($('#saldo').val());
					var dias = 	Number($('#dias_solicitados').val());
					if(dias < 0)
					{$('#saldo_estimado').val(saldo+dias);}
					else
					$('#saldo_estimado').val(saldo-dias);
		});
	});
	
	$("#fecha_final").change(function(event){
		var date_b = $("#fecha_inicio").val(); 
		var date_e = $("#fecha_final").val();
		var half_d = $('#medio_dia').is(':checked');
		$.post("calculo_dias.php", { date_inicio: "" + date_b , date_final: "" + date_e, half_day : "" + half_d },
  					function(data){
					$('#dias_solicitados').val(data);
					var saldo = Number($('#saldo').val());
					var dias = 	Number($('#dias_solicitados').val());
					if(dias < 0)
					{$('#saldo_estimado').val(saldo+dias);}
					else
					$('#saldo_estimado').val(saldo-dias);
				});
		});
	
	$("#medio_dia").bind('change',function(event){
		var date_b = $("#fecha_inicio").val(); 
		var date_e = $("#fecha_final").val();
		var half_d = $('#medio_dia').is(':checked');
		$.post("calculo_dias.php", { date_inicio: "" + date_b , date_final: "" + date_e, half_day : "" + half_d },
  					function(data){
					$('#dias_solicitados').val(data);	
					var saldo = Number($('#saldo').val());
					var dias = 	Number($('#dias_solicitados').val());
					if(dias < 0)
					{$('#saldo_estimado').val(saldo+dias);}
					else
					$('#saldo_estimado').val(saldo-dias);
				});
		
		});
		
	$('#aplicar').click(function(e){
		e.preventDefault();

		var date_b = $("#fecha_inicio").val(); 
		var date_e = $("#fecha_final").val();
		var half_d = $('#medio_dia').is(':checked');
		var observation_comment = $("#textObservaciones").val();
		var dias_encontador = $('#dias_solicitados').val();

		if(dias_encontador > 0)
		{
		$.post("generar_solicitud.php", { fecha_inicio: "" + date_b , fecha_final: "" + date_e, half_day : "" + half_d, texto_observaciones : "" + observation_comment },
  					function(data){
						alert(data);
							var direccion = 'portal.php';
							$(window.location).attr('href', direccion);	
						
				});			
			
			}
		else
		{
			alert('Llenar todos los campos');

		}
		
		});
});

$(function(){
	
	$( "#radio" ).buttonset();
	
	$('input.make_icon').click(function(e){
		$('#diag_empleados').dialog('open');
			return false;
		});

	
	
////////////////////////////////////////////////////////////////////////////////////////

$.post("consulta_empleados.php",{ q : 2},
function(data){
	$("#departamentos").replaceWith(data);
	$('#departamentos').selectmenu();
	$("select#departamentos").change(
	function(data){
		var opcion = $("#departamentos").val();
		$.post("consulta_empleados.php",{q : 3,op : "" + opcion},
		function(data){
			$('#text_encargado').val(data);
			});
		});
	});
//

	
////////////////////////////////////////////////////////////////////////////////////////
	
	var div_dialogo_involucrado ='<div id="diag_involucrado" title = "Involucrado"><form><select multiple id="outside"></select>  <a class = "boton_plus" id="add">add &gt;&gt;</a><select multiple id="inside"></select><a class = "boton_plus" id="remove">&lt;&lt; remove</a> </form></div>';


	$("#diag_involucrado").replaceWith(div_dialogo_involucrado);
	
	$('#add').click(function() {  
  return !$('#outside option:selected').remove().appendTo('#inside');  
 	}); 
	 
 	$('#remove').click(function() {  
  return !$('#inside option:selected').remove().appendTo('#outside');  
  }); 
	$.post("consulta_empleados.php", { q: "0" },
  					function(data){
						$('#outside').replaceWith(data);
  					});		
	$( "#plus_involucrados" ).click(function(event){
		$('#diag_involucrado').dialog('open');
			return false;
			});
			
	$('#diag_involucrado').dialog({
			autoOpen: false,
			width: 600,
			heigth: 500,
			show: "blind",
			hide:"blind",
			modal: true,
			buttons: {
				"Ok": function() { 
				 
				 $('#inside option').each(function(i) {  
  				$(this).attr("selected", "selected");  
 				});  
				 $('#contenedor_involucrados').replaceWith('<div id="contenedor_involucrados" class="text_involucrado"><div id= "grow"></div></div>');
				 var multipleValues = $("#inside").val() || [];
				$.each(multipleValues,function(index, value) { 
 					var texto = '<input type="text" required="" placeholder="Encargado" disabled="disabled" name="text_encargado" id="'+value+'" class="make_icon" value = "'+value+'"></BR><div id= "grow"></div>';
					$("#grow").replaceWith(texto);
					});				
				 
					$(this).dialog("close"); 
				}, 
				"Cancel": function() { 
					$(this).dialog("close"); 
				} 
			}
		});
				
				
	$("#diag_involucrados").bind("dblclick", function(){
   				 var multipleValues = $("#key_clientes").val() || [];
							$("#cliente").val(multipleValues.join(", ")); 
							$(this).dialog("close"); 
 				});	
				
	//Funcionalidad del cambio
	
	
	$('#busqueda_clientes').keyup(function(event){
		 if ( event.which == 13 ) {
     			event.preventDefault();
   			}
   		clave_busqueda = $("#busqueda_clientes").val();
		$.post("busquedaClientes.php", { q: "" + clave_busqueda, },
  					function(data){
						data = '<div id="update_lista_clientes">'+data+'</div>';
						$('#update_lista_clientes').replaceWith(data);
  					});		
 				});					

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var div_dialogo_encargado ='<div id="diag_encargado" title = "Encargado"><form><input type="text" id="busqueda_encargado" name="busqueda_encargado"/><div id="update_lista_encargado"><BR/><SELECT NAME="key_encargado" id="key_encargado" MULTIPLE SIZE=11></div>';

$.post("busquedaEmpleado.php", { q: "" + "", },
  					function(data){
						data = '<div id="update_lista_encargado">'+data+'</div>';
						$('#update_lista_encargado').replaceWith(data);
  					});	
				
$("#diag_encargado").replaceWith(div_dialogo_encargado);
	
$( "#text_encargado" ).click(function(event){
		$('#diag_encargado').dialog('open');
			return false;
			});

$('#diag_encargado').dialog({
					autoOpen: false,
					width: 600,
					heigth: 500,
					show: "blind",
					hide:"blind",
					modal: true,
					buttons: {
						"Ok": function() { 
						 var multipleValues = $("#key_encargado").val() || [];
							$("#text_encargado").val(multipleValues.join(", ")); ///Pasar un parametro que seria el parent!! COMO???????????
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				
	$("#diag_encargado").bind("dblclick", function(){
   				 var multipleValues = $("#key_encargado").val() || [];
							$("#text_encargado").val(multipleValues.join(", ")); 
							$(this).dialog("close"); 
 				});	
				
	//Funcionalidad del cambio
	
	
	$('#busqueda_encargado').keyup(function(event){
		 if ( event.which == 13 ) {
     			event.preventDefault();
   			}
   		clave_busqueda = $("#busqueda_encargado").val();
		$.post("busquedaEmpleado.php", { q: "" + clave_busqueda, },
  					function(data){
						data = '<div id="update_lista_encargado">'+data+'</div>';
						$('#update_lista_encargado').replaceWith(data);
  					});		
 				});					


////////////////////////////////////////////////////////////////////////////////////////
///CLIENTES
	function generar_div(item)
	{
		var respuesta = '<BR/><input type="text" required="" placeholder="Encargado" name="text_encargado" id="text_encargado'+item+'">';
		respuesta += '<div id="involucrados_grow">';
        respuesta += '</div> ';
		return respuesta;
		}	
		
	var div_dialogo_clientes ='<div id="diag_clientes" title = "Clientes"><form><input type="text" id="busqueda_clientes" name="busqueda_clientes"/><div id="update_lista_clientes"><BR/><SELECT NAME="key_clientes" id="key_clientes" MULTIPLE SIZE=11></div>';
	$.post("busquedaClientes.php", { q: "" + "", },
  					function(data){
						data = '<div id="update_lista_clientes">'+data+'</div>';
						$('#update_lista_clientes').replaceWith(data);
  					});	
				
	$("#diag_clientes").replaceWith(div_dialogo_clientes);
	

	//link del dialogo de empleados
	$("#link_clientes").click(function(){
			var clave_busqueda_primaria = $('#cliente').val();
			$('#busqueda_clientes').val(clave_busqueda_primaria);
			$('#diag_clientes').dialog('open');
			return false;
			});
	//Interfaz del dialogo de empleados
	$('#diag_clientes').dialog({
					autoOpen: false,
					width: 600,
					heigth: 500,
					show: "blind",
					hide:"blind",
					modal: true,
					buttons: {
						"Ok": function() { 
						 var multipleValues = $("#key_clientes").val() || [];
							$("#cliente").val(multipleValues.join(", ")); ///Pasar un parametro que seria el parent!! COMO???????????
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				
	$("#diag_clientes").bind("dblclick", function(){
   				 var multipleValues = $("#key_clientes").val() || [];
							$("#cliente").val(multipleValues.join(", ")); 
							$(this).dialog("close"); 
 				});	
				
	//Funcionalidad del cambio
	
	
	$('#busqueda_clientes').keyup(function(event){
		 if ( event.which == 13 ) {
     			event.preventDefault();
   			}
   		clave_busqueda = $("#busqueda_clientes").val();
		$.post("busquedaClientes.php", { q: "" + clave_busqueda, },
  					function(data){
						data = '<div id="update_lista_clientes">'+data+'</div>';
						$('#update_lista_clientes').replaceWith(data);
  					});		
 				});					
				
				
	$('#boton_aceptar').click(function(event){
		event.preventDefault();
		var cliente = $("#cliente").val();
		var asunto = $("#text_asunto").val();
		var texto = $("#solicitud_area").val();
		var encargado = $("#text_encargado").val();
		var departamento = $("#departamentos").val();
		var prioridad = $("input[@name='radio']:checked").val();
		var involucrados =  $("#inside").val() || [];
		$.post("guardar_formulario.php", { cli: "" + cliente, asu : "" + asunto,tex : "" + texto, enc : "" + encargado, dep : "" + departamento, pri : "" + prioridad , inv : involucrados},
  					function(data){
						if(data == '0')
							{
							$("#cliente").val("");
							$("#text_asunto").val("");
							$("#solicitud_area").val("");
						    $("#text_encargado").val("");
							$("#departamento").val("");
							alert("Solicitud Completada");
							var direccion = 'post.php';
							$(window.location).attr('href', direccion);
								}
						else{
							alert("ERROR");
							}
						
  					});		
		
		});
	$('#boton_cancelar').click(function(event){	
		event.preventDefault();
		$("#cliente").val("");
		$("#text_asunto").val("");
		$("#solicitud_area").val("");
		$("#text_encargado").val("");
		$("#departamento").val("");
	});
});
$(function(){
	$("#enviar").button({
		icons: {
			primary: "ui-icon-comment"
			},
		});
		
	$("#enviar").click(function(event){
		event.preventDefault();
		
		var nombre = $("#nombre").html();
		var solicitud = $("#id").html();
		var comentario = $("#solicitud_area").val();
		
		if(comentario == "")
			alert("Solicitud vacia");
		else
		{
		$.post("guardar_comment.php", { bandera: "1", id : "" + solicitud, con: "" + comentario},
  					function(data){
						if(data ==  "0")
							alert('Imposible realizar transaccion en este momento');
						else
						{
							alert('Solicitud completada');
							$("#solicitud_area").val("");
						}
  					});
		}
				});
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		
	$("#add").button({
		icons: {
			primary: "ui-icon-circle-plus"
			},
		 text: false
		});
		
	$("#add").click(function(event){
		event.preventDefault();
		$('#diag_involucrado').dialog('open');
			return false;
		});
		
		
	var div_dialogo_involucrado ='<div id="diag_involucrado" title = "Involucrado"><form><select multiple id="outside"></select>  <a class = "boton_plus" id="div_add">add &gt;&gt;</a><select multiple id="inside"></select><a class = "boton_plus" id="div_remove">&lt;&lt; remove</a> </form></div>';


	$("#diag_involucrado").replaceWith(div_dialogo_involucrado);
	$('#div_add').click(function() {  
  return !$('#outside option:selected').remove().appendTo('#inside');  
 	}); 
	 
 	$('#div_remove').click(function() {  
  return !$('#inside option:selected').remove().appendTo('#outside');  
  }); 
	$.post("consulta_empleados.php", { q: "0" },
  					function(data){
						$('#outside').replaceWith(data);
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
				 	var multipleValues = $("#inside").val() || [];
					
					$.post("guardar_comment.php", { bandera: "3", id : "" + solicitud, par: multipleValues},
  					function(data){
						if(data ==  "0")
							alert('Imposible realizar transaccion en este momento');
						else
						{
							alert(data);
							$("#solicitud_area").val("");
						}
  					});	
					

					$(this).dialog("close"); 
				}, 
				"Cancel": function() { 
					$(this).dialog("close"); 
				} 
			}
		});
		
		
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	$("#eliminar").button({
		icons: {
			primary: "ui-icon-circle-minus"
			},
		 text: false
		});
	
	var diag_eliminar = '<div id ="diag_eliminar" title="Salir">';
		diag_eliminar += '<span>Esta seguro que desea desvincularse de esta salicitud</span>';
		diag_eliminar +='</div'; 
	
	$("#diag_eliminar").replaceWith(diag_eliminar);
	
	$("#diag_eliminar").dialog({
			autoOpen: false,
			width: 280,
			heigth: 280,
			show: "blind",
			hide:"blind",
			modal: true,
			buttons: {
				"Aceptar": function() { 
				
					var solicitud = $("#id").html();
					$.post("guardar_comment.php", { bandera: "5", id : "" + solicitud},
  					function(data){
						if(data ==  "0")
							alert('Imposible realizar transaccion en este momento');
						else
						{
							//alert('Solicitud completada');
							$("#solicitud_area").val("");
						}
  					});	
					
					$(this).dialog("close"); 
				}, 
				"Cancelar": function() { 
					$(this).dialog("close"); 
				} 
			}
		});
		
	
	$("#eliminar").click(function(event){
		event.preventDefault();
		$('#diag_eliminar').dialog('open');
			return false;
		});
		
		
		
		
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#cerrar").button({
		icons: {
			primary: "ui-icon-locked"
			},
		 text: false
		});
		
		
	var diag_cerrar = '<div id ="diag_cerrar" title="Cerrar">';
		diag_cerrar += '<span>Esta seguro que desea cerrar el caso</span>';
		diag_cerrar +='</div'; 
	
	$("#diag_cerrar").replaceWith(diag_cerrar);
		
	$("#diag_cerrar").dialog({
			autoOpen: false,
			width: 300,
			heigth: 300,
			show: "blind",
			hide:"blind",
			modal: true,
			buttons: {
				"Aceptar": function() { 
					var solicitud = $("#id").html();
					$.post("guardar_comment.php", { bandera: "4", id : "" + solicitud},
  					function(data){
						if(data ==  "0")
							alert('Imposible realizar transaccion en este momento');
						else
						{
							//alert('Solicitud completada');
							$("#solicitud_area").val("");
						}
  					});	
				
				
					$(this).dialog("close"); 
				}, 
				"Cancel": function() { 
					$(this).dialog("close"); 
				} 
			}
		});
		
		
	$("#cerrar").click(function(event){
		$('#diag_cerrar').dialog('open');
			return false;		
			event.preventDefault();
		});
		
		
		
		
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FUNTION CONTINUA DE CONSULTA PARA EJECUTAR EL RECARGO DE LA PAGINA EN AJAX

setInterval(function() {
     var id = $("#id").html();
$.post("consulta_post.php", { q: "" + id },
  					function(data){
					$("#grow").replaceWith(data);
									});
}, 20000000);
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//JALAR LOS POST ORIGINALES
var id = $("#id").html();
$.post("consulta_post.php", { q: "" + id },
  					function(data){
					$("#grow").replaceWith(data);
									});	
var contador = 0;

$.post("consulta_post.php", {q : ""+ id, cont: "" + contador , bandera : 1},
function(event){
	
	});


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#person").button({
		icons: {
			primary: "ui-icon-person"
			},
		 text: false
		});
	var diag_cambiar = '<div id ="diag_cambiar" title="Encargado">';
		diag_cambiar += '<form>';
		diag_cambiar += '<span>El encargado actual es:</span> ';
		diag_cambiar += '<span id ="nombre_encargado" class = "nombre_encargado"></span> ';
		diag_cambiar += '<select multiple id="candidatos"></select>';
		diag_cambiar += '</form>';
		diag_cambiar +='</div'; 
	
	$("#diag_cambiar").replaceWith(diag_cambiar);
	
	var solicitud = $("#id").html();
	$.post("consulta_generales.php", { bandera: "1", id: "" + solicitud },
  					function(data){
						$('#candidatos').replaceWith(data);
  					});
					
	var solicitud = $("#id").html(); //OBtiene el nombre del encargado
	$.post("consulta_generales.php", { bandera: "0", id: "" + solicitud},
  					function(data){
						$('#nombre_encargado').html(data);
  					});
					
	$("#diag_cambiar").dialog({
			autoOpen: false,
			width: 600,
			heigth: 500,
			show: "blind",
			hide:"blind",
			modal: true,
			buttons: {
				"Ok": function() { 
				var id = $("#id").html();
				var nuevo_encargado = $("#candidatos").val() || [];
					$.post("guardar_comment.php", { bandera: "2", id: ""+id , par :""+ nuevo_encargado },
  					function(data){
						if(data ==  "0")
							alert('Imposible realizar transaccion en este momento');
						else
							alert('desinformacion');
							//alert('Solicitud completada');
  					});
				
				
					$(this).dialog("close"); 
				}, 
				"Cancel": function() { 
					$(this).dialog("close"); 
				} 
			}
		});
		
	$("#person").click(function(event){
		$('#diag_cambiar').dialog('open');
			return false;		
					event.preventDefault();
		});
});
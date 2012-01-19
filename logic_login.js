$(function(){
	
				//Funcion para corroborar que esta logueado y si si manda al portal si no, no cambia nada
				
				$.post("on_load.php",{bandera : '0'},
					function(data){
						if(data == '1')
						{
							var direccion = 'portal.php';
							$(window.location).attr('href', direccion);	
							}
						else
						{
							
							}
					}
				);
				
				
				
				//////////////////////////////////////////////////////////////////////////////////////////
	
				$('#aceptar').click(function(e){
 				 //todo cosas aqui
				
				  var usuario_login = $("#name").val();
				  var pass_login = $("#password").val();
				 $.post("login.php", { user: "" + usuario_login , pass: "" + pass_login},
  					function(data){
						switch(data)
						{
							case '1': $("#name").after('<label id="error_name" style="color:red;"> Ingrese un usuario </label>').addClass( "ui-state-error" );
							setTimeout(function() {
							$("#error_name").remove();
							}, 1000 );
							$("#password").after('<label id="error_password" style="color:red;"> Ingrese su password </label>').addClass( "ui-state-error" );
							setTimeout(function() {
							$("#error_password").remove();
							}, 1000 );
							break;
							
							case '3' : var direccion = 'portal.php';
							$(window.location).attr('href', direccion);		
							break;
							
							default: $("#password").after('<label id="error_password" style="color:red;"> Password equivacado </label>').addClass( "ui-state-error" );
							setTimeout(function() {
							$("#error_password").remove();
							}, 1000 );		
							}
						
    				
  					});
				  e.preventDefault();
	
				 
				});//marca el fin del boton
	
});
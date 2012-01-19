$(function(){
	
$.post("on_load.php",{bandera : '0'},
					function(data){
						if(data == '1')
						{
							
							}
						else
						{
							var direccion = 'index.php';
							$(window.location).attr('href', direccion);	
							}
					}
				);	
});
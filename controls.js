$(function(){
	
$('#salir').click(function(e){
		$.post("on_load.php",{bandera : '1'},
					function(data){
						if(data == '1')
						{
							alert('Usted ha salido de portal');
							var direccion = 'index.php';
							$(window.location).attr('href', direccion);		
							}
						else
						{
							alert('se da que no esta logueado');
							}
					}
				);
	});
	
	$('#persona').click(function(e){
	var direccion = 'portal.php';
	$(window.location).attr('href', direccion);
	
	});
});
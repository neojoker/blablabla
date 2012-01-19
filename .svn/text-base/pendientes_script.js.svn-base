$(function(){
	
	$('tr.boton_fila').click(function(event){
			var id = $(this).attr('id');
			
			$.post("id_save.php", { q: "" + id, },
  					function(data){
						var direccion = 'blog.php';
						$(window.location).attr('href', direccion);	
  					});
		});
		
	$('tr.boton_fila').hover(
	function(event){
		$(this).addClass('encima');	
		},
	function(event)
	{
		$(this).removeClass('encima');	
		});
		
	
	
});
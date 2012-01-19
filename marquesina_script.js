$(function(){
	
	
	while(true)
	{
		var texto = $('#notification').html();
		alert('cambio el notification');

		texto = '&nbsp;' + texto;
		$('#notification').html(texto).delay(900);
		
	}
	
});// JavaScript Document
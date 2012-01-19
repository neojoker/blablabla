// JavaScript Document 
	
// Drop-o-matic Scripts
// Created: 8.12.2010
// Author: Sam Napolitano
// URL: http://www.napolitopia.com/

// Makes sure jquery is loaded prior to this file

// Load function loops through all divs looking for anything with _menu that matches the link class 
// ie sample_menu where 'sample' is the class applied to the link under the nav entity
// Hides anything it finds and instantiates the mouseover observer. 

$(document).ready(function (){
	
	$('nav a').each(function() {

		var menu_array = $(this).attr('class').split(' ');
		if(menu_array[0]){
			var menu = "#" + menu_array[0] + "_menu";
			if(menu) {
				$(menu).hide();
				$(this).mouseover(function ()
					{
						link_item = menu_array[0];
						show_drop(menu, link_item);	
					});
			}
		}

	});
});

// Function to show and hide div menu items. Looks for the div and the button to attach it to. 
function show_drop(drop_div, button_class){
	
	//hide all other divs
	$('div.drop').each(function (){
		$(this).hide();
	});
	
	//remove all acitve classes
	$('a.active').each(function(){
		$(this).removeClass('active');
	});

	
	//find all the nav items on the page, sort them and apply unique ID's if they dont exist
	//then get their height or width property to pass to the functions below
	$('nav a.' + button_class).each(function (){
			
			$(this).addClass('active');
			
			var current_id = $(this).attr('id');
			if(current_id == 'undefined' || current_id == ""){
				//Check if the link has an id, if not give it one... 
				var unique_id = "dropomatic_" + (Math.floor(Math.random()*90000)+10000);
				$(this).attr('id', unique_id);
			}
			
			button = "#" + $(this).attr('id');
			button_width = $(this).outerWidth();
			button_height = $(this).outerHeight();
			button_position = $(this).offset();
			
			//This is where you can configure the script to change from horizontal to vertical
			
			//Horizontal
			//button_position.top = Math.round(button_position.top + button_height);
			//button_position.left = Math.round(button_position.left);
			
			//custom position for relative header
			button_position.top = 45;
			button_position.left = 456;

			//Vertical
			//button_position.top = Math.round(button_position.top);
			//button_position.left = Math.round(button_position.left + button_width) - 1 ;
		}
	);
	
	

	$(drop_div).show();
	
	$(drop_div).css({
		'position': 'absolute',
		'top':button_position.top,
		'left':button_position.left
	});	
	
	// Roll in out functions for the divs
	$(drop_div).mouseout(function(){		
		clearTimeout(document.timer);	
		document.timer = setTimeout( function(){
			$(drop_div).hide();
			$(button).removeClass('active');}, 
			500);	
		}
		
	);
	
	$(drop_div).mouseover(function(){
		$(drop_div).show();
		$(button).addClass('active');
		clearTimeout(document.timer);
	});
	
	// Roll in out functions for the buttons
	$(button).mouseout(function(){		
		clearTimeout(document.timer);	
		document.timer = setTimeout( function(){
			$(drop_div).hide();
			$(button).removeClass('active');},
			500);
		}
		
	);
	
	$(button).mouseover(function(){
		$(drop_div).show();
		$(button).addClass('active');
		clearTimeout(document.timer);
	});
	
	
}
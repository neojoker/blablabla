<?php
session_start();

if (isset($_POST['bandera']))
{
	$bandera = $_POST['bandera'];
	switch($bandera)
	{
		case 0: 
			if(isset($_SESSION['user']))
				{echo '1';
					 }
				else
				{echo '0'; 
					}
			break;
		case 1:
			session_destroy();
			echo 1;
			break;
				
	}
}



?>
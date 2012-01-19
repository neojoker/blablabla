<?php
include "resol.php";
$fecha_inicial = $_POST['date_inicio'];
$fecha_final = $_POST['date_final'];
$medio_dia = $_POST['half_day'];
$cantidad = 0;
if($medio_dia == 'true')
{
	$cantidad = $cantidad - 0.5; 
	}
if (($fecha_inicial != '')&&($fecha_final != ''))
{
	
	$fecha_inicial = $_POST['date_inicio'];
	$fecha_final = $_POST['date_final'];
	
	
	$sql="SELECT dia
	FROM Feriados";
	
	$result = mysql_query($sql);
	$k=0;
	$diasferiados;
	
	
	while($row = mysql_fetch_array($result))
  		{
		  $diasferiados[$k] = $row[0];
		  $k++;
		  
		 }
	////////////
	$check_date = $fecha_inicial;
	$end_date = $fecha_final;	
	
	while ($check_date <= $end_date)
	 { 
		if((date('w',strtotime($check_date)) == 0 )||  (in_array($check_date,$diasferiados))  || (date('w',strtotime($check_date)) == 6 ))
		{
		}
			else {
				$cantidad = ++$cantidad;
				}
		$check_date = date ("Y-m-d", strtotime ("+1 day", strtotime($check_date))); 
	}
		echo $cantidad;
	}
	else
	{	
		echo $cantidad;
		}

?>
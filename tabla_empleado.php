<?
$bandera = $_POST['q'];
$username = "root";
$password = "critical";
$hostname = "localhost"; 


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL+++".mysql_error());
  
  
  
  
  

switch($bandera)
{
case 0:
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");

$user = $_POST['name'];
  
  
  $sql="SELECT saldo,fechaEntrada
			FROM Empleados
			WHERE user = '".$user."'";					
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
		echo "<input  id=\"dias\" value=\"$row[0]\" >";
        echo "<input  id=\"fecha\" value=\"$row[1]\">";
		break;
		
		
		
case 1://llena datos de empleado desde tabla Movimientos
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");

$solicitud = $_POST['request'];
$sql="SELECT fechaFinal,fechaInicial,dias,comentario
			FROM Movimientos
			WHERE idMovimiento = '".$solicitud."'";	
			echo $sql;				

break;




case 3://Busca numero de solicitud y nombre
$selected = mysql_select_db("registroVacaciones",$dbhandle) 
  or die("Could not select examples");

$sql="SELECT idMovimiento, nombre FROM Movimientos, Empleados 
      WHERE Movimientos.idEmpleado = Empleados.idEmpleado";	
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$movimientos = array();

while($row = mysql_fetch_array($result))
   {
	$movimientos[count($movimientos)] = array('id' => $row[0],'nombre' => $row[1]);
	}

foreach ($movimientos as $mov)
      {
	echo '<option value="'.$mov['id'].'">'.$mov['id'].'&nbsp; &nbsp; &nbsp; '.$mov['nombre'] .'</option>';

      }
	break;
}
?>


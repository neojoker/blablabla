<?php

$body = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type\" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style>

body{
	background:#CBCBCB;
	
}
.gris{
	background:#eee;
	border-top-right-radius: 5px;
	border-bottom-right-radius: 5px;
	text-transform: uppercase;
	font-weight: 100;
		}
.simbolo{
	background:#eee;
	border-top-left-radius: 5px;
	border-bottom-left-radius: 5px;
}

table{
	background:white;
	height:20px;
	border-color:red;
	border-collapse: collapse;
	width: 400px; 
	/*border:thin white;*/
	font-family: Helvetica, Arial, sans-serif;
	font-size:12px;
	
	}

 td{	
 	width:30px;
	height:15px; 
	}
.blanco{
	color:white;
	}
.cabecera{
	margin:0 auto 0 auto;
	background:white;
	width:500px;
	height:400px;
	border-radius:5px;
	padding-top:15px;
	padding-left:15px;
	font-family: Helvetica, Arial, sans-serif;
	}
.semi_logo{
	paddin-top:10px;
	font-size:14px;
	text-transform: uppercase;
	}
	
.logo_movible{
	margin-top:-30px;
	margin-left:70px;
	}
	
	
.cuerpo{
	background:white;
	width:400px;
	height:800px;
	border-radius:5px;
	padding-left:10px;
	margin-top:5px;
	padding-left:10px;
	padding-top:10px;
	}
.contenido{
	margin-top:40px;
	font-size:12px
	}
.titulos{
	float:left;
	}
.contenidos{
	margin-left:150px;
	}
.secundario{
	margin-top:20px;
	}	
.botones{
	margin-top:40px;
	margin-left:280px;
	}
.estado{
		font: 20px;
    text-transform: uppercase;
    font-weight: none;
    font-weight: 100;
    margin: 30px 0px auto 131px;
    border: 1px solid #D0D0D0;
    background: #EEE;
    width: 210px;
    height: 40px;
    border-radius: 5px;
	}
.texto_estado{
	position: absolute;
    top: 14px;
    left: 50px;
	}
.izquierda{
	margin-top: 8px;
	margin-left: 7px;
	}
.derecha{
    height: 17px;
    width: 145px;
    margin-left: 38px;
    margin-top: -20px;
		}
.titulo {
	font-size: 16px;
}
</style>
</head>

<body>
<div  class="cabecera">
<table width="500" border="0" cellspacing="0">
  <tr>
    <td><img src="http://portal.grupoelectrotecnica.com/img/logo_mini.png" alt="logo"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="11"><span class="titulo">Servicio de vacaciones</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan="20">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="20">Solicitud de vacaciones de $nombre_empleado</td>
    </tr>
  <tr>
    <td colspan="20">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5"><a>D&iacute;a de Inicio : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>$fecha_inicio</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan="5"><a>D&iacute;a Final : </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>$fecha_final</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan="5">Cantidad de d&iacute;as : </td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>$cantidad</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td colspan="20">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5">Saldo Actual : </td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>$saldo_actual</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5">Saldo Resultante :</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">$saldo_actual - $cantidad</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="20">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5">Comentarios : </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="12" rowspan="3">$comentario</td>
    <td>&nbsp;</td>

  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td rowspan="3"  class="simbolo"><img src="http://portal.grupoelectrotecnica.com/img/informacion.png" alt="estado"></td>
    <td colspan="10" rowspan="3" class="gris">Solicitud en proceso</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>


<br><br><br><br><br><br><br><br><br><br><br>


<div class="cabecera">
	<div class="logo">
    <img src="http://portal.grupoelectrotecnica.com/img/logo_mini.png"/> <div class="logo_movible"><span class="semi_logo">Servicio de vacaciones</span></div>
  </div>
    <div class="contenido">
    	<div class="principal">
        	<span>Solicitud de vacaciones de $nombre_empleado</span>
    	</div>
        <div class="secundario">
            <div class="titulos">
                <a>D&iacute;a de Inicio : </a>
                <br>
                <a>D&iacute;a Final : </a>
                <br>
                <a>Cantidad de d&iacute;as : </a>
                
                <br>
                <br>
                
                <a>Saldo Actual : </a>
                <br>
                <a>Saldo Resultante : </a>
                
                <br>
                <br>
                <a>Comentarios : </a> 
                
            </div>
            <div class="contenidos">
                <span>$fecha_inicio</span>
                <br>
                <span>$fecha_final</span>
                <br>
                <span>$cantidad</span>
            
                <br>
                <br>
                    
                <span>$saldo_actual</span>
                <br>
                <span>$saldo_actual - $cantidad </span>
                
                <br>
                <br>
                
                <span>$comentario</span>  
            </div>
			<div id="estado" class="estado">
                <div class="izquierda">
      	          <img src="http://portal.grupoelectrotecnica.com/img/informacion.png">
                </div>
            <div class="derecha">
           	 <span>Solicitud en proceso</span></div>
			</div>
      	</div>
    </div>
</div>
</body>
</html>


';


$headers = 'From: Sistema de vacaciones <no-reply@grupoelectrotecnica.com>' . "\r\n" .
   'Return-Path: no-reply@grupoelectrotecnica.com' . "\r\n" .
   'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if(mail ('rloaiza@grupoelectrotecnica.com,eespinoza@grupoelectrotecnica.com','Pruebas imagenes', $body,$headers)){
      echo "Solicitud completada";
  }
  else{
      echo "Solicitud no se pudo realizar por el momento";
  }
?>
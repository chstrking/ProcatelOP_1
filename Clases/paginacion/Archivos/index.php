<?php
require_once("libreria/Zebra_Pagination.php");
//Conexion
$con = mysqli_connect("localhost","root","poiuytrewq","paginacion") or die("Error en el server".mysqli_error($con));

//Consultar el numero de registros de la tabla
$query = "SELECT id FROM registros";
$res = $con->query($query);
$num_registros = mysqli_num_rows($res);
//Registros por pagina:
$resul_x_pagina = 20;

//Paginar:
$paginacion = new Zebra_Pagination();
$paginacion->records($num_registros);
$paginacion->records_per_page($resul_x_pagina);


//Consulta de registros : 

$consulta = 'SELECT id,nombre,apellido FROM registros LIMIT ' .(($paginacion->get_page() - 1) * $resul_x_pagina). ',' .$resul_x_pagina;
	$result = $con->query($consulta);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Paginación con Zebra Pagination</title>
</head>

<body>
	<table border="1" align="center">
		<tr>
			<td width="200">ID</td>
			<td width="200">NOMBRE</td>
			<td width="200">APELLIDO</td>
		</tr>
        <tr>
        <?php while($row = mysqli_fetch_array($result)){ ?>
			<td><?php echo $row["id"]; ?></td>
			<td><?php echo $row["nombre"]; ?></td>
			<td><?php echo $row["apellido"]; ?></td>
		</tr>
        <?php  } ?>
        </table>
        <br />
    	<?php $paginacion->render(); ?>    
	


</body>
</html>
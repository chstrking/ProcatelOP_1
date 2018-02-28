<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

/*if(isset($_SESSION['usuario']))
{*/
	$codigo=$_REQUEST['codigo'];
	$datos=Print_Factura($conexion,$codigo);
	//var_dump($datos); 
?>

<table width="100%" border="1px">
	<tr>
		<td>
			<?php echo $datos[0]["codigocliente"]?>
		</td>
		<td>
			<?php if(trim($datos[0]["contado"])=="1"){?>Contado<?php }else{ ?>Credito<?php }?>
		</td>
	</tr>
	<tr>
		<td>
			<B>Cliente:</b><?php echo $datos[0]["nombrecliente"]?>
		</td>
	</tr>
	<tr>
		<td>
			<B>Ruc/C&eacute;dula:</b><?php echo $datos[0]["cedula"]?>
		</td>
		<td>
			<b>Telefono:</b><?php echo $datos[0]["telefono"]?>
		</td>
	</tr>
	<tr>
		<td>
			<B>Direcci&oacute;n:</b><?php echo $datos[0]["direccion"]?>
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td>
			<B>Fecha:</b><?php echo $datos[0]["dia"]?>-<?php echo $datos[0]["mes"]?>-<?php echo $datos[0]["anio"]?>
		</td>
		<td>
		</td>
	</tr>	
</table>
<table width="100%" border="1px">
	<thead>
		<tr>
			<th>Cantidad</th>
			<th>Concepto</th>
			<th>V.Unit</th>
			<th>Total</th>		
		</tr>
	</thead>
	<tbody>
	<?php foreach($datos as $detalle){?>
		<tr>
			<td>
				<?php echo $detalle["cantidad"]?>
			</td>	
			<td>
				<?php echo $detalle["descripcion"]?>
			</td>	
			<td>
				<?php echo $detalle["preciounitario"]?>
			</td>	
			<td>
				<?php echo $detalle["detalletotal"]?>
			</td>		
		</tr>
	<?php }?>
	</tbody>
</table>
<table width="30%" align="right" border="1px">
	<tr>
		<td>
			Subtotal:<?php echo $datos[0]["traifaiva"]?>
		</td>
	</tr>	
	<tr>
		<td>
			Desc:<?php echo $datos[0]["descuento"]?>
		</td>
	</tr>	
	<tr>
		<td>
			ICE 15%:<?php echo $datos[0]["ice"]?>
		</td>
	</tr>	
	<tr>
		<td>
			IVA 12%:<?php echo $datos[0]["iva"]?>
		</td>
	</tr>	
	<tr>
		<td>
			Total:<?php echo $datos[0]["total"]?>
		</td>
	</tr>		
</table>
<?php //} ?>
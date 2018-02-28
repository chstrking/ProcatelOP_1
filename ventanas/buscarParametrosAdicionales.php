<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
	$tipo=$_REQUEST["tipo"];
	if($tipo=="1")
	{
		$nombre_tipo="Producto";
		$marca=$_REQUEST["parametro"];
	}

?>
<div class="titulo_popup"> 
	Seleccionar <?php echo $nombre_tipo;?>
</div>
<table class="table">
<tr>
<td width="30%">
<select id="tipobusqueda" class="form-control">
	<option value="D">Por descripci&oacute;n</option>
	<option value="C">Por c&oacute;digo</option>
</select>
</td>
<td>
<input type="text" value="" id="busqueda" <?php if($tipo=="1") {?>onkeyup="BusquedaProduct(<?php echo $marca ;?>)"<?php } ?> class="form-control" placeholder="Busqueda" size="16">
</td>
</tr>
</table>
<table class="tabla_detalle" width="100%" cellspacing="0" cellpadding="0">
<thead>
	<th>Codigo</th>
	<th>Nombre</th>
	<th></th>
</thead>
<tbody id="detalle_busqueda">
	<?php if($tipo=="0"){ ?>
		<?php foreach($respuestas as $respuesta):?>
			<tr>
				<td align="center"><?php echo $respuesta['id'];?></td>
				<td align="left"><?php echo $respuesta['nombre'];?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarSucursal('<?php echo $respuesta['id'];?>','<?php echo $respuesta['nombre'];?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
			</tr>
		<?php endforeach;?>
	<?php } ?>
</tbody>
</table>
<script>
	Redimensionar();
</script>
<?php } ?> 
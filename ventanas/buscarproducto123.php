<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
$tipoproducto=$_GET['tipoproducto'];
if(isset($_SESSION['usuario'])) 
{
	$tipoproducto=$_GET['tipoproducto'];
?>
<div id="contenedor_pasos">
<div class="titulo_popup">
	Seleccionar Producto
</div>
<table class="table">
<tr>
<td width="30%">
<select id="tipobusqueda" class="form-control">
	<option value="1">Por descripci&oacute;n</option>
	<option value="2">Por c&oacute;digo</option>
</select>
</td>
<td>
<input type="text" value="" id="busqueda" onkeyup="BusquedaProductos()" class="form-control" placeholder="Busqueda" size="16">
<input type="hidden" value="<?php echo $tipoproducto;?>" id="tipoproducto">
</td>
</tr>
</table>
<table class="tabla_detalle" width="100%" cellspacing="0" cellpadding="0">
<thead>
	<th>Id</th>
	<th>Descripci&oacute;n</th>
	<th>Stock</th>
	<th>Costo</th>
	<th></th>
</thead>
<tbody id="detalle_busqueda">

</tbody>
</table>
</div>
<?php } ?>
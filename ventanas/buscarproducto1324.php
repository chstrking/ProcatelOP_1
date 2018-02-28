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
<select id="tipobusqueda">
	<option value="1">Por descripci&oacute;n</option>
	<option value="2">Por c&oacute;digo</option>
</select>
<input type="text" value="" id="busqueda" onkeyup="BusquedaProductos()">
<input type="hidden" value="<?php echo $tipoproducto;?>" id="tipoproducto">
<input type="hidden" value="<?php echo $tipoproducto;?>" id="tipoproducto">
<div id="detalle_busqueda">

</div>
<?php } ?>
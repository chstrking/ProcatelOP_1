<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
	//$codigo_producto=$_POST["idproducto"];
	$busqueda="";
	$codigo_producto=$_REQUEST["idproducto"];
	$codigo_categoria=$_REQUEST["tipoproducto"];
	$valor=$_REQUEST["valor"];
	$id=$_REQUEST["id"];
	$respuestas=buscarproducto($conexion,$codigo_producto,$busqueda,$codigo_categoria,1);
	//var_dump($id);
	$porcentaje=(int)$_SESSION['detalle_facturacion'][(string)$respuestas[0]['Pro_Codigo']]['descuento'];
	$cantidad=$_SESSION['detalle_facturacion'][(string)$respuestas[0]['Pro_Codigo']]['cantidad'];
	$costo=(float)$valor;
	$subtotal=(int)$cantidad * (float)$costo;
	$descuento=($subtotal * $porcentaje)/100;
	$subtotal_iva=(float)$subtotal - (float)$descuento;
	$iva=$subtotal_iva * 0.12;
	$total=$subtotal_iva + $iva;
	if(isset($_SESSION['detalle_facturacion'][$id]))
	{
		unset($_SESSION['detalle_facturacion'][$id]);
		unset($_SESSION['detalle_facturacion_completo'][$id]);
	}
?>
<script>
	DeleteElement('<?php echo $_POST["detalleid"]?>')
	RestaValoresI('Subtotal_IVA',<?php echo round($subtotal_iva,4);?>);
	RestaValoresI('Subtotal',<?php echo round($subtotal_iva,4);?>);
	RestaValoresI('IVA',<?php echo round($iva,4);?>);
	RestaValoresI('Total',<?php echo round($total,4);?>);
	//RestaTotalI('<?php echo $total;?>');
</script>

<?php }?>
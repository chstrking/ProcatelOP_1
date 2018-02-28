<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$tipobusqueda=$_POST["tipobusqueda"];
	if($tipobusqueda=="1")
	{
		$busqueda=$_POST["busqueda"];
		$codigo_producto=0;
	}
	else
	{
		$busqueda="";
		$codigo_producto=$_POST["busqueda"];
	}
	$codigo_categoria=$_POST["tipoproducto"];
	$respuestas=buscarproducto($conexion,$codigo_producto,$busqueda,$codigo_categoria,1);
?>
<?php if(count($respuestas)!=0){?>
	<?php $i=1;?>
	<?php foreach($respuestas as $respuesta){?>
			<tr class="<?php if($i%2==0){?>par<? }else{ ?>impar<?php }?>">
			<td align="center"><?php echo $respuesta['DProd_Codigo'];?></td>
			<td align="left"><?php echo $respuesta['Descripcion'];?></td>
			<td align="right"><?php echo $respuesta['Dprod_Stock'];?></td>
			<td align="right">$<?php echo $respuesta['Pro_Costo'];?></td>
			<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarDetalleFacturacionI('<?php echo $respuesta['DProd_Codigo'];?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
			</tr>
			<?php $i++;?>
	<?php }?>
<?php }else{?>
	<tr>
		<td align="center" colspan="5">No hay productos con esa b&uacute;squeda</td>
	</tr>
<?php }?>
<?php }?>
<script>
	Redimensionar();
</script>
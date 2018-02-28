<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
	$busqueda="";
	$detalleid=$_POST["detalleid"];
	$codigo_producto=$_POST["idproducto"];
	$codigo_categoria=$_POST["tipoproducto"];
	$cantidad=$_POST["cantidad"];
	$descuento=$_POST["descuento"];
	$numeroserie=$_POST["numeroserie"];
	$numerolinea=$_POST["numerolinea"];
	$valor=$_POST["valor"];
	$valor_descuento=0;
	$id = intval(substr($detalleid, 3, 1));
	$id++;
	$respuestas=buscarproducto($conexion,$codigo_producto,$busqueda,$codigo_categoria,1);
	//var_dump($respuestas);
?>
	<?php foreach($respuestas as $respuesta){?>
	<?php 
		$detalle_facturacion=array('cantidad'=>$cantidad,'descuento'=>$descuento,'numeroserie'=>$numeroserie,'numerolinea'=>$numerolinea,'id_html'=>$detalleid,'costo'=>$valor);
		$subtotal=(int)$cantidad*(float)$valor;
		$valor_descuento=($subtotal*(int)$descuento)/100;
		$total=$subtotal-$valor_descuento;
		$bandera=true;
		if(isset($_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]))
		{
			$bandera=false;
		}
		$_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]=$detalle_facturacion;
		$_SESSION['detalle_facturacion_completo'][(string)$respuesta['Pro_Codigo']]=$respuesta;
		//var_dump($_SESSION['detalle_facturacion']);
	?>
	<td align="center"><?php echo $respuesta['DProd_Codigo'];?></td>
	<td align="left"><?php echo $respuesta['Descripcion'];?></td>
	<td align="right"><?php echo $respuesta['Dprod_Stock'];?></td>
	<td align="right"><?php echo $cantidad;?></td>
	<td align="right"><?php echo $descuento;?>%</td>
	<td align="right">$<?php echo $valor_descuento;?></td>
	<td align="right">$<?php echo $valor;?></td>
	<td align="right">$<?php echo $total;?></td>
	<td align="right"><?php echo $numeroserie;?></td>
	<td align="right"><?php echo $numerolinea;?></td>
	<td class="padding_tabla_accion">
		<a class="btn btn-xs btn-warning" href="javascript:;" onclick="EditarDetalleI('<?php echo $respuesta['DProd_Codigo'];?>','<?php echo $codigo_categoria?>')" title="Editar">
		<i class="fa fa-edit"></i>
		</a>
		<a class="btn btn-xs btn-danger" href="javascript:;"  onclick="EliminarDetalleI('<?php echo $respuesta['DProd_Codigo'];?>','<?php echo $detalleid?>','<?php echo $codigo_categoria?>','<?php echo $respuesta['Pro_Codigo'];?>','<?php echo $valor;?>')"  title="Eliminar">
		<i class="fa fa-minus-circle"></i>
		</a>
	</td>
	<?php 
		$subtotal_iva=0;
		$iva=0;
		$total=0;
		$detalles=$_SESSION['detalle_facturacion'];
		//var_dump($_SESSION['detalle_facturacion']);
		foreach($detalles as $detalle)
		{
			$subtotal=(int)$detalle['cantidad']*(float)$detalle['costo'];
			$valor_descuento=($subtotal*(int)$detalle['descuento'])/100;
			$total=$subtotal-$valor_descuento;
			$subtotal_iva=$subtotal_iva+$total;
		}
		$iva=0.12*$subtotal_iva;
		$total=$iva+$subtotal_iva;
	?>
	<script>
		ActualizarValores('Subtotal_IVA','<?php echo round($subtotal_iva,4);?>');
		ActualizarValores('Subtotal','<?php echo round($subtotal_iva,4);?>');
		ActualizarValores('IVA','<?php echo round($iva,4);?>');
		/*ActualizarValores('ICE','0');*/
		/*ActualizarValores('Subtotal_Tarifa0','0');*/
		RecalcularTotal('<?php echo round($total,4)?>');
	<?php if($bandera){?>
		AgregarElementoDetalle('detalleid','<?php echo 'tr_'.$id;?>');
	<?php }?>
	</script>
	<?php }?>
<?php } ?>
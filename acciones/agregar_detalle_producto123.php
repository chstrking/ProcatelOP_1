﻿<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
	$busqueda="";
	$detalleid=$_POST["detalleid"];
	$codigo_producto=$_POST["id_producto"];
	$codigo_categoria=$_POST["tipoproducto"];
	$cantidad=$_POST["cantidad"];
	$descuento=$_POST["descuento"];
	$numeroserie=$_POST["numeroserie"];
	$numerolinea=$_POST["numerolinea"];
	$valor_descuento=0;
	$id = intval(substr($detalleid, 3, 1));
	$id++;
	$respuestas=buscarproducto($conexion,$codigo_producto,$busqueda,$codigo_categoria,1);
	//var_dump($codigo_producto);
	//var_dump($respuestas);
?>
	<?php foreach($respuestas as $respuesta){?>
	<?php 
		$detalle_facturacion=array('cantidad'=>$cantidad,'descuento'=>$descuento,'numeroserie'=>$numeroserie,'numerolinea'=>$numerolinea,'id_html'=>$detalleid,'costo'=>$respuesta['Pro_Codigo']);
		$subtotal=(int)$cantidad*(float)$respuesta['Pro_Costo'];
		$valor_descuento=($subtotal*(int)$descuento)/100;
		$total=$subtotal-$valor_descuento;
		$bandera=true;
		if(isset($_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]))
		{
			$bandera=false;
		}
		$_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]=$detalle_facturacion;
		$_SESSION['detalle_facturacion_completo'][(string)$respuesta['Pro_Codigo']]=$respuesta;
		//var_dump($detalle_facturacion);
	?>
	<td align="center"><?php echo $respuesta['Pro_Codigo'];?></td>
	<td align="left"><?php echo $respuesta['Descripcion'];?></td>
	<td align="right"><?php echo $respuesta['Dprod_Stock'];?></td>
	<td align="right"><?php echo $cantidad;?></td>
	<td align="right"><?php echo $descuento;?>%</td>
	<td align="right">$<?php echo $valor_descuento;?></td>
	<td align="right">$<?php echo $respuesta['Pro_Costo'];?></td>
	<td align="right">$<?php echo $total;?></td>
	<td align="right"><?php echo $numeroserie;?></td>
	<td align="right"><?php echo $numerolinea;?></td>
	<td class="padding_tabla_accion">
		<a class="btn btn-xs btn-warning" href="javascript:;" onclick="EditarDetalle('<?php echo $respuesta['Pro_Codigo'];?>','<?php echo $codigo_categoria?>')" title="Editar">
		<i class="fa fa-edit"></i>
		</a>
		<a class="btn btn-xs btn-danger" href="javascript:;"  onclick="EliminarDetalle('<?php echo $respuesta['Pro_Codigo'];?>','<?php echo $detalleid?>')"  title="Eliminar">
		<i class="fa fa-minus-circle"></i>
		</a>
	</td>
	<?php 
		$subtotal_iva=0;
		$iva=0;
		$total=0;
		$detalles=$_SESSION['detalle_facturacion'];
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
		ActualizarValores('Subtotal_IVA','<?php echo $subtotal_iva;?>');
		ActualizarValores('Subtotal','<?php echo $subtotal_iva;?>');
		ActualizarValores('IVA','<?php echo $iva;?>');
		/*ActualizarValores('ICE','0');*/
		/*ActualizarValores('Subtotal_Tarifa0','0');*/
		RecalcularTotal('<?php echo $total?>');
	<?php if($bandera){?>
		AgregarElementoDetalle('detalleid','<?php echo 'tr_'.$id;?>');
	<?php }?>
	</script>
	<?php }?>
<?php } ?>
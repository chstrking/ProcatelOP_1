<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	$usuario=$_SESSION['usuario'];
	$sucursal=$_SESSION['sucursal'];
	$BodegaID=$_REQUEST['BodegaID'];
	$Fecha=$_REQUEST['Fecha'];
	$BodegaIDE=$_REQUEST['BodegaIDE'];
	$motivo=$_REQUEST['motivo'];
	$detalles=$_SESSION['detalle_facturacion'];
	$detalles_completos=$_SESSION['detalle_facturacion_completo'];
	$subtotal_iva=0;
	$subtotal_cero=0;
	$total_descuento=0;
	$iva=0;
	$ice=0;
	$total_factura=0;
	$otros=0;
	$CodBodega="1";
	$Kar_Graba="1";
	$Fact_Linea="";
	$Fact_TipoCxC="1";
	
	$Fact_Codigo="";
	$AsiC_Codigo="";
	$AsiC_NumAsiento="";
	$Kar_Codigo="";
	$ACAK_Codigo="";
	
	$detalles=$_SESSION['detalle_facturacion'];
	
	foreach($detalles as $detalle)
	{
		$subtotal=(int)$detalle['cantidad']*(float)$detalle['costo'];
		$valor_descuento=($subtotal*(int)$detalle['descuento'])/100;
		$total_factura=$subtotal-$valor_descuento;
		$subtotal_iva=$subtotal_iva+$total_factura;
		$total_descuento=$total_descuento+$valor_descuento;
	}
	$iva=0.12*$subtotal_iva;
	
	guardarcabeceraKardex($conexion,1,$Fecha,'T',$BodegaID,$BodegaIDE,$motivo,0,0,0,$usuario,0,0,0);
	$datos = ultimo_kardex($conexion,$BodegaID,$BodegaIDE,$usuario);
	
	foreach($detalles as $clave => $detalle)
	{
		$subtotal=(int)$detalle['cantidad']*(float)$detalle['costo'];
		$valor_descuento=($subtotal*(int)$detalle['descuento'])/100;
		$total=$subtotal-$valor_descuento;
		$detalle_completo=$detalles_completos[$clave];
		
		guardardetalleKardex($conexion,$BodegaID,$BodegaIDE,$detalle_completo["Pro_Codigo"],$detalle_completo["numeroserie"],
			$detalle_completo["numerolinea"],$detalle["cantidad"],0,
			floatval($detalle_completo["Pro_Costo"]),$datos[0]["Kar_Codigo"],$detalle["cantidad"],0,floatval($detalle_completo["Pro_Costo"]),
			floatval($detalle_completo["Pro_Costo"]));
	}
	$respuesta["data"]=$datos[0]["Kar_Codigo"];
	echo json_encode($respuesta);
	//var_dump($respuesta);
}
?>
<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario']) && $_SESSION['sucursal']) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	$usuario=$_SESSION['usuario'];
	$sucursal=$_SESSION['sucursal'];
	$cliente=$_REQUEST['cliente'];
	$vendedor=$_REQUEST['vendedor'];
	$contado_val=$_REQUEST['contado_val'];
	$transporte=$_REQUEST['transporte'];
	$motivo=$_REQUEST['motivo'];
	$tipofacturacion=$_REQUEST['tipofacturacion'];
	$fecha_facturacion=$_REQUEST['fecha_facturacion'];
	$factura=intval($sucursal["Suc_ActualNumF"])+1;
	$Fact_CodOrdenCompra="0";
	$detalles=$_SESSION['detalle_facturacion'];
	$detalles_completos=$_SESSION['detalle_facturacion_completo'];
	if($tipofacturacion=="3")
	{
		$serie=$sucursal["Suc_SerieF"];
		$num_doc=str_pad($factura, 7, "0", STR_PAD_LEFT);
		$NumAutSri=$sucursal["Suc_NumAutSriF"];
		$FecMaxSri=$sucursal["Suc_FecMaxSriF"]->format('d-m-Y');
	}
	else
	{
		$serie=$sucursal["Suc_SerieNV"];
		$num_doc="";
		$NumAutSri=$sucursal["Suc_NumAutSriNV"];
		$FecMaxSri=$sucursal["Suc_FecMaxSriNV"]->format('d-m-Y');
	}
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
	if($transporte!="")
	{
		$total_factura=$iva+$subtotal_iva+floatval($transporte);
	}
	else
	{
		$total_factura=$iva+$subtotal_iva;
	}
	
	/*var_dump($sucursal);*/
	$datos_cabecera=guardarcabecera($conexion,
		$sucursal["Suc_CodEmpresa"],
		$sucursal["Suc_Codigo"],
		$cliente,
		$vendedor,
		$tipofacturacion,
		$serie,
		$num_doc,
		$fecha_facturacion,
		$NumAutSri,
		$FecMaxSri,
		$Fact_CodOrdenCompra,
		$subtotal_cero,
		$subtotal_iva,
		$total_descuento,
		$iva,
		$ice,
		floatval($transporte),
		$otros,
		$total_factura,
		$motivo,
		$contado_val,
		$sucursal["Emp_CodTipoAsientoC"],
		$total_factura,
		$CodBodega,
		$Kar_Graba,
		$usuario,
		$sucursal["Suc_Direccion"],
		$Fact_Linea,
		intval($tipofacturacion),
		$Fact_TipoCxC/*,
		$Fact_Codigo,
		$AsiC_Codigo,
		$AsiC_NumAsiento, 
		$Kar_Codigo,
		$ACAK_Codigo*/);
	$datos = ultima_factura($conexion,$sucursal["Suc_Codigo"]);
	var_dump($datos);
	
	/*var_dump($datos_cabecera);*/
	//var_dump($detalles_completos);
	foreach($detalles as $clave => $detalle)
	{
		$subtotal=(int)$detalle['cantidad']*(float)$detalle['costo'];
		$valor_descuento=($subtotal*(int)$detalle['descuento'])/100;
		$total=$subtotal-$valor_descuento;
		$detalle_completo=$detalles_completos[$clave];
		if($tipofacturacion=="3")
		{
			$referencia="FACT-F".str_pad($datos[0]["VFact_Codigo"], 7, "0", STR_PAD_LEFT);
		}
		else
		{
			$referencia="FACT-V".str_pad($datos[0]["VFact_Codigo"], 7, "0", STR_PAD_LEFT);
		}
		guardardetallefacturacion($conexion,
			$datos[0]["VFact_Codigo"],
			$clave,
			$detalle_completo["Descripcion"],
			$detalle["cantidad"],
			0,
			$detalle["descuento"],
			$valor_descuento,
			floatval($detalle_completo["Pro_Costo"]),
			$total,
			0,
			$datos[0]["VFact_CodKardex"],
			$total_factura,
			$detalle_completo["Pro_PVP1"],
			$datos[0]["VFact_CodAsientoCont"],
			$detalle_completo["TipP_CtaVenta"],
			$detalle_completo["TipP_CtaCosto"],
			$detalle_completo["TipP_CtaInventario"],
			$referencia,
			$motivo,
			$detalle_completo["Dprod_Numero"],
			floatval($detalle_completo["Pro_Costo"]),
			$total_factura,
			"",
			0,
			intval($tipofacturacion),
			$datos[0]["Acal_cod"],
			$detalle_completo["Pro_CodTipoProd"]);
	}
	$respuesta["data"]=$datos[0]["VFact_Codigo"];
	echo json_encode($respuesta);
	//var_dump($respuesta);
}
?>
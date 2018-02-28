<?php
error_reporting(1);
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['sucursal']) 
{
	$respuesta=array();
	$tipofacturacion=$_REQUEST['tipofacturacion'];
	$sucursal=$_SESSION['sucursal'];
	$respuesta["success"]=true;
	if($tipofacturacion=="3")
	{
		$factura=intval($sucursal["Suc_ActualNumF"])+1;
		$no_factura=substr($sucursal["Suc_SerieF"],0,3)."-".substr($sucursal["Suc_SerieF"],-3)."-".str_pad($factura, 7, "0", STR_PAD_LEFT);
		$data=array('NoAuto'=>$sucursal["Suc_NumAutSriF"],'FechaCaducidad'=>$sucursal["Suc_FecMaxSriF"]->format('d-m-Y'),'No_Fact'=>$no_factura);
	}
	else
	{
		$no_nota=substr($sucursal["Suc_SerieNV"],0,3)."-".substr($sucursal["Suc_SerieNV"],-3)."-";
		$data=array('NoAuto'=>$sucursal["Suc_NumAutSriNV"],'FechaCaducidad'=>$sucursal["Suc_FecMaxSriNV"]->format('d-m-Y'),'No_Fact'=>$no_nota);
	}
	$respuesta["data"]=$data;
	echo json_encode($respuesta);
	//var_dump($sucursal);
}
?>
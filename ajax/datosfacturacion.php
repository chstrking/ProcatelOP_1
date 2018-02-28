<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario']) && $_SESSION['sucursal']) 
{
	$respuesta=array();
	$tipobusqueda=$_POST["tipobusqueda"];
	$SucursalID=$_POST["SucursalID"];
	
	$Parametros=find_ParametrosxSucursal($conexion,$SucursalID);
	
	$tipofacturacion=$_REQUEST['tipofacturacion'];
	$sucursal=$_SESSION['sucursal'];
	$respuesta["success"]=true;
	if($Parametros[0]["secuencial"] != 0 && $Parametros[0]["ptoemi"] != 0 && $Parametros[0]["ptovta"] != 0 )
	{
		if($tipofacturacion=="3")
		{
			//$factura=intval($sucursal["Suc_ActualNumF"])+1;
			//$no_factura=substr($sucursal["Suc_SerieF"],0,3)."-".substr($sucursal["Suc_SerieF"],-3)."-".str_pad($factura, 7, "0", STR_PAD_LEFT);
			$factura=$Parametros[0]["secuencial"]+1;
			$no_factura=$Parametros[0]["ptoemi"]."-".$Parametros[0]["ptovta"]."-".str_pad($factura, 7, "0", STR_PAD_LEFT);
			$fechaV=$Parametros[0]["Suc_FecMaxSriF"]; 
			$data=array('NoAuto'=>$Parametros[0]["Suc_NumAutSriF"],'FechaCaducidad'=>$fechaV,'No_Fact'=>$no_factura);
		}
		else
		{
			$no_nota=substr($sucursal["Suc_SerieNV"],0,3)."-".substr($sucursal["Suc_SerieNV"],-3)."-";
			$data=array('NoAuto'=>$sucursal["Suc_NumAutSriNV"],'FechaCaducidad'=>$sucursal["Suc_FecMaxSriNV"]->format('d-m-Y'),'No_Fact'=>$no_nota);
		}	
	}
	else
	{
		$data=array('NoAuto'=>'','FechaCaducidad'=>'','No_Fact'=>'');
	}	
	$respuesta["data"]=$data;
	echo json_encode($respuesta);
}
?>
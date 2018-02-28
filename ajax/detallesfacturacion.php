<?php
error_reporting(1);
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['sucursal']) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	if(isset($_SESSION['detalle_facturacion']))
	{
		$detalles=$_SESSION['detalle_facturacion'];
		if(count($detalles)==0)
		{
			$respuesta["success"]=false;
		}
	}
	else
	{
		$respuesta["success"]=false;
	}
	echo json_encode($respuesta);
	//var_dump($respuesta);
}
?>
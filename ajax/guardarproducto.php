<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$IdTipProd=$_REQUEST['tipop'];
	$IdMarca=$_REQUEST['marca'];
	$Modelo=$_REQUEST['modelo'];
	$IdCodTec=$_REQUEST['Tec'];
	$Descri=$_REQUEST['Descri'];
	$Series=$_REQUEST['Series'];
	$TipoSeries=$_REQUEST['Tseries'];
	$Caracteristicas=$_REQUEST['Caracteristicas'];
	$CantidadR=$_REQUEST['CantR'];
	$IdPrecio=$_REQUEST['Precio'];
	$Servicio=$_REQUEST['Serv'];
	$Id=$_REQUEST['id'];
	$estado=$_REQUEST['estado'];
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	saveproductos($conexion,$IdTipProd,$IdMarca,$Modelo,$IdCodTec,$Descri,$Series,$TipoSeries,$Caracteristicas,$CantidadR,$IdPrecio,$Servicio,$Id,$estado);
	echo json_encode($respuesta);	
}
?>
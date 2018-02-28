<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
$idSucursal=$_REQUEST['idSucursal'];
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	eliminasucursal($conexion,$idSucursal);
	echo json_encode($respuesta);
	//var_dump($sucursal);
}
?>
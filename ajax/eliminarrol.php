<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
$idRol=$_REQUEST['idRol'];
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	eliminarol($conexion,$idRol);
	echo json_encode($respuesta);
	//var_dump($sucursal);
}
?>
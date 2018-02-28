<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
$id=$_REQUEST['idCuentas'];
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	eliminacuentas($conexion,$id);
	echo json_encode($respuesta);
}
?>
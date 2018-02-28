<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$Id=$_REQUEST['id'];
	$Ip=$_REQUEST['Ip'];
	$NombreAcceso=$_REQUEST['NombreAcceso'];
	$SucursalID=$_REQUEST['SucursalID'];
	$SucursalNombre=$_REQUEST['SucursalNombre'];
	$estado=$_REQUEST['estado'];
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	saveacceso($conexion,$Id,$Ip,$NombreAcceso,$SucursalID,$estado);
	echo json_encode($respuesta);	
}
?>
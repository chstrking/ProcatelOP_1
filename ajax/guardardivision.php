<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$Id=$_REQUEST['id'];
	$Nombre=$_REQUEST['NombreDivision'];
	$estado=$_REQUEST['Estado'];
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	savedivision($conexion,$Id,$Nombre,$estado);
	echo json_encode($respuesta);	
}
?>
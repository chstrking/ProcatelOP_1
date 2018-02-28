<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$Id=$_REQUEST['id'];
	$Nombre=$_REQUEST['nombre'];
	$estado=$_REQUEST['estado'];
	$responsable=$_REQUEST['responsable'];
	$ubicacion=$_REQUEST['ubicacion'];
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	savebodega($conexion,$Id,$Nombre,$estado,$responsable,$ubicacion);
	echo json_encode($respuesta);	
}
?>
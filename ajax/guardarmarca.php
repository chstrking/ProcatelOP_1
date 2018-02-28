<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$Id=$_REQUEST['id'];
	$Nombre=$_REQUEST['NombreTmarca'];
	$estado=$_REQUEST['estado'];
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	savemarca($conexion,$Id,$Nombre,$estado);
	echo json_encode($respuesta);	
}
?>
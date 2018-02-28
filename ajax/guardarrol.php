<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	//Recibe los parámetros
	$id=$_REQUEST["id"];
	$NombreRol=$_REQUEST['NombreRol'];
	$estado=$_REQUEST['estado'];
	
//Pregunta si esta logoneado y no si tiene asignada una sucursal por lo que el usuario es la que la selecciona	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;

	saverol($conexion,$id,$NombreRol,$estado);
	echo json_encode($respuesta);	
	
}
?>
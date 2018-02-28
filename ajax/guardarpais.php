<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$id=$_REQUEST['id'];
	$nombre=$_REQUEST['nombre'];
	$estado=$_REQUEST['estado'];
	$procedure='SP_IngresaPais';
	$parametros=array($id,$nombre,$estado);
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	saveregistros($procedure,$conexion,$parametros);
	echo json_encode($respuesta);	
}
?>
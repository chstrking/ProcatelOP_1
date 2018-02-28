<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$id=$_REQUEST['id'];$idPais=$_REQUEST['PaisID'];
	$nombre=$_REQUEST['nombre'];
	$estado=$_REQUEST['estado'];
	$procedure='SP_IngresaProvincia';
	$parametros=array($id,$idPais,$nombre,$estado);
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	saveregistros($procedure,$conexion,$parametros);
	echo json_encode($respuesta);	
}
?>
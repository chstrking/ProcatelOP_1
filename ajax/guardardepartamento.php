<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$Id=$_REQUEST['id'];
	$Nombre=$_REQUEST['NombreDepartamento'];
	$estado=$_REQUEST['estado'];
	$CContID=$_REQUEST['CContID'];
	$VendedorID=$_REQUEST['VendedorID'];
	$estado=$_REQUEST['estado'];
	$DivisiónlID=$_REQUEST['DivisiónlID'];

if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;

	savedepartamento($conexion,$Id,$DivisiónlID,$Nombre,$VendedorID,$CContID,$estado);
	echo json_encode($respuesta);	
}
?>
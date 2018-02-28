<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	//Recibe los parámetros
	
	$id=$_REQUEST["id"];
	$clave=$_REQUEST['clave'];
	$VendedorID=$_REQUEST['VendedorID'];
	$fecha_ingreso=$_REQUEST['FechaIng'];
	$fecha_vencimiento=$_REQUEST['FechaCad'];
	$estado=$_REQUEST['estado'];
	$rol=$_REQUEST['rol'];
	$mail=$_REQUEST['mail'];
	//var_dump($mail);

//Pregunta si esta logoneado y no si tiene asignada una sucursal por lo que el usuario es la que la selecciona
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	saveusuario($conexion,$id,$clave,$VendedorID,$fecha_ingreso,$fecha_vencimiento,$estado,$mail,$rol);
	//saveusuario($conexion,$id,$clave,$id_empleado,$fecha_ingreso,$fecha_vencimiento,$tipo,$correo);
	//saverolUsuario($conexion,$idRol,$id,$estado);
	echo json_encode($respuesta);	
}
?>
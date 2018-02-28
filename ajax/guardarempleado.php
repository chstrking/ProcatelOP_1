<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	
	$Id=$_REQUEST['Id'];
	$Cedula=$_REQUEST['Cedula'];
	$Apellidos=$_REQUEST['Apellidos'];
	$Nombres=$_REQUEST['Nombres'];
	$Titulo=$_REQUEST['Titulo'];
	$CargoID=$_REQUEST['CargoID'];
	$DepartamentolID=$_REQUEST['DepartamentolID'];
	$CContID=$_REQUEST['CContID'];
	$Tipo=$_REQUEST['Tipo'];
	$estado=$_REQUEST['estado'];
	$lugar=$_REQUEST['lugar'];
	$Sueldo=$_REQUEST['Sueldo'];
	$FechaIng=$_REQUEST['FechaIng'];
	$Pago=$_REQUEST['Pago'];
	$SucursalID=$_REQUEST['SucursalID'];

//Pregunta si esta logoneado y no si tiene asignada una sucursal por lo que el usuario es la que la selecciona
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	saveempleado($conexion,$Id,$Cedula,$Apellidos,$Nombres,$Titulo,$CargoID,$DepartamentolID,$CContID,$Tipo,$estado,$lugar,$Sueldo,$FechaIng,$Pago,$SucursalID);
	echo json_encode($respuesta);	
}
?>
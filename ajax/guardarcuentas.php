<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

	$Id=$_REQUEST['id'];
	$Nombre=$_REQUEST['Nombrecuentas'];
	$IdPadre= $_REQUEST['CuentaID'];
	$NumCuenta= $_REQUEST['NumCuenta'];
	$estado=$_REQUEST['Estado'];
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	savecuentas($conexion,$Id,$Nombre,$IdPadre,$NumCuenta,$estado);
	echo json_encode($respuesta);	
}
?>
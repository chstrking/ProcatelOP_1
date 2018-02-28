<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
//Almacena parametros enviados
	$id=$_REQUEST['id'];
	$Nombre=$_REQUEST['Nombre'];
	$Refencia=$_REQUEST['Refencia'];
	$Refencia1=$_REQUEST['Refencia1'];
	$Refencia2=$_REQUEST['Refencia2'];
	$Refencia3=$_REQUEST['Refencia3'];
	$Refencia4=$_REQUEST['Refencia4'];
	$Refencia5=$_REQUEST['Refencia5'];
	$iva=$_REQUEST['iva'];
	$icecomp=$_REQUEST['icecomp'];
	$iceven=$_REQUEST['iceven'];
	$descuento=$_REQUEST['descuento'];
	$estado=$_REQUEST['estado'];
	$procedure='SP_Ing_TipoProductoweb';
	$parametros=array($id,$Nombre,$Refencia,$Refencia1,$Refencia2,$Refencia3,$Refencia4,$Refencia5,$iva,$icecomp,$iceven,$descuento,$estado);
	//VAR_dump($parametros);
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	saveregistros($procedure,$conexion,$parametros);
	echo json_encode($respuesta);	
}
?>
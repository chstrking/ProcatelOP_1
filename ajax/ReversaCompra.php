<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
ini_set('max_execution_time', 0);
$fact=$_REQUEST['fact'];
if(isset($_SESSION['usuario'])) 
{
	//var_dump('Hola mundo');
	$respuesta=array();
	$respuesta["success"]=true;
	ReversaCompra($conexion,$fact);
	echo json_encode($respuesta);
	//var_dump($respuesta);
}
?>
<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
$idUsuario=$_REQUEST['id_usuario'];
if(isset($_SESSION['usuario'])) 
{
	//var_dump('Hola mundo');
	$respuesta=array();
	$respuesta["success"]=true;
	eliminausuario($conexion,$idUsuario);
	echo json_encode($respuesta);
	//var_dump($respuesta);
}
?>
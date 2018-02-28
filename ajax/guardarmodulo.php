<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();
	//Recibe los parámetros
$id=$_REQUEST["id"];
$NombreModulo=$_REQUEST['NombreModulo'];
$estado=$_REQUEST['estado'];
$respuesta["success"] = $id;	
	
//Pregunta si esta logoneado y no si tiene asignada una sucursal por lo que el usuario es la que la selecciona	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
	$verificador = "";
	$i = 0;
	
	$sql = "CALL Sp_IngresaActualizaModulos($id, '$NombreModulo',$estado)";
	
	foreach($mbd->query($sql) as $fila) {
		$verificador=$fila['CodigoMod'];
		$i++;
	}
	
	if(empty($verificador)){
			$respuesta["success"] = false;
	}else{
			$respuesta["success"] = true;
		}
		
	echo json_encode($respuesta);			
}
?>+
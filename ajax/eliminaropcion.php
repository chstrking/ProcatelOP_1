<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();
$id=$_REQUEST['id'];
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	//eliminaopcion($conexion,$id);
	//$respuesta["success"]=true;
	$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
	$verificador = "";
	$i = 0;
	$sql = "DELETE FROM opciones WHERE CodigoOp = $id";
	$mbd->query($sql);
	/*foreach($mbd->query($sql) as $fila) {
		$verificador=$fila['CodigoRol'];
		$i++;
	}*/

	echo json_encode($respuesta);
}
?>
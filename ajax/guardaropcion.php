<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();
	
$Id=$_REQUEST['id'];
$ModuloID=$_REQUEST['ModuloID'];
$NombreOpcion=$_REQUEST['NombreOpcion'];
$NombrePant=$_REQUEST['NombrePant'];
$estado=$_REQUEST['estado'];
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
	$verificador = "";
	$i = 0;
	
	//$stmt->execute();
	$sql = "CALL Sp_IngresaActualizaOpciones($Id, $ModuloID, '$NombreOpcion', '$NombrePant',$estado)";
	
	foreach($mbd->query($sql) as $fila) {
		$verificador=$fila['CodigoOp'];
		$i++;
	}
	
	if(empty($verificador)){
			$respuesta["success"] = false;
	}else{
			$respuesta["success"] = true;
		}
	echo json_encode($respuesta);
	
	//$respuesta=array();
	//$respuesta["success"]=true;
	
	//saveopcion($conexion,$Id,$ModuloID,$NombreOpcion,$estado);
	echo json_encode($respuesta);	
}
?>
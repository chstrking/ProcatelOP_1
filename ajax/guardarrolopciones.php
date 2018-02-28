<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondbd.php');
//$conexion=crear_conexion();
//echo($conexion);
if(isset($_SESSION['usuario'])) 
{
	//echo("CALLSp_ActualizaRolesOpciones");
	$respuesta=array();
	//$respuesta["success"]=true;
	$id_opcion=$_REQUEST['id_opcion'];
	$id_modulo=$_REQUEST['id_modulo'];
	$id_rol=$_REQUEST['id_rol'];
	$tipo=$_REQUEST['tipo'];
	$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
	$verificador = "";
	$i = 0;
	$sql = "CALL Sp_ActualizaRolesOpciones($id_modulo, $id_rol, $id_opcion, '$tipo')";
	
	foreach($mbd->query($sql) as $fila) {
		$verificador=$fila['CodigoRol'];
		$i++;
	}
	
	/*$sql = 'CALL Sp_ActualizaRolesOpciones(?, ?, ?, ?)';
	$stmt = $mbd->prepare($sql);

	$stmt->bindParam(1, $id_modulo, PDO::PARAM_INT, 11);
	$stmt->bindParam(2, $id_rol, PDO::PARAM_INT, 11);
	$stmt->bindParam(3, $id_opcion, PDO::PARAM_INT, 11);
	$stmt->bindParam(4, $tipo, PDO::PARAM_STR, 1);

	//print "Values of bound parameters _before_ CALL:\n";
	//print "  1: {$second_name} 2: {$weight}\n";

	$result_sp = $stmt->execute();
	*/
	if(empty($verificador)){
		if($tipo=='E'){
			$respuesta["success"] = true;
		}else{
			$respuesta["success"] = false;
		}

	}elseif($verificador>0){
		if($tipo=='I'){
			$respuesta["success"] = true;
		}else{
			$respuesta["success"] = false;
		}
	}else{
		$respuesta["success"] = false;
	}
		
	/*while ($row = mysqli_fetch_array($result_sp)){   
      print_r $row[0] . " - " . + $row[1]; 
	}*/
	echo json_encode($respuesta);
	//echo("tumadre");
}

?>
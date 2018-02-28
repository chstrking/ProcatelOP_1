<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	if(isset($_GET['guardar']))
	{
		$nombrerol=$_GET["nombrerol"];
		$estado=$_GET["estado"];
		$respuesta= deleterol($conexion,$id,$nombrerol,$estado);
		var_dump($respuesta);
		if($id==0)
		{
			$rol=getrol($conexion,$respuesta);
		}
		else
		{
			$rol=getrol($conexion,$id);
		}
	}
	else
	{
		if($id==0)
		{
			$rol=array('nombre'=>'','estado'=>1);
		}
		else
		{
			$rol=getrol($conexion,$id);
		}
	}
	
?>

<?php }?>
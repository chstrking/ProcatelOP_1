<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
	//Recibe los parámetros
	//var_dump($_REQUEST['idsucursal']);
	$idsucursal=$_REQUEST['idsucursal'];
	$nombre=$_REQUEST['Descripcion'];
	$direccion=$_REQUEST['direccion'];
	$telefono=$_REQUEST['telefono'];
	$selectError3 = $_REQUEST['selectError3'];
	$fax=$_REQUEST['fax'];
	$Estado=$_REQUEST['Estado'];
	$NumAutoRet=$_REQUEST['NumAutoRet'];
	$SerieRet=$_REQUEST['SerieRet'];
	$noDesdeRet=$_REQUEST['NoDesdeRet'];
	$NoHastaRet=$_REQUEST['NoHastaRet'];
	$FechaRet=$_REQUEST['FechaRet'];
	$NumAutoND=$_REQUEST['NumAutoND'];
	$SerieND=$_REQUEST['SerieND'];
	$NoDesdeND=$_REQUEST['NoDesdeND'];
	$NoHastaND=$_REQUEST['NoHastaND'];
	$FechaND=$_REQUEST['FechaND'];
	$NumAutoNC=$_REQUEST['NumAutoNC'];
	$SerieNC=$_REQUEST['SerieNC'];
	$NumDesdeNC=$_REQUEST['NumDesdeNC'];
	$NumHastaNC=$_REQUEST['NumHastaNC'];
	$fechaNC=$_REQUEST['fechaNC'];
	$NumAutoNV=$_REQUEST['NumAutoNV'];
	$SerieNV=$_REQUEST['SerieNV'];
	$NoDesdeNV=$_REQUEST['NoDesdeNV'];
	$NoHastaNV=$_REQUEST['NoHastaNV'];
	$FechaNV=$_REQUEST['FechaNV'];
	$NumAutoFac=$_REQUEST['NumAutoFac'];
	$SerieFac=$_REQUEST['SerieFac'];
	$NumDesdeFac=$_REQUEST['NumDesdeFac'];
	$NumHastaFac=$_REQUEST['NumHastaFac'];
	$NumActFac=$_REQUEST['NumActFac'];
	$FechaFac=$_REQUEST['FechaFac'];

//Pregunta si esta logoneado y no si tiene asignada una sucursal por lo que el usuario es la que la selecciona
	
if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$respuesta["success"]=true;
	
	savesucursal($conexion,$idsucursal,$nombre,$direccion,$telefono,$fax,$NumAutoRet,$SerieRet,$noDesdeRet,$NoHastaRet,$FechaRet,$NumAutoND,$SerieND,$NoDesdeND,$NoHastaND,$FechaND,$NumAutoNC,$SerieNC,$NumDesdeNC,$NumHastaNC,$fechaNC,$NumAutoNV,$SerieNV,$NoDesdeNV,$NoHastaNV,$FechaNV,$NumAutoFac,$SerieFac,$NumDesdeFac,$NumHastaFac,$NumActFac,$FechaFac,$selectError3);
	echo json_encode($respuesta);	
}
?>
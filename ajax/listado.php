<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php'); 
require_once('..//Clases/ListadoClass.php');
require_once('..//Clases/Sliding.php');
$conexion=crear_conexion();
var_dump('Hola de nuevo');
/*if(isset($_POST['enviar']) && $_POST['enviar'] == 'Listar')
{*/
  $Estado = $_POST['Estado'];
  $IdSuc = $_POST['$IdSuc'];
  $Nombre = $_POST['Nombre'];
  //$obj_listado = new ListadoClass();
  $datas = empleados($conexion,$IdSuc,$Nombre,$Estado);//$obj_listado->listado($status);
  var_dump($datas);
  $params = array(
   'mode'       => 'Sliding',
   'perPage'    => 5,
   'delta'      => 2,
   'itemData'   => $datas);
   $pager      = new Pager_Sliding($params);
   $datasin[0] = $pager->getPageData();
   $links      = $pager->getLinks(); 
   $datasin[1] = $links['all'];
   var_dump($datasin);
   echo json_encode($datasin);
//} 
?>
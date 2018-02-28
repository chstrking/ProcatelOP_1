<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/tutosvariados/PracticaJson/ListadoClass.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/tutosvariados/PracticaJson/library/Pager/Sliding.php";

if(isset($_POST['enviar']) && $_POST['enviar'] == 'Listar')
{
  $status = $_POST['status'];
  $obj_listado = new ListadoClass();
  $datas = $obj_listado->listado($status);
  $params = array(
   'mode'       => 'Sliding',
   'perPage'    => 5,
   'delta'      => 2,
   'itemData'   => $datas);
   $pager      = new Pager_Sliding($params);
   $datasin[0] = $pager->getPageData();
   $links      = $pager->getLinks(); 
   $datasin[1] = $links['all'];
   echo json_encode($datasin);
} 
?>
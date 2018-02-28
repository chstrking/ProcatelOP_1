<?php 
/**
 * ListadoClass - Es solo como prueba 
 */
require_once $_SERVER["DOCUMENT_ROOT"] . "/tutosvariados/PracticaJson/library/DbPdo.php";
class ListadoClass{

   protected function _getDbh(){
        return DbPdo::getInstance()->getConn();
   }


   public function listado($status){

   	$sql = "SELECT * from `Products` WHERE `status` = ?";
      $stm = $this->_getDbh()->prepare($sql);
      $stm->bindParam(1, $status, PDO::PARAM_INT);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC); 
   }
}    
<?php 
$db_usr='usrsinple';
$db_pass='';
$db_server='128.121.8.28';
$db_name='JBGSMJ';
$db_info= array('Database'=>$db_name,'UID'=>$db_usr,'PWD'=>$db_pass);
$db_link= sqlsrv_connect($db_server, $db_info);
if(!$db_link){
die( print_r( sqlsrv_errors(), true));
}
else
{
	$query2 = "select * from TBLEMPLE"; 
	$result_sp = sqlsrv_query($db_link, $query2);
	if( $result_sp === false) 
	{
		die( print_r( sqlsrv_errors(), true) );
	}
	$data = array();
	$i=0;
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$fila = array();
		$fila["nombre"]=$row['PERID'];
		$data[$i] = $fila;
		$i++;
	}
	sqlsrv_free_stmt( $result_sp );
header("Content-type: application/json"); 
echo "{\"data\":" .json_encode($data). "}";
}	
?>
<?php
function mssql_escape($variable) 
{
   
	$vowels = array( ";" , "'" , "--" ); 
	$CadenaSegura = str_replace ( $vowels , "" , $variable ); 
	return $CadenaSegura;
}	
?>
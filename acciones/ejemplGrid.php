<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
?>
		<div id="wrap">
		<h1>EditableGrid Demo - Database Link</h1> 
		
			<!-- Feedback message zone -->
			<div id="message"></div>

			<!-- Grid contents -->
			<div id="tablecontent"></div>
		
			<!-- Paginator control -->
			<div id="paginator"></div>
		</div>  

		<script type="text/javascript">
			window.onload = function() { 
				datagrid = new DatabaseGrid();
			}; 
		</script>
<?php }?>

<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Imprimir Stock" onclick="ImprimirKardex()" target="_blank">
				<i class="fa fa-user"></i>
				<span>Consulta Kardex</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-sm-4">
   <div class="panel">
	<div class="panel-heading">Reimpresi&oacute;n de Kardex</div>
	<table class="table">
		<tbody>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="idKardex" class="form-control" type="text" size="16" placeholder="No. Kardex">
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
	</div>
</div>
<?php }?>
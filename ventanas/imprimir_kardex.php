<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
$idKardex=$_REQUEST['idKardex'];
if(isset($_SESSION['usuario'])) 
{
?>
<table cellspacing="0" cellpadding="0" width="100%" height="100%">
	<tr>
		<td align="center" valign="middle">
			<div class="area_login">
				<div id="login">
					<h3>Se ha guardado el kardex de Forma Exitosa.</h3>
					<h5>¿Desea imprimir el kardex?</h5>
					<div class="form-group">
						<button class="btn btn-success btn-block" id="cancelar-btn" onclick="CancelarImprimirKardex()">Cancelar</button>
						<a class="btn btn-success btn-block" id="imprimir-btn" href="../ProcatelOP/acciones/imprimir_Kardex.php?idKardex=<?php echo $idKardex;?>" target="_blank">Imprimir</a>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
<?php
}
?>
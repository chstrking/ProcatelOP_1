<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	$tipo_productos=tipoventas($conexion);
	$arreglo_refencia=referencia($conexion,'1');
	$_SESSION['detalle_facturacion']=array();
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Imprimir Stock" onclick="ImprimirMovimientoKardex()" target="_blank">
				<i class="fa fa-user"></i>
				<span>Movimiento Kardex</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
		<div class="panel">
			<div class="panel-heading">Movimiento de kardex</div>
			<table class="table">
				<tr>
					<td>
						<div class="form-group">
							<label class="control-label">Producto</label>
							<div class="controls">
									<div class="input-group">
										<input id="ProductNombre" class="form-control" type="text" size="16" placeholder="Producto" readonly="readonly">
										<input id="ProductID" type="hidden" value="">
										<span class="input-group-btn">
											<button onclick="BuscarParametrosAdicional('1')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
										</span>
									</div>
							</div>
						</div>
					</td>	
				</tr>
			</table>
			</div>
			<input type="hidden" value="tr_1" id="detalleid">
		</div>
</div>

<script type="text/javascript">
	CambiarDatos();
	jQuery(function($){
		$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
		})//show datepicker when clicking on the icon
		.next().on("click", function(){
		$(this).prev().focus();
		}); 
	});
</script>
<?php }?>
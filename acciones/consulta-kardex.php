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
	$_SESSION['detalle_facturacion_completo']=array();
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Imprimir Stock" onclick="ImprimirConKardex('<?php echo $Usuario;?>')" target="_blank">
				<i class="fa fa-user"></i>
				<span>Consulta kardex</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-8">
		<div class="panel">
			<div class="panel-heading">Consulta de Kardex</div>
			<table class="table">
			  <tr>

				<td width="33%">
					<div class="form-group">
						<label class="control-label" for="date01">Fecha Inicio</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="FechaI" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
				<td width="33%">
					<div class="form-group">
						<label class="control-label" for="date01">Fecha Fin</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="FechaF" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
			  </tr>
			</table>
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
									
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				
			</table>
			<div style="background: #ffffff;">

			</div>
			<input type="hidden" value="tr_1" id="detalleid">
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(function($){
		$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
		})
		.next().on("click", function(){
		$(this).prev().focus();
		}); 
	});
</script>
<?php }?>
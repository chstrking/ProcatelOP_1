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
<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-heading">Genera Factura</div>
			
			<td width="33%">
				<div class="form-group">
					<label class="control-label" for="date01">Fecha</label>
					<div class="input-group col-xs-8 col-sm-8">
						<input id="fecha_facturacion" class="form-control date-picker" type="text"  readonly="readonly">
						<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
					</div>
				</div>
			</td>
			<input type="hidden" value="tr_1" id="detalleid">
		</div>
	</div>
</div>
<script type="text/javascript">
	CambiarDatos();
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
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
<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-heading">Egresos</div>
			<table class="table">
			  <tr>
				<td>
					<div class="form-group">
					<label class="control-label" for="selectError3">Tipo</label>
					<div class="controls">
						<select id="Tipo" class="form-control">
							<option name="Nvta" value="1">Uso Interno</option>
							<option name="Nvta" value="2">Dar de baja</option>
							<option name="Nvta" value="3">Ajuste</option>
						</select>
					</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Referencia</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label" for="date01">Fecha</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<label class="control-label">Bodega</label>
							<div class="input-group">
								<input id="BodegaNombre" class="form-control" type="text" size="16" placeholder="Bodega" readonly="readonly">
								<input type="hidden" id="BodegaID" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('4')" id="bt_Bodega" class="btn" type="button"><i class="fa fa-search"></i></button>
								</span> 
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Fecha de Sistema</label>
						<div class="controls">
							<?php ini_set('date.timezone', 'America/Guayaquil'); $fecha_servidor=date('d-m-Y');?>
							<input id="FechaSistema" class="form-control" type="text" size="16" placeholder="Fecha Sistema" readonly="readonly" value="<?php echo $fecha_servidor;?>">
						</div>
					</div>
				</td> 
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label">Motivo</label>
						<div class="controls">
							<input id="MotivoNombre" class="form-control" type="text" size="40" placeholder="Motivo">
						</div>
					</div>
				</td>
			</tr>
			</table>
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td class="nombre_tabla">Detalle de productos</td>
										</tr>
									</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id Producto</th>
						<th>Descripci&oacute;n</th>
						<th>Stock</th>
						<th>Cantidad</th>
						<th>% Descuento</th>
						<th>Valor Descuento</th>
						<th>Precio de Venta</th>
						<th>Total</th>
						<th>N&uacute;mero de Serie</th>
						<th>N&uacute;mero de L&iacute;nea</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
						
					</tr>
				</tbody>
			</table>
			<div style="background: #ffffff;">
				<tr>
					<td colspan="2" align="center">
						<button onclick="Guardar_Facturacion()" type="button" class="boton_save"><i class="fa fa-save"></i> Guardar</button> 
					</td>
				</tr>
			</div>
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
		})//show datepicker when clicking on the icon
		.next().on("click", function(){
		$(this).prev().focus();
		}); 
	});
</script>
<?php }?>
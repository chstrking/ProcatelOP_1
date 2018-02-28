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
			<a title="Imprimir Stock" onclick="GuardarKardex()" target="_blank">
				<i class="fa fa-user"></i>
				<span>Guardar</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-8">
		<div class="panel">
			<div class="panel-heading">Transferencia de bodegas</div>
			<table class="table">
			  <tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<label class="control-label">Bodega/Salida</label>
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
				<td width="50%">
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
						<div class="controls">
							<label class="control-label">Bodega/Entrada</label>
							<div class="input-group">
								<input id="BodegaNombreE" class="form-control" type="text" size="16" placeholder="Bodega" readonly="readonly">
								<input type="hidden" id="BodegaIDE" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('23')" id="bt_Bodega" class="btn" type="button"><i class="fa fa-search"></i></button>
								</span> 
							</div>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				  <td>
						<div class="form-group">
							<label class="control-label">Motivo</label>
							<div class="controls">
								<input onkeyup = "this.value=this.value.toUpperCase()" id="motivo" class="form-control" type="text" size="16" placeholder="Motivo">
							</div>
						</div>
					</td>
			  </tr>
			</table>
			

			<input type="hidden" value="tr_1" id="detalleid">
		</div>
	</div>
	<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td class="nombre_tabla">Detalle productos</td>
											<td class="padding_td_tablas" align="right" valign="middle">
												<label class="label_without_margin">Tipo de Producto</label>
											</td>
											<td class="padding_td_tablas" align="left" valign="middle" style="width:12%">
												<button id="detalle_facturacion" class="boton_save" type="button"  onclick="BuscarProductoTransferencia()"><i class="fa fa-plus-square"></i> Nuevo</button>
											</td>
										</tr>
									</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id Producto</th>
						<th>Descripción</th>
						<th>Stock</th>
						<th>Cantidad</th>
						<th>% Descuento</th>
						<th>Valor Descuento</th>
						<th>Precio de Venta</th>
						<th>Total</th>
						<th>Número de Serie</th>
						<th>Número de Línea</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
						
					</tr>
				</tbody>
			</table>
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
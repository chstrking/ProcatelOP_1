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
			<div class="panel-heading">Impresi&oacute;n de factura</div>
			<table class="table">
			  <tr>
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
				<div class="form-group">
						<label class="control-label" ></label>
						<div class="controls">
							<td align="left" valign="middle">
								<label class="radio"><input type="radio" value="FactMatriz" name="Chkgruop1" checked="checked"/> PVIR</label>
							</td>
							<td align="left" valign="middle">
										<label class="radio"><input type="radio" value="FactTienda" name="Chkgruop1"/> MOVILPOS</label>
							</td>
							<td align="left" valign="middle">
										<label class="radio"><input type="radio" value="Consignación" name="Chkgruop1"/> Consignaci&oacute;n</label>
							</td>
						</div>
					</div>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">c&oacute;digo</label>
						<div class="controls">
							<div class="input-group">
								<input id="FacturaNombre" class="form-control" type="text" size="16" placeholder="Factura" readonly="readonly">
								<input type="hidden" id="FacturaID">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('3')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td> 
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<label class="control-label">Cliente</label>
							<div class="input-group">
								<input id="ClienteNombre" class="form-control" type="text" size="16" placeholder="Cliente" readonly="readonly">
								<input type="hidden" id="ClienteID" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('2')" id="bt_cliente" class="btn" type="button"><i class="fa fa-search"></i></button>
								</span> 
							</div>
						</div>
					</div>
				</td>
			 </tr>
			  <tr>
				<td>
					<div class="form-group">
					<label class="control-label" for="selectError3">Tipo</label>
					<div class="controls">
						<select id="TipoFacturacion" class="form-control" onchange="CambiarDatos()">
							<option name="Nvta" value="1">Nota/Venta</option>
							<option name="Nvta" value="2">Nota/Venta con iva</option>
							<option name="Nvta" value="3">Factura</option>
						</select>
					</div>
					</div>
				</td>
				<td align="right">
					<div class="form-group">
						<input class="control-label" type="hidden" align="Left">Total</input>
						<div class="controls">
							<input id="Total" class="form-control valores" type="text" size="16" placeholder="TOTAL" readonly="readonly">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>	
				<td>
					<div class="form-group">
						<label class="control-label">No. Factura</label>
						<div class="controls">
							<input id="NoFact" class="form-control" type="text" size="16" placeholder="No. Factura" disabled="disabled">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No Autorizaci&oacute;n</label>
						<div class="controls">
							<input id="NumAuto" class="form-control" type="text" size="16" placeholder="No.Autoriz/Ret" disabled="disabled">
						</div>
					</div>
				</td>
			  </tr>
			</table>
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td class="nombre_tabla">Detalle Facturaci&oacute;n</td>
										</tr>
									</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Factura</th>
						<th>Fecha</th>
						<th>Total</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
						
					</tr>
				</tbody>
			</table>
			<div style="background: #ffffff;">
			<table align="right" width="20%" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2" align="center">
						<button onclick="ImprimirFactura()" type="button" class="boton_save"><i class="fa fa-save"></i> Imprimir</button> 
					</td>
				</tr>
			</table>
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
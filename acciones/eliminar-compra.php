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
			<div class="panel-heading">Eliminar compra</div>
			<table class="table">
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">C&oacute;digo</label>
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
				<td>
					<div class="form-group">
					<label class="control-label" for="selectError3">Tipo</label>
					<div class="controls">
						<select id="TipoFacturacion" class="form-control" onchange="CambiarDatos()">
							<option name="Nvta" value="1">Nota/Venta</option>
							<option name="Nvta" value="3">Factura</option>
						</select>
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
						<label class="control-label">Sucursal</label>
						<div class="controls">
							<div class="input-group">
								<input id="SucursalNombre" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $_SESSION['sucursal']['Suc_Codigo'].' - '.$_SESSION['sucursal']['Suc_Nombre']?>">
								<input type="hidden" id="SucursalID" value="<?php echo $_SESSION['sucursal']['Suc_Codigo']?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Referencia</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia" value="<?php echo $arreglo_refencia[0]["nombre_referencia"];?>" disabled="disabled">
							<input type="hidden" id="ReferenciaID" value="<?php echo $arreglo_refencia[0]["id_referemcia"];?>">
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
						<label class="control-label">Vendedor</label>
						<div class="controls">
							<div class="input-group">
								<input id="VendedorNombre" class="form-control" type="text" size="16" placeholder="Vendedor" readonly="readonly">
								<input id="VendedorID" type="hidden" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('1')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Factura</label>
						<div class="controls">
							<input id="NoFact" class="form-control" type="text" size="16" placeholder="No. Factura" disabled="disabled">
						</div>
					</div>
				</td>
				<td>
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
				<td>
					<div class="form-group">
						<label class="control-label" for="date01">Fecha Caducidad</label>
						<div class="controls">
							<input id="FechaCaducidad" class="form-control" type="text" size="16" placeholder="Fecha de Caducidad" disabled="disabled">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">No Autorizaci&oacute;n</label>
						<div class="controls">
							<input id="NumAuto" class="form-control" type="text" size="16" placeholder="No.Autoriz/Ret" disabled="disabled">
						</div>
					</div>
				</td>
				<td>
				</td>
			  </tr>
			  <!---<tr><td align="left" valign="middle">
					<div class="form-group">
						<label class="control-label" >No se</label>
						<div class="controls">
							<label class="radio"><input type="radio" value="FactMatriz" name="Chkgruop1" checked="checked"/> FactMatriz</label>
							<label class="radio"><input type="radio" value="FactTienda" name="Chkgruop1"/> FactTienda</label>
							<label class="radio"><input type="radio" value="Normal" name="Chkgruop1"/> Normal</label>
							<label class="radio"><input type="radio" value="Consignación" name="Chkgruop1"/> Consignación</label>
						</div>
					</div>
			   </td><td></td><td></td></tr>!--->
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
			<div style="background: #ffffff;">
			<table align="right" width="20%" cellspacing="0" cellpadding="0">
				<!--<tr>
					<td>
						<div class="form-group">
							<label class="control-label">Subtotal Tarifa 0:</label>
						</div>
					</td>
					<td align="right">
						<div class="form-group">
							<div class="controls">
								<input id="Subtotal_Tarifa0" class="form-control valores" type="text" size="16" placeholder="Subtotal Tarifa 0" readonly="readonly">
							</div>
						</div>
					</td>
				</tr> -->
				<tr>
					<td>
						<div class="form-group">
							<label class="control-label">Subtotal Tarifa IVA:</label>
						</div>
					</td>
					<td align="right">
						<div class="form-group">
							<div class="controls">
								<input id="Subtotal_IVA" class="form-control valores" type="text" size="16" placeholder="Subtotal Tarifa IVA" readonly="readonly">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group">
							<label class="control-label">Subtotal:</label>
						</div>
					</td>
					<td align="right">
						<div class="form-group">
							<div class="controls">
								<input id="Subtotal" class="form-control valores" type="text" size="16" placeholder="Subtotal" readonly="readonly">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group">
							<label class="control-label">IVA:</label>
						</div>
					</td>
					<td align="right">
						<div class="form-group">
							<div class="controls">
								<input id="IVA" class="form-control valores" type="text" size="16" placeholder="IVA" readonly="readonly">
							</div>
						</div>
					</td>
				</tr>
				<!--<tr>
					<td>
						<div class="form-group">
							<label class="control-label">ICE:</label>
						</div>
					</td>
					<td align="right">
						<div class="form-group">
							<div class="controls">
								<input id="ICE" class="form-control valores" type="text" size="16" placeholder="ICE" readonly="readonly">
							</div>
						</div>
					</td>
				</tr>-->
				<tr>
					<td>
						<div class="form-group">
							<label class="control-label">Transporte:</label>
						</div>
					</td>
					<td align="right">
						<div class="form-group">
							<div class="controls">
								<input id="Transporte" class="form-control valores" type="text" size="16" placeholder="Transporte">
							</div>
						</div>
					</td>
				</tr>
				<!--<tr>
					<td>
						<div class="form-group">
							<label class="control-label">Otros:</label>
						</div>
					</td>
					<td align="right">
						<div class="form-group">
							<div class="controls">
								<input id="Otros" class="form-control valores" type="text" size="16" placeholder="Otros">
							</div>
						</div>
					</td>
				</tr>-->
				<tr>
					<td>
						<div class="form-group">
							<label class="control-label">Total:</label>
						</div>
					</td>
					<td align="right">
						<div class="form-group">
							<div class="controls">
								<input id="Total" class="form-control valores" type="text" size="16" placeholder="TOTAL" readonly="readonly">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button onclick="Guardar_Facturacion()" type="button" class="boton_save"><i class="fa fa-save"></i> Reversar</button> 
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
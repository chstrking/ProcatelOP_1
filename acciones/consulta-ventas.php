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
	<div class="col-sm-4">
		<div class="panel">
			<div class="panel-heading">Consultas varias</div>
			<table class="table">
				  <tr>
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
				  </tr>
				 <tr>
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
				</tr>
				<tr>
						<div class="form-group">
							<label class="control-label">Producto</label>
							<div class="controls">
									<div class="input-group">
										<input id="VendedorNombre" class="form-control" type="text" size="16" placeholder="Producto" readonly="readonly">
										<input id="VendedorID" type="hidden" value="">
										<span class="input-group-btn">
											<button onclick="Buscar('1')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
										</span>
									</div>
							</div>
						</div>	
				</tr>
				<tr>
					<!--<td class="padding_td_tablas" align="left" valign="middle" style="width:20%">-->
														<div class="controls"> 
																<select id="tipo_producto" name="tipo_producto" class="form-control">
																	<?php foreach($tipo_productos as $tipo_producto):?>
																	<option value="<?php echo $tipo_producto['id'];?>"><?php echo $tipo_producto['descripcion'];?></option>
																	<?php endforeach;?>
																</select>
														</div>
					<!--</td>-->
				</tr>	
				<!--<tr>
					<div class="form-group">
							<label class="control-label" >Tipo de documento</label>
							<div class="controls">
								<td align="left" valign="middle">
									<label class="radio"><input type="radio" value="FactMatriz" name="Chkgruop1" checked="checked"/> Todos</label>
								</td>
								<td align="left" valign="middle">
											<label class="radio"><input type="radio" value="FactTienda" name="Chkgruop1"/> Factura</label>
								</td>
								<td align="left" valign="middle">
											<label class="radio"><input type="radio" value="Normal" name="Chkgruop1"/> Nota/Venta</label>
								</td>
							</div>
						</div>
				  </tr>-->
				  <!--<tr>
					<div class="form-group">
							<label class="control-label" >Estado del documento</label>
							<div class="controls">
								<td align="left" valign="middle">
									<label class="radio"><input type="radio" value="FactMatriz" name="Chkgruop1" checked="checked"/> Todos</label>
								</td>
								<td align="left" valign="middle">
											<label class="radio"><input type="radio" value="FactTienda" name="Chkgruop1"/> Pendiente</label>
								</td>
								<td align="left" valign="middle">
											<label class="radio"><input type="radio" value="Normal" name="Chkgruop1"/> Cancelada</label>
								</td>
								<td align="left" valign="middle">
											<label class="radio"><input type="radio" value="Normal" name="Chkgruop1"/> Eliminada</label>
								</td>
							</div>
					</div>
				  </tr>-->
				  <tr>
						<div class="form-group">
							<input type="checkbox" name="xFecha" value="Bike"> Por Fecha<br>
						</div>
				 </tr>
				 <tr>
					<td>
							<div class="form-group">
								<label class="control-label" for="date01">Fecha Desde</label>
								<div class="controls">
									<input id="FechaDesde" class="form-control" type="text" size="16" placeholder="Fecha Desde" disabled="disabled">
								</div>
							</div>
					</td>
					<td>
							<div class="form-group">
								<label class="control-label" for="date01">Fecha Hasta</label>
								<div class="controls">
									<input id="FechaHasta" class="form-control" type="text" size="16" placeholder="Fecha Hasta" disabled="disabled">
								</div>
							</div>
					</td>
				 </tr>
				 <tr>
						<td colspan="2" align="center">
							<button onclick="Guardar_Facturacion()" type="button" class="boton_save"><i class="fa fa-save"></i> Consultar</button> 
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
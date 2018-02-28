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
	<div class="col-sm-6">
		<div class="panel">
			<div class="panel-heading">Stock Bodegas</div>
			<table class="table">
				  <tr>
						<td>
							<div class="form-group">
								<div class="controls">
									<label class="control-label">Proveedor</label>
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
						<label class="control-label" for="selectError3">Tipo provisi&oacute;n</label>
						<div class="controls">
							<select id="TipoFacturacion" class="form-control" onchange="CambiarDatos()">
								<option name="Nvta" value="1">T - Todas</option>
								<option name="Nvta" value="2">I - Compras inventario</option>
								<option name="Nvta" value="3">V - Compras activo fijo inventario</option>
							</select>
						</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group">
							<div class="controls">
							<label class="radio">
								<input id="optionsRadios1" type="radio" checked="" value="option1" name="optionsRadios">
								Cr&eacute;dito
							</label>
							<div style="clear:both"></div>
							<label class="radio">
							<input id="optionsRadios2" type="radio" value="option2" name="optionsRadios">
							Contado
							</label>
							</div>
						</div>
					</td> 
			  </tr>
				<tr>
					<td>
						<div class="form-group">
							<input type="checkbox" name="Hitoric" value="Historico"> Por Fecha<br>
						</div>
					</td>
				</tr>	
				<tr>
						<td>
							<div class="form-group">
								<label class="control-label" for="date01">Desde</label>
								<div class="input-group col-xs-8 col-sm-8">
									<input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy">
									<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
								</div>
							</div>
						</td>
						<td>
							<div class="form-group">
								<label class="control-label" for="date01">Hasta</label>
								<div class="input-group col-xs-8 col-sm-8">
									<input id="id-date-picker-2" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy">
									<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
								</div>
							</div>
						</td>
				</tr>
				<tr>
						<td>
							<div class="form-group">
								<div class="controls">
									<button class="boton_save" type="button" onclick=""><i class="fa fa-save"></i> Consultar</button> 
								</div>
							</div>	
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
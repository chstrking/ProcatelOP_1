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
			<div class="panel-heading">Facturaci&oacute;n</div>
			<table class="table">
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
						<label class="control-label">Fecha caja</label>
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
						<label class="control-label">Cod. banco</label>
						<div class="controls">
							<div class="input-group">
								<input id="BancoNombre" class="form-control" type="text" size="16" placeholder="Banco Cod." readonly="readonly" value="<?php echo $_SESSION['sucursal']['Suc_Codigo'].' - '.$_SESSION['sucursal']['Suc_Nombre']?>">
								<input type="hidden" id="BancoID" value="<?php echo $_SESSION['sucursal']['Suc_Codigo']?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Fecha de deposito</label>
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
						<label class="control-label">Responsable</label>
						<div class="controls">
							<div class="input-group">
								<input id="VendedorNombre" class="form-control" type="text" size="16" placeholder="Responsable" readonly="readonly">
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
					<label class="control-label"> </label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Efectivo">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
					<label class="control-label"> </label>
						<div class="controls">
							<input id="NoPapeletaNombre" class="form-control" type="text" size="16" placeholder="No. papeleta">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
					<label class="control-label" for="selectError3">Tipo</label>
					<div class="controls">
						<select id="TipoFacturacion" class="form-control" onchange="CambiarDatos()">
							<option name="Nvta" value="1">PVIR</option>
							<option name="Nvta" value="2">MOVILPOS</option>
							<option name="Nvta" value="3">Ruta</option>
							<option name="Nvta" value="1">Rec x mayor</option>
							<option name="Nvta" value="2">Tienda</option>
							<option name="Nvta" value="3">Cartera</option>
							<option name="Nvta" value="3">Otros</option>
						</select>
					</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="controls">
						<label class="radio">
							<input id="optionsRadios1" type="radio" checked="" value="option1" name="optionsRadios">
							Deposito en transito
						</label>
						<div style="clear:both"></div>
						<label class="radio">
						<input id="optionsRadios2" type="radio" value="option2" name="optionsRadios">
						Arqueo de efectivo
						</label>
						</div>
					</div>
				</td> 
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="ConceptoNombre" class="form-control" type="text" size="16" placeholder="Concepto">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="ValorcajaNombre" class="form-control" type="text" size="16" placeholder="Valor caja">
						</div>
					</div>
				</td>
			</tr>
		</table>
		<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td class="nombre_tabla">Deposito en Cheque</td>
										</tr>
									</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Banco</th>
						<th>Cuenta</th>
						<th>No. cheque</th>
						<th>Valor</th>
						<th>Girado por</th>
						<th>Fecha</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
						
					</tr>
				</tbody>
			</table>
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td class="nombre_tabla">Deposito en Transito</td>
										</tr>
									</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Sucursal</th>
						<th>Fecha</th>
						<th>VEfectivo</th>
						<th>Vcheque</th>
						<th>Usuario</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
						
					</tr>
				</tbody>
			</table>
			<tr>
					<td colspan="2" align="center">
						<button onclick="Guardar_Facturacion()" type="button" class="boton_save"><i class="fa fa-save"></i> Guardar</button> 
					</td>
				</tr>
			<div style="background: #ffffff;">
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
<?php
error_reporting(1);
session_start();
///require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	//$tipo_productos=tipoventas($conexion);
	//$arreglo_refencia=referencia($conexion,'1');
	$_SESSION['detalle_facturacion']=array();
	$_SESSION['detalle_facturacion_completo']=array();
?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-heading">Registro de pagos</div>
			<table class="table"> 
			  <tr>
				<td></td>
				<td></td>
				<td align="left">
					<div class="form-group" align="left">
						<label class="control-label">Fecha</label>
						<div class="controls" align="left">
							<?php ini_set('date.timezone', 'America/Guayaquil'); $fecha_servidor=date('d-m-Y');?>
							<input align="left" id="FechaSistema" class="form-control" type="text" size="16" placeholder="Fecha Sistema" readonly="readonly" value="<?php echo $fecha_servidor;?>">
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
				<td>
					<div class="form-group">
						<div class="controls">
							<label class="control-label">Alumno</label>
							<div class="input-group">
								<input id="AlumnoNombre" onkeydown="CambiarDatos()" class="form-control" type="text" size="16" placeholder="Alumno" readonly="readonly" value="<?php echo ''?>">
								<input type="hidden" id="AlumnoID" value="<?php echo ''?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('27')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
				<td></td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">Tipo de pago</label>
						<div class="controls" width="33%">
							<select id="estado" name="estado" class="form-control" >
								  <option value="X" <?php if($estado=='X'){?>selected<?php }?>>Contado</option>
								  <option value="P" <?php if($estado=='P'){?>selected<?php }?>>Cheque</option>
							</select> 
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="controls">
							<label class="control-label">Valor a pagar</label>
							<div class="input-group">
								<input id="AlumnoNombre" onkeydown="CambiarDatos()" class="form-control" type="text" size="16" placeholder="0.00" value="<?php echo ''?>">
							</div>
						</div>
					</div>
				</td>
				<td></td>
			  </tr>
			</table>
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td class="nombre_tabla">Facturas a pagar</td>
						<td class="padding_td_tablas" align="left" valign="middle" style="width:12%">
							<button id="detalle_facturacion" class="boton_save" type="button"  onclick="BuscarProducto()"><!--<i class="fa fa-plus-square"></i>--> Adicionar</button>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th># Factura</th>
						<th>Monto</th>
						<th>Estado</th>
						<th>Adicionar</th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
					
					</tr>
				</tbody>
			</table>
			<input type="hidden" value="tr_1" id="detalleid">
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td class="nombre_tabla">Items seleccionados para el pago</td>
						<!--<td class="padding_td_tablas" align="left" valign="middle" style="width:12%">
							<button id="detalle_facturacion" class="boton_save" type="button"  onclick="BuscarProducto()"><!--<i class="fa fa-plus-square"></i> Adicionar</button>
						</td>-->
					</tr>
				</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th># Factura</th>
						<th>Monto</th>
						<th>Acci&oacute;n</th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
					</tr>
				</tbody>
			</table>
			<input type="hidden" value="tr_1" id="detalleid">
			<div style="background: #ffffff;">
			<table align="right" width="20%" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2" align="center">
						<button onclick="Guardar_Facturacion()" type="button" class="boton_save"> Guardar </button> 
					</td>
				</tr>
			</table>
			</div>
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
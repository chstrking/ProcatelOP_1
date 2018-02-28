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
			<div class="panel-heading">Tipo producto</div>
			<table class="table">
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Tipo producto</label>
						<div class="controls">
							<div class="input-group">
								<input id="TipProdNombre" class="form-control" type="text" size="16" placeholder="C&oacute;digo" readonly="readonly">
								<input type="hidden" id="TipProdID">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="BuscarResultado('Tipo producto','SP_ConsultaTipoProducto')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Descripci&oacute;n</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>	
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo de Clasificaci&oacute;n</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 1</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 2</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 3</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 4</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 5</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">IVA</label>
						<div class="controls">
							<select id="selectError3" class="form-control">
								<option value="1" <?php if($usuario["estado"]==1){?>selected<?php }?>>Si</option>
								<option value="0" <?php if($usuario["estado"]==0){?>selected<?php }?>>No</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">ICE Compra</label>
						<div class="controls">
							<select id="selectError3" class="form-control">
								<option value="1" <?php if($usuario["estado"]==1){?>selected<?php }?>>Si</option>
								<option value="0" <?php if($usuario["estado"]==0){?>selected<?php }?>>No</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">ICE Venta</label>
						<div class="controls">
							<select id="selectError3" class="form-control">
								<option value="1" <?php if($usuario["estado"]==1){?>selected<?php }?>>Si</option>
								<option value="0" <?php if($usuario["estado"]==0){?>selected<?php }?>>No</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label">Max Desc. %</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>
			</table>
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td class="nombre_tabla">Detalle tipo producto</td>
										</tr>
									</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Cod. Tecnolog&iacute;a</th>
						<th>Cod. Tipo producto</th>
						<th>Descripci&oacute;n</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
						
					</tr>
				</tbody>
			</table>
			<div style="background: #ffffff;">
			</div>
			<input type="hidden" value="tr_1" id="detalleid">
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<button class="boton_save" type="button" onclick=""><i class="fa fa-save"></i> Guardar</button> 
						</div>
					</div>	
				</td>
			<!--</tr>
			<tr>-->
				<td>
					<div class="form-group">
						<div class="controls">
							<button class="boton_save" type="button" onclick=""><i class="fa fa-save"></i> Modificar</button> 
						</div>
					</div>	
				</td>
			<!--</tr>
			<tr>-->
				<td>
					<div class="form-group">
						<div class="controls">
							<button class="boton_save" type="button" onclick=""><i class="fa fa-save"></i> Eliminar</button> 
						</div>
					</div>	
				</td>
			</tr>
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
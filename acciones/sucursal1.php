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
			<div class="panel-heading">Sucursal</div>
			<table class="table">
			  <tr>
					<div class="form-group">
						<label class="control-label">Sucursal</label>
						<div class="controls">
							<div class="input-group">
								<input id="SucursalNombre" class="form-control" type="text" size="8" placeholder="Sucursal" readonly="readonly" value="<?php echo $_SESSION['sucursal']['Suc_Codigo'].' - '.$_SESSION['sucursal']['Suc_Nombre']?>">
								<input type="hidden" id="SucursalID" value="<?php echo $_SESSION['sucursal']['Suc_Codigo']?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
			  </tr>
			  <tr>
					<div class="form-group">
						<label class="control-label">Direcci&oacute;n</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" placeholder="Direccion">
						</div>
					</div>
			  </tr>	
			  <tr>
					<div class="form-group">
						<label class="control-label">Tel&eacute;fono</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" placeholder="Telefono">
						</div>
					</div>
			  </tr>	
			  <tr>
					<div class="form-group">
						<label class="control-label">F&aacute;x</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" placeholder="Fax">
						</div>
					</div>
			  </tr>
			  <tr>
					<div class="form-group">
						<label class="control-label" for="selectError3">Estado</label>
						<div class="controls">
							<select id="selectError3" class="form-control">
								<option value="1" <?php if($usuario["estado"]==1){?>selected<?php }?>>Activo</option>
								<option value="0" <?php if($usuario["estado"]==0){?>selected<?php }?>>Inactivo</option>
							</select> 
						</div>
					</div>	
			</tr>
			<tr>
			<label class="control-label">SRI Retenciones</label>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label">No Autorizaci&oacute;n</label>
						<div class="controls">
							<input id="NumAuto" class="form-control" type="text" size="16" placeholder="No.Autoriz/Ret">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Serie</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Desde</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Hasta</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label" for="date01">Fecha max.</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<label class="control-label">SRI Notas de D&eacute;bito</label>
				</td>
			  </tr>		
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">No Autorizaci&oacute;n</label>
						<div class="controls">
							<input id="NumAuto" class="form-control" type="text" size="16" placeholder="No.Autoriz/Ret">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Serie</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Desde</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Hasta</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label" for="date01">Fecha max.</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<label class="control-label">SRI Notas de cr&eacute;dito</label>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">No Autorizaci&oacute;n</label>
						<div class="controls">
							<input id="NumAuto" class="form-control" type="text" size="16" placeholder="No.Autoriz/Ret">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Serie</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Desde</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Hasta</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label" for="date01">Fecha max.</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<label class="control-label">SRI N/V</label>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">No Autorizaci&oacute;n</label>
						<div class="controls">
							<input id="NumAuto" class="form-control" type="text" size="16" placeholder="No.Autoriz/Ret">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Serie</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Desde</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Hasta</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label" for="date01">Fecha max.</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
			  </tr>
			   <tr>
				<td>
					<label class="control-label">SRI Facturas</label>
				</td>
			   </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">No Autorizaci&oacute;n</label>
						<div class="controls">
							<input id="NumAuto" class="form-control" type="text" size="16" placeholder="No.Autoriz/Ret">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">Serie</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Desde</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label">No. Hasta</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Serie">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<label class="control-label" for="date01">Fecha max.</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="id-date-picker-1" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
			  </tr>
			</table>
				<tr>
					<td colspan="2" align="center">
						<button onclick="Guardar_Facturacion()" type="button" class="boton_save"><i class="fa fa-save"></i> Guardar</button> 
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
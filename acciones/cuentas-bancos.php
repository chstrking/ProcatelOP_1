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
			<div class="panel-heading">Cuentas de bancos</div>
			<table class="table">
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">C&oacute;digo</label>
						<div class="controls">
							<div class="input-group">
								<input id="FacturaNombre" class="form-control" type="text" size="16" placeholder="Bancos" readonly="readonly">
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
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">N&uacute;mero</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
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
						Ahorro
						</label>
						</div>
					</div>
				</td> 
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Cdo. ctas. bancos</label>
						<div class="controls">
							<div class="input-group">
								<input id="ctabancosNombre" class="form-control" type="text" size="16" placeholder="Cta. Bancos" readonly="readonly" value="<?php echo $_SESSION['sucursal']['Suc_Codigo'].' - '.$_SESSION['sucursal']['Suc_Nombre']?>">
								<input type="hidden" id="ctabancosID" value="<?php echo $_SESSION['sucursal']['Suc_Codigo']?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label">Dep. tr&aacute;nsito</label>
						<div class="controls">
							<div class="input-group">
								<input id="DepTranNombre" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $_SESSION['sucursal']['Suc_Codigo'].' - '.$_SESSION['sucursal']['Suc_Nombre']?>">
								<input type="hidden" id="DeptranID" value="<?php echo $_SESSION['sucursal']['Suc_Codigo']?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label">Chq. Post-Fechado</label>
						<div class="controls">
							<div class="input-group">
								<input id="chqpostfecNombre" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $_SESSION['sucursal']['Suc_Codigo'].' - '.$_SESSION['sucursal']['Suc_Nombre']?>">
								<input type="hidden" id="chqpostfecID" value="<?php echo $_SESSION['sucursal']['Suc_Codigo']?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label">Chq. Protestado</label>
						<div class="controls">
							<div class="input-group">
								<input id="ChqproNombre" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $_SESSION['sucursal']['Suc_Codigo'].' - '.$_SESSION['sucursal']['Suc_Nombre']?>">
								<input type="hidden" id="ChqprolID" value="<?php echo $_SESSION['sucursal']['Suc_Codigo']?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">Estado</label>
						<div class="controls">
							<select id="selectError3" class="form-control">
								<option value="1" <?php if($usuario["estado"]==1){?>selected<?php }?>>Activo</option>
								<option value="0" <?php if($usuario["estado"]==0){?>selected<?php }?>>Inactivo</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>
			</table>
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
				<td>
					<div class="form-group">
						<div class="controls">
							<button class="boton_save" type="button" onclick=""><i class="fa fa-save"></i> Modificar</button> 
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
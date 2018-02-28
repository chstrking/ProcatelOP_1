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
						<label class="control-label">Cod. cuenta banco</label>
						<div class="controls">
							<input id="RefenciaNombre" class="form-control" type="text" size="16" placeholder="Referencia">
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
					<td>
						<div class="form-group">
							<input type="checkbox" name="Hitoric" value="Historico"> Tarjeta<br>
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
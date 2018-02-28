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
			<div class="panel-heading">Bodegas por Sucursal</div>
			<table class="table">
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Bodegas/sucursal</label>
						<div class="controls">
							<div class="input-group">
								<input id="BodegaSucursalNombre" class="form-control" type="text" size="16" placeholder="BodegaSucursal" readonly="readonly">
								<input type="hidden" id="BodegaSucursalID">
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
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<label class="control-label">Bodega</label>
							<div class="input-group">
								<input id="BodegaNombre" class="form-control" type="text" size="16" placeholder="Bodega" readonly="readonly">
								<input type="hidden" id="BodegaID" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('4')" id="bt_Bodega" class="btn" type="button"><i class="fa fa-search"></i></button>
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
			<tr>
					<td colspan="2" align="center">
						<button onclick="Guardar_Facturacion()" type="button" class="boton_save"><i class="fa fa-save"></i> Guardar</button> 
					</td>
				</tr>
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
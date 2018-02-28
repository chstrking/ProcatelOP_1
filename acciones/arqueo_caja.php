<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	//$tipo_productos=tipoventas($conexion);
	//$arreglo_refencia=referencia($conexion,'1');
	$_SESSION['detalle_facturacion']=array();
	$_SESSION['detalle_facturacion_completo']=array();
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="ImprimirArqueocaja()">
				<i class="fa fa-user"></i>
				<span>Imprimir</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-heading">Arqueo de Caja</div>
			<table class="table">
			  <tr>
				  <td width="33%">
						<div class="form-group">
							<label class="control-label">Sucursal</label>
							<div class="controls">
								<div class="input-group">
									<input id="SucursalNombre" onkeydown="CambiarDatos()" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $_SESSION['sucursal']['Suc_Codigo'].' - '.$_SESSION['sucursal']['Suc_Nombre']?>">
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
							<label class="control-label">Caja Usuario</label>
							<div class="controls">
								<div class="input-group">
									<input id="UsuarioNombre" onkeydown="CambiarDatos()" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="">
									<input type="hidden" id="UsuarioID" value="">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="BuscarWithParam('28')"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						</div>
					</td>
					<td width="33%">
					</td><td width="33%">
					</td>
				</tr>
				<tr>
				<td width="33%">
					<div class="form-group">
						<label class="control-label" for="date01">Fecha Desde</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="fechaD" class="form-control date-picker" type="text" readonly="readonly" data-date-format="dd-mm-yyyy">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
				<td width="33%">
					<div class="form-group">
						<label class="control-label" for="date01">Fecha Hasta</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="fechaH" class="form-control date-picker" type="text" readonly="readonly" data-date-format="dd-mm-yyyy">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td width="33%">
					<div class="form-group">
					<label class="control-label" style="visibility:hidden" for="selectError3">Tipo</label>
					<div class="controls">
						<select id="TipoReporte" style="visibility:hidden" class="form-control">
							<option name="Reporte" value="1">Reporte de efectivo</option>
							<!--<option name="Reporte" value="2">Arqueo de caja</option>-->
						</select>
					</div>
					</div>
				</td>
			 </tr>	
			 <br><br><br></tr><tr></tr><tr></tr><tr></tr><tr></tr> <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr> <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			</table>
			</div>
			<input type="hidden" value="tr_1" id="detalleid">
		</div>
	</div>

<script type="text/javascript">
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
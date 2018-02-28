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
			<div class="panel-heading">Genera Matr&iacute;cula</div>
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
						<label class="control-label">Secci&oacute;n</label>
						<div class="controls">
							<select id="seccion" class="form-control">
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
							</select> 
						</div>
					</div>	
				</td>
				<td>
					<div class="form-group">
					<label class="control-label">Jornada</label>
						<div class="controls">
							<select id="jornada" class="form-control">
								<option value="M">Matutina</option>
								<option value="V">Vespertina</option>
							</select> 
						</div>
					</div>	
				</td>
				</td><td>
			 </tr>
			 <tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<label class="control-label">Curso</label>
							<div class="input-group">
								<input id="CursoNombre" class="form-control" type="text" size="16" placeholder="Curso" readonly="readonly">
								<input type="hidden" id="CursoID" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('2')" id="bt_cliente" class="btn" type="button"><i class="fa fa-search"></i></button>
								</span> 
							</div>
						</div>
					</div>
				</td><td>
				</td><td>
				</td>
			  </tr>	
			</table>
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td class="nombre_tabla">Detalle Facturaci&oacute;n</td>
						<!--<td class="padding_td_tablas" align="right" valign="middle">
							
								<div class="controls">
									<div class="input-group">
										<input id="ClienteNombre" class="form-control" type="text" size="16" placeholder="cliente" readonly="readonly">
										<input id="ClienteID" type="hidden" value="">
										<span class="input-group-btn">
											<button onclick="Buscar('1')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</div>
							
						</td>-->
						<td class="padding_td_tablas" align="right" valign="middle">
							<label class="label_without_margin">Matr&iacute;cula</label>
						</td>
						<td class="padding_td_tablas" align="left" valign="middle" style="width:20%">
							<div class="controls"> 
									<select id="tipo_producto" name="tipo_producto" class="form-control">
										<?php foreach($tipo_productos as $tipo_producto):?>
										<option value="<?php echo $tipo_producto['id'];?>"><?php echo $tipo_producto['descripcion'];?></option>
										<?php endforeach;?>
									</select>
								</div>
						</td>
						<td class="padding_td_tablas" align="left" valign="middle" style="width:12%">
							<button id="detalle_facturacion" class="boton_save" type="button"  onclick="BuscarProducto()"><i class="fa fa-plus-square"></i> Nuevo</button>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Identificaci&oacute;n</th>
						<th>Alumno</th>
						<th>Curso matr&iacute;culado</th>
						<th>Monto</th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<tr class="impar" id="tr_1">
					
					</tr>
				</tbody>
			</table>
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
		})
		.next().on("click", function(){
		$(this).prev().focus();
		}); 
	});
</script>
<?php }?>
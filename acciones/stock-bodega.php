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
	$Usuario=$_SESSION['usuario']; 
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Imprimir Stock" onclick="ImprimirStockBodeg('<?php echo $Usuario;?>')" target="_blank">
				<i class="fa fa-user"></i>
				<span>Consulta Stock</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
		<div class="panel">
			<div class="panel-heading">Stock Bodegas</div>
			<table class="table">
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
						<label class="control-label">Tipo Producto</label>
							<div class="controls"> 
								<select id="tipo_producto" name="tipo_producto" class="form-control">
									<?php foreach($tipo_productos as $tipo_producto):?>
										<option value="<?php echo $tipo_producto['id'];?>"><?php echo $tipo_producto['descripcion'];?></option>
									<?php endforeach;?>
								</select>
							</div>
					    </td>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label">Marca</label>
						<div class="controls">
							<div class="input-group">
								<input id="MarcaNombre" class="form-control" type="text" size="16" placeholder="Marca" readonly="readonly">
								<input type="hidden" id="MarcaID">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('19')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			  </tr>				
				<tr>
					<td>
						<div class="form-group">
							<label class="control-label">Producto</label>
							<div class="controls">
									<div class="input-group">
										<input id="ProductNombre" class="form-control" type="text" size="16" placeholder="Producto" readonly="readonly">
										<input id="ProductID" type="hidden" value="">
										<span class="input-group-btn">
											<button onclick="BuscarParametrosAdicionales('1')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
										</span>
									</div>
							</div>
						</div>
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
		})//show datepicker when clicking on the icon
		.next().on("click", function(){
		$(this).prev().focus();
		}); 
	});
</script>
<?php }?>
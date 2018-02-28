<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	if($id=='' or $id==null)
	{
		$id='';
	}
	else
	{
		$series=series($conexion,$id);
	} 
	
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Consulta serie" href="#" onclick="verProcesoSeries('Reimpresion-series','')">
				<i class="fa fa-user"></i>
				<span>Consulta serie</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
		<div class="panel">
			<div class="panel-heading">Consulta Series</div>
			<table class="table">
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Series de tel&eacute;fono</label>
						<input id="SeriesNombre" value="<?php echo $id ?>" class="form-control" type="text" maxlength="20" onkeyUp="return ValNumero(this);" size="16" placeholder="Series">
					</div>
				</td>
			</tr>
			</table>
		</div>	
	</div>
	<div>
			<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									</tbody>
			</table>
			<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id Producto</th>
						<th>Descripci&oacute;n</th>
						<th>Serie</th>
						<th>Cod. Prod</th>
						<th>Cod. Kardex</th>
						<th>Tipo</th>
						<th>Fecha</th>
						<th>Cod. Fact</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="contenedor_datos_detalle">
					<?php $i=1;?>
						<?php foreach($series as $serie){?>
						<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_usuarios_<?php echo $i;?>">
							<td align="center"><?php echo $serie["Pro_Codigo"]?></td>
							<td align="center"><?php echo $serie["Pro_Dato1"]?></td>
							<td align="center"><?php echo $serie["Dprod_Serie"]?></td>
							<td align="center"><?php echo $serie["DProd_Codigo"]?></td>
							<td align="center"><?php echo $serie["DKar_CodKardex"]?></td>
							<td align="center"><?php echo $serie["Kar_Tipo"]?></td>
							<td align="center"><?php echo $serie["Kar_Fecha"]?></td>
							<td align="center"><?php echo $serie["Kar_CodFact"]?></td>
						</tr>
						<?php $i++;?>
					<?php }?>
				</tbody>
			</table>
			<input type="hidden" value="tr_1" id="detalleid">
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
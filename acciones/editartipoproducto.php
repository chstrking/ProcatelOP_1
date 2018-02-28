<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];

	if($id=='')
	{
		$disabledEstado = 'disabled';
		//$Titulo = 'Crear';
	}
	else
	{
		$resultados=find_tipoproducto($conexion,'',$id);
		//$Titulo = 'Editar';
	}	
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-users"></i><?php if($id==''){?>Crear<?php }else{?>Editar<?php }?> tipo de productos</div>
	<table class="table">
	
		<table class="col-sm-4">
					
			<tr>
				
				<td>
				
					<div class="form-group">
						<div class="controls">
								
								<input readonly="readonly" class="form-control" type="hidden" id="TipProdID" value="<?php echo $resultados[0]["CODIGO"] ?>">
								
						</div>
					</div>
				
				</td>
			
			</tr>
			
			<tr>
				
				<td>
					<div class="form-group">
						<label class="control-label">Descripci&oacute;n</label>
						<div class="controls">
							<input id="TipProdNombre" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Descripción" value="<?php echo utf8_encode($resultados[0]["NOMBRE"]) ?>">
						</div>
					</div>
				</td>
			
			</tr>
			
			<tr>
				
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo de Clasificaci&oacute;n</label>
						<div class="controls">
							<input id="Refencia" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Clasificación" value="<?php echo utf8_encode($resultados[0]["TipP_Titulo"]) ?>">
						</div>
					</div>
				</td>
			
			</tr>
			
			<tr>
				
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 1</label>
						<div class="controls">
							<input id="Refencia1" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Referencia 1" value="<?php echo utf8_encode($resultados[0]["TipP_Titulo1"]) ?>">
						</div>
					</div>
				</td>
			
			</tr>
			
			<tr>
			
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 2</label>
						<div class="controls">
							<input id="Refencia2" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Referencia 2" value="<?php echo utf8_encode($resultados[0]["TipP_Titulo2"]) ?>">
						</div>
					</div>
				</td>
		
			</tr>
			
			<tr>
			
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 3</label>
						<div class="controls">
							<input id="Refencia3" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Referencia 3" value="<?php echo utf8_encode($resultados[0]["TipP_Titulo3"]) ?>">
						</div>
					</div>
				</td>
		
			</tr>
			
			<tr>
			
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 4</label>
						<div class="controls">
							<input id="Refencia4" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Referencia 4" value="<?php echo utf8_encode($resultados[0]["TipP_Titulo4"]) ?>">
						</div>
					</div>
				</td>
		
			</tr>
			
			<tr>
			
				<td>
					<div class="form-group">
						<label class="control-label">T&iacute;tulo 5</label>
						<div class="controls">
							<input id="Refencia5" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Referencia 5" value="<?php echo utf8_encode($resultados[0]["TipP_Titulo5"]) ?>">
						</div>
					</div>
				</td>
		
			</tr>
			
			<tr>
			
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">IVA</label>
						<div class="controls">
							<select id="iva" class="form-control">
								<option value="0" <?php if($resultados[0]["TipP_IVA"]==0){?>selected<?php }?>>No</option>
								<option value="1" <?php if($resultados[0]["TipP_IVA"]==1){?>selected<?php }?>>Si</option>
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
							<select id="icecomp" class="form-control">
								<option value="0" <?php if($resultados[0]["TipP_ICECompra"]==0){?>selected<?php }?>>No</option>
								<option value="1" <?php if($resultados[0]["TipP_ICECompra"]==1){?>selected<?php }?>>Si</option>
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
							<select id="iceven" class="form-control">
								<option value="0" <?php if($resultados[0]["TipP_ICEVenta"]==0){?>selected<?php }?>>No</option>
								<option value="1" <?php if($resultados[0]["TipP_ICEVenta"]==1){?>selected<?php }?>>Si</option>
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
							<input id="dscto" class="form-control" type="text" size="16" placeholder="Descuento" value="<?php echo $resultados[0]["TipP_PorcDcto"] ?>">
						</div>
					</div>
				</td>
			
			</tr>
			
			<tr>
			
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">Estado</label>
						<div class="controls">
							<select id="estado" class="form-control" <?php echo $disabledEstado?>>
								<option value="0" <?php if($resultados[0]["TipP_Estado"]==0){?>selected<?php }?>>No</option>
								<option value="1" <?php if($resultados[0]["TipP_Estado"]==1){?>selected<?php }?>>Si</option>
							</select> 
						</div>
					</div>	
				</td>
				
			</tr>
			<!--<table class="tabla_cabecera" cellpadding="0" cellspacing="0" width="100%">
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
			</table>-->
			
			<tr>
										
				<td align="left">
					
					<br>
					<button onclick="Guardartipoproductos()" type="button" class="boton_save"  align="left"><i class="fa fa-save"></i> Guardar</button> 
					
				</td>
										
			</tr>
		
		</table>
	
	</table>
	
</div>
<?php }?>
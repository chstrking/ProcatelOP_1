<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$respuesta=array();
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	$id=$_GET["id"];
	if($id=='')
	{
		$id=0;
		$NumActualFactura=0;
		$Titulo="Nueva sucursal";
	}
	else
	{
		$respuesta=find_sucursal($conexion,'F',$id,'nothing');  
		$FechaNC=$respuesta[0]["Suc_FecMaxSriNC"]->format('d-m-Y');
		$FechaNV=$respuesta[0]["Suc_FecMaxSriNV"]->format('d-m-Y');
		$FechaND=$respuesta[0]["Suc_FecMaxSriND"]->format('d-m-Y');
		$FechaF=$respuesta[0]["Suc_FecMaxSriF"]->format('d-m-Y');
		$FechaR=$respuesta[0]["Suc_FecMaxSriR"]->format('d-m-Y');
		$NumActualFactura=$respuesta[0]["Suc_ActualNumF"];
		$Titulo="Editar sucursal";
	
	}
?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="cabecera_editar"><i class="fa fa-tags"></i><?php echo $Titulo?></div>
			<table class="table">
				
				<tr>
					<table class="col-sm-12">
							<td>
								<fieldset>
									
									<table class="col-sm-4">
										
										<tr>
										
											<td>
												<div class="form-group">
													<label class="control-label">Sucursal</label>
													<div class="controls">
														<div class="input-group">
															<input id="SucursalNombre" class="form-control" type="text" size="50" onkeyup = "this.value=this.value.toUpperCase()" placeholder="Nombre sucursal"  <?php echo $Readonly?> width="400px" value="<?php echo $respuesta[0]["Suc_Nombre"]?>">
															<input type="hidden" id="SucursalID" value="<?php echo $id?>">
														</div>
													</div>
												</div>
											</td>	
											
									   </tr>
									  
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Direcci&oacute;n</label>
													<div class="controls">
														<input id="Direccion" class="form-control" type="text" placeholder="Direccion" value="<?php echo $respuesta[0]["Suc_Direccion"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Tel&eacute;fono</label>
													<div class="controls">
														<input id="Telefono" class="form-control" type="text" placeholder="Telefono" onkeypress="return justNumbers(event);" value="<?php echo $respuesta[0]["Suc_Telefono"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>	
											<td>
												<div class="form-group">
													<label class="control-label">F&aacute;x</label>
													<div class="controls">
														<input id="Fax" class="form-control" type="text" placeholder="Fax" onkeypress="return justNumbers(event);" value="<?php echo $respuesta[0]["Suc_Fax"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<div class="form-group">
													<label class="control-label" for="selectError3">Estado</label>
													<div class="controls">
														<select id="estado" name="estado" class="form-control">
															  <option value="1" <?php if($respuesta[0]["Suc_Estado"]==1){?>selected<?php }?>>Activo</option>
															  <option value="0" <?php if($respuesta[0]["Suc_Estado"]==0){?>selected<?php }?>>Inactivo</option>
														</select> 
													</div>
												</div>
											</td>
										</tr>
										
									</table>	
								</fieldset>
							</td>	
					
					</table>
					
				</tr>
				
				<tr>
					<table class="col-sm-12">
							<td>
								<fieldset>
									
									<legend>SRI Retenciones</legend>

									<table class="col-sm-8">
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No Autorizaci&oacute;n</label>
													<div class="controls">
														<input id="NumAutoRet" class="form-control" type="text" onkeypress="return justNumbers(event);" size="16" placeholder="No.Autoriz/Ret" value="<?php echo $respuesta[0]["Suc_NumAutSriR"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Serie</label>
													<div class="controls">
														<input id="SerieRet" class="form-control" type="text" size="16" placeholder="Serie" value="<?php echo $respuesta[0]["Suc_SerieR"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>	
											<td>
												<div class="form-group">
													<label class="control-label">No. Desde</label>
													<div class="controls">
														<input id="NoDesdeRet" class="form-control" type="text" size="16" placeholder="No. Desde" onkeypress="return justNumbers(event);" value="<?php echo $respuesta[0]["Suc_DesdeNumR"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No. Hasta</label>
													<div class="controls">
														<input id="NoHastaRet" class="form-control" type="text" size="16" placeholder="No. Hasta" onkeypress="return justNumbers(event);" value="<?php echo $respuesta[0]["Suc_HastaNumR"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label" for="date01">Fecha máx</label>
													<div class="input-group col-xs-8 col-sm-8">
														<input id="FechaRet" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php echo $FechaR?>">
														<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
													</div>
												</div>
											</td>
										
										</tr>
									</table>	
								</fieldset>
							</td>	
							
							<td>
								<fieldset>
									
									<legend>SRI Notas de D&eacute;bito</legend>

									<table class="col-sm-8">
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No Autorizaci&oacute;n</label>
													<div class="controls">
														<input id="NumAutoND" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No.Autoriz/ND" value="<?php echo $respuesta[0]["Suc_NumAutSriND"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Serie</label>
													<div class="controls">
														<input id="SerieND" class="form-control" type="text" size="16" placeholder="Serie" value="<?php echo $respuesta[0]["Suc_SerieND"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>	
											<td>
												<div class="form-group">
													<label class="control-label">No. Desde</label>
													<div class="controls">
														<input id="NoDesdeND" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No. Desde" value="<?php echo $respuesta[0]["Suc_DesdeNumND"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No. Hasta</label>
													<div class="controls">
														<input id="NoHastaND" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No. Hasta" value="<?php echo $respuesta[0]["Suc_HastaNumND"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label" for="date01">Fecha máx</label>
													<div class="input-group col-xs-8 col-sm-8">
														<input id="FechaND" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php echo $FechaND?>">
														<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
													</div>
												</div>
											</td>
										
										</tr>
									</table>	
								</fieldset>
							</td>
					
					</table>
					
				</tr>
				
				<tr>
					<table class="col-sm-12">
							<td>
								<fieldset>
									
									<legend>SRI Notas de cr&eacute;dito</legend>

									<table class="col-sm-8">
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No Autorizaci&oacute;n</label>
													<div class="controls">
														<input id="NumAutoNC" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No.Autoriz/NC" value="<?php echo $respuesta[0]["Suc_NumAutSriNC"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Serie</label>
													<div class="controls">
														<input id="SerieNC" class="form-control" type="text" size="16" placeholder="Serie" value="<?php echo $respuesta[0]["Suc_SerieNC"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>	
											<td>
												<div class="form-group">
													<label class="control-label">No. Desde</label>
													<div class="controls">
														<input id="NumDesdeNC" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No. Desde" value="<?php echo $respuesta[0]["Suc_DesdeNumNC"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No. Hasta</label>
													<div class="controls">
														<input id="NumHastaNC" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No. Hasta" value="<?php echo $respuesta[0]["Suc_HastaNumNC"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label" for="date01">Fecha máx</label>
													<div class="input-group col-xs-8 col-sm-8">
														<input id="fechaNC" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php echo $FechaNC?>">
														<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
													</div>
												</div>
											</td>
										
										</tr>
									</table>	
								</fieldset>
							</td>	
							
							<td>
								<fieldset>
									
									<legend>SRI Nota de venta</legend>

									<table class="col-sm-8">
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No Autorizaci&oacute;n</label>
													<div class="controls">
														<input id="NumAutoNV" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No.Autoriz/Ret" value="<?php echo $respuesta[0]["Suc_NumAutSriNV"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Serie</label>
													<div class="controls">
														<input id="SerieNV" class="form-control" type="text" size="16" placeholder="Serie" value="<?php echo $respuesta[0]["Suc_SerieNV"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>	
											<td>
												<div class="form-group">
													<label class="control-label">No. Desde</label>
													<div class="controls">
														<input id="NoDesdeNV" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No. Desde" value="<?php echo $respuesta[0]["Suc_DesdeNumNV"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No. Hasta</label>
													<div class="controls">
														<input id="NoHastaNV" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No. Hasta" value="<?php echo $respuesta[0]["Suc_HastaNumNV"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label" for="date01">Fecha máx</label>
													<div class="input-group col-xs-8 col-sm-8">
														<input id="FechaNV" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php echo $FechaNV?>">
														<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
													</div>
												</div>
											</td>
										
										</tr>
									</table>	
								</fieldset>
							</td>
					
					</table>
					
				</tr>
				
				<tr>
					<table class="col-sm-12">
							<td>
								<fieldset>
									
									<legend>SRI Facturas</legend>

									<table class="col-sm-4">
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No Autorizaci&oacute;n</label>
													<div class="controls">
														<input id="NumAutoFac" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No.Autoriz/Ret" value="<?php echo $respuesta[0]["Suc_NumAutSriF"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Serie</label>
													<div class="controls">
														<input id="SerieFac" class="form-control" type="text" size="16" placeholder="Serie" value="<?php echo $respuesta[0]["Suc_SerieF"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>	
											<td>
												<div class="form-group">
													<label class="control-label">No. Desde</label>
													<div class="controls">
														<input id="NumDesdeFac" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No.Desde" value="<?php echo $respuesta[0]["Suc_DesdeNumF"]?>">
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No. Hasta</label>
													<div class="controls">
														<input id="NumHastaFac" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" placeholder="No.Hasta" value="<?php echo $respuesta[0]["Suc_HastaNumF"]?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">No. Actual</label>
													<div class="controls">
														<input id="NumActFac" class="form-control" type="text" size="16" onkeypress="return justNumbers(event);" readonly="readonly" placeholder="No.Actual" value="<?php echo $NumActualFactura?>">
													</div>
												</div>
											</td>
										</tr>
										
										<tr>
										
											<td>
												<div class="form-group">
													<label class="control-label" for="date01">Fecha máx</label>
													<div class="input-group col-xs-8 col-sm-8">
														<input id="FechaFac" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php echo $FechaF?>">
														<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
													</div>
												</div>
											</td>
										
										</tr>
										
										<tr>
										
											<td align="left">
												<button onclick="GuardarSucursalParametros()" type="button" class="boton_save"  align="left"><i class="fa fa-save"></i> Guardar</button> 
											</td>
										
										</tr>
										
									</table>	
								</fieldset>
							</td>	
					
					</table>
					
				</tr>
				
								
							<select id="TipoFacturacion" style="visibility:hidden">
								<option name="Nvta" value="1" type="hidden"></option>
								<option name="Nvta" value="2" type="hidden"></option>
								<option name="Nvta" value="3" type="hidden"></option>
							</select>

					

			
				  
			</table>

			<!--<table align="right" width="20%" cellspacing="0" cellpadding="0">
					<td colspan="2" align="center">
						<button onclick="Guardar_Facturacion()" type="button" class="boton_save"><i class="fa fa-save"></i> Guardar</button> 
					</td>
				</tr>
			</table>-->
		</div>
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
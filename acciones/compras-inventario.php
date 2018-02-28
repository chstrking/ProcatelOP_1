<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$desde = $_REQUEST['fecInicio'];
	
	if($desde!=NULL)
	{
		$desde = $_REQUEST['fecInicio'];
		$hasta = $_REQUEST['fecFin']; 
		//var_dump($desde);
		//var_dump($hasta );
		$Usuario = '';
		$estado = 'X';
		$Sucursal = 0;
		$IdSuc = ''; 
		$NumeroPaginas = 1; 
		$Direccion = $_REQUEST['Direccion'];
		$index = $_REQUEST['index'];
		$last = $_REQUEST['last'];
		$cantidad = CantidadfacturasC($conexion,'Sp_Cantidadfacturasdiarias',$NumeroPaginas,20,$desde,$hasta,$IdSuc,$estado,$Usuario,$Direccion,$index,$last);
		$facturas=listarfacturasC($conexion,'Sp_ListadoFactura',$NumeroPaginas,20,$desde,$hasta,$IdSuc,$estado,$Usuario,$Direccion,$index,$last); //var_dump($facturas);
		//var_dump($facturas);
		$Subtotal=count($facturas); 
		$Total=$facturas[0]["TOTAL"];
		$Maximo = $cantidad[0]['CANTIDAD'];
		$Subtotal = $index;
		$Total = $Maximo/20;
		$Total = ceil($Total);
	}
	else
	{
		ini_set('date.timezone', 'America/Guayaquil');
		$desde=date('d-m-Y');
		$hasta=date('d-m-Y');
		$IdSuc = 0;
		$Id = 0;
		$Usuario = '';
		$estado = 'X';
		$Direccion = 1;
		$CantidadRegistros  = 20;
		$TotalPaginas = 0;
		$NumeroPaginas = 1;
		$Direccion = 0;
		$index = 1;
		$last = 1;
		$cantidad = CantidadfacturasC($conexion,'Sp_Cantidadfacturasdiarias',$NumeroPaginas,20,$desde,$hasta,$IdSuc,$estado,$Usuario,$Direccion,$index,$last);
		$facturas=listarfacturasC($conexion,'Sp_ListadoFacturaC',$NumeroPaginas,20,$desde,$hasta,$IdSuc,$estado,$Usuario,$Direccion,$index,$last); 
		$Maximo = $cantidad[0]['CANTIDAD'];
		$Subtotal = 1;
		$Total = $Maximo/20;
		$Total = ceil($Total);
	}
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('generaCompra','generaCompra')">
				<i class="fa fa-user"></i>
				<span>Nueva factura</span>
			</a>
		</div>
		<div class="col-sm-2 action-nav-button">
			<a title="Buscar Factura" href="#" onclick="BuscarFacturaPaginacionC(1,0,0,1)">
				<i class="fa fa-user"></i>
				<span>Consulta facturas</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="cabecera_editar"><i class="fa fa-tags"></i>Compras de Inventario</div>
			<table class="table">
				
				<tr>
					<table class="col-sm-12">
							<td>
								<fieldset>
									
									<table class="col-sm-8">
										
										<!--<tr>
										
											<td>
												<div class="form-group">
													<label class="control-label">Sucursal</label>
													<div class="controls">
														<div class="input-group">
															<input id="SucursalNombre" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $Sucursal ?>">
															<input type="hidden" id="SucursalID" value="<--?php echo $IdSuc ?>">
															<span class="input-group-btn">
																<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
															</span>
														</div>
													</div>
												</div>
											</td>
											<td width="5%"></td>
											<td>
												<div class="form-group">
													<label class="control-label">Usuario</label>
													<div class="controls">
														<div class="input-group">
															<input id="UsuarioNombre" class="form-control" type="text" size="16" placeholder="Usuario" readonly="readonly" value="<?php echo $Usuario ?>">
															<input type="hidden" id="idUsuario">
															<span class="input-group-btn">
																<button class="btn" type="button" onclick="Buscar('16')"><i class="fa fa-search"></i></button>
															</span>
														</div>
													</div>
												</div>
											</td>
									   </tr>-->
									  
										<!--<tr>
											<td>
													<div class="form-group">
														<label class="control-label" for="selectError3">Estado</label>
														<div class="controls" width="33%">
															<select id="estado" name="estado" class="form-control" >
																  <option value="X" <--?php if($estado=='X'){?>selected<--?php }?>>Ninguno</option>
																  <option value="P" <--?php if($estado=='P'){?>selected<--?php }?>>Pendiente</option>
																  <option value="C" <--?php if($estado=='C'){?>selected<--?php }?>>Cobrada</option>
																  <option value="E" <--?php if($estado=='E'){?>selected<--?php }?>>Eliminada</option>
															</select> 
														</div>
													</div>
												</td>
										</tr>-->
										
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label" for="date01">Fecha desde</label>
													<div class="input-group col-xs-8 col-sm-8">
														<input id="FechaDes" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php echo $desde ?>">
														<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
													</div>
												</div>
											</td>
											<td width="5%"></td>
											<td>
												<div class="form-group">
													<label class="control-label" for="date01">Fecha hasta</label>
													<div class="input-group col-xs-8 col-sm-8">
														<input id="FechaHas" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php echo $hasta ?>">
														<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
													</div>
												</div>
											</td>
										
										</tr>
										
										<div id="listado">
												<td><label><?php if($Total!=1){?> <?php echo $Subtotal.' pagina de '.$Total?><?php } else {?><?php echo $Subtotal.' pagina'?><?php } ?></label></td>
												<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th><a href="#" class="enlace_accion" onclick="BuscarFacturaPaginacionC('<?php echo 0 ?>','<?php echo $index ?>','<?php echo 1 ?>','<?php echo $Total ?>')"><</a></th>
															<th><a href="#" class="enlace_accion" onclick="BuscarFacturaPaginacionC('<?php echo 0 ?>','<?php echo $index ?>','<?php echo 0 ?>','<?php echo $Total ?>')"><<</a></th>
															<th>ID</th>
															<th>Descripci&oacute;n</th>
															<th>V. Total</th>
															<th>Num. Doc</th>
															<th>Estado</th>
															<th colspan="2">Acciones</th>
															<th><a href="#" class="enlace_accion" onclick="BuscarFacturaPaginacionC(<?php echo 1 ?>,<?php echo $index ?>,<?php echo 0 ?>,<?php echo $Total?>)">>></a></th>
															<th><a href="#" class="enlace_accion" onclick="BuscarFacturaPaginacionC(<?php echo 1 ?>,<?php echo $index ?>,<?php echo 1 ?>,<?php echo $Total?>)">></a></th>
														</tr>
													</thead>
													<tbody>
														<?php $i=1;?>
														<?php foreach($facturas as $factura){?>
															<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
																<td></td><td></td>
																<td align="center"><?php echo $factura["ID"] ?></td>
																<td align="left"><?php echo utf8_encode($factura["CONCEPTO"])?></td>
																<td align="center"><?php echo utf8_encode($factura["VTOTAL"])?></td>
																<td align="center"><?php echo utf8_encode($factura["secuencial"])?></td>
																<td align="center"><?php if($factura["ESTADO"]==1){?>ACTIVO<?php } else {?>ELIMINADO<?php }?></td>
																<!--<td align="center"><a href="#" class="enlace_accion" onclick="Reimprimirfactura('<?php echo $factura["ID"]?>')">Reimprimir</a></td>-->
																<td align="center"><a href="#" class="enlace_accion" onclick="ReversarCompra('<?php echo $factura["ID"]?>','<?php echo $factura["ESTADO"]?>')">Reversar</a></td>
																<td></td><td></td>	
															</tr>
														<?php $i++;?>
														<?php }?>
													</tbody>
												</table>		
										</div>
										
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

		</div>
			<input type="hidden" value="tr_1" id="detalleid">
	</div>
</div>

<script type="text/javascript">
	//CambiarDatos();
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
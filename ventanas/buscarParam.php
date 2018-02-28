<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
	$tipo=$_REQUEST["tipo"];
	$param=$_REQUEST["param"];
	if($tipo=="0")
	{
		$nombre_tipo="Sucursal";
		$respuestas=find_sucursal($conexion,'',0,'');
	}
	else
	{
		if($tipo=="1")
		{
			$nombre_tipo="Vendedor";
		}
		else
		{
			if($tipo=="2")
			{
				$nombre_tipo="Cliente";
			}
			else
			{
				if($tipo=="3")
				{
					$nombre_tipo="BodegaxSucursal";
				}
				else
				{
					if($tipo=="4")
					{
						$nombre_tipo="Bodegas";
					}
					else
					{
						if($tipo=="5")
						{
							$nombre_tipo="Ciudad";
						}
						else
						{
							if($tipo=="6")
							{
								$nombre_tipo="Zona";
							}
							else
							{
								if($tipo=="7")
								{
									$nombre_tipo="Tipo Negocio";
								}
								else
								{
									if($tipo=="8")
									{
										$nombre_tipo="Vendedor";
									}
									else
									{
										if($tipo=="9")
										{
											$nombre_tipo="Tipo Cliente";
										}
										else
										{
											if($tipo=="10")
											{
												$nombre_tipo="Cuentas";
											}
											else
											{
												if($tipo=="11")
												{
													$nombre_tipo="Sucursal";
												}
												else
											    {
													if($tipo=="12")
													{
														$nombre_tipo="Departamento";
													}
													else
													{
														if($tipo=="13")
														{
															$nombre_tipo="Cargo";
														}
														else
														{
															if($tipo=="14")
															{
																$nombre_tipo="Módulos";
															}
															else
															{
																if($tipo=="15")
																{
																	$nombre_tipo="División";
																}
																else
																{
																	if($tipo=="16")
																	{
																		$nombre_tipo="Usuario";
																	}
																	else
																	{
																		if($tipo=="17")
																		{
																			$nombre_tipo="País";
																		}
																		else
																		{
																			if($tipo=="18")
																			{
																				$nombre_tipo="Tipo Producto";
																			}
																			else
																			{
																				if($tipo=="19")
																				{
																					$nombre_tipo="Marca";
																				}
																				else
																				{
																					if($tipo=="20")
																					{
																						$nombre_tipo="Producto";
																					}
																					else
																					{
																						if($tipo=="21")
																						{
																							$nombre_tipo="Tecnologia";
																						}
																						else
																						{
																							if($tipo=="22")
																							{
																								$nombre_tipo="Precio";
																							}
																							else
																							{
																								if($tipo=="23")
																								{
																									$nombre_tipo="Bodegas";
																								}
																								else
																								{
																									if($tipo=="24")
																									{
																										$nombre_tipo="Cuenta/Padre";
																									}
																									else
																									{
																										if($tipo=="25")
																										{
																											$nombre_tipo="Consulta Cuenta";
																										}
																										else
																										{
																											if($tipo=="26")
																											{
																												$nombre_tipo="Consulta Cuenta";
																											}
																											else
																											{
																												if($tipo=="27")
																												{
																													$nombre_tipo="Sucursal";
																												}
																												else
																												{
																													if($tipo=="28")
																													{
																														$nombre_tipo="Cajas x Usuarios";
																													}
																												}
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}	
										}
									}
								}
							}
						}
					}
		
				}
			}
		}
	}
?>
<div class="titulo_popup"> 
	Seleccionar <?php echo $nombre_tipo;?>
</div>
<table class="table">
<tr>
<td width="30%">
<select id="tipobusqueda" class="form-control" disabled="true">
	<option value="D">Por descripci&oacute;n</option>
	<!--<option value="C">Por c&oacute;digo</option>-->
</select>
</td>
<td>
<input type="text" value="" id="busqueda" <?php if($tipo=="0") {?>onkeyup="BusquedaSucursal()"<?php } ?> <?php if($tipo=="1") {?>onkeyup="BusquedaVendedor()"<?php } ?> <?php if($tipo=="2") {?>onkeyup="BusquedaCliente()"<?php } ?> <?php if($tipo=="3") {?>onkeyup="BusquedaBodegaSucursal()"<?php } ?> <?php if($tipo=="4") {?>onkeyup="BusquedaBodega()"<?php } ?> <?php if($tipo=="5") {?>onkeyup="BusquedaCiudad()"<?php } ?> <?php if($tipo=="6") {?>onkeyup="BusquedaZona()"<?php } ?> <?php if($tipo=="7") {?>onkeyup="BusquedaTipoNegocio()"<?php } ?> <?php if($tipo=="8") {?>onkeyup="BusquedaSucursalGen()"<?php } ?>  <?php if($tipo=="9") {?>onkeyup="BusquedaTipoCliente()"<?php } ?> <?php if($tipo=="10") {?>onkeyup="BusquedaCuentas()"<?php } ?> <?php if($tipo=="11") {?>onkeyup="BusquedaSucursalGeneral()"<?php } ?> <?php if($tipo=="12") {?>onkeyup="BusquedaDepartamento()"<?php } ?> <?php if($tipo=="13") {?>onkeyup="BusquedaCargo()"<?php } ?> <?php if($tipo=="14") {?>onkeyup="BusquedaModulo()"<?php } ?> <?php if($tipo=="15") {?>onkeyup="BusquedaDivision()"<?php } ?> <?php if($tipo=="16") {?>onkeyup="BusquedaUsuario()"<?php } ?> <?php if($tipo=="17") {?>onkeyup="BusquedaPais()"<?php } ?> <?php if($tipo=="18") {?>onkeyup="BusquedaTipoProducto()"<?php } ?><?php if($tipo=="19") {?>onkeyup="BusquedaMarca()"<?php } ?><?php if($tipo=="20") {?>onkeyup="BusquedaProducto()"<?php } ?> <?php if($tipo=="21") {?>onkeyup="BusquedaTecnologia()"<?php } ?> <?php if($tipo=="22") {?>onkeyup="BusquedaPrecio()"<?php } ?> <?php if($tipo=="23") {?>onkeyup="BusquedaBodega1()"<?php } ?> <?php if($tipo=="24") {?>onkeyup="BusquedaCuentaPadre()"<?php } ?> <?php if($tipo=="25") {?>onkeyup="BusquedaCuentasDesde()"<?php } ?> <?php if($tipo=="26") {?>onkeyup="BusquedaCuentasHasta()"<?php } ?> <?php if($tipo=="27") {?>onkeyup="BusquedaSucursal3()"<?php } ?> <?php if($tipo=="28") {?>onkeyup="BusquedaCajasUsuarios('<?php echo $param ;?>')"<?php } ?> class="form-control" placeholder="Busqueda" size="16">
</td>
</tr>
</table>
<table class="tabla_detalle" width="100%" cellspacing="0" cellpadding="0">
<thead>
	<th>Codigo</th>
	<th>Nombre</th>
	<th></th>
</thead>
<tbody id="detalle_busqueda">
	<?php if($tipo=="0"){ ?>
		<?php foreach($respuestas as $respuesta):?>
			<tr>
				<td align="center"><?php echo $respuesta['id'];?></td>
				<td align="left"><?php echo $respuesta['nombre'];?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarSucursal('<?php echo $respuesta['id'];?>','<?php echo $respuesta['nombre'];?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
			</tr>
		<?php endforeach;?>
	<?php } ?>
</tbody>
</table>
<script>
	Redimensionar();
</script>
<?php } ?> 
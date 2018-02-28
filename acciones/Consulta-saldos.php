<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	//$fecha = date.getfullyear;
	$ano = Date(Y);
	
	$id=$_GET["id"];
	if($id=='')
	{
		$disabledEstado = 'disabled';
		$Titulo = 'Crear';
		$id=0;
	}
	else
	{
		$division=division($conexion,$id);
		$Titulo = 'Editar';
	}
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Consulta series" onclick="ImprimirCuentasSaldos()" target="_blank">
				<i class="fa fa-user"></i>
				<span>Consultar</span>
			</a>
		</div>
	</div>
</div>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Consulta saldos de cuentas</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label"></label>
							<div class="controls">
								<div class="input-group">
									<label class="check"><input type="checkbox" onclick="CuentasGlobalConsulta()" id="chkVerctas"/> Ver todas las cuentas contables</label>
								</div>
							</div>
						</div>
					
					</td>
					
				</tr>
				
				<tr>
				
					<td>
						<div class="form-group">
							<div class="controls">
								<div class="input-group">
									<input id="CContNombre1" class="form-control" type="text" size="16" placeholder="Cta. Contable Desde" readonly="readonly">
									<input id="CContID1" type="hidden" value="">
									<span class="input-group-btn">
										<button onclick="Buscar('25')" id="bt_ctah" class="btn" type="button"><i class="fa fa-search"></i></button>
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
								<div class="input-group">
									<input id="CContNombre2" class="form-control" type="text" size="16" placeholder="Cta. Contable Hasta" readonly="readonly">
									<input id="CContID2" type="hidden" value="">
									<span class="input-group-btn">
										<button onclick="Buscar('26')" id="bt_ctad" class="btn" type="button"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						</div>
					</td>
				
				</tr>
				
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label" for="selectError3">Año</label>
							<div class="controls">
								<select id="anos" name="años" class="form-control">
									<option value="2006" <?php if($ano==2006){?>selected<?php }?>>2006</option>
									<option value="2007" <?php if($ano==2007){?>selected<?php }?>>2007</option>
									<option value="2008" <?php if($ano==2008){?>selected<?php }?>>2008</option>
									<option value="2009" <?php if($ano==2009){?>selected<?php }?>>2009</option>
									<option value="2010" <?php if($ano==2010){?>selected<?php }?>>2010</option>
									<option value="2011" <?php if($ano==2011){?>selected<?php }?>>2011</option>
									<option value="2012" <?php if($ano==2012){?>selected<?php }?>>2012</option>
									<option value="2013" <?php if($ano==2013){?>selected<?php }?>>2013</option>
									<option value="2014" <?php if($ano==2014){?>selected<?php }?>>2014</option>
									<option value="2015" <?php if($ano==2015){?>selected<?php }?>>2015</option>
									<option value="2016" <?php if($ano==2016){?>selected<?php }?>>2016</option>
									<option value="2017" <?php if($ano==2017){?>selected<?php }?>>2017</option>
									<option value="2018" <?php if($ano==2018){?>selected<?php }?>>2018</option>
									<option value="2019" <?php if($ano==2019){?>selected<?php }?>>2019</option>
									<option value="2020" <?php if($ano==2020){?>selected<?php }?>>2020</option>
									<option value="2021" <?php if($ano==2021){?>selected<?php }?>>2021</option>
									<option value="2022" <?php if($ano==2022){?>selected<?php }?>>2022</option>
									<option value="2023" <?php if($ano==2023){?>selected<?php }?>>2023</option>
									<option value="2024" <?php if($ano==2024){?>selected<?php }?>>2024</option>
									<option value="2025" <?php if($ano==2025){?>selected<?php }?>>2025</option>
									<option value="2026" <?php if($ano==2026){?>selected<?php }?>>2026</option>
									<option value="2027" <?php if($ano==2027){?>selected<?php }?>>2027</option>
									<option value="2028" <?php if($ano==2028){?>selected<?php }?>>2028</option>
									<option value="2029" <?php if($ano==2029){?>selected<?php }?>>2029</option>
									<option value="2030" <?php if($ano==2030){?>selected<?php }?>>2030</option>
									<option value="2031" <?php if($ano==2031){?>selected<?php }?>>2031</option>
									<option value="2032" <?php if($ano==2032){?>selected<?php }?>>2032</option>
									<option value="2033" <?php if($ano==2033){?>selected<?php }?>>2033</option>
									<option value="2034" <?php if($ano==2034){?>selected<?php }?>>2034</option>
									<option value="2035" <?php if($ano==2035){?>selected<?php }?>>2035</option>
									<option value="2036" <?php if($ano==2036){?>selected<?php }?>>2036</option>
									<option value="2037" <?php if($ano==2037){?>selected<?php }?>>2037</option>
									<option value="2038" <?php if($ano==2038){?>selected<?php }?>>2038</option>
									<option value="2039" <?php if($ano==2039){?>selected<?php }?>>2039</option>
									<option value="2040" <?php if($ano==2040){?>selected<?php }?>>2040</option>
									<option value="2041" <?php if($ano==2041){?>selected<?php }?>>2041</option>
									<option value="2042" <?php if($ano==2042){?>selected<?php }?>>2042</option>
									<option value="2043" <?php if($ano==2043){?>selected<?php }?>>2043</option>
									<option value="2044" <?php if($ano==2044){?>selected<?php }?>>2044</option>
									<option value="2045" <?php if($ano==2045){?>selected<?php }?>>2045</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label" for="selectError3">Mes</label>
							<div class="controls">
								<select id="mes" name="meses" class="form-control">
									<option value="01">01 Enero</option>
									<option value="02">02 Febrero</option>
									<option value="03">03 Marzo</option>
									<option value="04">04 Abril</option>
									<option value="05">05 Mayo</option>
									<option value="06">06 Junio</option>
									<option value="07">07 Julio</option>
									<option value="08">08 Agosto</option>
									<option value="09">09 Septiembre</option>
									<option value="10">10 Octubre</option>
									<option value="11">11 Noviembre</option>
									<option value="12">12 Diciembre</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>
				<tr>
					
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
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
		$Titulo = 'Crear';
		$id=0;
	}
	else
	{
		$acceso=accesos($conexion,$id);
		$Titulo = 'Editar';
	}
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Acceso</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Ip</label>
							<div class="controls">
								<div class="input-group">
									<input id="Ip" class="form-control" type="text" maxlength="50" size="50" placeholder="Ip" width="400px" value="<?php echo $acceso [0]["vIpConfig"]?>">
									<input type="hidden" id="id" value="<?php echo $id ?>">
								</div>
							</div>
						</div>
					
					</td>
					
				</tr>
				
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Descipci&oacute;n</label>
							<div class="controls">
								<div class="input-group">
									<input id="NombreAcceso" class="form-control" type="text" maxlength="50" size="50" placeholder="Descripción" width="400px" value="<?php echo $acceso[0]["vDescriIpConfig"]?>">
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
									<input id="SucursalNombre" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $acceso[0]["Suc_Nombre"] ?>">
									<input type="hidden" id="SucursalID" value="<?php echo $acceso[0]["Suc_Codigo"] ?>">
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
							<label class="control-label" for="selectError3">Acceso</label>
							<div class="controls">
								<select id="estado" name="estado" class="form-control" <?php echo $disabledEstado?>>
									<option value="1" <?php if($acceso[0]["iListaIpConfig"]==1){?>selected<?php }?>>Acceso</option>
									<option value="0" <?php if($acceso[0]["iListaIpConfig"]==0){?>selected<?php }?>>Denegado</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr>
					<td><div class="boton_save" onclick="GuardarAcceso()">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
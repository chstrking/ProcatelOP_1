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
		$cuentas=array('nombre'=>'','estado'=>1);
		$Titulo = 'Crear';
	}
	else
	{
		$cuentas=cuentas($conexion,$id);
		$Titulo = 'Editar';
	}
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Cuenta</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Cuenta</label>
							<div class="controls">
								<div class="input-group">
									<input id="Nombrecuentas" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="50" maxlength="50" placeholder="Nombre cuenta" width="400px" value="<?php echo $cuentas[0]["PCta_Nombre"] ?>">
									<input type="hidden" id="id" value="<?php echo $id;?>">
								</div>
							</div>
						</div>
					
					</td>
					
				</tr>
			
				<tr>
				
					<td>
						<div class="form-group">
							<label class="control-label">Cuenta/Padre</label>
							<div class="controls">
								<div class="input-group">
									<input id="CuentaNombre" readonly="readonly" class="form-control" type="text" size="16" placeholder="Nombre/Padre" value="<?php echo $cuentas[0]["Nombre_Padre"] ?>">
									<input id="CuentaID" type="hidden" value="<?php echo $cuentas[0]["PCta_CodCtaPadre"] ?>">
									<span class="input-group-btn">
										<button onclick="Buscar('24')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						</div>
					</td>
					
				</tr>
				
				<tr>
				
					<td>
						<div class="form-group">
							<label class="control-label"># Cuenta</label>
							<div class="controls">
								<input id="NumCuenta" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Número Cuenta" value="<?php echo utf8_encode($cuentas[0]["PCta_Cuenta"]) ?>">
							</div>
						</div>
					</td>
										
				</tr>	
				
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label" for="selectError3">Estado</label>
							<div class="controls">
								<select id="estado" name="estado" class="form-control" <?php echo $disabledEstado?>>
									<option value="1" <?php if($cuentas[0]["PCta_Estado"]==1){?>selected<?php }?>>Activo</option>
									<option value="0" <?php if($cuentas[0]["PCta_Estado"]==0){?>selected<?php }?>>Inactivo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr>
					<td><div class="boton_save" onclick="Guardarcuentas()">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
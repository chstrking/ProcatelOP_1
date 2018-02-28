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
		$departamentos=departamentos($conexion,$id);
		$Titulo = 'Editar';
	}
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Departamento</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Departamento</label>
							<div class="controls">
								<div class="input-group">
									<input id="NombreDepartamento" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" maxlength="50" size="50" placeholder="Nombre Cargo" width="400px" value="<?php echo utf8_encode($departamentos [0]["Dpto_Nombre"])?>">
									<input type="hidden" id="id" value="<?php echo $id ?>">
								</div>
							</div>
						</div>
					
					</td>
					
				</tr>
				
				<tr>
			
					<td>
						<div class="form-group">
							<label class="control-label">División</label>
							<div class="controls">
								<div class="input-group">
									<input id="DivisiónNombre" class="form-control" type="text" size="16" placeholder="División" readonly="readonly" value="<?php echo utf8_encode($departamentos[0]["Div_Nombre"]) ?>">
									<input type="hidden" id="DivisiónlID" value="<?php echo $departamentos[0]["Dpto_CodDivision"] ?>">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="Buscar('15')"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						</div>
					</td>
		
				</tr>
				
				<tr>
			
					<td>
						<div class="form-group">
							<label class="control-label">Cta. Contable</label>
							<div class="controls">
								<div class="input-group">
									<input id="CContNombre" class="form-control" type="text" size="16" placeholder="Cta. Contable" readonly="readonly" value="<?php echo utf8_encode($departamentos[0]["Cuenta"]) ?>">
									<input type="hidden" id="CContID" value="<?php echo $departamentos[0]["Dpto_CodCtaGastos"] ?>">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="Buscar('10')"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						</div>
					</td>
		
				</tr>
				
				<tr>
			
					<td>
					
						<br>
						<div class="form-group">
							<div class="controls">
								<div class="input-group">
									<input id="VendedorNombre" class="form-control" type="text" size="16" placeholder="Código Empleado" readonly="readonly" value="<?php echo utf8_encode($departamentos[0]["empleado"]) ?>">
									<input id="VendedorID" type="hidden" value="<?php echo $departamentos[0]["Dpto_CodEmplJefe"]?>">
									<span class="input-group-btn">
										<button onclick="Buscar('8')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
									</span>
								</div>
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
									<option value="1" <?php if($departamentos[0]["Dpto_Estado"]==1){?>selected<?php }?>>Activo</option>
									<option value="0" <?php if($departamentos[0]["Dpto_Estado"]==0){?>selected<?php }?>>Inactivo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr>
					<td><div class="boton_save" onclick="Guardartipoproductos()">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
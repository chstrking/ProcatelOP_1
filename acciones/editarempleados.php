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
	}
	else
	{
		$empleado=getempleado($conexion,$id);
		$Titulo = 'Editar';
	}	
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-users"></i><?php if($id==''){?>Crear<?php }else{?>Editar<?php }?> Empleados</div>
	<table class="table">
	
		<table class="col-sm-4">
					
			<tr>
				
				<td>
				
					<div class="form-group">
						<label class="control-label">Apellidos</label>
						<div class="controls">
							<div class="input-group">
								<input id="Apellidos" class="form-control" type="text" maxlength="50" size="50" onkeyup = "this.value=this.value.toUpperCase()" placeholder="Apellidos" width="400px" value="<?php echo $empleado["Empl_Apellidos"]?>">
								<input type="hidden" id="Id" value="<?php echo $id ?>">
							</div>
						</div>
					</div>
				
				</td>
			
			</tr>
			
			<tr>
				
				<td>
				
					<div class="form-group">
						<label class="control-label">Nombres</label>
						<div class="controls">
							<div class="input-group">
								<input id="Nombres" class="form-control" type="text" maxlength="50" size="50" onkeyup = "this.value=this.value.toUpperCase()" placeholder="Nombres" width="400px" value="<?php echo $empleado["Empl_Nombres"]?>">
							</div>
						</div>
					</div>
				
				</td>
			
			</tr>
			
			<tr>
				
				<td>
				
					<div class="form-group">
						<label class="control-label">C&eacute;dula</label>
						<div class="controls">
							<div class="input-group">
								<input id="Cedula" class="form-control" onkeyup = "onlyNumbers()" type="text" maxlength="10" size="50" placeholder="Cédula" width="400px" value="<?php echo $empleado["Empl_Cedula"]?>">
							</div>
						</div>
					</div>
				
				</td>
			
			</tr>
			
			<tr>
				
				<td>
				
					<div class="form-group">
						<label class="control-label">T&iacute;tulo</label>
						<div class="controls">
							<div class="input-group">
								<input id="Titulo" class="form-control" type="text" maxlength="10" placeholder="Título" width="400px" value="<?php echo $empleado["Empl_Titulo"]?>">
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
								<input id="SucursalNombre" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $empleado["Suc_Nombre"] ?>">
								<input type="hidden" id="SucursalID" value="<?php echo $empleado["Suc_Codigo"] ?>">
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
						<label class="control-label">Cargo</label>
						<div class="controls">
							<div class="input-group">
								<input id="CargoNombre" class="form-control" type="text" size="16" placeholder="Cargo" readonly="readonly" value="<?php echo $empleado["Carg_Descripcion"] ?>">
								<input type="hidden" id="CargoID" value="<?php echo $empleado["Carg_Codigo"] ?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('13')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
		
			</tr>
			
			<tr>
			
				<td>
					<div class="form-group">
						<label class="control-label">Departamento</label>
						<div class="controls">
							<div class="input-group">
								<input id="DepartamentoNombre" class="form-control" type="text" size="16" placeholder="Departamento" readonly="readonly" value="<?php echo $empleado["Dpto_Nombre"] ?>">
								<input type="hidden" id="DepartamentolID" value="<?php echo $empleado["Dpto_Codigo"] ?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('12')"><i class="fa fa-search"></i></button>
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
								<input id="CContNombre" class="form-control" type="text" size="16" placeholder="Cta. Contable" readonly="readonly" value="<?php echo $empleado["cuenta"] ?>">
								<input type="hidden" id="CContID" value="<?php echo $empleado["Empl_CodCtaCont"] ?>">
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
				
					<div class="form-group">
						<label class="control-label" for="selectError3">Tipo de Empleado</label>
						<div class="controls">
							<select id="Tipo" name="Tipo" class="form-control">
								<option value="V" <?php if($empleado["Empl_Tipo"]=="V"){?>selected<?php }?>>Vendedor</option>
								<option value="R" <?php if($empleado["Empl_Tipo"]=="R"){?>selected<?php }?>>Rol</option>
								<option value="A" <?php if($empleado["Empl_Tipo"]=="A"){?>selected<?php }?>>Ambos</option>
							</select> 
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
								<option value="1" <?php if($empleado["estado"]==1){?>selected<?php }?>>Activo</option>
								<option value="0" <?php if($empleado["estado"]==0){?>selected<?php }?>>Inactivo</option>
							</select> 
						</div>
					</div>
					
				</td>
				
			</tr>
			
			<tr>
			
				<td>
				
					<div class="form-group">
						<label class="control-label" for="selectError3">Lugar</label>
						<div class="controls">
							<select id="lugar" name="lugar" class="form-control">
								<option value="GYE" <?php if($empleado["DEmpl_lugar"]=='GUAY'){?>selected<?php }?>>GYE</option>
								<option value="PROV" <?php if($empleado["DEmpl_lugar"]=='PROV'){?>selected<?php }?>>PROV</option>
							</select> 
						</div>
					</div>
					
				</td>
				
			</tr>
			
			<tr>
				
				<td>
				
					<div class="form-group">
						<label class="control-label">Sueldo</label>
						<div class="controls">
							<div class="input-group">
								<input id="Sueldo" class="form-control" type="text" size="50" placeholder="Sueldo" width="400px" value="<?php echo $empleado["DEmpl_sueldo"]?>">
							</div>
						</div>
					</div>
				
				</td>
			
			</tr>
			
			<tr>
			
				<td>
				
					<div class="form-group">
						<label class="control-label" for="date01">Fecha Ingreso</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="FechaIng" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php if($id!=''){ echo $empleado["DEmpl_fecha"]->format('d-m-Y');}else{ echo date('d-m-Y');}?>">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
					
				</td>
										
			</tr>
			
			<tr>
			
				<td>
				
					<div class="form-group">
						<label class="control-label" for="selectError3">Forma de Pago</label>
						<div class="controls">
							<select id="Pago" name="Pago" class="form-control">
								<option value="Guayaquil" <?php if($empleado["DEmpl_formpago"]=='Bco. Guayaquil'){?>selected<?php }?>>Bco. Guayaquil</option>
								<option value="Pacifico" <?php if($empleado["DEmpl_formpago"]=='Bco. Pacifico'){?>selected<?php }?>>Bco. Pa&iacute;fico</option>
								<option value="Efectivo" <?php if($empleado["DEmpl_formpago"]=='Efectivo'){?>selected<?php }?>>Efectivo</option>
								<option value="Cheque" <?php if($empleado["DEmpl_formpago"]=='Cheque'){?>selected<?php }?>>Cheque</option>
							</select> 
						</div>
					</div>
					
				</td>
				
			</tr>
			
			<tr>
										
				<td align="left">
					
					<br>
					<button onclick="GuardarEmpleados()" type="button" class="boton_save"  align="left"><i class="fa fa-save"></i> Guardar</button> 
					
				</td>
										
			</tr>
		
		</table>
	
	</table>
	
</div>
<?php }?>
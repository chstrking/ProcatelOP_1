<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	if(isset($_GET['guardar']))
	{
		if($id=='')
		{
			$disabledEstado = 'disabled';
		}
		else
		{
			$disabledEstado = '';
		}
		$estado=$_GET["estado"];
		$idRol=$_GET["idRol"];
		$fecha_ingreso=$_GET["fecha_ingreso"];
		$fecha_vencimiento=dameFecha(date('d-m-Y'),90);
		$id_empleado=$_GET["id_empleado"];
		$clave=$_GET["clave"];
		$tipo=$_GET["tipo"];
		$correo=$_GET["correo"];
		$respuesta= saveusuario($conexion,$id,$fecha_ingreso,$fecha_vencimiento,$id_empleado,$clave,$tipo,$correo,$idRol);
		$usuario=getusuario($conexion,$id);
		$tipo='M';
		$respuesta=saverolUsuario($conexion,$idRol,$id,$estado);
	}
	else
	{
		if($id=='')
		{
			$disabledEstado = 'disabled';
			$usuario=array('id'=>'','fecha_ingreso'=>'','fecha_vencimiento'=>'','estado'=>1,'cod_empleado'=>'');
			$tipo='I';
		}
		else
		{
			$disabledEstado = '';
			$usuario=getusuario($conexion,$id);
			$tipo='M';
		}
	}
	$roles=roles($conexion);
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-users"></i><?php if($id==''){?>Crear<?php }else{?>Editar<?php }?> Usuario</div>
	<table class="table">
	
		<table class="col-sm-4">
		
			<tr>
			
				<td>
				
					<div class="form-group">
						<label class="control-label">Usuario</label>
						<div class="controls">
							<div class="input-group">
								<input id="id" class="form-control" type="text" size="50" maxlength="8" onkeyup = "this.value=this.value.toUpperCase()" placeholder="Usuario" width="400px" value="<?php echo $usuario["id"]?>">
							</div>
						</div>
					</div>
				
				</td>
				
			</tr>
			
			<tr>
				
				<td>
				
					<div class="form-group">
						<label class="control-label">Password</label>
						<div class="controls">
							<div class="input-group">
								<input id="clave" class="form-control" type="password" maxlength="8" size="50" placeholder="Password" width="400px" value="<?php echo $usuario["Usu_clave"]?>">
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
								<input id="VendedorNombre" class="form-control" type="text" size="16" placeholder="Código Empleado" readonly="readonly" value="<?php echo $usuario["nombre"]?>">
								<input id="VendedorID" type="hidden" value="<?php echo $usuario["cod_empleado"]?>">
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
						<label class="control-label" for="date01">Fecha Ingreso</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="FechaIng" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php if($tipo=='M'){ echo $usuario["fecha_ingreso"]->format('d-m-Y');}else{ echo date('d-m-Y');}?>">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
						</div>
					</div>
					
				</td>
										
			</tr>
			
			<tr>
			
				<td>
				
					<div class="form-group">
						<label class="control-label" for="date01">Fecha Caducidad</label>
						<div class="input-group col-xs-8 col-sm-8">
							<input id="FechaCad" class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" readonly="readonly" value="<?php if($tipo=='M'){ echo $usuario["fecha_vencimiento"]->format('d-m-Y');}else{ echo dameFecha(date('d-m-Y'),90);}?>">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
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
								<option value="1" <?php if($usuario["estado"]==1){?>selected<?php }?>>Activo</option>
								<option value="0" <?php if($usuario["estado"]==0){?>selected<?php }?>>Inactivo</option>
							</select> 
						</div>
					</div>
					
				</td>
				
			</tr>
			
			<tr>
			
				<td>
				
					<div class="form-group">
						<label class="control-label">Usuario mail</label>
						<div class="controls">
							<div class="input-group">
								<input id="mail" class="form-control" type="text" size="50" placeholder="Mail" width="400px" value="<?php echo $usuario["mail"]?>">
							</div>
						</div>
					</div>
				
				</td>
				
			</tr>
			
			<tr>
			
				<td>
				
					<label class="control-label">Rol</label>
					<select id="rol" class="form-control">
						<?php foreach($roles as $rol){?>
							<option value="<?php echo $rol['id']?>" <?php if($usuario["Rol_codigo"]==$rol['id']){?>selected="selected"<?php }?>><?php echo $rol['nombre'];?></option>
						<?php }?>
					</select>
					<input type="hidden" id="idRol" value="<?php echo $id;?>">
					
				</td>
				
			</tr>
			
			<tr>
			
				<input type="hidden" id="tipo" value="<?php echo $tipo;?>">
			
			</tr>
			
			<tr>
										
				<td align="left">
					
					<br>
					<button onclick="GuardarUsuario()" type="button" class="boton_save"  align="left"><i class="fa fa-save"></i> Guardar</button> 
					
				</td>
										
			</tr>
		
		</table>
	
	</table>
	
</div>
<?php }?>
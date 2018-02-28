<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	$id_rol=$_GET["id_rol"];
	if(isset($_GET['guardar']))
	{
		
	}
	$roles=roles($conexion);
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-users"></i>Asignar Rol a Usuario</div>
	<table  cellpadding="5" cellspacing="10" width="100%">
		<tbody>
			<tr>
				<td width="150px">Rol</td>
				<td>
					<select id="rol" name="rol">
						<?php foreach($roles as $rol){?>
							<option value="<?php echo $rol['id']?>" <?php if($id_rol==$rol['id']){?>selected="selected"<?php }?>><?php echo $rol['nombre'];?></option>
						<?php }?>
					</select>
					<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
				</td>
			</tr>
			<tr>
				<td>Estado</td>
				<td>
					<select id="estado" name="estado">
					  <option value="1">Activo</option>
					  <option value="0">Inactivo</option>
					</select> 
				</td>
			</tr>
			<tr>
				<td><div class="boton_save" onclick="GuardarRolUsuario()">Guardar</div></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>
<?php }?>
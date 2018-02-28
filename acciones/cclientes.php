<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	$usuarios=usuarios($conexion);
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarcliente','')">
				<i class="fa fa-user"></i>
				<span>Nuevo Cliente</span>
			</a>
		</div>
	</div>
</div>
<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-users"></i><?php echo $opcion["nombre"];?></td>
			</tr>
		</tbody>
	</table>
</div>
<div>
	<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Username</th>
				<th>Rol</th>
				<th>Estado</th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($usuarios as $usuario){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>">
				<td><?php echo $usuario["user"]?></td>
				<td><?php echo $usuario["rol"]?></td>
				<td><?php if($usuario["estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td><a href="#" class="enlace_accion" onclick="verSubProcesoRol('asignarrol','<?php echo $usuario["user"]?>','<?php echo $usuario["rol_codigo"]?>')">Asignar Rol</a></td>
				<td><a href="#" class="enlace_accion" onclick="verSubProceso('editarcliente','<?php echo $usuario["user"]?>')">Editar Cliente</a></td>
				<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el cliente?')){verSubProceso('eliminarusuario','<?php echo $usuario["user"]?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
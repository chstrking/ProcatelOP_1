<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	//$roles=roles($conexion);
	//var_dump($roles);
	/*$codigo=1554;
	$datos=Print_Factura($conexion,$codigo);
	var_dump($datos);*/
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarrol','')">
				<i class="fa fa-user"></i>
				<span>Nuevo rol</span>
			</a>
		</div>
	</div>
</div>
<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-tags"></i>
				<?php 
					if(isset($_GET["nombre_menu"]))
					{
						echo $nombre_menu=$_GET["nombre_menu"];
					}
					else
					{
						echo $opcion["nombre"];
					}
					?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div>
	<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Rol</th>
				<th>Estado</th>
				<th>Modulos</th>
				<th colspan="2">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($roles as $rol){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
				<td><?php echo $rol["nombre"]?></td>
				<td align="center"><?php if($rol["estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td><a href="#" class="enlace_accion" onclick="verSubProceso('listar_opciones','<?php echo $rol["id"]?>')">Asignar Opciones</a></td>
				<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editarrol','<?php echo $rol["id"]?>')">Editar</a></td>
				<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el rol?')){EliminarRol('<?php echo $rol["id"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
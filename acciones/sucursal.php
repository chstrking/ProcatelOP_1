<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	$NombreMenu = $_GET["nombre_menu"];
	$sucursales=sucursal($conexion);
    //var_dump($NombreMenu);
?>

<div class="action-nav-normal action-nav-line">
							<div class="row">
								<div class="col-sm-2 action-nav-button">
									<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarsucursal','<?php echo $sucursal["id"]?>')">
										<i class="fa fa-user"></i>
										<span>Nueva Sucursal</span>
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
				<th>Sucursal</th>
				<th>Estado</th>
				<th colspan="3"></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($sucursales as $sucursal){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
				<td><?php echo $sucursal["nombre"]?></td>
				<td align="center"><?php if($sucursal["estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td><a href="#" class="enlace_accion" onclick="verSubProceso('editarsucursal','<?php echo $sucursal["id"]?>')">Editar</a></td>
				<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el rol?')){EliminarSucursal('<?php echo $sucursal["id"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
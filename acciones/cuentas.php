<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	$cuentas=cuentas($conexion,0);
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarcuentas','')">
				<i class="fa fa-user"></i>
				<span>Nueva cuenta</span>
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
						echo $nombre_menu="Cuentas";
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
				<th>ID</th>
				<th>#Cuenta</th>
				<th>#Cuenta/Padre</th>
				<th>Nivel</th>
				<th>Estado</th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($cuentas as $cuenta){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_cuenta_<?php echo $i;?>">
				<td><?php echo utf8_encode($cuenta["PCta_codigo"])?></td>
				<td><?php echo utf8_encode($cuenta["PCta_Cuenta"]). "- " .utf8_encode($cuenta["PCta_Nombre"])?></td>
				<td><?php echo utf8_encode($cuenta["Cuenta_Padre"]). "- " .utf8_encode($cuenta["Nombre_Padre"])?></td>
				<td><?php echo utf8_encode($cuenta["PCta_Nivel"])?></td>
				<td align="center"><?php if($cuenta["PCta_Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td><a href="#" class="enlace_accion" onclick="verSubProceso('editarcuentas','<?php echo $cuenta["PCta_codigo"]?>')">Editar</a></td>
				<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar la cuenta?')){EliminarCuentas('<?php echo $cuenta["PCta_codigo"]?>','tr_cuenta_<?php echo $i;?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
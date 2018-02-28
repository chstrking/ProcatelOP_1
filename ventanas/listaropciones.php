<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	$modulos=modulos($conexion);
?>
<div class="botonera">
	<div class="boton_save" onclick="verSubProceso('editarmodulo','0')">Nuevo</div>
	<div class="clear"></div>
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
				<th>Modulo</th>
				<th>Estado</th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($modulos as $modulo){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_modulos_<?php echo $i;?>">
				<td><?php echo $modulo["nombre"]?></td>
				<td align="center"><?php if($modulo["estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td><a href="#" class="enlace_accion" onclick="verSubProceso('editarmodulo','<?php echo $modulo["id"]?>')">Editar</a></td>
				<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el modulo?')){EliminarModulo('<?php echo $modulo["id"]?>','tr_modulos_<?php echo $i;?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	//$paises=pais($conexion,$Id);
	
?>

<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarpais','')">
				<i class="fa fa-user"></i>
				<span>Nuevo pa&iacute;s</span>
			</a>
		</div>
	</div>
	
</div>

<div>

		<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id</th>
					<th>Pa&iacute;s</th>
					<th>Estado</th>
					<th colspan="2">Acciones</th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($paises as $pais){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="center"><?php echo $pais["Pais_Codigo"]?></td>
						<td align="left"><?php echo utf8_encode($pais["Pais_Descripcion"])?></td>
						<td align="center"><?php if($pais["Pais_Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editarpais','<?php echo $pais["Pais_Codigo"]?>')">Editar</a></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el registro?')){Eliminarregistros('eliminarpais','<?php echo $pais["Pais_Codigo"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}?>
<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$cargos=cargos($conexion,$Id);
	
?>

<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarcargos','')">
				<i class="fa fa-user"></i>
				<span>Nuevo Cargo</span>
			</a>
		</div>
	</div>
</div>

<div>

		<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id</th>
					<th>Cargo</th>
					<th>Estado</th>
					<th colspan="3"></th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($cargos as $cargo){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="left"><?php echo utf8_encode($cargo["Carg_Codigo"])?></td>
						<td align="left"><?php echo utf8_encode($cargo["Carg_Descripcion"])?></td>
						<td><?php if($cargo["Carg_Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
						<td><a href="#" class="enlace_accion" onclick="verSubProceso('editarcargos','<?php echo $cargo["Carg_Codigo"]?>')">Editar</a></td>
						<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar la opcion?')){Eliminarcargo('<?php echo $cargo["Carg_Codigo"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}?>
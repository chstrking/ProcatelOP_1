<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$bodegas=bodegas($conexion,$Id);
	
?>

<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarbodegas','')">
				<i class="fa fa-user"></i>
				<span>Nueva bodega</span>
			</a>
		</div>
	</div>
</div>

<div>

		<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id</th>
					<th>bodega</th>
					<th>Estado</th>
					<th colspan="2"></th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($bodegas as $bodega){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="center"><?php echo utf8_encode($bodega["Bod_Codigo"])?></td>
						<td align="left"><?php echo utf8_encode($bodega["Bod_Descripcion"])?></td>
						<td align="center"><?php if($bodega["estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
						<td><a href="#" class="enlace_accion" onclick="verSubProceso('editarbodegas','<?php echo $bodega["Bod_Codigo"]?>')">Editar</a></td>
						<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar la opcion?')){Eliminarbodega('<?php echo $bodega["Bod_Codigo"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}?>
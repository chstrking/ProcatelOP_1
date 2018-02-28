<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$accesos=accesos($conexion,$Id);
	
?>

<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editaracceso','')">
				<i class="fa fa-user"></i>
				<span>Nuevo acceso</span>
			</a>
		</div>
	</div>
</div>

<div>

		<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Ip</th>
					<th>Desrcipción</th>
					<th>Estado</th>
					<th colspan="3">Acciones</th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($accesos as $acceso){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="left"><?php echo utf8_encode($acceso["vIpConfig"])?></td>
						<td align="left"><?php echo utf8_encode($acceso["vDescriIpConfig"])?></td>
						<td><?php if($acceso["iListaIpConfig"]==1){?>Acceso<?php }else{?>Denegado<?php }?></td>
						<td><a href="#" class="enlace_accion" onclick="verSubProceso('editaracceso','<?php echo $acceso["iIdIpConfig"]?>')">Editar</a></td>
						<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar la opcion?')){Eliminaracceso('<?php echo $acceso["iIdIpConfig"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}?>
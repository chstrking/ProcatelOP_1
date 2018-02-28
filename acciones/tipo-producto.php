<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	$usuario=$_SESSION['usuario'];
	$resultados=find_tipoproducto($conexion,'a',0);
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo tipo producto" href="#" onclick="verSubProceso('editartipoproducto','')">
				<i class="fa fa-user"></i>
				<span>Nuevo tipo producto</span>
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
				<th>C&oacute;digo</th>
				<th>Descripci&Oacute;n</th>
				<th>Estado</th>
				<th colspan="3"></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($resultados as $resultado){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_usuarios_<?php echo $i;?>">
				<td><?php echo $resultado["CODIGO"]?></td>
				<td><?php echo $resultado["NOMBRE"]?></td>
				<td><?php if($resultado["TipP_Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td><a href="#" class="enlace_accion" onclick="verSubProceso('editartipoproducto','<?php echo $resultado["CODIGO"]?>')">Editar</a></td>
				<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el tipo de producto?')){Eliminarregistros('eliminartipoproducto','<?php echo $resultado["CODIGO"]?>','tr_usuarios_<?php echo $i;?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
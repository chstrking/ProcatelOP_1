<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	
	$Id = $_REQUEST['id']; $IdPais= $_REQUEST['idpais'];
	$Nombre = $_REQUEST['nombre'];
	if($Id!=NULL)
	{
		//$provincias=provincia($conexion,0,$Id);
	} 
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarprovincia','')">
				<i class="fa fa-user"></i>
				<span>Nueva provincia</span>
			</a>
		</div>
	</div>
</div>

<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-tags"></i>
				<?php echo 'Provincia';
					?>
				</td>
			</tr>	
		</tbody>
	</table>
</div>
<div>

	<table class="col-sm-12">
		<td>
			<div class="form-group">
				<label class="control-label">Pa&iacute;s</label>
				<div class="controls">
					<div class="input-group">
						<input id="PaisNombre" readonly="readonly" class="form-control" type="text" size="16" placeholder="País" value="<?php echo $Nombre ?>">
						<input id="PaisID" type="hidden" value="<?php echo $Id ?>">
						<span class="input-group-btn">
							<button onclick="Buscar('17')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
		</td>
		
		  <td align="left"> 	
					<button onclick="BuscarProvincia()" type="button" class="boton_save" align="left"><i class="fa fa-save"></i> Buscar</button> 	
		  </td>	
		  
		<td width="30%"></td>
		
	</table >

</div>

<div style="width:100%;">

	<br>
	
</div>

<div>
		<label></label>
		<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id</th>
					<th>Provincia</th>
					<th>Estado</th>
					<th colspan="2"></th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($provincias as $provincia){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="center"><?php echo $provincia["Provi_Codigo"] ?></td>
						<td align="left"><?php echo utf8_encode($provincia["Provi_Descripcion"])?></td>
						<td align="center"><?php if($provincia["Provi_Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
						<td><a href="#" class="enlace_accion" onclick="verSubProceso('editarprovincia','<?php echo $provincia["Provi_Codigo"]?>')">Editar</a></td>
						<td><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el registro?')){Eliminarprovincia('<?php echo $provincia["Provi_Codigo"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}?>
<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{	
	$IdSuc = $_REQUEST['Idsuc'];
	$Id = $_REQUEST['CantidadRegistros'];
	$Nombre = $_REQUEST['Nombre'];
	$Sucursal = $_REQUEST['Sucursal'];
	$Direccion = $_REQUEST['Direccion'];
	$CantidadRegistros = $_REQUEST['CantidadRegistros'];
	$TotalPaginas = $_REQUEST['TotalPaginas'];
	$NumeroPaginas = $_REQUEST['NumeroPaginas'];
	if($IdSuc!=NULL)
	{
		$cantidades=empleadoCantidad($conexion,$IdSuc,$Nombre,$Id);
		$empleados=empleados($conexion,$IdSuc,$Nombre,$Id);
		if($IdSuc!=NULL)
		{
			foreach( $cantidades as $c)
			{
				$Maximo = $c['maximo'];
				$Total = $c['Total'];
				$TotalPaginas = $Total/20;
				$TotalPaginas = floor($TotalPaginas);
			}
			if($TotalPaginas==0)
			{$TotalPaginas = 1;}
		}	
	}
	else
	{
		$IdSuc = 0;
		$Id = 0;
		$Nombre = '';
		$Sucursal = '';
		$Direccion = 1;
		$Maximo = 1;
		$Total = 0;
		$CantidadRegistros  = 0;
		$TotalPaginas = 0;
		$NumeroPaginas = 0;
	}
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarempleados','')">
				<i class="fa fa-user"></i>
				<span>Nuevo empleado</span>
			</a>
		</div>
	</div>
</div>

<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-tags"></i>
				<?php echo 'Empleados';
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
				<label class="control-label">Empleado</label>
				<div class="controls">
					<div class="input-group">
						<input id="VendedorNombre" onkeyup="BusquedaSucursalGen()" class="form-control" type="text" size="16" placeholder="Código Empleado" value="<?php echo $Nombre ?>">
						<input id="VendedorID" type="hidden" value="<?php echo $Id ?>">
						<span class="input-group-btn">
							<button onclick="Buscar('8')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
		</td>
		<td width="3%"></td>
		<td>
			<div class="form-group">
				<label class="control-label">Sucursal</label>
				<div class="controls">
					<div class="input-group">
						<input id="SucursalNombre" class="form-control" type="text" size="16" placeholder="Sucursal" readonly="readonly" value="<?php echo $Sucursal ?>">
						<input type="hidden" id="SucursalID" value="<?php echo $IdSuc ?>">
						<span class="input-group-btn">
							<button class="btn" type="button" onclick="Buscar('0')"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
		</td>
	
		
		  <td> 	
					<button onclick="BuscarEmpleado('1','0','1','0','0')" type="button" class="boton_save" align="left"><i class="fa fa-save"></i> Buscar</button> 	
		  </td>	
		  
		<td width="30%"></td>
		
	</table >

</div>

<div style="width:300px;">

	<br>
	

</div>

<div id="listado">
		<label><?php echo $NumeroPaginas.' de '.$TotalPaginas.' registros' ?></label>
		<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><a href="#" class="enlace_accion" onclick="BuscarEmpleado('<?php echo 0 ?>','<?php echo $TotalPaginas ?>','<?php echo 0 ?>','<?php echo 0 ?>','<?php echo 0 ?>','<?php echo 0 ?>')"><</a></th>
					<th><a href="#" class="enlace_accion" onclick="BuscarEmpleado('<?php echo 0 ?>','<?php echo $TotalPaginas ?>','<?php echo $NumeroPaginas ?>','<?php echo $CantidadRegistros ?>','<?php echo 0 ?>','<?php echo 0 ?>')"><<</a></th>
					<th>Sucursal</th>
					<th>Empleados</th>
					<th>Estado</th>
					<th colspan="2">Acciones</th>
					<th><a href="#" class="enlace_accion" onclick="BuscarEmpleado('<?php echo 1 ?>','<?php echo $TotalPaginas ?>','<?php echo $NumeroPaginas ?>','<?php echo $CantidadRegistros ?>','<?php echo 0 ?>','<?php echo 0 ?>')">>></a></th>
					<th><a href="#" class="enlace_accion" onclick="BuscarEmpleado('<?php echo 1 ?>','<?php echo $TotalPaginas ?>','<?php echo $TotalPaginas - 1 ?>','<?php echo $TotalPaginas - 1 ?>','<?php echo 1 ?>','<?php echo 0 ?>')">></a></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($empleados as $rol){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td></td><td></td>
						<td align="center"><?php echo utf8_encode($rol["Sucursal"])?></td>
						<td align="left"><?php echo $rol["Id"].' - '.utf8_encode($rol["Nombre"])?></td>
						<td><?php if($rol["Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editarempleados','<?php echo $rol["Id"]?>')">Editar</a></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar al empleado?')){Eliminarempleado('<?php echo $rol["Id"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
						<td></td><td></td>	
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}
?>
<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	try{
		$servicios = array();
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		
		foreach($mbd->query('select DISTINCT CodigoServicio, NombreServicio, Estado from servicios ') as $fila) {
			$servicios[$i]['id']=$fila['CodigoServicio'];
			$servicios[$i]['nombre']=$fila['NombreServicio'];
			$servicios[$i]['estado']=$fila['Estado'];
			$i++;
		}
		$mbd = null;
		
	}catch (PDOException $e){
		print "!Error¡:" . $e->getMessage() . "<br>";
		die();
	}
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarservicio','')">
				<i class="fa fa-user"></i>
				<span>Nuevo Servicio</span>
			</a>
		</div>
	</div>
</div>
<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-tags"></i>
				<?php echo 'Servicios';?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div>
	<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Servicios</th>
				<th>Estado</th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($servicios as $servicio){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_modulos_<?php echo $i;?>">
				<td><?php echo $servicio["nombre"]?></td>
				<td align="center"><?php if($servicio["estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editarservicio','<?php echo $servicio["id"]?>')">Editar</a></td>
				<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el modulo?')){EliminarServicio('<?php echo $servicio["id"]?>','tr_modulos_<?php echo $i;?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
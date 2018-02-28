<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	try{
		$descuentos = array();
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		
		foreach($mbd->query('select DISTINCT CodigoDescuento, NombreDescuento, PorcentajeDescuento, Estado from descuentos ') as $fila) {
			$descuentos[$i]['id']=$fila['CodigoDescuento'];
			$descuentos[$i]['nombre']=$fila['NombreDescuento'];
			$descuentos[$i]['Descuento']=$fila['PorcentajeDescuento'];
			$descuentos[$i]['estado']=$fila['Estado'];
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
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editardescuento','')">
				<i class="fa fa-user"></i>
				<span>Nuevo Descuento</span>
			</a>
		</div>
	</div>
</div>
<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-tags"></i>
				<?php echo 'Descuento';?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div>
	<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Descuento</th>
				<th>Estado</th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($descuentos as $descuento){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_modulos_<?php echo $i;?>">
				<td><?php echo $descuento["nombre"]?></td>
				<td align="center"><?php if($descuento["estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editardescuento','<?php echo $descuento["id"]?>')">Editar</a></td>
				<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el modulo?')){EliminarDescuento('<?php echo $descuento["id"]?>','tr_modulos_<?php echo $i;?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$Id = $_REQUEST['id'];
	$Nombre = $_REQUEST['nombre'];
	/*************************************************************************************************************/

	if($Id!=NULL){
		try{
			$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
			$where = "where CodigoMod = '$modulo'";
			
			$i = 0;
			foreach($mbd->query('SELECT CodigoOp, CodigoMod, Nombre, NombrePant, Estado FROM opciones') as $fila) {
				$opciones[$i]['CodigoOp']=$fila['CodigoOp'];
				$opciones[$i]['CodigoMod']=$fila['CodigoMod'];
				$opciones[$i]['Nombre']=$fila['Nombre'];
				$opciones[$i]['NombrePant']=$fila['NombrePant'];
				$opciones[$i]['Estado']=$fila['Estado'];
				$i++;
			}
			$mbd = null;
			
		}catch (PDOException $e){
			print "!Error¡:" . $e->getMessage() . "<br>";
			die();
		}
	}

	/*************************************************************************************************************/
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editaropcion','')">
				<i class="fa fa-user"></i>
				<span>Nueva opci&oacute;n</span>
			</a>
		</div>
	</div>
</div>

<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-tags"></i>
				<?php echo 'Opciones';
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
				<label class="control-label">M&oacute;dulos</label>
				<div class="controls">
					<div class="input-group">
						<input id="ModuloNombre" readonly="readonly" class="form-control" type="text" size="16" placeholder="Módulos" value="<?php echo $Nombre ?>">
						<input id="ModuloID" type="hidden" value="<?php echo $Id ?>">
						<span class="input-group-btn">
							<button onclick="Buscar('14','B&uacute;squeda de m&oacute;dulos')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
		</td>
		
		  <td align="right" width="5%"> 	
					<button onclick="BuscarOpciones()" type="button" class="boton_save" align="right"><!--<i class="fa fa-save"></i>-->Buscar</button> 	
		  </td>	
		  
		<td width="60%"></td>
		
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
					<th>Opci&oacute;n</th>
					<th>Estado</th>
					<th colspan="2">Acciones</th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($opciones as $opcion){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="center"><?php echo $opcion["CodigoOp"] ?></td>
						<td align="left"><?php echo utf8_encode($opcion["Nombre"])?></td>
						<td align="center"><?php if($opcion["Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editaropcion','<?php echo $opcion["CodigoOp"]?>')">Editar</a></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar la opcion?')){Eliminaropcion('<?php echo $opcion["CodigoOp"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}?>
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
	try{
		$where = "where CodigoMod = '$modulo'";
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		$cursos=array();
		$i = 0;
		foreach($mbd->query('SELECT CodigoCurso, c.CodigoNivel as CodigoNivel, NombreCurso, NombreNivel, c.Estado as Estado FROM cursos c inner join niveleducacion n on c.CodigoNivel = n.CodigoNivel') as $fila) {
			$cursos[$i]['id']=$fila['CodigoCurso'];
			$cursos[$i]['nivel']=$fila['CodigoNivel'];
			$cursos[$i]['NombreCurso']=$fila['NombreCurso'];
			$cursos[$i]['NombreNivel']=$fila['NombreNivel'];
			$cursos[$i]['Estado']=$fila['Estado'];
			$i++;
		}
		$mbd = null;
		
	}catch (PDOException $e){
		print "!Error¡:" . $e->getMessage() . "<br>";
		die();
	}

	/*************************************************************************************************************/
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarcursos','')">
				<i class="fa fa-user"></i>
				<span>Nuevo Curso</span>
			</a>
		</div>
	</div>
</div>

<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-tags"></i>
				<?php echo 'Cursos';
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
				<label class="control-label">Cursos</label>
				<div class="controls">
					<div class="input-group">
						<input id="NivelNombre" readonly="readonly" class="form-control" type="text" size="16" placeholder="Niveles" value="<?php echo $Nombre ?>">
						<input id="NivelID" type="hidden" value="<?php echo $Id ?>">
						<span class="input-group-btn">
							<button onclick="Buscar('14','B&uacute;squeda de niveles')" id="bt_niveles" class="btn" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
		</td>
		
		  <td align="right" width="5%"> 	
					<button onclick="BuscarCursos()" type="button" class="boton_save" align="right"><!--<i class="fa fa-save"></i>-->Buscar</button> 	
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
					<th>Descripci&oacute;n</th>
					<th>Nivel de educaci&oacute;n</th>
					<th>Estado</th>
					<th colspan="2">Acciones</th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($cursos as $curso){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="center"><?php echo $curso["id"] ?></td>
						<td align="left"><?php echo utf8_encode($curso["NombreCurso"])?></td>
						<td align="left"><?php echo utf8_encode($curso["NombreNivel"])?></td>
						<td align="center"><?php if($curso["Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editarcursos','<?php echo $curso["CodigoOp"]?>')">Editar</a></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar la opcion?')){Eliminarcursos('<?php echo $curso["CodigoOp"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}?>
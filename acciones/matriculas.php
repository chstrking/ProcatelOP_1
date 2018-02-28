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
	$alumnos=array();
	//if($Id!=NULL){
		try{
			$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
//$where = "where CONCAT(primerapellido,CONCAT(segundoapellido,nombre)) like '$Nombre'";
			
			$i = 0;
			foreach($mbd->query("SELECT identificacion, CONCAT(CONCAT(primerapellido,' '),CONCAT(CONCAT(segundoapellido,' '),CONCAT(nombre,' '))) as Nombre, Estado FROM alumno") as $fila) {
				$alumnos[$i]['id']=$fila['identificacion'];
				$alumnos[$i]['Nombre']=$fila['Nombre'];
				$alumnos[$i]['Estado']=$fila['Estado'];
				$i++;
			}
			$mbd = null;
			
		}catch (PDOException $e){
			print "!Error¡:" . $e->getMessage() . "<br>";
			die();
		}
	//}

	/*************************************************************************************************************/
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('Registro_alumno','')">
				<i class="fa fa-user"></i>
				<span>Registro de alumno</span>
			</a>
		</div>
	</div>
</div>

<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-tags"></i>
				<?php echo 'Matriculaci&oacute;n';
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
				<label class="control-label">Alumnos</label>
				<div class="controls">
					<div class="input-group">
						<input id="AlumnoNombre" readonly="readonly" class="form-control" type="text" size="16" placeholder="Nombre Alumno" value="<?php echo $Nombre ?>">
						<input id="AlumnoID" type="hidden" value="<?php echo $Id ?>">
						<span class="input-group-btn">
							<button onclick="Buscar('14','B&uacute;squeda de alumnos')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
		</td>
		
		  <td align="right" width="5%"> 	
					<button onclick="Buscaralumnos()" type="button" class="boton_save" align="right"><!--<i class="fa fa-save"></i>-->Buscar</button> 	
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
					<th>Identificaci&oacute;n</th>
					<th>Alumno</th>
					<th>Estado</th>
					<th colspan="2">Acciones</th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($alumnos as $alumno){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="center"><?php echo $alumno["id"] ?></td>
						<td align="left"><?php echo utf8_encode($alumno["Nombre"])?></td>
						<td align="center"><?php if($alumno["Estado"]==1){?>APROBADO<?php }else{?>REPROBADO<?php }?></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('Matricular_alumno','<?php echo $alumno["id"]?>')">Matricular</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
		</table>
		
</div>
<?php
}?>
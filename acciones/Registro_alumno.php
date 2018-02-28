<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	if(isset($_GET['NombreClte']))
	{
		if(isset($_GET["ClienteID"])) 
		{
			$Clte_codigo=$_GET["ClienteID"];
		}
		else
		{
			$Clte_codigo='';
		}
		if($Clte_codigo=='')
		{
			$Clte_codigo='0';
		}
		$Clte_nombre=$_GET["NombreClte"];
		$Clte_cedula=$_GET["cedula"];
		$Clte_direccion=$_GET["Direccion"];
		$Clte_ciudad=$_GET["CiudadID"];
		$Clte_zona=$_GET["ZonaID"];
		$Clte_telefono=$_GET["Telefono"];
		$Clte_fax=$_GET["Fax"];
		$Clte_mail=$_GET["Mail"];
		$Clte_tipon=$_GET["TipoNID"];
		$Clte_vendedor=$_GET["VendedorID"];
		$Clte_cupoc=$_GET["cupoc"];
		$Clte_cupou=$_GET["cupou"];
		$Clte_tipoc=$_GET["TipoCID"];
		$Clte_cuenta=$_GET["CContID"];
		$Clte_nota='F';
		$Clte_observacion='Buen cliente';
		$Clte_foto='No hay';
		$Clte_tipo='C';
		$Clte_Fecha=date('d-m-Y');
		$Clte_Aut='1';
		$Clte_Suc='1';
		$Clte_Empresa='1';
		//$respuesta= savecliente($conexion,$Clte_Empresa,$Clte_tipo,$Clte_cedula,$Clte_nombre,$Clte_telefono,$Clte_direccion,$Clte_ciudad,$Clte_zona,$Clte_telefono,$Clte_fax,$Clte_mail,$Clte_tipon,$Clte_vendedor,$Clte_nota,$Clte_observacion,$Clte_foto,$Clte_cupoc,$Clte_cupou,$Clte_tipoc,$Clte_cuenta,$Clte_Fecha,$Clte_Aut,$Clte_Suc);
	}
	else
	{
		if($id=='')
		{
			$usuario=array('id'=>'','fecha_ingreso'=>'','fecha_vencimiento'=>'','estado'=>1,'cod_empleado'=>'');
			$tipo='I';
		}
		else
		{
			//$usuario=getusuario($conexion,$id);
			$tipo='M';
		}
	}
	//var_dump();
	
?>
<div class="row">
  <div class="col-sm-5">
   <div class="panel">
	<div class="panel-heading"><i class="fa fa-users"></i> Alumno</div>
	<table class="table">
		<tbody>
			<tr>
				<td>
					<?php if(isset($_GET['NombreClte'])){ ?>
					<h5>El cliente se guardo de manera exitosa</h5>
					<?php } ?>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table">
		<tbody>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="NombreClte" class="form-control" type="text" size="16" placeholder="Nombre">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="NombreClte" class="form-control" type="text" size="16" placeholder="Primer apellido">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="NombreClte" class="form-control" type="text" size="16" placeholder="Segundo apellido">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">Tipo de documento</label>
						<div class="controls">
							<select id="estado" class="form-control">
								<option value="01" <?php if($usuario["estado"]==1){?>selected<?php }?>>C&eacute;dula</option>
								<option value="02" <?php if($usuario["estado"]==0){?>selected<?php }?>>Ruc</option>
								<option value="03" <?php if($usuario["estado"]==1){?>selected<?php }?>>Pasaporte</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="NombreClte" class="form-control" type="text" size="16" placeholder="Identificaci&oacute;n">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="Direccion" class="form-control" type="text" size="16" placeholder="Dirección">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<div class="input-group">
								<input id="CiudadNombre" class="form-control" type="text" size="16" placeholder="Pais" readonly="readonly">
								<input type="hidden" id="CiudadID" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('5')" id="bt_cliente" class="btn" type="button"><i class="fa fa-search"></i></button>
								</span> 
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<div class="input-group">
								<input id="ZonaNombre" class="form-control" type="text" size="16" placeholder="Ciudad" readonly="readonly">
								<input type="hidden" id="ZonaID" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('6')" id="bt_cliente" class="btn" type="button"><i class="fa fa-search"></i></button>
								</span> 
							</div>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
   </div>
  <div class="col-sm-5">
   <div class="panel">
	<div class="panel-heading"><i class="fa fa-users"></i> Info. adicional</div>
	<table class="table">
		<tbody>
			<tr>
				<td>
					<?php if(isset($_GET['NombreClte'])){ ?>
					<h5>El cliente se guardo de manera exitosa</h5>
					<?php } ?>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table">
		<tbody>			
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">Sexo</label>
						<div class="controls">
							<select id="estado" class="form-control">
								<option value="M" <?php if($usuario["estado"]==1){?>selected<?php }?>>Masculino</option>
								<option value="F" <?php if($usuario["estado"]==0){?>selected<?php }?>>Femenino</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<div class="controls">
								<textarea id="Enfermedad" cols="10" rows="5" class="form-control" type="text" size="16" placeholder="Sufre de alguna enfermedad?"></textarea>
							</div>
						</div>
					</div>
				</td>
			</tr>	
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">Tipo de sangre</label>
						<div class="controls">
							<select id="estado" class="form-control">
								<option value="0" <?php if($usuario["estado"]==1){?>selected<?php }?>>O+</option>
								<option value="1" <?php if($usuario["estado"]==0){?>selected<?php }?>>H1N1</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">Estado</label>
						<div class="controls">
							<select id="estado" class="form-control">
								<option value="1" <?php if($usuario["estado"]==1){?>selected<?php }?>>Activo</option>
								<option value="0" <?php if($usuario["estado"]==0){?>selected<?php }?>>Inactivo</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<button class="boton_save" type="button" onclick="GuardarCliente()"><i class="fa fa-save"></i> Guardar</button> 
						</div>
					</div>	
				</td>
			</tr>						
		</tbody>
	</table>
	</div>
   </div>
  <div class="col-sm-10">
	<div class="panel-heading"><i class="fa fa-users"></i> Familiares</div>
	<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Relaci&oacute;n</th>
					<th>Apellidos, Nombres</th>
					<th colspan="2">Acciones</th></tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				<?php foreach($opciones as $opcion){?>
					<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_roles_<?php echo $i;?>">
						<td align="center"><?php echo $opcion["CodigoOp"] ?></td>
						<td align="left"><?php echo utf8_encode($opcion["Nombre"])?></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editaropcion','<?php echo $opcion["CodigoOp"]?>')">Editar</a></td>
						<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar la opcion?')){Eliminaropcion('<?php echo $opcion["CodigoOp"]?>','tr_roles_<?php echo $i;?>')}">Eliminar</a></td>
					</tr>
				<?php $i++;?>
				<?php }?>
			</tbody>
	</table>
	<tr>
		<td>
		</td>
	</tr>
	<table width="100%">
		<tr>
			<td>
				<div class="form-group">
					<div class="controls">
						<button class="boton_save" type="button" onclick="GuardarCliente()"><i class="fa fa-save"></i> Guardar</button> 
					</div>
				</div>	
			</td>
		</tr>
		<tr>
			<td>
			</td>
		</tr>
	</table>
	<br>
	<table class="table" width="100%">
	  <tbody width="100%">
		<tr>
			<td>
				<div class="form-group">
					<div class="controls">
						<div class="controls">
							<textarea id="Observaciones" cols="10" rows="5" class="form-control" type="text" size="16" placeholder="Observaciones"></textarea>
						</div>
					</div>
				</div>
			</td>
		</tr>		
	  </tbody>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
  </div>
  </div>
<?php }?>
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
  <div class="col-sm-4">
   <div class="panel">
	<div class="panel-heading"><i class="fa fa-users"></i>Clientes</div>
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
							<label class="control-label">Cliente</label>
							<div class="input-group">
								<input id="ClienteNombre" class="form-control" type="text" size="16" placeholder="Código" readonly="readonly">
								<input type="hidden" id="ClienteID" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('2')" id="bt_cliente" class="btn" type="button"><i class="fa fa-search"></i></button>
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
							<input id="NombreClte" class="form-control" type="text" size="16" placeholder="Nombre">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="cedula" class="form-control" type="text" size="16" placeholder="RUC/Cédula">
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
								<input id="CiudadNombre" class="form-control" type="text" size="16" placeholder="Ciudad" readonly="readonly">
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
								<input id="ZonaNombre" class="form-control" type="text" size="16" placeholder="Zona" readonly="readonly">
								<input type="hidden" id="ZonaID" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('6')" id="bt_cliente" class="btn" type="button"><i class="fa fa-search"></i></button>
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
							<input id="Telefono" class="form-control" type="text" size="16" placeholder="Teléfono">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="Fax" class="form-control" type="text" size="16" placeholder="Fáx">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<input id="Mail" class="form-control" type="text" size="16" placeholder="E-mail">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<div class="input-group">
								<input id="TipoNNombre" class="form-control" type="text" size="16" placeholder="Tipo negocio" readonly="readonly">
								<input id="TipoNID" type="hidden" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('7')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
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
								<input id="VendedorNombre" class="form-control" type="text" size="16" placeholder="Vendedor" readonly="readonly">
								<input id="VendedorID" type="hidden" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('8')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
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
								<input id="TipoCNombre" class="form-control" type="text" size="16" placeholder="Tipo Cliente" readonly="readonly">
								<input id="TipoCID" type="hidden" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('9')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
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
								<input id="CContNombre" class="form-control" type="text" size="16" placeholder="Cta. Contable" readonly="readonly">
								<input id="CContID" type="hidden" value="">
								<span class="input-group-btn">
									<button onclick="Buscar('10')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
								</span>
							</div>
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
</div>
<?php }?>
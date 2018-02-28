<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	$IdPais= $_REQUEST['idpais'];
	$Nombre = $_REQUEST['nombre'];
	if($id=='')
	{
		$disabledEstado = 'disabled';
		$Titulo = 'Crear';
	}
	else
	{
		$provincias=provincia($conexion,0,$Id);
		$Titulo = 'Editar';
		$disabledmodulo = 'disabled';
	}
	
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Provincia</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Provincia</label>
							<div class="controls">
								<div class="input-group">
									<input id="NombreProvincia" class="form-control" type="text" maxlength="50" size="50" placeholder="Nombre provincia" width="400px" value="<?php echo $opcion["nombre"]?>">
									<input type="hidden" id="id" value="<?php echo $id ?>">
								</div>
							</div>
						</div>
					
					</td>
					
				</tr>
				
				<tr>
				
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
					
				</tr>
				
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label" for="selectError3">Estado</label>
							<div class="controls">
								<select id="estado" name="estado" class="form-control" <?php echo $disabledEstado?>>
									<option value="1" <?php if($opcion["estado"]==1){?>selected<?php }?>>Activo</option>
									<option value="0" <?php if($opcion["estado"]==0){?>selected<?php }?>>Inactivo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr>
					<td><div class="boton_save" onclick="GuardarProvincia()">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
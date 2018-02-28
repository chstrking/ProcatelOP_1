<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	if($id=='')
	{
		$disabledEstado = 'disabled';
		$Titulo = 'Crear';
		$id=0;
	}
	else
	{
		$paises=pais($conexion,$id);
		$Titulo = 'Editar';
	}
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> tipo Pa&iacute;s</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Pa&iacute;s</label>
							<div class="controls">
								<div class="input-group">
									<input id="nombre" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" maxlength="50" size="50" placeholder="País" width="400px" value="<?php echo $paises[0]["Pais_Descripcion"]?>">
									<input type="hidden" id="id" value="<?php echo $id ?>">
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
									<option value="1" <?php if($paises[0]["Pais_Estado"]==1){?>selected<?php }?>>Activo</option>
									<option value="0" <?php if($paises[0]["Pais_Estado"]==0){?>selected<?php }?>>Inactivo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr>
					<td><div class="boton_save" onclick="GuardarPais()">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
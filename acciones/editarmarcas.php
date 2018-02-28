<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	//var_dump($id);
	if($id=='')
	{
		$disabledEstado = 'disabled';
		$Titulo = 'Crear';
		$id=0;
	}
	else
	{
		$marca=marca($conexion,$id);
		$Titulo = 'Editar';
		//var_dump($marca);
	}
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Marcas</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Marca</label>
							<div class="controls">
								<div class="input-group">
									<input id="NombreTmarca" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" maxlength="50" size="50" placeholder="Nombre Cargo" width="400px" value="<?php echo $marca [0]["Mar_Descripcion"]?>">
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
									<option value="1" <?php if($marca[0]["Mar_Estado"]==1){?>selected<?php }?>>Activo</option>
									<option value="0" <?php if($marca[0]["Mar_Estado"]==0){?>selected<?php }?>>Inactivo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr>
					<td><div class="boton_save" onclick="Guardarmarca()">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	if($id==0)
	{
		$disabledEstado = 'disabled';
		$Titulo = 'Crear';
		$id=0;
	}
	else
	{
		$bodegas=bodegas($conexion,$id);
		$Titulo = 'Editar';
	}
	
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Bodega</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<label class="control-label">Bodega</label>
								<input id="BodegaNombre" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Bodega" value="<?php echo $bodegas [0]["Bod_Descripcion"]?>">
								<input type="hidden" id="BodegaID" value="<?php echo $bodegas [0]["Bod_Codigo"]?>">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label">Responsable</label>
						<div class="controls">
							<div class="input-group">
								<input id="VendedorNombre" class="form-control" type="text" size="16" placeholder="Responsable" readonly="readonly" value="<?php echo $bodegas [0]["Nombre"]?>">
								<input id="VendedorID" type="hidden" value="<?php echo $bodegas [0]["Bod_CodRespEmpl"]?>">
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
							<input id="Ubicacion" onkeyup = "this.value=this.value.toUpperCase()" class="form-control" type="text" size="16" placeholder="Ubicacion" value="<?php echo $bodegas [0]["Bod_Ubicacion"]?>">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<label class="control-label" for="selectError3">Estado</label>
						<div class="controls">
							<select id="estado" class="form-control" <?php echo $disabledEstado?>>
								<option value="1" <?php if($bodegas[0]["estado"]==1){?>selected<?php }?>>Activo</option>
								<option value="0" <?php if($bodegas[0]["estado"]==0){?>selected<?php }?>>Inactivo</option>
							</select> 
						</div>
					</div>	
				</td>
			</tr>

				<tr>
					<td><div class="boton_save" onclick="GuardarBodega()">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
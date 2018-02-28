<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	if(empty($id))
	{
		$disabledEstado = 'disabled';
		$Titulo = 'Crear';
		$Estado=1;
	}
	else
	{
		//$opcion=getopcion($conexion,$id);
		$Titulo = 'Editar';
		$disabled = 'disabled';
		try{
			$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
			$where = "where CodigoServicio = '$id'";
			//print('SELECT CodigoOp,o.CodigoMod as CodigoMod, o.Nombre, NombrePant, o.Estado, m.Nombre as Modulo FROM opciones o inner join modulos m on m.CodigoOp = o.CodigoOp '.$where);
			foreach($mbd->query('select DISTINCT CodigoServicio, NombreServicio, TipoCobro, Estado from servicios  '.$where) as $fila) {
				$nombre=$fila['NombreServicio'];
				$TipoCobro=$fila['TipoCobro'];
				$Estado=$fila['Estado'];
			}
			$mbd = null;
			
		}catch (PDOException $e){
			print "!Error¡:" . $e->getMessage() . "<br>";
			die();
		}
	}
	
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Servicios</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Servicios</label>
							<div class="controls">
								<div class="input-group">
									<input id="NombreServicio" class="form-control" type="text" maxlength="50" size="50" placeholder="Nombre Servicio" width="400px" value="<?php echo $nombre?>">
									<input type="hidden" id="id" value="<?php echo $id ?>">
								</div>
							</div>
						</div>
					
					</td>
					
				</tr>
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label" for="selectError3">Tipo de cobro</label>
							<div class="controls">
								<select id="estado" name="estado" class="form-control" <?php echo $disabledEstado?>>
									<option value="1" <?php if($TipoCobro==1){?>selected<?php }?>>Anual</option>
									<option value="8" <?php if($TipoCobro==8){?>selected<?php }?>>Mensual</option>
									<option value="3" <?php if($TipoCobro==3){?>selected<?php }?>>Trimestral</option>
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
								<select id="estado" name="estado" class="form-control" <?php echo $disabled?>>
									<option value="1" <?php if($Estado==1){?>selected<?php }?>>Activo</option>
									<option value="0" <?php if($Estado==0){?>selected<?php }?>>Inactivo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr height="50px">
					<td><div class="boton_save" onclick="GuardarServicio()" height="40px">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
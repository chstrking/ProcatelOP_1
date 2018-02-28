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
		$disabledmodulo = 'disabled';
		try{
			$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
			$where = "where CodigoOp = '$id'";
			//print('SELECT CodigoOp,o.CodigoMod as CodigoMod, o.Nombre, NombrePant, o.Estado, m.Nombre as Modulo FROM opciones o inner join modulos m on m.CodigoOp = o.CodigoOp '.$where);
			foreach($mbd->query('SELECT CodigoOp,o.CodigoMod as CodigoMod, o.Nombre, NombrePant, o.Estado, m.Nombre as Modulo FROM opciones o inner join modulos m on m.CodigoMod = o.CodigoMod '.$where) as $fila) {
				$nombre=$fila['Nombre'];
				$NombrePant=$fila['NombrePant'];
				$Estado=$fila['Estado'];
				$idMod=$fila['CodigoMod'];
				$NombreMod=$fila['Modulo'];
			}
			$mbd = null;
			
		}catch (PDOException $e){
			print "!Error¡:" . $e->getMessage() . "<br>";
			die();
		}
	}
	
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> Cursos</div>
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">Cursos</label>
							<div class="controls">
								<div class="input-group">
									<input id="NombreOpcion" class="form-control" type="text" maxlength="50" size="50" placeholder="Nombre Opción" width="400px" value="<?php echo $nombre?>">
									<input type="hidden" id="id" value="<?php echo $id ?>">
								</div>
							</div>
						</div>
					
					</td>
					
				</tr>
				
				<tr>
				
					<td>
						<div class="form-group">
							<label class="control-label">Niveles de educac&iacute;n</label>
							<div class="controls">
								<div class="input-group">
									<input id="NivelesNombre" readonly="readonly" class="form-control" type="text" size="16" placeholder="Niveles" value="<?php echo $NombreMod ?>">
									<input id="NivelesID" type="hidden" value="<?php echo $idMod ?>">
									<span class="input-group-btn">
										<button onclick="Buscar('14','B&usqueda de niveles de educac&iacute')" id="bt_vendedor" class="btn" type="button"><i class="fa fa-search"></i></button>
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
									<option value="1" <?php if($Estado==1){?>selected<?php }?>>Activo</option>
									<option value="0" <?php if($Estado==0){?>selected<?php }?>>Inactivo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr height="50px">
					<td><div class="boton_save" onclick="GuardarCurso()" height="40px">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
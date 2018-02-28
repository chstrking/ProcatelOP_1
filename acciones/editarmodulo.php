<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	if(!empty($id)){
		try{
			$modulos = array();
			$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
			//$where = "where CodigoMod = '$modulo' and CodigoRol = '$rol'";
			$where = "where CodigoMod = '$id' ";
			
			foreach($mbd->query('select DISTINCT CodigoMod, Nombre, Estado from modulos '. $where) as $fila) {
				$Nombre=$fila['Nombre'];
				$Estado=$fila['Estado'];
				$i++;
			}
			$mbd = null;
			
		}catch (PDOException $e){
			print "!Error¡:" . $e->getMessage() . "<br>";
			die();
		}
	}else{
		$id=0;
		$Nombre="";
		$Estado=1;
		$disabledEstado="disabled";
	}
?>
<div class="area_editar">
	<div class="cabecera_editar" align="left"><i class="fa fa-tags"></i><?php echo $Titulo ?> M&oacute;dulo</div>
	<!--<table  cellpadding="5" cellspacing="10" width="100%"><tbody></tbody>-->
		<table class="table">	
		
			<table class="col-sm-4">
			
				<tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label">M&oacute;dulo</label>
							<div class="controls">
								<div class="input-group">
									<input id="NombreModulo" class="form-control" type="text" size="50" maxlength="50" placeholder="Nombre módulo" width="400px" value="<?php echo $Nombre?>">
									<input type="hidden" id="id" value="<?php echo $id;?>">
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
									<option value="0" <?php if($Estado==0){?>selected<?php }?>>Inactivo</option>
									<option value="1" <?php if($Estado==1){?>selected<?php }?>>Activo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>

				<tr>
					<td><div class="boton_save" onclick="GuardarModulo()">Guardar</div></td>
					<td></td>
				</tr>
				
			</table>	
			
		</table>
</div>
<?php }?>
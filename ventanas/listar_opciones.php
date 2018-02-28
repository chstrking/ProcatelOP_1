<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();
//$tipoproducto=$_GET['tipoproducto'];
if(isset($_SESSION['usuario'])) 
{
	$rol = $_SESSION['CodigoUsuarioRol'];
	$admin = S_SESSION['Administrador'];
	$lista_opciones=array();//opciones_totales($conexion);
	$opciones_rol=array();//opciones_rol($conexion,$rol_id);
	
	try{
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		i=0;
		//foreach($mbd->query('select DISTINCT CodigoMod, Modulos, CodigoOp, Opciones, CodigoAc, Acciones from vi_accesos ') as $fila) {
		foreach($mbd->query('select DISTINCT CodigoMod, Modulos, CodigoOp, Opciones from vi_accesos ') as $fila) {
			$lista_opciones[$i]['CodigoModulo']=$fila['CodigoMod'];
			$lista_opciones[$i]['NombreModulo']=$fila['Modulos'];
			$lista_opciones[$i]['CodigoOpcion']=$fila['CodigoOp'];
			$lista_opciones[$i]['NombreOpcion']=$fila['Opciones'];			
			//$lista_opciones[$i]['CodigoAcciones']=$fila['CodigoAc'];
			//$lista_opciones[$i]['NombreAcciones']=$fila['Acciones'];
			$i++;
		}
		$mbd = null;
		
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		$where = "";
		if($admin!=1){
			$where = "where CodigoRol = '$rol'";
		
			i=0;
			foreach($mbd->query('select DISTINCT CodigoOp from vi_accesos '. $where) as $fila) {
				$modulos[$i]['CodigoOpcion']=$fila['CodigoOp'];
				$i++;
			}
			$mbd = null;
		}
		else{
			$opciones_rol = stripslashes($lista_opciones);
			$opciones_rol = urldecode($lista_opciones);
			$opciones_rol = unserialize($lista_opciones); 
		}
		
	}catch (PDOException $e){
		print "!Error¡:" . $e->getMessage() . "<br>";
		die();
	}
	
?>
<div id="contenedor_pasos" style="overflow-y: scroll;">
<div class="titulo_popup">
	Permisos por roles
</div>
<table class="tabla_detalle" width="100%" cellspacing="0" cellpadding="0">
	<thead>
		<th>M&oacute;dulo</th>
		<th>Opci&oacute;n</th>
		<th></th> 
	</thead>
	<tbody id="detalle_busqueda">
		<?php $i=0;?>
		<?php foreach($lista_opciones as $opcion){ ?>
			<?php $i++;?>
			<tr>
				<td align="center"><?php echo $opcion["NombreModulo"]?></td>
				<td align="center"><?php echo $opcion["NombreOpcion"]?></td>
				<td><input type="hidden" id="modulo_opcion_rol_<?php echo $i;?>" value="<?php echo $opcion["CodigoModulo"]?>"><input id="rol_opcion_<?php echo $i;?>" type="checkbox" <?php foreach($opciones_rol as $opcion_rol){?><?php if($opcion_rol["CodigoOpcion"]==$opcion["CodigoOpcion"]){ echo 'checked="checked"';}?><?php }?> value="<?php echo $opcion["CodigoOpcion"];?>"></td>
			</tr>
		<?php } ?>
		<input type="hidden" id="cant_opciones_rol" value="<?php echo $i;?>">
		<input type="hidden" id="rol_id" value="<?php echo $rol_id;?>">
	</tbody>
</table>
<div class="form-group">
	<div class="controls">
		<button type="button" class="boton_save" onclick="GuardarOpcionesRol()"><i class="fa fa-plus-square"></i>Guardar</button> 
	</div>
</div>
</div>
<?php } ?>
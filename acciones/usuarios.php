<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$opcion=$_SESSION['opcion'];
	//$usuarios=$_SESSION['usuario'];
	//$usuarios=usuarios($conexion);
	
	$usuarios = array();
	$Clave = $_POST['login-password'];
	
	$usuario = $_POST['login-username'];
	
	try{
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		$i = 0;
		
		foreach($mbd->query('select Codigo, u.Nombre, u.Estado, Mail, r.NombreRol from usuarios u inner join roles r on r.CodigoRol = u.CodigoRol ') as $fila) {
			$usuarios[$i]['id'] = $fila['Codigo'];
			$usuarios[$i]['Nombre'] = $fila['Nombre'];
			$usuarios[$i]['Estado'] = $fila['Estado'];
			$usuarios[$i]['Mail'] = $fila['Mail'];
			$usuarios[$i]['Rol'] = $fila['NombreRol'];
			$i++;
		}
		$mbd = null;
		
	}catch (PDOException $e){
		print "!Error¡:" . $e->getMessage() . "<br>";
		die();
	}	
	
?>
<div class="action-nav-normal action-nav-line">
	<div class="row">
		<div class="col-sm-2 action-nav-button">
			<a title="Nuevo Usuario" href="#" onclick="verSubProceso('editarusuario','')">
				<i class="fa fa-user"></i>
				<span>Nuevo Usuario</span>
			</a>
		</div>
	</div>
</div>
<div align="left" style="padding-left:20px;">
	<table>
		<tbody>
			<tr>
				<td class="cabecera_editar"><i class="fa fa-users"></i><?php echo ' Usuarios'?></td>
			</tr>
		</tbody>
	</table>
</div>
<div>
	<table class="tabla_detalle" cellpadding="0" cellspacing="0" width="90%">
		<thead>
			<tr>
				<th>Username</th>
				<th>Rol</th>
				<th>Mail</th>
				<th>Estado</th>
				<th colspan="3">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;?>
			<?php foreach($usuarios as $usuario){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_usuarios_<?php echo $i;?>">
				<td><?php echo $usuario["id"]?></td>
				<td><?php echo $usuario["Rol"]?></td>
				<td><?php echo $usuario["Mail"]?></td>
				<td align="center"><?php if($usuario["Estado"]==1){?>Activo<?php }else{?>Inactivo<?php }?></td>
				<td align="center"><a href="#" class="enlace_accion" onclick="verSubProceso('editarusuario','<?php echo $usuario["id"]?>')">Editar</a></td>
				<td align="center"><a href="#" class="enlace_accion" onclick="if(confirm('Esta seguro que desea eliminar el usuario?')){EliminarUsuario('<?php echo $usuario["id"]?>','tr_usuarios_<?php echo $i;?>')}">Eliminar</a></td>
			</tr>
			<?php $i++;?>
			<?php }?>
		</tbody>
	</table>
</div>
<?php
}
?>
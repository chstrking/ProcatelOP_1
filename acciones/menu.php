<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$usuario=$_SESSION['usuario'];
	$modulos=$_SESSION['modulos'];
	$modulo=$_POST['id_accion'];
	$rol = $_SESSION['CodigoUsuarioRol'];
	$admin = $_SESSION['Administrador'];
	foreach($modulos as $menu)
	{
		if($modulo==$menu["id"])
		{
			$nombre_modulo=$menu["nombre"];
		}
	}

	$opciones = array();
	try{
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		//$where = "where CodigoMod = '$modulo' and CodigoRol = '$rol'";
		$where = "where CodigoMod = '$modulo' ";
		if($admin!=1){
			$where = $where . "and CodigoRol = '$rol'";
		}
		
		foreach($mbd->query('select DISTINCT CodigoOp, Opciones, Pantalla from vi_accesos '. $where) as $fila) {
			$opciones[$i]['id']=$fila['CodigoOp'];
			$opciones[$i]['nombre']=$fila['Opciones'];
			$opciones[$i]['proceso']=$fila['Pantalla'];
			$i++;
		}
		$mbd = null;
		
	}catch (PDOException $e){
		print "!Error¡:" . $e->getMessage() . "<br>";
		die();
	}
	
?>
	<div class="logo_menu"><?php echo $nombre_modulo;?></div>
	<?php $i=1;
	$id_opcion=0;
	$nombre_opcion="";
	$class_name="";
	$proceso="";
	?>
	<ul class="nav nav-tabs nav-stacked main-menu">
	<?php foreach($opciones as $menu){?>
		<?php if($i==1){$class_name="active";$proceso=$menu["proceso"];$id_opcion=$menu["id"];$nombre_opcion=$menu["nombre"];}?>
		<li class="<?php echo $class_name;?>" id="menu_<?php echo $i;?>" onclick="verProceso('<?php echo $menu["proceso"];?>','menu_<?php echo $i;?>',true,'<?php echo $menu["nombre"];?>')"><a href="#"><i class="fa fa-home icon"></i><span class="hidden-sm"><?php echo $menu["nombre"];?></span></a></li>
		<?php $i++;
		$class_name="";
		?>
	<?php }?>
	</ul>
	<?php $_SESSION['opcion']=array('id'=>$id_opcion,'nombre'=>$nombre_opcion);?>
	<script>
			verProceso('<?php echo $proceso;?>','menu_1',false);
	</script>
<?php } ?>

<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	//$sucursal=$_POST["sucursal"];

	try{
		
		$tipobusqueda=$_POST["tipobusqueda"];
		$parambusq=$_POST["busqueda"];
		if($tipobusqueda=="D")
		{
			//$busqueda=$_POST["busqueda"];
			//$codigo=0;
			$where = "where Estado = 1 and Nombre like '%$parambusq%'";
		}
		else
		{
			//$busqueda="";
			//$codigo=$_POST["busqueda"];
			$where = "where Estado = 1 and CodigoMod = '$parambusq'";
		}
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		
		$i = 0;
		foreach($mbd->query('SELECT CodigoMod, Nombre FROM modulos '.$where) as $fila) {
			$modulos[$i]['CodigoMod']=$fila['CodigoMod'];
			$modulos[$i]['Nombre']=$fila['Nombre'];
			$i++;
		}
		$mbd = null;
		
	}catch (PDOException $e){
		print "!Error¡:" . $e->getMessage() . "<br>";
		die();
	}
	//$respuestas=find_modulo($conexion,$tipobusqueda,$codigo,$busqueda);
?>
<?php if(count($modulos)!=0){?>
	<?php $i=1;?>
	<?php foreach($modulos as $respuesta){?>
			<tr class="<?php if($i%2==0){?>par<? }else{ ?>impar<?php }?>">
				<td align="center"><?php echo $respuesta['CodigoMod'];?></td>
				<td align="left"><?php echo utf8_encode($respuesta['Nombre']);?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarModulo('<?php echo $respuesta['CodigoMod'];?>','<?php echo $respuesta['Nombre'];?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
			</tr>
			<?php $i++;?>
	<?php }?>
<?php }else{?>
	<tr>
		<td align="center" colspan="3">No hay datos con esa b&uacute;squeda</td>
	</tr>
<?php }?>
<?php }?>
<script>
	Redimensionar();
</script>
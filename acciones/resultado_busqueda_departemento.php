<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$tipobusqueda=$_POST["tipobusqueda"];
	if($tipobusqueda=="D")
	{
		$busqueda=$_POST["busqueda"];
		$codigo=0;
	}
	else
	{
		$busqueda="";
		$codigo=$_POST["busqueda"];
	}
	$departamento=find_departamento($conexion,$tipobusqueda,$codigo,$busqueda);
	//var_dump($departamento);
?>
<?php if(count($departamento)!=0){?>
	<?php $i=1;?>
	<?php foreach($departamento as $dep){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_dep_<?php echo $i;?>">
				<td align="center"><?php echo $dep["id"];?></td>
				<td align="left"><?php echo utf8_encode($dep["nombre"]);?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarDepartemento('<?php echo $dep['id'];?>','<?php echo $dep['nombre'];?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
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
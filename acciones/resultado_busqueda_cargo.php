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
	$Cargos=find_cargo($conexion,$tipobusqueda,$codigo,$busqueda);
	
?>
<?php if(count($Cargos)!=0){?>
	<?php $i=1;?>
	<?php foreach($Cargos as $Cargo){?>
			<tr class="<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>" id="tr_carg_<?php echo $i;?>">
				<td align="center"><?php echo $Cargo["id"];?></td>
				<td align="left"><?php echo utf8_encode($Cargo["nombre"]);?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarCargo('<?php echo $Cargo['id'];?>','<?php echo $Cargo['nombre'];?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
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
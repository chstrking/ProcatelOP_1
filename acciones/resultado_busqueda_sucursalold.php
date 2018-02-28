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
	$respuestas=find_sucursal($conexion,$tipobusqueda,$codigo,$busqueda);
	//var_dump($respuestas); 
?>
<?php if(count($respuestas)!=0){?>
	<?php $i=1;?>
	<?php foreach($respuestas as $respuesta){?>
			<tr class="<?php if($i%2==0){?>par<? }else{ ?>impar<?php }?>">
				<td align="center"><?php echo $respuesta['Suc_Codigo'];?></td>
				<td align="left"><?php echo utf8_encode($respuesta['Suc_Nombre']);?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarSucursal('<?php echo $respuesta['Suc_Codigo'];?>','<?php echo $respuesta['Suc_Nombre'];?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
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
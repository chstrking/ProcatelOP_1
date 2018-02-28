<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$titulo = $_POST["titulo"];
	$Identificador = $_POST["Num1"];
	$tipobusqueda=$_POST["tipobusqueda"];
	$datoBusqueda=$_POST["busqueda"];
	$descripcion=$_POST["descripcion"];
	$parametros=consultaParametros($conexion,$Identificador);
	$respuestas=consultaGlobal($conexion,$tipobusqueda,$datoBusqueda,$parametros[0]['Valor']);
	//var_dump($respuestas);
?>
<?php if(count($respuestas)!=0){?>
	<?php $i=1;?>
	<?php foreach($respuestas as $respuesta){?>
			<tr class="<?php if($i%2==0){?>par<? }else{ ?>impar<?php }?>">
				<td align="center"><?php echo $respuesta['CODIGO'];?></td>
				<td align="left"><?php echo utf8_encode($respuesta['NOMBRE']);?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarCampos('<?php echo $respuesta['CODIGO'];?>','<?php echo $respuesta['NOMBRE'];?>','<?php echo $titulo;?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
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
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
	//IngresarSucursalGeneral(idsucursal,nombresucursal,direccion,telefono,fax,selectError3,NumAutoRet,SerieRet,NoDesdeRet,NoHastaRet,FechaRet,NumAutoND,SerieND,NoDesdeND,NoHastaND,FechaND,NumAutoNC,SerieNC,NumDesdeNC,NumHastaNC,fechaNC,NumAutoNV,SerieNV,NoDesdeNV,NoHastaNV,FechaNV,NumAutoFac,SerieFac,NumDesdeFac,NumHastaFac,NumActFac,FechaFac)
?>
<?php if(count($respuestas)!=0){?>
	<?php $i=1;?>
	<?php foreach($respuestas as $respuesta){?>
			<tr class="<?php if($i%2==0){?>par<? }else{ ?>impar<?php }?>">
				<td align="center"><?php echo $respuesta['Suc_Codigo'];?></td>
				<td align="left"><?php echo utf8_encode($respuesta['Suc_Nombre']);?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarSucursalGeneral('<?php echo $respuesta['Suc_Codigo'];?>','<?php echo $respuesta['Suc_Nombre'];?>','<?php echo $respuesta['Suc_Direccion'];?>','<?php echo $respuesta['Suc_Telefono'];?>','<?php echo $respuesta['Suc_Fax'];?>','<?php echo $respuesta['Suc_Estado'];?>','<?php echo $respuesta['Suc_NumAutSriR'];?>','<?php echo $respuesta['Suc_SerieR'];?>','<?php echo $respuesta['Suc_DesdeNumR'];?>','<?php echo $respuesta['Suc_HastaNumR'];?>','<?php echo $respuesta['Suc_FecMaxSriR']->format('d-m-Y');?>','<?php echo $respuesta['Suc_NumAutSriND'];?>','<?php echo $respuesta['Suc_SerieND'];?>','<?php echo $respuesta['Suc_DesdeNumND'];?>','<?php echo $respuesta['Suc_HastaNumND'];?>','<?php echo $respuesta['Suc_FecMaxSriND']->format('d-m-Y');?>','<?php echo $respuesta['Suc_NumAutSriNC'];?>','<?php echo $respuesta['Suc_SerieNC'];?>','<?php echo $respuesta['Suc_DesdeNumNC'];?>','<?php echo $respuesta['Suc_HastaNumNC'];?>','<?php echo $respuesta['Suc_FecMaxSriNC']->format('d-m-Y');?>','<?php echo $respuesta['Suc_NumAutSriNV'];?>','<?php echo $respuesta['Suc_SerieNV'];?>','<?php echo $respuesta['Suc_DesdeNumNV'];?>','<?php echo $respuesta['Suc_HastaNumNV'];?>','<?php echo $respuesta['Suc_FecMaxSriNV']->format('d-m-Y');?>','<?php echo $respuesta['Suc_NumAutSriF'];?>','<?php echo $respuesta['Suc_SerieF'];?>','<?php echo $respuesta['Suc_DesdeNumF'];?>','<?php echo $respuesta['Suc_HastaNumF'];?>','<?php echo $respuesta['Suc_ActualNumF'];?>','<?php echo $respuesta['Suc_FecMaxSriF']->format('d-m-Y');?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
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
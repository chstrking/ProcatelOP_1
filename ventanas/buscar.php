<?php
error_reporting(1);
session_start();
//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
	$tipo=$_REQUEST["tipo"];
	$nombre_tipo=$_REQUEST["nombrepant"];
	/*if($tipo=="0")
	{
		$nombre_tipo="Sucursal";
		$respuestas=find_sucursal($conexion,'',0,'');
	}*/
?>
<div class="titulo_popup"> 
	Seleccionar <?php echo $nombre_tipo;?>
</div>
<table class="table">
<tr>
<td width="30%">
<select id="tipobusqueda" class="form-control" disabled="true">
	<option value="D">Por descripci&oacute;n</option>
	<option value="C">Por c&oacute;digo</option>
</select>
</td>
<td>
<input type="text" value="" id="busqueda" <?php if($tipo=="0") {?>onkeyup="BusquedaSucursal()"<?php } ?> <?php if($tipo=="1") {?>onkeyup="BusquedaVendedor()"<?php } ?> <?php if($tipo=="2") {?>onkeyup="BusquedaCliente()"<?php } ?> <?php if($tipo=="3") {?>onkeyup="BusquedaBodegaSucursal()"<?php } ?> <?php if($tipo=="4") {?>onkeyup="BusquedaBodega()"<?php } ?> <?php if($tipo=="5") {?>onkeyup="BusquedaCiudad()"<?php } ?> <?php if($tipo=="6") {?>onkeyup="BusquedaZona()"<?php } ?> <?php if($tipo=="7") {?>onkeyup="BusquedaTipoNegocio()"<?php } ?> <?php if($tipo=="8") {?>onkeyup="BusquedaSucursalGen()"<?php } ?>  <?php if($tipo=="9") {?>onkeyup="BusquedaTipoCliente()"<?php } ?> <?php if($tipo=="10") {?>onkeyup="BusquedaCuentas()"<?php } ?> <?php if($tipo=="11") {?>onkeyup="BusquedaSucursalGeneral()"<?php } ?> <?php if($tipo=="12") {?>onkeyup="BusquedaDepartamento()"<?php } ?> <?php if($tipo=="13") {?>onkeyup="BusquedaCargo()"<?php } ?> <?php if($tipo=="14") {?>onkeyup="BusquedaModulo()"<?php } ?> <?php if($tipo=="15") {?>onkeyup="BusquedaDivision()"<?php } ?> <?php if($tipo=="16") {?>onkeyup="BusquedaUsuario()"<?php } ?> <?php if($tipo=="17") {?>onkeyup="BusquedaPais()"<?php } ?> <?php if($tipo=="18") {?>onkeyup="BusquedaTipoProducto()"<?php } ?><?php if($tipo=="19") {?>onkeyup="BusquedaMarca()"<?php } ?><?php if($tipo=="20") {?>onkeyup="BusquedaProducto()"<?php } ?> <?php if($tipo=="21") {?>onkeyup="BusquedaTecnologia()"<?php } ?> <?php if($tipo=="22") {?>onkeyup="BusquedaPrecio()"<?php } ?> <?php if($tipo=="23") {?>onkeyup="BusquedaBodega1()"<?php } ?> <?php if($tipo=="24") {?>onkeyup="BusquedaCuentaPadre()"<?php } ?> <?php if($tipo=="25") {?>onkeyup="BusquedaCuentasDesde()"<?php } ?> <?php if($tipo=="26") {?>onkeyup="BusquedaCuentasHasta()"<?php } ?> <?php if($tipo=="27") {?>onkeyup="BusquedaSucursal3()"<?php } ?> <?php if($tipo=="28") {?>onkeyup="BusquedaCajasUsuarios()"<?php } ?> <?php if($tipo=="29") {?>onkeyup="BusquedaProveedor()"<?php } ?> class="form-control" placeholder="Busqueda" size="16">
</td>
</tr>
</table>
<table class="tabla_detalle" width="100%" cellspacing="0" cellpadding="0">
<thead>
	<th>Codigo</th>
	<th>Nombre</th>
	<th></th>
</thead>
<tbody id="detalle_busqueda">
	<?php if($tipo=="0"){ ?>
		<?php foreach($respuestas as $respuesta):?>
			<tr>
				<td align="center"><?php echo $respuesta['id'];?></td>
				<td align="left"><?php echo $respuesta['nombre'];?></td>
				<td><button id="detalle_facturacion" class="boton_save boton_icon" type="button" onclick="IngresarSucursal('<?php echo $respuesta['id'];?>','<?php echo $respuesta['nombre'];?>')" title="Seleccionar"><i class="fa fa-check-square-o"></i></button></td>
			</tr>
		<?php endforeach;?>
	<?php } ?>
</tbody>
</table>
<script>
	Redimensionar();
</script>
<?php } ?> 
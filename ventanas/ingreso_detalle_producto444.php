<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
	$busqueda="";
	$codigo_producto=$_REQUEST["idproducto"];
	$codigo_categoria=$_REQUEST["tipoproducto"];
	$respuestas=buscarproducto($conexion,$codigo_producto,$busqueda,$codigo_categoria,1);
?>
	<?php foreach($respuestas as $respuesta){?>
	<div class="titulo_popup">
		Ingresar Detalle de Producto
	</div>
	<div class="form-group">
		<label>C&oacute;digo</label>
		<div class="controls">
			<input id="codigo" class="form-control" type="text" placeholder="Codigo" size="16" readonly="readonly" value="<?php echo $respuesta['Pro_Codigo'];?>">
		</div>
	</div>
	<div class="form-group">
		<label>Producto</label>
		<div class="controls">
			<input id="descripcion" class="form-control" type="text" placeholder="Producto" size="16" readonly="readonly" value="<?php echo $respuesta['Descripcion'];?>">
		</div>
	</div>
	<div class="form-group">
		<label>Stock</label>
		<div class="controls">
			<input id="stock" class="form-control" type="text" placeholder="Stock" size="16" readonly="readonly" value="<?php echo $respuesta['Dprod_Stock'];?>">
		</div>
	</div>
	<div class="form-group">
		<label>Valor</label>
		<div class="controls">
			<input id="valor" class="form-control" type="text" placeholder="Valor" size="16" readonly="readonly" value="<?php echo $respuesta['Pro_Costo'];?>">
		</div>
	</div>
	<div class="form-group">
		<div class="controls">
			<input id="cantidad" class="form-control" type="text" placeholder="Cantidad*" size="16" value="<?php if(isset($_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']])){?><?php echo $_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]['cantidad'];?><?php }?>" onkeyup="onlyNumbers(this);">
		</div>
	</div>
	<div class="form-group">
		<div class="controls">
			<input id="descuento" class="form-control" type="text" placeholder="Descuento*" size="16" value="<?php if(isset($_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']])){?><?php echo $_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]['descuento'];?><?php }?>" onkeyup="onlyNumbers(this);" maxlength="3">
		</div>
	</div>
	<div class="form-group">
		<div class="controls">
			<input id="numeroserie" class="form-control" type="text" placeholder="Numero de Serie" size="16" value="<?php if(isset($_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']])){?><?php echo $_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]['numeroserie'];?><?php }?>" onkeyup="onlyNumbers(this);">
		</div>
	</div>
	<div class="form-group">
		<div class="controls">
			<input id="numerolinea" class="form-control" type="text" placeholder="Numero de Linea" size="16"  value="<?php if(isset($_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']])){?><?php echo $_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]['numerolinea'];?><?php }?>" onkeyup="onlyNumbers(this);">
		</div>
	</div>
	<div class="form-group">
		<div class="controls">
			<button <?php if(isset($_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']])){?>onclick="Editar_Detalle('<?php echo $respuesta['Pro_Codigo'];?>','<?php echo $_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']]['id_html'];?>')"<?php }else{ ?>onclick="Agregar_Detalle('<?php echo $respuesta['Pro_Codigo'];?>')"<?php } ?> type="button" class="boton_save"><i class="fa fa-plus-square"></i><?php if(isset($_SESSION['detalle_facturacion'][(string)$respuesta['Pro_Codigo']])){?>Editar<?php }else{?>Agregar<?php }?></button> 
		</div>
	</div>
	<?php }?>
<?php } ?>

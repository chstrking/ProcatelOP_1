<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();

if(isset($_SESSION['usuario'])) 
{
	$id=$_GET["id"];
	//var_dump($id);
	if($id=='')
	{
		$disabledEstado = 'disabled';
		$Titulo = 'Crear';
		$id=0;
		$estado=1;
	}
	else
	{
		$productos=productos($conexion,$id);
		$Titulo = 'Editar';
		$estado=$productos[0]["estado"];
	}
	$tipo_productos=tipoventas($conexion);
?>
<div class="row">
	<div class="col-sm-4">
		<div class="panel">
			<div class="panel-heading">Productos</div>
			<table class="table">
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Producto</label>
						<input id="ProductoNombre" onkeyup = "this.value=this.value.toUpperCase()"  class="form-control" type="text" size="16" placeholder="Producto" value="<?php echo $productos[0]["Pro_Dato1"] ?>">
						<input type="hidden" id="ProductoID" value="<?php echo $id ?>">
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Tipo Producto</label>
							<div class="controls"> 
								<select id="tipo_producto" name="tipo_producto" class="form-control">
									<?php foreach($tipo_productos as $tipo_producto):?>
										<option value="<?php echo $tipo_producto['id'];?>"><?php echo $tipo_producto['descripcion'];?></option>
									<?php endforeach;?>
								</select>
							</div>
					    </td>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Marca</label>
						<div class="controls">
							<div class="input-group">
								<input id="MarcaNombre" class="form-control" type="text" size="16" placeholder="Marca" readonly="readonly" value="<?php echo $productos[0]["Mar_Descripcion"] ?>">
								<input type="hidden" id="MarcaID" value="<?php echo $productos[0]["Pro_CodMarca"] ?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('19')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Tecnologia</label>
						<div class="controls">
							<div class="input-group">
								<input id="TecnologiaNombre" class="form-control" type="text" size="16" placeholder="Tecnologia" readonly="readonly" value="<?php echo $productos[0]["Tec_Descripcion"] ?>">
								<input type="hidden" id="TecnologiaID" value="<?php echo $productos[0]["Pro_CodTecnologia"] ?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('21')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Modelo</label>
						<div class="controls">
							<input id="ModeloNombre" onkeyup = "this.value=this.value.toUpperCase()"  class="form-control" type="text" size="16" placeholder="Modelo" value="<?php echo $productos[0]["Pro_Modelo"] ?>">
						</div>
					</div>
				</td>
			 </tr>
			 <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Caracter&iacute;sticas</label>
						<div class="controls">
							<input id="Caracteristica" onkeyup = "this.value=this.value.toUpperCase()"  class="form-control" type="text" size="16" placeholder="Caracteristicas" value="<?php echo $productos[0]["Pro_Caracteristicas"] ?>">
						</div>
					</div>
				</td>
			 </tr>
			 <!--<tr>
				<td>
					<div class="form-group">
					<label class="control-label" for="selectError3">Maneja series</label>
						<div class="controls">
							<select id="MSeries" disabled="true" class="form-control">
								<option name="Nvta" value="1" <--?php if($productos[0]["Pro_SerieVC"]==1){?>selected<-?php }?>>Si</option>
								<option name="Nvta" value="0" <--?php if($productos[0]["Pro_SerieVC"]==0){?>selected<-?php }?>>No</option>
							</select>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
					<label class="control-label" for="selectError3">Tipos series</label>
						<div class="controls">
							<select id="TSeries" class="form-control">
								<option name="Nvta" value="0" <--?php if($productos[0]["Pro_Serie"]==0){?>selected<-?php }?>>Compra</option>
								<option name="Nvta" value="1" <--?php if($productos[0]["Pro_Serie"]==1){?>selected<-?php }?>>Venta</option>
							</select>
						</div>
					</div>
				</td>
			</tr>-->
			<tr>
				<td>
					<div class="form-group">
					<label class="control-label" for="selectError3">Servicio</label>
						<div class="controls">
							<select id="Servicio" class="form-control">
								<option name="Nvta" value="1" <?php if($productos[0]["Pro_Servicio"]==1){?>selected<?php }?>>Si</option>
								<option name="Nvta" value="0" <?php if($productos[0]["Pro_Servicio"]==0){?>selected<?php }?>>No</option>
							</select>
						</div>
					</div>
				</td>
			</tr>
			  <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Cant. Reorden</label>
						<div class="controls">
							<input id="CantR" class="form-control" onkeyUp="return ValNumero(this);" type="text" size="16" placeholder="Cantidad reorden" value="<?php echo $productos[0]["Pro_CantReorden"] ?>">
						</div>
					</div>
				</td>
			 </tr>
			 <tr>
				<td>
					<div class="form-group">
						<label class="control-label">Precio</label>
						<div class="controls">
							<div class="input-group">
								<input id="PrecioNombre" class="form-control" type="text" size="16" placeholder="Precio" readonly="readonly" value="<?php echo $productos[0]["Prec_Descripcion"] ?>">
								<input type="hidden" id="PrecioID" value="<?php echo $productos[0]["Pro_CodPrecio"] ?>">
								<span class="input-group-btn">
									<button class="btn" type="button" onclick="Buscar('22')"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</div>
				</td>
			  </tr>
			  <tr>
				
					<td>
					
						<div class="form-group">
							<label class="control-label" for="selectError3">Estado</label>
							<div class="controls">
								<select id="estado" name="estado" class="form-control" <?php echo $disabledEstado?>>
									<option value="0" <?php if($estado==0){?>selected<?php }?>>Inactivo</option>
									<option value="1" <?php if($estado==1){?>selected<?php }?>>Activo</option>
								</select> 
							</div>
						</div>
						
					</td>
					
				</tr>
		</table>
			</div>
			<input type="hidden" value="tr_1" id="detalleid">
			<tr>
				<td>
					<div class="form-group">
						<div class="controls">
							<button class="boton_save" type="button" onclick="Guardarproducto()"><i class="fa fa-save"></i> Guardar</button> 
						</div>
					</div>	
				</td>
			</tr>
		</div>
	</div>
</div>
<script type="text/javascript">
	CambiarDatos();
	jQuery(function($){
		$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
		})//show datepicker when clicking on the icon
		.next().on("click", function(){
		$(this).prev().focus();
		}); 
	});
</script>
<?php }?>
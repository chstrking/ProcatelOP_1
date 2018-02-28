<?php
require_once('..//conexion/conexiondb.php');
$codigo_Producto=$_REQUEST["ProductID"];
$nombre_Producto=$_REQUEST["ProductNombre"];
ini_set('max_execution_time', 0);
$content = ObtenerKardexHTML($codigo_Producto,$nombre_Producto);
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once('..//acciones/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('L','A4','es');
$html2pdf->WriteHTML($content);
//$html2pdf->pdf->includeJS('print(false)');
$html2pdf->Output('StockxBodega.pdf');
//var_dump($content);
	
function ObtenerKardexHTML($codigo_Producto,$nombre_Producto)
{
	$conexion=crear_conexion();
	$datos=Print_MovimientoKardex($conexion,$codigo_Producto); //var_dump($datos);
	                        
	$contenido_html='';
	$contenido_html='
	<table width="100%" border="0px" >
	<tr>
		<td style="font-size:30px;text-align:center;width:800px">
			SORQUITEL S.A
		</td>
	</tr>
	<br>
	<tr>
		<td style="font-size:10px;text-align:center">
			MOVIMIENTO DE KARDEX
		</td>
	</tr>
	<tr>
		<td style="font-size:8px;text-align:center">
			<B>FECHA:</b>  '.date('d-m-Y').'
		</td>
	</tr>
	</table>
	<br>
	<br>
	<table width="800px" border="0px" >
	<tr>
		<td style="font-size:9px">
			<B>PRODUCTO:</b>    &nbsp;&nbsp;'.$codigo_Producto.' - '.$nombre_Producto.'
		</td>
	</tr>
	</table>
	<br>';

	$contenido_html.='<table width="800px" border="1px">
	<thead>
		<tr>
			<th style="font-size:9px;text-align:center">FECHA</th>
			<th style="font-size:9px;text-align:center">DESCRIPCION</th>
			<th style="font-size:9px;text-align:center">B. ENTRADA</th>	
			<th style="font-size:9px;text-align:center">B. SALIDA</th>
			<th style="font-size:9px;text-align:center">TIPO</th>
			<th style="font-size:9px;text-align:center">C. UNIT</th>	
			<th style="font-size:9px;text-align:center">CANT/ENTR.</th>	
			<th style="font-size:9px;text-align:center">VALOR/ENTR.</th>
			<th style="font-size:9px;text-align:center">CANT/SAL.</th>	
			<th style="font-size:9px;text-align:center">VALOR/SAL.</th>	
			<th style="font-size:9px;text-align:center">CANT/SALDOS</th>	
			<th style="font-size:9px;text-align:center">C. UNIT/SALDOS</th>	
			<th style="font-size:9px;text-align:center">TOTAL/SALDOS</th>	
		</tr>
	</thead>
	<tbody>';
	foreach($datos as $detalle){
	
			$CostoE=0;
			$CostoS=0;
			$CantS=0;
			$CantE=0;
			$Tipo='';
			if($detalle["kar_tipo"]=='I') 
			{
				$Tipo="Inv. Inicial";
				$CantE= $detalle["dkar_cant"];
				$CostoE= $detalle["dkar_costo"];
			}
			if($detalle["kar_tipo"]=='C') 
			{
				$Tipo="Compra";
				$CantE= $detalle["dkar_cant"];
				$CostoE= $detalle["dkar_costo"];
			}   
			if($detalle["kar_tipo"]=='E') 
			{
				$Tipo="Dev.x Venta";
				$CantE= $detalle["dkar_cant"];
				$CostoE= $detalle["dkar_costo"];
			}       
			if($detalle["kar_tipo"]=='T')
			{
				$Tipo="Transferencia";
				$CantE= $detalle["dkar_cant"];
				$CostoE= $detalle["dkar_costo"];
			}           
			if($detalle["kar_tipo"]=='J')
			{
				$Tipo="Ing.x Ajuste de Inv.";
				$CantE= $detalle["dkar_cant"];
				$CostoE= $detalle["dkar_costo"];
			}              
			if($detalle["kar_tipo"]=='V')
			{
				$Tipo="Venta";
				$CantS= $detalle["dkar_cant"];
				$CostoS= $detalle["dkar_costo"];
			}               
			if($detalle["kar_tipo"]=='O')
			{
				$Tipo="Dev.x Compra";
				$CantS= $detalle["dkar_cant"];
				$CostoS= $detalle["dkar_costo"];
			}   
			if($detalle["kar_tipo"]=='D')
			{
				$Tipo="Dar de Baja";
				$CantS= $detalle["dkar_cant"];
				$CostoS= $detalle["dkar_costo"];
			}                   
			if($detalle["kar_tipo"]=='U')
			{
				$Tipo="Uso Interno";
				$CantS= $detalle["dkar_cant"];
				$CostoS= $detalle["dkar_costo"];
			}                        
			if($detalle["kar_tipo"]=='G')
			{
				$Tipo="Egreso x Ajuste de Inv.";
				$CantS=$detalle["dkar_cant"];
				$CostoS= $detalle["dkar_costo"];
			}  
			
		$ValorE= $CostoE * $CantE;
		$ValorS= $CostoS * $CantS;
		
		$contenido_html.='<tr>
			<td style="font-size:9px;width:50px;text-align:center">
				'.$detalle["kar_fecha"].'
			</td>	
			<td style="font-size:9px;width:250px;text-align:center">
				'.$detalle["kar_motivo"].'
			</td>	
			<td style="font-size:9px;text-align:center;width:30px">
				'.$detalle["kar_codbodega"].'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["kar_codbodegae"].'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$Tipo.'
			</td>	
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["dkar_costo"].'
			</td>	
			<td style="font-size:9px;text-align:center;width:50px">
				'.$CantE.'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$ValorE.'
			</td>	
			<td style="font-size:9px;text-align:center;width:50px">
				'.$CantS.'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$ValorS.'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$CantE.'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$CostoE.'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$ValorE.'
			</td>
		</tr>';
	}
	$contenido_html.='</tbody>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="left" border="0px">
			
	</table>';
	return $contenido_html;
}

?>





<?php
require_once('..//conexion/conexiondb.php');
$FechaD=$_REQUEST["FechaD"];
$FechaH=$_REQUEST["FechaH"];
$Usuario=$_REQUEST["Usuario"];
$Sucursal=$_REQUEST["Sucursal"];
ini_set('max_execution_time', 0);
$content = ObtenerKardexHTML($FechaD,$FechaH,$Usuario,$Sucursal);
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once('..//acciones/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','es');
$html2pdf->WriteHTML($content);
//$html2pdf->pdf->includeJS('print(false)');
$html2pdf->Output('StockxBodega.pdf');
//var_dump($content);
	
function ObtenerKardexHTML($FechaD,$FechaH,$Usuario,$Sucursal)
{
	$conexion=crear_conexion();
	$datos=Print_Caja($conexion,$FechaD,$FechaH,$Usuario,$Sucursal);
	$Valor1=0;
	$Valor2=0;
	$ValorTotal=0;
	$CantidadRegistros=0;
	//$nombre=$datos[0]["Kar_CodBodega"] + ' - ' + $datos[0]["Bod_Descripcion"];
	$contenido_html='';
	$contenido_html='
	<table width="800px" border="0px" >
	<tr>
		<td style="font-size:30px;text-align:center;width:800px">
			SORQUITEL S.A
		</td>
	</tr>
	<br>
	<tr>
		<td style="font-size:10px;text-align:center">
			 REPORTE DE CAJA
		</td>
	</tr>
	<tr>
		<td style="font-size:8px;text-align:center">
			<B>FECHA:</b>  '.date('d-m-Y').'
		</td>
	</tr>
	</table>';

	$contenido_html.='<table width="800px" border="1px">
	<thead>
		<tr>
			<th style="font-size:9px;text-align:center">USER</th>
			<th style="font-size:9px;text-align:center">CONCEPTO</th>
			<th style="font-size:9px;text-align:center">FACTURA</th>	
			<th style="font-size:9px;text-align:center"></th>
			<th style="font-size:9px;text-align:center"></th>
			<!--<th style="font-size:9px;text-align:center">TOTAL</th>-->	
		</tr>
	</thead>
	<tbody>';
	foreach($datos as $detalle){
		
		$Valor1 = $Valor1 + $detalle["Valor1"];
		$Valor2 = $Valor2 + $detalle["Valor2"];
		$ValorTotal = $Valor1 + $Valor2; //+ $ValorC ;
		$CantidadRegistros = $CantidadRegistros + 1;
		$contenido_html.='<tr>
			<td style="font-size:9px;width:50px;text-align:center">
				'.$detalle["Usuario"].'
			</td>	
			<td style="font-size:9px;width:400px;text-align:center">
				'.$detalle["Concepto"].'
			</td>	
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["Fecha"].'
			</td>
			<td style="font-size:9px;text-align:left;width:50px">
				'.$detalle["Valor1"].'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["Valor2"].'
			</td>
			<!--<td style="font-size:9px;width:50px;text-align:right">
				'.$detalle["Valor3"].'
			</td>-->		 
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
	<table align="left" border="1.5px">
			<tr>
				<td style="font-size:9px;width:200px;text-align:left">
					<H5>CANTIDAD/FACTURAS: '.$CantidadRegistros.'</H5>
				</td>
			</tr>
			<tr>
				<td style="font-size:9px;width:200px;text-align:left">
					<H5>TOTAL/EFECTIVO: '.$ValorTotal.'</H5> 
				</td>

			</tr> 
	</table>';
	return $contenido_html;
}

?>





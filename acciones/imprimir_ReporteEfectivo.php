<?php
require_once('..//conexion/conexiondb.php');
$Fecha=$_REQUEST["Fecha"];
$Usuario=$_REQUEST["Usuario"];
$Sucursal=$_REQUEST["Sucursal"];
ini_set('max_execution_time', 0);
$content = ObtenerKardexHTML($Fecha,$Usuario,$Sucursal);
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once('..//acciones/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','es');
$html2pdf->WriteHTML($content);
//$html2pdf->pdf->includeJS('print(false)');
$html2pdf->Output('StockxBodega.pdf');
//var_dump($content);
	
function ObtenerKardexHTML($Fecha,$Usuario,$Sucursal)
{
	$conexion=crear_conexion();
	$datos=Print_Efectivo($conexion,$Fecha,$Usuario,$Sucursal);
	$ValorQ=0;
	$ValorE=0;
	$ValorC=0;
	$ValorT=0;
	$ValorR=0;
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
			 REPORTE DE EFECTIVO
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
			<th style="font-size:9px;text-align:center">C:FACT C:COBR</th>
			<th style="font-size:9px;text-align:center">FACTURA</th>	
			<th style="font-size:9px;text-align:center">CLIENTE</th>
			<th style="font-size:9px;text-align:center">TIPO</th>
			<th style="font-size:9px;text-align:center">EFECTIVO</th>	
			<th style="font-size:9px;text-align:center">CHEQUE</th>
			<!--<th style="font-size:9px;text-align:center">CABINA</th>	
			<th style="font-size:9px;text-align:center">TARJ. CREDITO</th>
			<th style="font-size:9px;text-align:center">RETENCION</th>-->	
		</tr>
	</thead>
	<tbody>';
	foreach($datos as $detalle){
		
		$ValorQ = $ValorQ + $detalle["ValorQ"];
		$ValorE = $ValorE + $detalle["ValorE"];
		$ValorC = $ValorC + $detalle["ValorC"];
		$ValorT = $ValorT + $detalle["ValorT"];
		$ValorR = $ValorR + $detalle["ValorR"];
		$ValorTotal = $ValorQ + $ValorE; //+ $ValorC ;
		$CantidadRegistros = $CantidadRegistros + 1;
		$contenido_html.='<tr>
			<td style="font-size:9px;width:50px;text-align:center">
				'.$detalle["Usuario"].'
			</td>	
			<td style="font-size:9px;width:90px;text-align:center">
				'.$detalle["CodFact"].' - '.$detalle["CodFact"].'
			</td>	
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["Factura"].'
			</td>
			<td style="font-size:9px;text-align:left;width:300px">
				'.$detalle["Cliente"].'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["Tipo"].'
			</td>
			<td style="font-size:9px;width:50px;text-align:right">
				'.$detalle["ValorE"].'
			</td>	
			<td style="font-size:9px;width:50px;text-align:right">
				'.$detalle["ValorQ"].'
			</td>	
			<!--<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["ValorC"].'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["ValorT"].'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["ValorR"].'
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
					<H5>TOTAL CHEQUE:'.$ValorQ.'</H5> 
				</td>
			</tr>
			<tr>
				<td style="font-size:9px;width:200px;text-align:left">
					<H5>TOTAL EFECTIVO: '.$ValorE.'</H5> 
				</td>
			</tr>
			<!--<tr>
				<td style="font-size:9px;width:200px;text-align:left">
					<H5>TOTAL CABINA: '.$ValorC.'</H5>
				</td>
			</tr>
			<tr>	
				<td style="font-size:9px;width:200px;text-align:left">
					<H5>TOTAL TARJETA: '.$ValorT.'</H5>
				</td>
			</tr>
			<tr>	
				<td style="font-size:9px;width:200px;text-align:left">
					<H5>TOTAL RETEN.: '.$ValorR.'</H5>
				</td>
			</tr>-->
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





<?php
require_once('..//conexion/conexiondb.php');
$codigo_Kardex=$_REQUEST["idKardex"];
ini_set('max_execution_time', 0);
$content = ObtenerKardexHTML($codigo_Kardex);
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once('..//acciones/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','es');
$html2pdf->WriteHTML($content);
//$html2pdf->pdf->includeJS('print(false)');
$html2pdf->Output('StockxBodega.pdf');
//var_dump($content);
	
function ObtenerKardexHTML($codigo_Kardex)
{
	$conexion=crear_conexion();
	$datos=Print_Kardex($conexion,$codigo_Kardex);
	
	$nombre=$datos[0]["Kar_CodBodega"] + ' - ' + $datos[0]["Bod_Descripcion"];
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
			RUC: '.$datos[0]["Emp_RUC"].'
		</td>
	</tr>
	<br>
	<tr>
		<td style="font-size:10px;text-align:center">
			IMPRESION DE KARDEX
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
			<B>No. Kardex:</b>    &nbsp;&nbsp;'.$datos[0]["codigo_kar"].'
		</td>
	</tr>
	<tr>
		<td style="font-size:9px">
			<B>BODEGA:</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$nombre.'
		</td>	
	</tr>
	</table>
	<br>';

	$contenido_html.='<table width="800px" border="1px">
	<thead>
		<tr>
			<th style="font-size:9px;text-align:center">CODIGO</th>
			<th style="font-size:9px;text-align:center">COD. PRODUCTO</th>
			<th style="font-size:9px;text-align:center">PRODUCTO</th>	
			<th style="font-size:9px;text-align:center">STOCK</th>
			<th style="font-size:9px;text-align:center">SERIE</th>				
		</tr>
	</thead>
	<tbody>';
	foreach($datos as $detalle){
		$contenido_html.='<tr>
			<td style="font-size:9px;width:50px;text-align:center">
				'.$detalle["DKar_CodProducto"].'
			</td>	
			<td style="font-size:9px;width:100px;text-align:center">
				'.$detalle["DProd_Codigo"].'
			</td>	
			<td style="font-size:9px;text-align:center;width:300px">
				'.$detalle["Descripcion"].'
			</td>
			<td style="font-size:9px;text-align:center;width:50px">
				'.$detalle["DKar_Cant"].'
			</td>
			<td style="font-size:9px;text-align:center;width:200px">
				'.$detalle["Dprod_serie"].'
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
			<tr>
				<td style="font-size:9px;width:200px;text-align:center">
					_____________________________
				</td>
				<td style="font-size:9px;width:300px;text-align:left">
					 
				</td>
				<td style="font-size:9px;width:200px;text-align:center">
					_____________________________
				</td>
			</tr>	
			<tr>
				<td style="font-size:9px;width:200px;text-align:center">
					RECIBE
				</td>
				<td style="font-size:9px;width:300px;text-align:left">
					 
				</td>
				<td style="font-size:9px;width:200px;text-align:center">
					ENTREGA
				</td>
			</tr>		
	</table>';
	return $contenido_html;
}

?>





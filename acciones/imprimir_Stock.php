<?php
require_once('..//conexion/conexiondb.php');
$codigo_Bodega=$_REQUEST["codigoBodega"];
$codigo_TipoProducto=$_REQUEST["codigoTipoProducto"];
$codigo_Marca=$_REQUEST["codigoMarca"];
$codigo_Producto=$_REQUEST["codigoProducto"];
$Usuario=$_REQUEST["Usuario"];
ini_set('max_execution_time', 0);
$content = ObtenerStockBodegaHTML($codigo_Bodega,$codigo_TipoProducto,$codigo_Marca,$codigo_Producto,$Usuario);
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once('..//acciones/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','es');
$html2pdf->WriteHTML($content);
//$html2pdf->pdf->includeJS('print(false)');
$html2pdf->Output('StockxBodega.pdf');
//var_dump($content);
	
function ObtenerStockBodegaHTML($codigoB,$codigoT,$codigoM,$codigoP,$User)
{
	$conexion=crear_conexion();
	$datos=Print_StockBodega($conexion,$codigoB,$codigoT,$codigoM,$codigoP,$User);
	//$tipo=(trim($datos[0]["contado"])=="1")?'Contado':'Credito';
	//var_dump($datos);
	if($codigoB==0)
	{
		$nombre='TODOS';
		$encargado='TODOS';
	}
	else
	{
		$nombre=$codigoB+$datos[0]["Bod_Descripcion"];
		$encargado=$datos[0]["Bod_CodRespEmpl"]+$datos[0]["Empl_Apellidos"];
	}
	
	$contenido_html='';
	$contenido_html='
	<table width="800px" border="0px" >
	<tr>
		<td style="font-size:8px">
			<B>USUARIO:</b>     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$User.'
		</td>
	</tr>
	<tr>
		<td style="font-size:30px;text-align:center;width:800px">
			SORQUITEL S.A
		</td>
	</tr>
	<br>
	<tr>
		<td style="font-size:10px;text-align:center">
			INVENTARIO POR BODEGA
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
			<B>BODEGA:</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$nombre.'
		</td>	
	</tr>
	<tr>
		<td style="font-size:9px">
			<B>RESPONSABLE:</b>    &nbsp;&nbsp;'.$encargado.'
		</td>		
	</tr>
	</table>
	<br>';

	$contenido_html.='<table width="800px" border="1px">
	<thead>
		<tr>
			<th style="font-size:9px;text-align:center">PRODUCTO</th>
			<th style="font-size:9px;text-align:center">SERIE</th>
			<th style="font-size:9px;text-align:center">EXISTENCIA</th>	
		</tr>
	</thead>
	<tbody>';
	foreach($datos as $detalle){
		$contenido_html.='<tr>
			<td style="font-size:9px;width:500px">
				'.$detalle["Pro_Codigo"].' - '.$detalle["Descripcion"].'
			</td>	
			<td style="font-size:9px;width:100px">
				'.$detalle["Dprod_Serie"].'
			</td>	
			<td style="font-size:9px;text-align:center;width:100px">
				'.$detalle["DProd_Stock"].'
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
					CUSTODIO DEL INVENTARIO
				</td>
				<td style="font-size:9px;width:300px;text-align:left">
					 
				</td>
				<td style="font-size:9px;width:200px;text-align:center">
					ENCARGADO DEL INVENTARIO
				</td>
			</tr>		
	</table>';
	return $contenido_html;
}

?>





<?php
require_once('..//conexion/conexiondb.php');
$ano=$_REQUEST["ano"];
$mes=$_REQUEST["mes"];
$ctaI=$_REQUEST["ctaI"];
$ctaF=$_REQUEST["ctaF"];
ini_set('max_execution_time', 0);
$content = ObtenerCuentasSaldo($ctaI,$ctaF,$ano,$mes);
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once('..//acciones/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','es');
$html2pdf->WriteHTML($content);
//$html2pdf->pdf->includeJS('print(false)');
$html2pdf->Output('StockxBodega.pdf');
//var_dump($content);
	
function ObtenerCuentasSaldo($ctaI,$ctaF,$ano,$mes)
{
	$conexion=crear_conexion();
	$datos=Print_ConsultaSaldos($conexion,$ctaI,$ctaF,$ano,$mes);
	//var_dump($datos);
	$contenido_html='';
	$contenido_html='
	<table width="800px" border="0px" >
		<tr>
			<td style="font-size:30px;text-align:center;width:800px">
				PROCATEL S.A
			</td>
		</tr>
		<br>
		<tr>
			<td style="font-size:10px;text-align:center">
				BALANCE DE SALDOS
			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>';

	$contenido_html.='<table width="800px" border="1px">
	<thead>
		<tr>
			<th style="font-size:9px;text-align:center">T. CUENTA</th>
			<th style="font-size:9px;text-align:center">CUENTA</th>
			<th style="font-size:9px;text-align:center">CONCEPTO</th>	
			<th style="font-size:9px;text-align:center">ANTERIOR</th>
			<th style="font-size:9px;text-align:center">DEBE</th>
			<th style="font-size:9px;text-align:center">HABER</th>			
		</tr>
	</thead>
	<tbody>';
	foreach($datos as $detalle){
		$contenido_html.='<tr>
			<td style="font-size:9px;width:50px;text-align:center">
				'.$detalle["codigo"].'
			</td>	
			<td style="font-size:9px;width:100px;text-align:left">
				'.$detalle["cuenta"].'
			</td>	
			<td style="font-size:9px;text-align:left;width:300px">
				'.$detalle["nombre"].'
			</td>
			<td style="font-size:9px;text-align:center;width:80px">
				'.$detalle["Saldo_Ant"].'
			</td>
			<td style="font-size:9px;text-align:center;width:80px">
				'.$detalle["Debe"].'
			</td>	
			<td style="font-size:9px;text-align:center;width:80px">
				'.$detalle["Haber"].'
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
				
			</tr>	
			<tr>
			
			</tr>		
	</table>';
	return $contenido_html;
}

?>





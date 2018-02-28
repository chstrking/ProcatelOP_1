<?php
//error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$Id=$_REQUEST["codigo"];
ini_set('max_execution_time', 0);
$content = ObtenerFacturaHTML($Id);
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','es');
$html2pdf->WriteHTML($content);
$html2pdf->pdf->includeJS('print(true)');
$html2pdf->Output('factura.pdf');

	
function ObtenerFacturaHTML($Id)
{
	$conexion=crear_conexion();
	$datos=RPrint_Factura($conexion,$Id);
	//var_dump($datos);
	ActualizaEstadoPagado($conexion,$Id);
	
	$tipo=(trim($datos[0]["contado"])=="1")?'Contado':'Credito';

	$contenido_html='';
	$contenido_html='
	<table width="827px" border="0px" >
	<tr>
		<td style="font-size:9px">
			'.$datos[0]["codigocliente"].'
		</td>
		<td style="font-size:9px">
			'.$tipo.'
		</td>
	</tr>
	<tr>
		<td style="font-size:9px">
			<B>Cliente:</b>'.$datos[0]["nombrecliente"].'
		</td>
	</tr>
	<tr>
		<td style="font-size:9px">
			<B>Ruc/C&eacute;dula:</b>'.$datos[0]["cedula"].' &nbsp;
			<b>Telefono:</b>'.$datos[0]["telefono"].'
		</td>
	</tr>
	<tr>
		<td style="font-size:9px">
			<B>Direcci&oacute;n:</b>'.$datos[0]["direccion"].'
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td style="font-size:9px">
			<B>Fecha:</b>'.$datos[0]["dia"].'-'.$datos[0]["mes"].'-'.$datos[0]["anio"].'
		</td>
		<td>
		</td>
	</tr>	
	</table>
	<br>';

	$contenido_html.='<table width="20px" border="0px">
	<thead>
		<tr>
			<th style="font-size:9px">Cantidad</th>
			<th style="font-size:9px">Concepto</th>
			<th style="font-size:9px">V.Unit</th>
			<th style="font-size:9px">Total</th>		
		</tr>
	</thead>
	<tbody>';
	foreach($datos as $detalle){
		$contenido_html.='<tr>
			<td style="font-size:9px">
				'.$detalle["cantidad"].'
			</td>	
			<td style="font-size:9px">
				'.$detalle["descripcion"].'
			</td>	
			<td style="font-size:9px">
				'.$detalle["preciounitario"].'
			</td>	
			<td style="font-size:9px">
				'.$detalle["detalletotal"].'
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
				<td style="font-size:9px;width:250px;text-align:right">
					Subtotal:'.$datos[0]["traifaiva"].'
				</td>
			</tr>	
			<tr>
				<td style="font-size:9px;width:250px;text-align:right">
					Desc:'.$datos[0]["descuento"].'
				</td>
			</tr>	
			<tr>
				<td style="font-size:9px;width:250px;text-align:right">
					ICE 15%:'.$datos[0]["ice"].'
				</td>
			</tr>	
			<tr>
				<td style="font-size:9px;width:250px;text-align:right">
					IVA 12%:'.$datos[0]["iva"].'
				</td>
			</tr>	
			<tr>
				<td style="font-size:9px;width:250px;text-align:right">
					Total:'.$datos[0]["total"].'
				</td>
			</tr>	
	</table>';
	return $contenido_html;
}

?>





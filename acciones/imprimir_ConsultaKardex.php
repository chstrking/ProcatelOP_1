<?php
require_once('..//conexion/conexiondb.php');
$FechaI=$_REQUEST["FechaI"];
$FechaF=$_REQUEST["FechaF"];
ini_set('max_execution_time', 0);
$content = ObtenerKardexHTML($FechaI,$FechaF);
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once('..//acciones/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','es');
$html2pdf->WriteHTML($content);
//$html2pdf->pdf->includeJS('print(false)');
$html2pdf->Output('ConsultaKardex.pdf');
//echo $content;
	
function ObtenerKardexHTML($FechaI,$FechaF)
{
	$conexion=crear_conexion();
	$datos=Print_ConsultaKardex($conexion,$FechaI,$FechaF);
	//var_dump($datos);
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
			
		</td>
	</tr>
	<tr>
		<td style="font-size:9px">
		
		</td>	
	</tr>
	</table>
	<br>';

	$contenido_html.='<table width="800px" border="0px">
	<thead>
		<tr>
			<!--<th style="font-size:9px;text-align:center">CODIGO</th>
			<th style="font-size:9px;text-align:center">COD. PRODUCTO</th>
			<th style="font-size:9px;text-align:center">PRODUCTO</th>	
			<th style="font-size:9px;text-align:center">STOCK</th>
			<th style="font-size:9px;text-align:center">SERIE</th>-->			
		</tr>
	</thead>
	<tbody>';
	foreach($datos as $detalle){
		$contenido_html.='<tr><td style="font-size:9px;text-align:center;width:50px">
					__________________________________
				</td><td style="font-size:9px;text-align:center;width:150px">
					__________________________________
				</td><td style="font-size:9px;text-align:center;width:150px">
					__________________________________
				</td><td style="font-size:9px;text-align:center;width:150px">
					__________________________________
				</td>
				<td style="font-size:9px;text-align:center;width:150px">
					__________________________________
				</td></tr><tr>
				<td style="font-size:9px;width:150px;text-align:left">
					<B>NO. KARDEX:</B> '.$detalle["Kar_Codigo"].'
				</td>
				<td style="font-size:9px;width:150px;text-align:left">
					<B>NO. KARDEX:</B> '.$detalle["Kar_Motivo"].'
				</td>	
				<td style="font-size:9px;width:150px;text-align:left">
					
				</td>	
				<td style="font-size:9px;width:250px;text-align:left">
					<B>FECHA:</B> '.$detalle["Kar_Fecha"].'
				</td>		
			</tr><tr><td style="font-size:9px;width:50px;text-align:left">
					
				</td></tr><tr><td style="font-size:9px;width:50px;text-align:left">
					
				</td></tr><tr><td style="font-size:9px;width:50px;text-align:left">
					
				</td></tr><tr><td style="font-size:9px;width:150px;text-align:left">
					<B>BODEGA:</B> '.$detalle["Kar_CodBodega"].' - '.$detalle["Bod_Descripcion"].'
				</td>
				<td style="font-size:9px;width:150px;text-align:left">
					
				</td>	
				<td style="font-size:9px;width:150px;text-align:right">
					
				</td>	
				<td style="font-size:9px;width:250px;text-align:left">
					<B>FECHA SIST.:</B> '.$detalle["Kar_FechaSist"].'
				</td>			
			</tr><tr><td style="font-size:9px;width:50px;text-align:left">
					
				</td></tr><tr><td style="font-size:9px;width:50px;text-align:left">
					
				</td></tr><tr><td style="font-size:9px;width:50px;text-align:left">
					
				</td></tr><tr><td style="font-size:9px;width:50px;text-align:left">
					
				</td></tr><tr><td style="font-size:9px;text-align:center;width:150px">
					==============================
				</td><td style="font-size:9px;text-align:center;width:150px">
					==============================
				</td><td style="font-size:9px;text-align:center;width:150px">
					==============================
				</td><td style="font-size:9px;text-align:center;width:50px">
					===========================================
				</td></tr><tr>
				<td style="font-size:9px;width:150px;text-align:center">
					<B>CODIGO</B>
				</td>	
				<td style="font-size:9px;width:100px;text-align:center">
					<B>COD. PRODUCTO</B>
				</td>	
				<td style="font-size:9px;text-align:center;width:250px">
					<B>PRODUCTO</B>
				</td>
				<td style="font-size:9px;text-align:center;width:150px">
					<B>STOCK</B>
				</td>
				<!--<td style="font-size:9px;text-align:center;width:200px">
					'.$detalle["Dprod_serie"].'
				</td>-->			
			</tr><tr>
				<td style="font-size:9px;width:150px;text-align:center">
					'.$detalle["DKar_CodProducto"].'
				</td>	
				<td style="font-size:9px;width:100px;text-align:center">
					'.$detalle["DProd_Codigo"].'
				</td>	
				<td style="font-size:9px;text-align:lef;width:250px">
					'.$detalle["Descripcion"].'
				</td>
				<td style="font-size:9px;text-align:center;width:150px">
					'.$detalle["DKar_Cant"].'
				</td>
				<!--<td style="font-size:9px;text-align:center;width:200px">
					'.$detalle["Dprod_serie"].'
				</td>-->			
			</tr><tr><td style="font-size:9px;text-align:center;width:150px">
					==============================
				</td><td style="font-size:9px;text-align:center;width:150px">
					==============================
				</td><td style="font-size:9px;text-align:center;width:150px">
					==============================
				</td><td style="font-size:9px;text-align:center;width:50px">
					===========================================
				</td></tr>';
	}
	$contenido_html.='</tbody>
	</table>
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





<?php
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	
function imprimirPDF($html,$name)
{
    $html2pdf = new HTML2PDF('P','A4','es');
    $html2pdf->WriteHTML($html);
    $html2pdf->Output($name);
}
?>


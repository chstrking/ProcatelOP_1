<?php
error_reporting(1);
session_start();
require_once('..//conexion/conexiondb.php');
$conexion=crear_conexion();
if(isset($_SESSION['usuario'])) 
{
?>
<center><h4>Graficos Estadisticos con Jquery</h4></center>
<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'Ranking de Navegadores, 2011'
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
				    series: [{
						type: 'pie',
						name: 'Browser share',
						data: [
							['Firefox',   45.0],
							['IE',       26.8],
							{
								name: 'Chrome',    
								y: 12.8,
								sliced: true,
								selected: true
							},
							['Safari',    8.5],
							['Opera',     6.2],
							['Others',   0.7]
						]
					}]
				});
			});
</script>
<?php }?>
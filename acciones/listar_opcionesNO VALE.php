<?php
error_reporting(1);
session_start();

//require_once('..//conexion/conexiondb.php');
//$conexion=crear_conexion();
//$tipoproducto=$_GET['tipoproducto'];
if(isset($_SESSION['usuario'])) 
{
	$rol = $_SESSION['CodigoUsuarioRol'];
	$admin = $_SESSION['Administrador'];
	$lista_opciones=array();//opciones_totales($conexion);
	$opciones_rol=array();//opciones_rol($conexion,$rol_id);
	
	try{
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		$i = 0;
		//foreach($mbd->query('select DISTINCT CodigoMod, Modulos, CodigoOp, Opciones, CodigoAc, Acciones from vi_accesos ') as $fila) {
		foreach($mbd->query('select DISTINCT CodigoMod, Modulos, CodigoOp, Opciones from vi_accesos ') as $fila) {
			$lista_opciones[$i]['CodigoModulo']=$fila['CodigoMod'];
			$lista_opciones[$i]['NombreModulo']=$fila['Modulos'];
			$lista_opciones[$i]['CodigoOpcion']=$fila['CodigoOp'];
			$lista_opciones[$i]['NombreOpcion']=$fila['Opciones'];			
			//$lista_opciones[$i]['CodigoAcciones']=$fila['CodigoAc'];
			//$lista_opciones[$i]['NombreAcciones']=$fila['Acciones'];
			$i++;
		}
		$mbd = null;
		
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		$where = "";
		if($admin!=1){
			$where = "where CodigoRol = '$rol'";
			$i = 0;
			foreach($mbd->query('select DISTINCT CodigoOp from vi_accesos '. $where) as $fila) {
				$modulos[$i]['CodigoOpcion']=$fila['CodigoOp'];
				$i++;
			}
			$mbd = null;
		}
		else{
			$opciones_rol = $lista_opciones;
		}
		
	}catch (PDOException $e){
		print "!Error¡:" . $e->getMessage() . "<br>";
		die();
	}
	
?>

</script>
<div id="contenedor_pasos" style="overflow-y: scroll;">
	<div class="titulo_popup">
		Permisos por roles
	</div>
	<div id="tree-container"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
    //fill data to tree  with AJAX call
    $('#tree-container').jstree({
	'plugins': ["wholerow", "checkbox"],
        'core' : {
            'data' : {
                "url" : "response.php",
                "dataType" : "json" // needed only if you do not supply JSON headers
            }
        }
    }) 
});
<?php } ?>
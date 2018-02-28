<?php
session_start();
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'login.php';

if (isset($_SESSION['usuario'])) 
{
	$modulos=array();
	$Usuario = $_SESSION['usuario'];
	$Rol = $_SESSION['CodigoUsuarioRol'];
	$admin = $_SESSION['Administrador'];
	$i=0;

	try{
		$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');
		$where = "";
		if($admin==1){
			$where = "where CodigoRol = '$Rol'";
		}	

		foreach($mbd->query('select DISTINCT CodigoMod,Modulos from vi_accesos '. $where) as $fila) {
			$modulos[$i]['id']=$fila['CodigoMod'];
			$modulos[$i]['nombre']=$fila['Modulos'];
			$i++;
		}
		$mbd = null;
		if(count($modulos)>0){
			if(!isset($_SESSION['modulos']))$_SESSION['modulos']=$modulos;
		}
		
	}catch (PDOException $e){
		print "!Error¡:" . $e->getMessage() . "<br>";
		die();
	}	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="./css/estilos.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="./SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
		<link href="./css/ext-all.css" media="all" type="text/css" rel="stylesheet"/>
		<link href="./css/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="./css/bootstraptheme.css" rel="stylesheet" type="text/css">
		<link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="./css/datepicker.css" rel="stylesheet" type="text/css"/>
		<link href="./css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" href="./css/estilos2.css"/>
		<script type="text/javascript" src="./js/ajax.js"></script>
		<script src="./js/funciones.js" type="text/javascript"></script>
		<script src="./js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="./js/bootstrap.min.js"></script>
		<script src="./js/ext-jquery-adapter.js" type="text/javascript"></script>
		<script src="./js/ext-all.js" type="text/javascript"></script>
		<script src="./js/ext-lang-es.js" type="text/javascript"></script>	
		<script src="./js/jquery-ui.min.js"></script>
		<script src="./js/tinybox.js" type="text/javascript"></script>
		<script src="./js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="./js/jquery-1.4.2.min.js" type="text/javascript"></script>
		<script src="./js/highcharts.js" type="text/javascript"></script>
		<script src="./js/Chart.js"" type="text/javascript"></script>
		<!-- Este archivo es para darle un estilo (Este archivo es Opcional) -->
	    <script src="./js/themes/grid.js" type="text/javascript"></script>
		<!-- Este archivo es para poder exportar losd atos que obtengamos -->
		<script src="./js/modules/exporting.js" type="text/javascript"></script>
		<script src="js/editablegrid-2.0.1.js"></script>   
		<!-- I use jQuery for the Ajax methods -->
		<script src="js/jquery-1.7.2.min.js" ></script>
		<script src="js/demo.js" ></script>
	</head>
	<?php $primero='';?>
	<?php $first = true;?>
	<?php foreach($modulos as $modulo):?>
		<?php if ( $first ){$primero=$modulo['id'];$first=false;}?>
	<?php endforeach;?>
	<body onload="verMenu('<?php echo $primero;?>');">
		<div role="navigation"  class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
				  <button data-target=".navbar-collapse-primary" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
					<span class="sr-only">Toggle Side Navigation</span>
					<i class="icon-th-list"></i>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a href="#" class="navbar-brand">Escuela</a>
				</div>
				<div class="navbar-collapse collapse" style="height: 1px;">
					<ul class="nav navbar-nav">
					  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Inicio<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="#">Informaci&oacute;n</a></li>
						  <li><a href="#">Contactenos</a></li>
						</ul>
					  </li>
					  <li><a class="dropdown-toggle" data-toggle="dropdown">Promociones<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="#">Productos</a></li>
						</ul>
					  </li>
					  <li class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Módulos<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <?php foreach($modulos as $modulo):?>
							<li><a href="#" onclick="verMenu('<?php echo $modulo['id'];?>')"><?php echo $modulo['nombre'];?></a></li>
						  <?php endforeach;?>
						</ul>
					  </li>
					  <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Guía<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="#">Gu&iacute;a del mes</a></li>
						  <li><a href="#">Gu&iacute;a del mes anterior</a></li>
						</ul>
					  </li>
					  <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuario<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="#" onclick="CerrarSesion()">Cerrar Sesión</a></li>
						</ul>
					  </li>
					  <li>
						<div id="cerrar_sesion"></div>
					  </li>
					</ul>
				</div>
			
			</div>
		</div>			
		<div class="row">
			<div class="main-menu-span col-sm-2">
				<div class="sidebar-nav nav-collapse collapse navbar-collapse" id="id_menu"></div>
			</div>
			<div id="content" class="col-sm-10" style="min-height: 626px;">
				<div class="contenido_detalle" id="id_transacciones"></div>
			</div>
		</div>
		<footer>
			<p>
				<span style="text-align:left;float:left">&copy; 2018 Escuela.</span>
			</p>
		</footer>
	</body>
</head>
<?php }else{header("Location: http://$host$uri/$extra");}?>
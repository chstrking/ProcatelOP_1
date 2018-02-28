<?php
session_start();
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';

if (isset($_SESSION['usuario'])) 
{
	if(isset($_POST["login-password-actualizar"]))
	{ 
		require_once('./conexion/conexiondb.php');
		$conexion=crear_conexion();
		if($conexion)
		{
			$usuario=$_SESSION['usuario'];
			$clave=$_POST["login-password-actualizar"];
			actualizarclave($conexion,$usuario,$clave);
			header("Location: http://$host$uri/$extra");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="./css/styles.css"/>
		<script src="./js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="./js/ext-jquery-adapter.js" type="text/javascript"></script>
		<script src="./js/ext-all.js" type="text/javascript"></script>
		<script src="./js/ext-lang-es.js" type="text/javascript"></script>
		<script src="./js/tinybox.js" type="text/javascript"></script>
		<script src="./js/funciones.js"></script>
	</head>
	<body>
		<div class="background_login" align="center">
			<table cellspacing="0" cellpadding="0" width="100%" height="100%">
				<tr>
					<td align="center" valign="middle">
						<div class="area_login">
							<div id="logo">
								<img src="./img/logo.jpg" style="padding-top: 15px;">
							</div>
							<div id="login">
								<h3>Clave vencida</h3>
								<h5>Ingrese su nueva clave</h5>
								<form class="form" id="login-form" method="post">
								  <div class="form-group">
									<input type="password" placeholder="Clave" id="login-password-actualizar" name="login-password-actualizar" class="form-control" onKeyDown="ActualizaClave(event)">
								  </div>
								</form>
								<div class="form-group">
									<button class="btn btn-success btn-block" id="login-btn" onclick="ValidarActualizarClave()">Cambiar Clave</button>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
<?php
}
?>
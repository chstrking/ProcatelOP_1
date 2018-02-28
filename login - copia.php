<?php
	error_reporting(0);
	session_start();
	$mensaje="";
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';
	$login;
	if(isset($_SESSION['usuario']))
	{
		header("Location: http://$host$uri/$extra");
	}
	if(isset($_POST["login-username"]) && isset($_POST["login-password"]))
	{
		require_once('./conexion/conexiondb.php');
		$conexion=crear_conexion();
		if($conexion)
		{
			$usuario=$_POST["login-username"];
			$clave=$_POST["login-password"];
			$respuesta=login($conexion,$usuario,$clave);
			//var_dump($respuesta);
			if($respuesta["Respuesta"]==1)
			{
				CerrarUsuario($conexion,$usuario,1);
				$IP_usuario=getIP();
				$ingreso_ip=modulos_IPs($conexion,$IP_usuario);
				$ingreso_ip=true;
				if($ingreso_ip)
				{
					$modulos=modulos_usuario($conexion,$usuario);
					$mensaje="";
					if(!isset($_SESSION['usuario']))$_SESSION['usuario']=$usuario;
					if(count($modulos)>0)
					{
						if(!isset($_SESSION['modulos']))$_SESSION['modulos']=$modulos;
					}
					$sucursal=find_sucursal($conexion,'',$respuesta["CodSuc"],'');
					$_SESSION['sucursal']=$sucursal[0];
					header("Location: http://$host$uri/$extra");
				}
				else
				{
					$mensaje="La IP ".$IP_usuario." desde donde intenta conectarse no est&aacute; habilitada";
				}
			}
			if($respuesta["Respuesta"]==2)
			{
				$IP_usuario=getIP();
				$ingreso_ip=modulos_IPs($conexion,$IP_usuario);
				if($ingreso_ip)
				{
					$modulos=modulos_usuario($conexion,$usuario);
					$mensaje="";
					if(!isset($_SESSION['usuario']))$_SESSION['usuario']=$usuario;
					if(count($modulos)>0)
					{
						if(!isset($_SESSION['modulos']))$_SESSION['modulos']=$modulos;
					}
					$sucursal=find_sucursal($conexion,'',$respuesta["CodSuc"],'');
					$_SESSION['sucursal']=$sucursal[0];
					$extra = 'actualizaclave.php';
					header("Location: http://$host$uri/$extra");
				}
				else
				{
					$mensaje="La IP ".$IP_usuario." desde donde intenta conectarse no est&aacute; habilitada";
				}
			}
			if ($respuesta["Respuesta"]==3)
			{
				$mensaje="Sesión ya se encuentra iniciada";
			}
			else
			{
				$mensaje="Usuario o clave incorrecta";
			}
			
		}
		else
		{
			$mensaje="Error en base de datos, consulte con el administrador";
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
								<h3>SORQUITEL</h3>
								<h5>Ingrese su usuario y clave</h5>
								<?php if($mensaje!=""){?><h5 class="error"><?php echo $mensaje;?></h5><?php }?>
								
								<form class="form" id="login-form" method="post">
								  <div class="form-group">
									<input type="text" placeholder="Usuario" id="login-username" name="login-username" class="form-control">
								  </div>
								  <div class="form-group">
									<input type="password" placeholder="Clave" id="login-password" name="login-password" class="form-control" onKeyDown="EnterLogin(event)">
								  </div>
								  <div class="form-group">
									<!--<a href="#" onclick="RecordarUsuario()" id="Recordatorio">¿No puedes iniciar sesión?</a>-->
									<a href="#" id="Recordatorio" onclick="Olvidar()">¿No puedes iniciar sesión?</a>
								  </div>
								</form>
								  <div class="form-group">
									<button class="btn btn-success btn-block" id="login-btn" onclick="ValidarLogin()">Ingresar</button>
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
function getIP()
{
	if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
			return $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
			return $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
			return $_SERVER["HTTP_X_FORWARDED"];
		}
		elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
			return $_SERVER["HTTP_FORWARDED_FOR"];
		}
		elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
			return $_SERVER["HTTP_FORWARDED"];
		}
		else
        {
			return $_SERVER["REMOTE_ADDR"];
		}
}
?>
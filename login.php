<?php
	error_reporting(0);
	session_start();
	/*************************************************************************************************************/
	$msg='';
	if(isset($_POST["login-username"]) && isset($_POST["login-password"])){
		$Usuario = $_POST['login-username'];
		$Clave = $_POST['login-password'];
		
		$usuario = $_POST['login-username'];
		
		if(empty($Usuario) OR empty($Clave)){
			$msg='Usuario y contrseña no puede ir vacio';
		}else{
			try{
				$mbd = new PDO('mysql:host=localhost;dbname=serviciomatriculas','root','');

				$where = "where u.Estado = 1 and Codigo = '$Usuario' and Clave = '$Clave'";
				
				foreach($mbd->query('select r.CodigoRol, r.EstadoAdmin from usuarios u inner join roles r on r.CodigoRol = u.CodigoRol '. $where) as $fila) {
					$_SESSION['login'] = $Usuario.','.md5($Clave);
					$_SESSION['usuario'] = $Usuario;
					$_SESSION['CodigoUsuarioRol'] = $fila['CodigoRol'];
					$_SESSION['Administrador'] = $fila['EstadoAdmin'];
					header('location: index.php');
				}
				$mbd = null;
				
			}catch (PDOException $e){
				print "!Error¡:" . $e->getMessage() . "<br>";
				die();
			}
		}
	}
	/*************************************************************************************************************/
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
	<body action="login.php" method="post">
		<div class="background_login" align="center">
			<table cellspacing="0" cellpadding="0" width="100%" height="100%">
				<tr>
					<td align="center" valign="middle">
						<div class="area_login">
							<div id="logo">
								<img src="./img/logo.jpg" style="padding-top: 15px;">
							</div>
							<div id="login">
								<h3>ESCUELA</h3>
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
									<button class="btn btn-success btn-block" name="autenticar" id="login-btn" onclick="ValidarLogin()" value="1">Ingresar</button>
									<!--<button type="submit" id="login-btn" name="autenticar" value="1">Ingresar</button>-->
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
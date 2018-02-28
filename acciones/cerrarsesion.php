<?php
	error_reporting(0);
	session_start();
	require_once('..//conexion/conexiondb.php');
	$conexion=crear_conexion();
	
	if(isset($_SESSION['usuario']))
	{
		CerrarUsuario($conexion,$_SESSION['usuario'],0);
		unset($_SESSION['usuario']);
	}
	if(isset($_SESSION['modulos']))
	{
		unset($_SESSION['modulos']);
	}
?>
<script>window.location.reload(true);</script>
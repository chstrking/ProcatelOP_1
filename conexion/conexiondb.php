<?php
/*$db_usr='usr';
$db_pass='T2Ka5AjoYf'; 
$db_server='108.60.209.5,1087';
$db_name='BDIntegso';*/

$db_usr='root';
$db_pass='';
$db_server='localhost';
$db_name='serviciomatriculas';


function mssql_escape($str)
{
    if(get_magic_quotes_gpc())
    {
        $str= stripslashes($str);
    }
    return str_replace("'", "''", $str);
}

function dameFecha($fecha,$dia)
{   list($day,$mon,$year) = explode('-',$fecha);
    return date('d-m-Y',mktime(0,0,0,$mon,$day+$dia,$year));        
}

function crear_conexion()
{
	global $db_usr, $db_pass, $db_server, $db_name;
	//$db_info= array('Database'=>$db_name,'UID'=>$db_usr,'PWD'=>$db_pass);
	$db_info= mysqli_connect($db_server,$db_usr,$db_pass,$db_name);
	$db_link= mysqli_select_db($db_name, $db_info);
	if(!$db_link){
		print_r( sqlsrv_errors(), true);
		return null;
	}
	else
	{
		return $db_link;
	}
}

function consultar($conexion,$procedure,$parametros)
{
	$datos="";
	for($i=0;$i<count($parametros);$i++)
	{
		//$datos=$datos."'".mysql_real_escape_string($parametros[$i])."'";
		if(is_int($parametros[$i]))
		{
			$datos=$datos.mssql_escape($parametros[$i]);
		}
		else
		{
			$datos=$datos."'".mssql_escape($parametros[$i])."'";
		}
		if(($i+1)<count($parametros))
		{
			$datos=$datos.", ";
		}
	}
	$query = "exec $procedure $datos"; //var_dump($query);
	if($procedure=="SP_Ing_FacturasVWeb" || $procedure=="SP_Ing_DFacturasV")
	{
		//var_dump($query);
	}
	$result_sp = sqlsrv_query($conexion, $query); 
	if( $result_sp === false) 
	{//var_dump('error');
		if( ($errors = sqlsrv_errors() ) != null) 
		{
			foreach( $errors as $error ) 
			{
				//var_dump( "SQLSTATE: ".$error[ 'SQLSTATE']."<br />");
				//var_dump( "code: ".$error[ 'code']."<br />");
				//var_dump( "message: ".$error[ 'message']."<br />");
			}
		}
		return null;
	}
	else
	{
		//var_dump($result_sp);
		return $result_sp;
	}
}
/*
function consultar($conexion,$procedure,$parametros)
{
	$datos="";
	for($i=0;$i<count($parametros);$i++)
	{
		$datos=$datos."'".mysql_real_escape_string($parametros[$i])."'";
		if(($i+1)<count($parametros))
		{
			$datos=$datos.", ";
		}
	}
	$query = "exec $procedure $datos";
	$result_sp = sqlsrv_query($conexion, $query);
	if( $result_sp === false) 
	{
		if( ($errors = sqlsrv_errors() ) != null) 
		{
			foreach( $errors as $error ) 
			{
				//echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				//echo "code: ".$error[ 'code']."<br />";
				//echo "message: ".$error[ 'message']."<br />";
			}
		}
		return null;
	}
	else
	{
		return $result_sp;
	}
}*/
/*
function consultar($conexion,$procedure,$parametros)
{
	$datos="";
	for($i=0;$i<count($parametros);$i++)
	{
		//$datos=$datos."'".mysql_real_escape_string($parametros[$i])."'";
		if(is_int($parametros[$i]))
		{
			$datos=$datos.mssql_escape($parametros[$i]);
		}
		else
		{
			$datos=$datos."'".mssql_escape($parametros[$i])."'";
		}
		if(($i+1)<count($parametros))
		{
			$datos=$datos.", ";
		}
	}
	$query = "exec $procedure $datos";
	if($procedure=="SP_Ing_FacturasVWeb" || $procedure=="SP_Ing_DFacturasV")
	{
		//echo $query;
	}
	$result_sp = sqlsrv_query($conexion, $query);
	if( $result_sp === false) 
	{
		if( ($errors = sqlsrv_errors() ) != null) 
		{
			foreach( $errors as $error ) 
			{
				//echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				//echo "code: ".$error[ 'code']."<br />";
				//echo "message: ".$error[ 'message']."<br />";
			}
		}
		return null;
	}
	else
	{
		return $result_sp;
	}
}*/


function consultarstore($conexion,$procedure,$parametros)
{
	$datos="";
	//echo count($parametros);
	for($i=0;$i<count($parametros);$i++)
	{
		$datos=$datos." ?";
		if(($i+1)<count($parametros))
		{
			$datos=$datos.",";
		}
	}
	$query = "{call $procedure($datos)}";
	//echo $query;
	$result_sp = sqlsrv_query($conexion, $query, $parametros);
	//var_dump($parametros);
	if( $result_sp === false) 
	{
		if( ($errors = sqlsrv_errors() ) != null) 
		{
			foreach( $errors as $error ) 
			{
				//echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				//echo "code: ".$error[ 'code']."<br />";
				//echo "message: ".$error[ 'message']."<br />";
			}
		}
		return null;
	}
	else
	{
		return $result_sp;
	}
}


function consultarSinParametros($conexion,$procedure)
{
	$query = "exec $procedure ";
	$result_sp = sqlsrv_query($conexion, $query);
	//var_dump($result_sp);
	if( $result_sp === false) 
	{
		if( ($errors = sqlsrv_errors() ) != null) 
		{
			foreach( $errors as $error ) 
			{
				//echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				//echo "code: ".$error[ 'code']."<br />";
				//echo "message: ".$error[ 'message']."<br />";
			}
		}
		return null;
	}
	else
	{
		return $result_sp;
	}
}


function login($conexion,$usuario,$clave)
{
	$procedure="Sp_Autenticacion";
	$parametros=array($usuario,$clave);
	//var_dump($parametros);
	$login=array();
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$login['Respuesta']=$row['Respuesta'];
		$login['CodSuc']=$row['CodSuc'];
	}
	//var_dump($login);
	return $login;		
}

function actualizarclave($conexion,$usuario,$clave)
{
	$procedure="Sp_ActualizaClaveUsuario";
	$parametros=array($usuario,$clave);
	//var_dump($parametros);
	$login=array();
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$login['Respuesta']=$row['Respuesta'];
		$login['CodSuc']=$row['CodSuc'];
	}
	return $login;		
}

function RecuperarPass($conexion,$usuario)
{
	$procedure="Sp_ValidaUsuario";
	$parametros=array($usuario);
	//var_dump($parametros);
	$login=array();
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$login['Pwd']=$row['Pass'];
		$login['Mail']=$row['correo'];
	}
	return $login;		
}

function sendMail($correo,$password) 
{
    $remitente = 'noresponder@improcads.com' ;
	$destino = $correo ;
	$asunto = "Recordar Clave Improcads";
	$mensaje = "Este es un correo del sistema que pertenece a PROCATEL S.A. Corresponde a la recuperaci&oacute;n de la clave. Su clave es:".$password ;
	$encabezados = "From: $remitente\nReply-To: $remitente\nContent-Type: text/html; charset=iso-8859-1" ;
	@mail($destino, $asunto, $mensaje, $encabezados) ;
}

function modulos_IPs($conexion,$ip_usuario)
{
	$bandera=false;
	$procedure="Sp_TraeDatosIp";
	$parametros=array();
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$ip=$row['vIpConfig'];
		if($ip==$ip_usuario)
		{
			$bandera=true;
		}
	}
	return $bandera;		
}

function modulos_usuario($conexion,$usuario)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConOpcRolMod";
	$parametros=array($usuario,'M',0);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function opciones_totales($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaRolesOpciones";
	$result_sp=consultarSinParametros($conexion,$procedure);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function ultima_factura($conexion,$Usuario)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaLastFactura";
	$parametros=array($Usuario);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function ultima_facturaC($conexion,$Usuario)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaLastFacturaC";
	$parametros=array($Usuario);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function ultimo_kardex($conexion,$IdBod,$IdBodE,$Usuario)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaLastKardex";
	$parametros=array(intval($IdBod),intval($IdBodE),$Usuario);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function opciones_rol($conexion,$id_rol)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaOpcionesPorUsuario";
	$parametros=array(intval($id_rol));
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function guardarrolopcion($conexion,$id_opcion,$id_modulo,$id_rol,$tipo)
{
	$data = array();
	$i=0;
	$procedure="Sp_ActualizaRolesOpciones";
	$parametros=array(intval($id_modulo),intval($id_rol),intval($id_opcion),$tipo);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function find_sucursal($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultasSucursales";
	$parametros=array($codigo,$tipo,$busqueda);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$data[$i]=$row;
		//$i++;
		$data[$i]['Suc_Codigo']=$row['Suc_Codigo'];
		$data[$i]['Suc_Nombre']=$row['Suc_Nombre'];
		$data[$i]['Suc_Direccion']=$row['Suc_Direccion'];
		$data[$i]['Suc_Telefono']=$row['Suc_Telefono'];
		$data[$i]['Suc_Fax']=$row['Suc_Fax'];
		$data[$i]['Suc_Estado']=$row['Suc_Estado'];
		$data[$i]['Suc_NumAutSriR']=$row['Suc_NumAutSriR'];
		$data[$i]['Suc_SerieR']=$row['Suc_SerieR'];
		$data[$i]['Suc_HastaNumR']=$row['Suc_HastaNumR'];
		$data[$i]['Suc_DesdeNumR']=$row['Suc_DesdeNumR'];
		$data[$i]['Suc_FecMaxSriR']=$row['Suc_FecMaxSriR'];
		$data[$i]['Suc_NumAutSriND']=$row['Suc_NumAutSriND'];
		$data[$i]['Suc_SerieND']=$row['Suc_SerieND'];
		$data[$i]['Suc_DesdeNumND']=$row['Suc_DesdeNumND'];
		$data[$i]['Suc_HastaNumND']=$row['Suc_HastaNumND'];
		$data[$i]['Suc_FecMaxSriND']=$row['Suc_FecMaxSriND'];
		$data[$i]['Suc_NumAutSriNC']=$row['Suc_NumAutSriNC'];
		$data[$i]['Suc_SerieNC']=$row['Suc_SerieNC'];
		$data[$i]['Suc_DesdeNumNC']=$row['Suc_DesdeNumNC'];
		$data[$i]['Suc_HastaNumNC']=$row['Suc_HastaNumNC'];
		$data[$i]['Suc_FecMaxSriNC']=$row['Suc_FecMaxSriNC'];
		$data[$i]['Suc_NumAutSriNV']=$row['Suc_NumAutSriNV'];
		$data[$i]['Suc_SerieNV']=$row['Suc_SerieNV'];
		$data[$i]['Suc_DesdeNumNV']=$row['Suc_DesdeNumNV'];
		$data[$i]['Suc_HastaNumNV']=$row['Suc_HastaNumNV'];
		$data[$i]['Suc_FecMaxSriNV']=$row['Suc_FecMaxSriNV'];
		$data[$i]['Suc_NumAutSriF']=$row['Suc_NumAutSriF'];
		$data[$i]['Suc_SerieF']=$row['Suc_SerieF'];
		$data[$i]['Suc_DesdeNumF']=$row['Suc_DesdeNumF'];
		$data[$i]['Suc_HastaNumF']=$row['Suc_HastaNumF'];
		$data[$i]['Suc_ActualNumF']=$row['Suc_ActualNumF'];
		$data[$i]['Suc_FecMaxSriF']=$row['Suc_FecMaxSriF'];
		$i++;
	}
	return $data;	
}

/*
function getsucursal($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultasSucursales";
	$parametros=array($codigo,$tipo,$busqueda);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data['Suc_Codigo']=$row['Suc_Codigo'];
		$data['Suc_Nombre']=$row['Suc_Nombre'];
		$data['Suc_Direccion']=$row['Suc_Direccion'];
		$data['Suc_Telefono']=$row['Suc_Telefono'];
		$data['Suc_Fax']=$row['Suc_Fax'];
		$data['Suc_Estado']=$row['Suc_Estado'];
		$data['Suc_NumAutSriR']=$row['Suc_NumAutSriR'];
		$data['Suc_SerieR']=$row['Suc_SerieR'];
		$data['Suc_HastaNumR']=$row['Suc_HastaNumR'];
		$data['Suc_DesdeNumR']=$row['Suc_DesdeNumR'];
		$data['Suc_FecMaxSriR']=$row['Suc_FecMaxSriR'];
		$data['Suc_NumAutSriND']=$row['Suc_NumAutSriND'];
		$data['Suc_SerieND']=$row['Suc_SerieND'];
		$data['Suc_DesdeNumND']=$row['Suc_DesdeNumND'];
		$data['Suc_HastaNumND']=$row['Suc_HastaNumND'];
		$data['Suc_FecMaxSriND']=$row['Suc_FecMaxSriND'];
		$data['Suc_NumAutSriNC']=$row['Suc_NumAutSriNC'];
		$data['Suc_SerieNC']=$row['Suc_SerieNC'];
		$data['Suc_DesdeNumNC']=$row['Suc_DesdeNumNC'];
		$data['Suc_HastaNumNC']=$row['Suc_HastaNumNC'];
		$data['Suc_FecMaxSriNC']=$row['Suc_FecMaxSriNC'];
		$data['Suc_NumAutSriNV']=$row['Suc_NumAutSriNV'];
		$data['Suc_SerieNV']=$row['Suc_SerieNV'];
		$data['Suc_DesdeNumNV']=$row['Suc_DesdeNumNV'];
		$data['Suc_HastaNumNV']=$row['Suc_HastaNumNV'];
		$data['Suc_FecMaxSriNV']=$row['Suc_FecMaxSriNV'];
		$data['Suc_NumAutSriF']=$row['Suc_NumAutSriF'];
		$data['Suc_SerieF']=$row['Suc_SerieF'];
		$data['Suc_DesdeNumF']=$row['Suc_DesdeNumF'];
		$data['Suc_HastaNumF']=$row['Suc_HastaNumF'];
		$data['Suc_ActualNumF']=$row['Suc_ActualNumF'];
		$data['Suc_FecMaxSriF']=$row['Suc_FecMaxSriF'];
	}
	return $data;		
}
*/
function getusuario($conexion,$id)
{
	$data = array();
	$procedure="SP_consultar_usuarioWEB";
	$parametros=array($id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data['id']=$row['Usu_usuario'];
		$data['Usu_clave']=$row['Usu_clave'];
		$data['estado']=$row['Usu_Estado'];
		$data['fecha_ingreso']=$row['Usu_FecIng'];
		$data['fecha_vencimiento']=$row['Usu_FecVenc'];
		$data['cod_empleado']=$row['Usu_CodEmpl'];
		$data['nombre']=$row['nombre'];
		$data['mail']=$row['Usu_correo'];
		$data['Rol_codigo']=$row['Rol_codigo'];
	}
	return $data;		
}

function getopcion($conexion,$id)
{
	$data = array();
	$procedure="SP_ConsultaOpcionesWeb";
	$parametros=array($id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data['nombre']=$row['Opc_Nombre'];
		$data['estado']=$row['Opc_Estado'];
		$data['modulo']=$row['Mod_Nombre'];
		$data['Opc_ModCodigo']=$row['Opc_ModCodigo'];
	}
	return $data;		
}

function getempleado($conexion,$id)
{
	$data = array();
	$procedure="SP_ConsultaEmpleadosGen";
	$parametros=array($id);
	console.log($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data['Id']=$row['Empl_codigo'];
		$data['Empl_CodEmpresa']=$row['Empl_CodEmpresa'];
		$data['Empl_Cedula']=$row['Empl_Cedula'];
		$data['Empl_Apellidos']=$row['Empl_Apellidos'];
		$data['Empl_Nombres']=$row['Empl_Nombres'];
		$data['Empl_Titulo']=$row['Empl_Titulo'];
		$data['Empl_CodCargo']=$row['Empl_CodCargo'];
		$data['Empl_CodDepto']=$row['Empl_CodDepto'];
		$data['Empl_CodCtaCont']=$row['Empl_CodCtaCont'];
		$data['Empl_Tipo']=$row['Empl_Tipo'];
		$data['Empl_Foto']=$row['Empl_Foto'];
		$data['estado']=$row['Empl_Estado'];
		$data['DEmpl_lugar']=$row['DEmpl_lugar'];
		$data['DEmpl_sueldo']=$row['DEmpl_sueldo'];
		$data['DEmpl_fecha']=$row['DEmpl_fecha'];
		$data['DEmpl_formpago']=$row['formpago'];
		$data['DEmpl_alimentacion']=$row['DEmpl_alimentacion'];
		$data['DEmpl_imprent']=$row['DEmpl_imprent'];
		$data['DEmpl_hijos']=$row['DEmpl_hijos'];
		$data['Suc_Nombre']=$row['Suc_Nombre'];
		$data['Suc_Codigo']=$row['Suc_Codigo'];
		$data['Dpto_Nombre']=$row['Dpto_Nombre'];
		$data['Dpto_Codigo']=$row['Dpto_Codigo'];
		$data['Carg_Descripcion']=$row['Carg_Descripcion'];
		$data['Carg_Codigo']=$row['Carg_Codigo'];
		$data['cuenta']=$row['cuenta']; 	//$i++;
	}
	return $data;			
}

function find_cliente($conexion,$sucursal,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaClientes";
	$parametros=array('1',$tipo,$busqueda,$codigo);
	
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_bodega($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaBodega";
	$parametros=array('U');
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_bodega2($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaBodega2";
	$parametros=array($codigo,$tipobusqueda,$busqueda);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_ciudad($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaCiudad";
	$parametros=array('U');
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_division($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaDivision";
	$parametros=array($codigo,$tipobusqueda,$busqueda);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}


function find_zona($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaZona";
	$parametros=array('U');
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_marca($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaMarca";
	$parametros=array($codigo,$tipobusqueda,$busqueda);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_producto($conexion,$tipobusqueda,$codigo,$busqueda,$marca)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaProducto";
	$parametros=array($codigo,$tipobusqueda,$busqueda,$marca);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function Print_Kardex($conexion,$codigo_Kardex)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_Kardex";
	$parametros=array(1,$codigo_Kardex);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['codigo_kar'] = $row['codigo_kar'];      
		$data[$i]['DProd_Codigo'] = $row['DProd_Codigo'];    
		$data[$i]['Kar_Fecha'] = $row['Kar_Fecha'];  
		$data[$i]['Kar_FechaSist'] = $row['Kar_FechaSist'];  
		$data[$i]['Kar_Tipo'] = $row['Kar_Tipo']; 
		$data[$i]['Kar_CodBodega'] = $row['Kar_CodBodega'];  
		$data[$i]['Kar_CodBodegaE'] = $row['Kar_CodBodegaE']; 
		$data[$i]['Kar_Motivo'] = $row['Kar_Motivo'];  
		$data[$i]['Kar_CodFact'] = $row['Kar_CodFact'];  
		$data[$i]['Kar_CodAsientoCont'] = $row['Kar_CodAsientoCont'];    
		$data[$i]['Kar_Estado'] = $row['Kar_Estado']; 
		$data[$i]['Kar_Usuario'] = $row['Kar_Usuario'];  
		$data[$i]['DKar_CodKardex'] = $row['DKar_CodKardex'];   
		$data[$i]['DKar_CodProducto'] = $row['DKar_CodProducto'];   
		$data[$i]['Descripcion'] = $row['Descripcion'];  
		$data[$i]['Pro_CodTipoProd'] = $row['Pro_CodTipoProd'];  
		$data[$i]['TipP_Descripcion'] = $row['TipP_Descripcion']; 
		$data[$i]['Pro_CantRast'] = $row['Pro_CantRast'];   
		$data[$i]['Pro_CantxRast'] = $row['Pro_CantxRast'];  
		$data[$i]['Pro_Serie'] = $row['Pro_Serie'];  
		$data[$i]['Dprod_serie'] = $row['Dprod_serie'];    
		$data[$i]['Pro_Stock'] = $row['Pro_Stock'];  
		$data[$i]['Pro_StockFraccion'] = $row['Pro_StockFraccion'];  
		$data[$i]['Pro_Costo'] = $row['Pro_Costo'];   
		$data[$i]['Pro_PVP1'] = $row['Pro_PVP1'];   
		$data[$i]['Pro_PVP2'] = $row['Pro_PVP2'];  
		$data[$i]['Pro_PVP3'] = $row['Pro_PVP3'];  
		$data[$i]['Pro_PVP4'] = $row['Pro_PVP4']; 
		$data[$i]['Pro_CodPrecio'] = $row['Pro_CodPrecio'];   
		$data[$i]['Pro_CodProv'] = $row['Pro_CodProv'];  
		$data[$i]['Pro_Estado'] = $row['Pro_Estado'];  
		$data[$i]['DKar_Cant'] = $row['DKar_Cant'];    
		$data[$i]['DKar_CantFraccion'] = $row['DKar_CantFraccion'];  
		$data[$i]['DKar_Costo'] = $row['DKar_Costo']; 		
		$data[$i]['Dkar_PVP1'] = $row['Dkar_PVP1'];   
		$data[$i]['Dkar_PVP2'] = $row['Dkar_PVP2'];  
		$data[$i]['Dkar_PVP3'] = $row['Dkar_PVP3'];  
		$data[$i]['Kar_CodEmpresa'] = $row['Kar_CodEmpresa']; 
		$data[$i]['Emp_Nombre'] = $row['Emp_Nombre'];   
		$data[$i]['Emp_RUC'] = $row['Emp_RUC'];  
		$data[$i]['Emp_Direccion'] = $row['Emp_Direccion'];  
		$data[$i]['Emp_Telefono'] = $row['Emp_Telefono'];    
		$data[$i]['Emp_Fax'] = $row['Emp_Fax'];  
		$data[$i]['Bod_Descripcion'] = $row['Bod_Descripcion']; 
		$data[$i]['BodDescrip2'] = $row['BodDescrip2']; 
		$i++;
	}
	return $data;		
}

function Print_MovimientoKardex($conexion,$codigo_Producto)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_KardexXProd";
	$parametros=array($codigo_Producto);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['kar_fecha'] = $row['kar_fecha'];      
		$data[$i]['pro_codigo'] = $row['pro_codigo'];    
		$data[$i]['dprod_codigo'] = $row['dprod_codigo'];  
		$data[$i]['dprod_serie'] = $row['dprod_serie'];  
		$data[$i]['dkar_numserie'] = $row['dkar_numserie']; 
		$data[$i]['dkar_cant'] = $row['dkar_cant'];  
		$data[$i]['dkar_costo'] = $row['dkar_costo']; 
		$data[$i]['kar_tipo'] = $row['kar_tipo'];  
		$data[$i]['kar_codbodega'] = $row['kar_codbodega'];  
		$data[$i]['kar_codbodegae'] = $row['kar_codbodegae'];    
		$data[$i]['kar_motivo'] = $row['kar_motivo']; 
		$i++;
	}
	return $data;		
}

function Print_ConsultaKardex($conexion,$FechaI,$FechaF)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_KardexMul";
	$parametros=array(1,$FechaI,$FechaF);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Kar_Codigo'] = $row['Kar_Codigo'];      
		$data[$i]['DProd_Codigo'] = $row['DProd_Codigo'];    
		$data[$i]['Kar_Fecha'] = $row['Kar_Fecha']->format("d/m/Y");  
		$data[$i]['Kar_FechaSist'] = $row['Kar_FechaSist']->format("d/m/Y");  
		$data[$i]['Kar_Tipo'] = $row['Kar_Tipo']; 
		$data[$i]['Kar_CodBodega'] = $row['Kar_CodBodega'];  
		$data[$i]['Kar_CodBodegaE'] = $row['Kar_CodBodegaE']; 
		$data[$i]['Kar_Motivo'] = $row['Kar_Motivo'];  
		$data[$i]['Kar_CodFact'] = $row['Kar_CodFact'];  
		$data[$i]['Kar_CodAsientoCont'] = $row['Kar_CodAsientoCont'];    
		$data[$i]['Kar_Estado'] = $row['Kar_Estado']; 
		$data[$i]['DKar_CodKardex'] = $row['DKar_CodKardex'];      
		$data[$i]['DKar_CodProducto'] = $row['DKar_CodProducto'];    
		$data[$i]['Descripcion'] = $row['Descripcion'];  
		$data[$i]['Pro_CodTipoProd'] = $row['Pro_CodTipoProd'];  
		$data[$i]['TipP_Descripcion'] = $row['TipP_Descripcion']; 
		$data[$i]['Pro_CantRast'] = $row['Pro_CantRast'];  
		$data[$i]['Pro_CantxRast'] = $row['Pro_CantxRast']; 
		$data[$i]['Pro_Serie'] = $row['Pro_Serie'];  
		$data[$i]['Dprod_serie'] = $row['Dprod_serie'];  
		$data[$i]['Pro_Stock'] = $row['Pro_Stock'];    
		$data[$i]['Pro_StockFraccion'] = $row['Pro_StockFraccion']; 
		$data[$i]['Pro_Costo'] = $row['Pro_Costo']; 
		$data[$i]['Pro_PVP1'] = $row['Pro_PVP1'];      
		$data[$i]['Pro_PVP2'] = $row['Pro_PVP2'];    
		$data[$i]['Pro_PVP3'] = $row['Pro_PVP3'];  
		$data[$i]['Pro_PVP4'] = $row['Pro_PVP4'];  
		$data[$i]['Pro_CodPrecio'] = $row['Pro_CodPrecio']; 
		$data[$i]['Pro_CodProv'] = $row['Pro_CodProv'];  
		$data[$i]['Pro_Estado'] = $row['Pro_Estado']; 
		$data[$i]['DKar_Cant'] = $row['DKar_Cant'];  
		$data[$i]['DKar_CantFraccion'] = $row['DKar_CantFraccion'];  
		$data[$i]['DKar_Costo'] = $row['DKar_Costo'];    
		$data[$i]['Dkar_PVP1'] = $row['Dkar_PVP1']; 
		$data[$i]['Dkar_PVP2'] = $row['Dkar_PVP2']; 
		$data[$i]['Dkar_PVP3'] = $row['Dkar_PVP3'];  
		$data[$i]['Kar_CodEmpresa'] = $row['Kar_CodEmpresa']; 
		$data[$i]['Emp_Nombre'] = $row['Emp_Nombre'];  
		$data[$i]['Emp_RUC'] = $row['Emp_RUC'];  
		$data[$i]['Emp_Direccion'] = $row['Emp_Direccion'];    
		$data[$i]['Emp_Telefono'] = $row['Emp_Telefono']; 
		$data[$i]['Emp_Fax'] = $row['Emp_Fax'];  
		$data[$i]['Bod_Descripcion'] = $row['Bod_Descripcion'];    
		$data[$i]['BodDescrip2'] = $row['BodDescrip2']; 
		$i++;
	}
	return $data;		
}

function Print_StockBodega($conexion,$codigoB,$codigoT,$codigoM,$codigoP)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_Resumen_StockxBodega";
	$parametros=array(1,intval($codigoB),intval($codigoT),intval($codigoM),intval($codigoP));
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		/*$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];*/
		$data[$i]['Pro_Codigo'] = $row['Pro_Codigo'];      
		$data[$i]['Descripcion'] = $row['Descripcion'];    
		$data[$i]['Emp_RUC'] = $row['Emp_RUC'];  
		$data[$i]['Pro_CodTipoProd'] = $row['Pro_CodTipoProd'];  
		$data[$i]['TipP_Descripcion'] = $row['TipP_Descripcion']; 
		$data[$i]['Pro_CodMarca'] = $row['Pro_CodMarca'];  
		$data[$i]['Mar_Descripcion'] = $row['Mar_Descripcion']; 
		$data[$i]['Pro_Modelo'] = $row['Pro_Modelo'];  
		$data[$i]['Pro_CodTecnologia'] = $row['Pro_CodTecnologia'];  
		$data[$i]['Tec_Descripcion'] = $row['Tec_Descripcion'];    
		$data[$i]['Dprod_Serie'] = $row['Dprod_Serie']; 
		$data[$i]['Pro_Dato1'] = $row['Pro_Dato1'];  
		$data[$i]['Pro_Dato2'] = $row['Pro_Dato2'];   
		$data[$i]['Pro_Dato3'] = $row['Pro_Dato3'];   
		$data[$i]['Pro_Stock'] = $row['Pro_Stock'];  
		$data[$i]['Pro_StockFraccion'] = $row['Pro_StockFraccion'];  
		$data[$i]['DProd_Stock'] = $row['DProd_Stock']; 
		$data[$i]['Dprod_CodBodega'] = $row['Dprod_CodBodega'];   
		$data[$i]['Bod_Descripcion'] = $row['Bod_Descripcion'];  
		$data[$i]['Bod_CodRespEmpl'] = $row['Bod_CodRespEmpl'];  
		$data[$i]['Bod_Ubicacion'] = $row['Bod_Ubicacion'];    
		$data[$i]['Empl_Apellidos'] = $row['Empl_Apellidos'];  
		$data[$i]['Empl_Nombres'] = $row['Empl_Nombres'];    
		$i++;
	}
	return $data;		
}

function ActualizaEstadoPagado($conexion,$idFactura)
{
	$data = array();
	$i=0;
	$procedure="Sp_CobroFactura";
	$parametros=array(intval($idFactura));
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function RPrint_Factura($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_Factura";
	$parametros=array(1,intval($Id));
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['codigo'] = $row['VFact_Codigo'];      
		$data[$i]['codigoempresa'] = $row['VFact_CodEmpresa'];    
		$data[$i]['nombreempresa'] = $row['Emp_Nombre'];  
		$data[$i]['ruc'] = $row['Emp_RUC'];  
		$data[$i]['codigocliente'] = $row['VFact_CodCliente']; 
		$data[$i]['nombrecliente'] = $row['Clte_Nombre'];  
		$data[$i]['direccion'] = $row['Clte_Direccion']; 
		$data[$i]['cedula'] = $row['Clte_Ruc'];  
		$data[$i]['telefono'] = $row['Clte_telef'];  
		$data[$i]['facturatipo'] = $row['VFact_Tipo'];    
		$data[$i]['dia'] = $row['dia']; 
		$data[$i]['mes'] = $row['mes'];  
		$data[$i]['anio'] = $row['anio'];   
		$data[$i]['fecha'] = $row['VFact_Fecha'];   
		$data[$i]['codigokardex'] = $row['VFact_CodKardex'];  
		$data[$i]['codigoordencompra'] = $row['VFact_CodOrdenCompra'];  
		$data[$i]['tarifacero'] = $row['VFact_SubTarifaCero']; 
		$data[$i]['traifaiva'] = $row['VFact_SubTarifaIVA'];   
		$data[$i]['descuento'] = $row['VFact_Descuento'];  
		$data[$i]['iva'] = $row['VFact_IVA'];  
		$data[$i]['total'] = $row['VFact_Total'];    
		$data[$i]['ice'] = $row['VFact_ICE'];  
		$data[$i]['concepto'] = $row['VFact_Concepto'];    
		$data[$i]['estado'] = $row['VFact_Estado']; 
		$data[$i]['detalletotal'] = $row['VDFact_Total']; 
		$data[$i]['preciounitario'] = $row['VDFact_PUnitario'];  
		$data[$i]['dsctov'] = $row['VDFact_DesctoV']; 
		$data[$i]['dsctop'] = $row['VDFact_DesctoP'];  
		$data[$i]['cantidad'] = $row['VDFact_Cant'];      
		$data[$i]['codigoproducto'] = $row['VDFact_CodDproducto'];     
		$data[$i]['codigotipoproducto'] = $row['TipP_Codigo'];    
		$data[$i]['desctipoproducto'] = $row['TipP_Descripcion'];    
		$data[$i]['descripcion'] = $row['Descripcion'];     
		$data[$i]['serie'] = $row['Series_Prod'];      
		$data[$i]['intv'] = $row['Series_Intv'];  
		$data[$i]['contado'] = $row['Contado']; 
		$data[$i]['facturaserie'] = $row['VFact_Serie'];  
		$data[$i]['numerodocumento'] = $row['VFact_NumDoc'];  
		$data[$i]['AutorizacionSRI'] = $row['VFact_NumAutSri'];   
		$i++;
	}
	return $data;		
}

function Print_Factura($conexion,$usuario)
{
	$data = array();
	$i=0;
	//$procedure="SP_Con_Factura";
	$procedure="SP_Con_Factura2";
	$parametros=array(1,$usuario);
	//var_dump($conexion);
	//var_dump($procedure);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		/*$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];*/
		//var_dump("ENTRO");
		$data[$i]['codigo'] = $row['VFact_Codigo'];      
		$data[$i]['codigoempresa'] = $row['VFact_CodEmpresa'];    
		$data[$i]['nombreempresa'] = $row['Emp_Nombre'];  
		$data[$i]['ruc'] = $row['Emp_RUC'];  
		$data[$i]['codigocliente'] = $row['VFact_CodCliente']; 
		$data[$i]['nombrecliente'] = $row['Clte_Nombre'];  
		$data[$i]['direccion'] = $row['Clte_Direccion']; 
		$data[$i]['cedula'] = $row['Clte_Ruc'];  
		$data[$i]['telefono'] = $row['Clte_telef'];  
		$data[$i]['facturatipo'] = $row['VFact_Tipo'];    
		$data[$i]['dia'] = $row['dia']; 
		$data[$i]['mes'] = $row['mes'];  
		$data[$i]['anio'] = $row['anio'];   
		$data[$i]['fecha'] = $row['VFact_Fecha'];   
		$data[$i]['codigokardex'] = $row['VFact_CodKardex'];  
		$data[$i]['codigoordencompra'] = $row['VFact_CodOrdenCompra'];  
		$data[$i]['tarifacero'] = $row['VFact_SubTarifaCero']; 
		$data[$i]['traifaiva'] = $row['VFact_SubTarifaIVA'];   
		$data[$i]['descuento'] = $row['VFact_Descuento'];  
		$data[$i]['iva'] = $row['VFact_IVA'];  
		$data[$i]['total'] = $row['VFact_Total'];    
		$data[$i]['ice'] = $row['VFact_ICE'];  
		$data[$i]['concepto'] = $row['VFact_Concepto'];    
		$data[$i]['estado'] = $row['VFact_Estado']; 
		$data[$i]['detalletotal'] = $row['VDFact_Total']; 
		$data[$i]['preciounitario'] = $row['VDFact_PUnitario'];  
		$data[$i]['dsctov'] = $row['VDFact_DesctoV']; 
		$data[$i]['dsctop'] = $row['VDFact_DesctoP'];  
		$data[$i]['cantidad'] = $row['VDFact_Cant'];      
		$data[$i]['codigoproducto'] = $row['VDFact_CodDproducto'];     
		$data[$i]['codigotipoproducto'] = $row['TipP_Codigo'];    
		$data[$i]['desctipoproducto'] = $row['TipP_Descripcion'];    
		$data[$i]['descripcion'] = $row['Descripcion'];     
		$data[$i]['serie'] = $row['Series_Prod'];      
		$data[$i]['intv'] = $row['Series_Intv'];  
		$data[$i]['contado'] = $row['Contado']; 
		$data[$i]['facturaserie'] = $row['VFact_Serie'];  
		$data[$i]['numerodocumento'] = $row['VFact_NumDoc'];  
		$data[$i]['AutorizacionSRI'] = $row['VFact_NumAutSri'];   
		$i++;
	}
	//var_dump($data);
	return $data;		
}

function Print_Efectivo($conexion,$Fecha,$Usuario,$Sucursal)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_Efectivo";
	$parametros=array(1,$Fecha,$Usuario,$Sucursal);
	//var_dump($parametros);
	//var_dump($procedure);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
	    $data[$i]['Codigo'] = $row['Codigo'];  
	    $data[$i]['CodSuc'] = $row['CodSuc'];  
	    $data[$i]['Sucursal'] = $row['Sucursal']; 
	    $data[$i]['Usuario'] = $row['Usuario'];  
	    $data[$i]['CodPFact'] = $row['CodPFact'];    
	    $data[$i]['CodFact'] = $row['CodFact']; 
	    $data[$i]['Factura'] = $row['Factura'];    
	    $data[$i]['Cliente'] = $row['Cliente'];   
	    $data[$i]['Tipo'] = $row['Tipo'];   
	    $data[$i]['ValorE'] = $row['ValorE'];   
	    $data[$i]['ValorQ'] = $row['ValorQ'];  
	    $data[$i]['ValorC'] = $row['ValorC']; 
	    $data[$i]['ValorT'] = $row['ValorT'];  
	    $data[$i]['ValorR'] = $row['ValorR'];
		$i++;
	}
	//var_dump($data);
	return $data;		
}

function Print_Caja($conexion,$FechaD,$FechaH,$Usuario,$Sucursal)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_ArqueoEfectivo";
	$parametros=array(1,$FechaD,$FechaH,$Usuario,$Sucursal);
	//var_dump($parametros);
	//var_dump($procedure);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
	    $data[$i]['Codigo'] = $row['Codigo'];  
	    $data[$i]['CodSuc'] = $row['CodSuc'];  
	    $data[$i]['Sucursal'] = $row['Sucursal']; 
	    $data[$i]['Usuario'] = $row['Usuario'];  
	    $data[$i]['Concepto'] = $row['Concepto'];    
	    $data[$i]['Fecha'] = $row['Fecha']->format("d/m/Y"); 
	    $data[$i]['Valor1'] = $row['Valor1'];    
	    $data[$i]['Valor2'] = $row['Valor2'];   
	    $data[$i]['Valor3'] = $row['Valor3']; 
		$i++;
	}
	//var_dump($data);
	return $data;		
}

function find_tiponegocio($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaTipoNegocio";
	$parametros=array('U');
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_tipocliente($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaTipoCliente";
	$parametros=array('U');
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}
 
function find_cuentas($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaCuentasClientes";
	$parametros=array($codigo,$tipobusqueda,$busqueda);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_bodegasucursal($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaBodegaSucursal";
	$parametros=array('U');
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_vendedor($conexion,$sucursal,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaVendedor";
	$parametros=array($tipo,$busqueda,$codigo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_cargo($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaCargo";
	$parametros=array($codigo,$tipo,$busqueda);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	//var_dump($data);
	return $data;		
}

function find_departamento($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaDepartamento";
	$parametros=array($codigo,$tipobusqueda,$busqueda);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	//var_dump($data);
	return $data;		
}

function find_usuario($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaUsuario";
	$parametros=array($codigo,$tipobusqueda,$busqueda);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	//var_dump($data);
	return $data;		
}

function find_modulo($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaModulo";
	$parametros=array($codigo,$tipobusqueda,$busqueda);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_vendedorgen($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaVendedor";
	$parametros=array($tipo,$busqueda,$codigo);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_provincia($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaProvincia";
	$parametros=array($tipo,$busqueda,$codigo);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_Proveedores($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultasProveedor";
	$parametros=array($codigo,$tipo,$busqueda);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['Prov_Codigo'];
		$data[$i]['nombre']=$row['Prov_Nombre'];
		$i++;
	}
	return $data;		
}

function find_Pais($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaPais";
	$parametros=array($tipo,$busqueda,$codigo);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_tipoproducto($conexion,$tipo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaTipoProducto";
	$parametros=array($tipo,$busqueda);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		/*$data[$i]['CODIGO']=$row['CODIGO'];
		$data[$i]['NOMBRE']=$row['NOMBRE'];
		$i++;*/
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function find_precios($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaPrecio";
	$parametros=array($tipo,$busqueda,$codigo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_tecnologia($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaTecnolgia";
	$parametros=array($tipo,$busqueda,$codigo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_cuentausuario($conexion,$tipo,$codigo,$busqueda,$idSuc)
{
	$data = array();
	$i=0;
	$procedure="Sp_UsuariosCaja";
	$parametros=array($busqueda,$idSuc);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['Caja'];
		$data[$i]['nombre']=$row['Usuario'];
		$i++;
	}
	return $data;		
}

function consultaGlobal($conexion,$tipobusqueda,$datoBusqueda,$storeProcedured)
{
	$data = array();
	$i=0;
	$parametros=array($tipobusqueda,$datoBusqueda);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$storeProcedured,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function consultaParametros($conexion,$Identificador)
{
	$data = array();
	$i=0;
	$storeProcedured="Sp_ConsultaSParametroAcceso";
	$parametros=array($tipobusqueda,$datoBusqueda);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$storeProcedured,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function opciones_modulo_usuario($conexion,$usuario,$modulo)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConOpcRolMod";
	$modulo=intval($modulo);
	$parametros=array($usuario,'O',$modulo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre_menu']=$row['NOMBRE'];
		$data[$i]['proceso']=limpia_espacios(strtolower($row['NOMBRE']));
		$i++;
	}
	return $data;		
}

function usuarios($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaUsuariosGlobal";
	$parametros=array('U');
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['user']=$row['Usu_usuario'];
		$data[$i]['estado']=$row['Usu_Estado'];
		$data[$i]['rol']=$row['Rol_Nombre'];
		$data[$i]['rol_codigo']=$row['Rol_codigo'];
		$data[$i]['mail']=$row['Usu_correo'];
		$i++;
	}
	return $data;		
}

function roles($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaRolesGlobal";
	$parametros=array('U');
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['Rol_codigo'];
		$data[$i]['nombre']=$row['Rol_Nombre'];
		$data[$i]['estado']=$row['Rol_Estado'];
		$i++;
	}
	return $data;		
}

function listarfacturas($conexion,$stored,$NumeroPaginas,$CantidadRegistros,$desde,$hasta,$IdSuc,$estado,$Usuario,$Direccion,$index,$last)
{
	$data = array();
	$i=0;
	$procedure="Sp_ListadoFactura";
	$parametros=array($Direccion,$last,$index,$CantidadRegistros,$desde,$hasta,$IdSuc,$Usuario,$estado); //var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) )
	{
		$data[$i]['ID']=$row['VFact_Codigo'];
		$data[$i]['CONCEPTO']=$row['VFact_Concepto'];
		$data[$i]['VTOTAL']=$row['VFact_Total'];
		$data[$i]['ESTADO']=$row['VFact_Estado'];
		$data[$i]['TOTAL']=$row['Cantidad'];
		$data[$i]['VFact_CodAsientoCont']=$row['VFact_CodAsientoCont'];
		$data[$i]['VFact_CodKardex']=$row['VFact_CodKardex'];
		$data[$i]['secuencial']=$row['secuencial'];
		$i++;
	} //var_dump($data);
	return $data;		
}

function listarfacturasC($conexion,$stored,$NumeroPaginas,$CantidadRegistros,$desde,$hasta,$IdSuc,$estado,$Usuario,$Direccion,$index,$last)
{
	$data = array();
	$i=0;
	$procedure="Sp_ListadoFacturaC";
	$parametros=array($Direccion,$last,$index,$CantidadRegistros,$desde,$hasta,$IdSuc,$Usuario,$estado); //var_dump($parametros);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) )
	{
		$data[$i]['ID']=$row['CFact_Codigo'];
		$data[$i]['CONCEPTO']=$row['CFact_Concepto'];
		$data[$i]['VTOTAL']=$row['CFact_Total'];
		$data[$i]['ESTADO']=$row['CFact_Estado'];
		$data[$i]['TOTAL']=$row['Cantidad'];
		$data[$i]['VFact_CodAsientoCont']=$row['CFact_CodAsientoCont'];
		$data[$i]['VFact_CodKardex']=$row['CFact_CodKardex'];
		$data[$i]['secuencial']=$row['secuencial'];
		$i++;
	} //var_dump($data);
	return $data;		
}

function Cantidadfacturas($conexion,$stored,$NumeroPaginas,$CantidadRegistros,$desde,$hasta,$IdSuc,$estado,$Usuario,$Direccion,$index,$last)
{
	$data = array();
	$i=0;
	$procedure="Sp_Cantidadfacturasdiarias";
	$parametros=array($Direccion,$last,$index,$CantidadRegistros,$desde,$hasta,$IdSuc,$Usuario,$estado); //var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) )
	{
		$data[$i]['CANTIDAD']=$row['CANTIDAD'];
		$i++;
	} //var_dump($data);
	return $data;		
}

function CantidadfacturasC($conexion,$stored,$NumeroPaginas,$CantidadRegistros,$desde,$hasta,$IdSuc,$estado,$Usuario,$Direccion,$index,$last)
{
	$data = array();
	$i=0;
	$procedure="Sp_CantidadfacturasdiariasC";
	$parametros=array($Direccion,$last,$index,$CantidadRegistros,$desde,$hasta,$IdSuc,$Usuario,$estado); //var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) )
	{
		$data[$i]['CANTIDAD']=$row['CANTIDAD'];
		$i++;
	} //var_dump($data);
	return $data;		
}

function contarfacturas($conexion,$stored,$desde,$hasta,$IdSuc,$estado,$Usuario,$Id)
{
	$data = array();
	$i=0;
	$Valor= $Id;
	$procedure=$stored;
	$parametros=$parametros=array($desde,$hasta,$IdSuc,$estado,$Usuario,$Id); 
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['maximo']=$row['maximo'];
		$data[$i]['Total']=$row['Total'];
		$i++;
	}
	return $data;		
}

function empleados($conexion,$IdSuc,$Nombre,$Id)
{
	$data = array();
	$i=0;
	$Valor= $Id;
	$procedure="SP_ConsultaEmpleadosGlobal";
	$parametros=$parametros=array($IdSuc,$Nombre,$Valor);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Id']=$row['Id'];
		$data[$i]['Nombre']=$row['Nombre'];
		$data[$i]['Estado']=$row['Estado'];
		$data[$i]['SucId']=$row['SucId'];
		$data[$i]['Sucursal']=$row['Sucursal'];
		$i++;
	}
	return $data;		
}

function empleadoCantidad($conexion,$IdSuc,$Nombre,$Id)
{
	$data = array();
	$i=0;
	$Valor= $Id;
	$procedure="SP_ContadorEmpleadosGlobal";
	$parametros=$parametros=array($IdSuc,$Nombre,$Valor);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['maximo']=$row['maximo'];
		$data[$i]['Total']=$row['Total'];
		$i++;
	}
	return $data;		
}

function opciones($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaOpcionesGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Opc_Codigo']=$row['Opc_Codigo'];
		$data[$i]['Opc_Nombre']=$row['Opc_Nombre'];
		$data[$i]['Opc_Estado']=$row['Opc_Estado'];
		$i++;
	}
	return $data;		
}

function accesos($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaIpGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['iIdIpConfig']=$row['iIdIpConfig'];
		$data[$i]['vIpConfig']=$row['vIpConfig'];
		$data[$i]['vDescriIpConfig']=$row['vDescriIpConfig'];
		$data[$i]['iListaIpConfig']=$row['iListaIpConfig'];
		$data[$i]['Suc_Codigo']=$row['Suc_Codigo'];
		$data[$i]['Suc_Nombre']=$row['Suc_Nombre'];
		$i++;
	}
	return $data;		
}

function negocio($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaTipNegocioGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['TipNego_Codigo']=$row['TipNego_Codigo'];
		$data[$i]['TipNego_Descripcion']=$row['TipNego_Descripcion'];
		$data[$i]['TipNego_Estado']=$row['TipNego_Estado'];
		$i++;
	}
	return $data;		
}

function marca($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaMarcaGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Mar_Codigo']=$row['Mar_Codigo'];
		$data[$i]['Mar_Descripcion']=$row['Mar_Descripcion'];
		$data[$i]['Mar_Estado']=$row['Mar_Estado'];
		$i++;
	}
	return $data;		
}

function series($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaSerie";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Pro_Codigo']=$row['Pro_Codigo'];
		$data[$i]['Pro_Dato1']=$row['Pro_Dato1'];
		$data[$i]['Dprod_Serie']=$row['Dprod_Serie'];
		$data[$i]['DProd_Codigo']=$row['DProd_Codigo'];
		$data[$i]['DKar_CodKardex']=$row['DKar_CodKardex'];
		$data[$i]['Kar_Tipo']=$row['Kar_Tipo'];
		$data[$i]['Kar_Fecha']=$row['Kar_Fecha'];
		$data[$i]['Kar_Estado']=$row['Kar_Estado'];
		$data[$i]['Kar_CodFact']=$row['Kar_CodFact'];
		$data[$i]['Pro_CodTipoProd']=$row['Pro_CodTipoProd'];
		$i++;
	}
	return $data;		
}

function productos($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaProductosGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Pro_Codigo']=$row['Pro_Codigo'];
		$data[$i]['Pro_CodTipoProd']=$row['Pro_CodTipoProd'];
		$data[$i]['TipP_Descripcion']=$row['TipP_Descripcion'];
		$data[$i]['Pro_CodMarca']=$row['Pro_CodMarca'];
		$data[$i]['Mar_Descripcion']=$row['Mar_Descripcion'];
		$data[$i]['Pro_Modelo']=$row['Pro_Modelo'];
		$data[$i]['Pro_CodTecnologia']=$row['Pro_CodTecnologia'];
		$data[$i]['Tec_Descripcion']=$row['Tec_Descripcion'];
		$data[$i]['Pro_CantRast']=$row['Pro_CantRast'];
		$data[$i]['Pro_CantxRast']=$row['Pro_CantxRast'];
		$data[$i]['Pro_Dato1']=$row['Pro_Dato1'];
		$data[$i]['Pro_Dato2']=$row['Pro_Dato2'];
		$data[$i]['Pro_Dato3']=$row['Pro_Dato3'];
		$data[$i]['Pro_Dato4']=$row['Pro_Dato4'];
		$data[$i]['Pro_Dato5']=$row['Pro_Dato5'];
		$data[$i]['Pro_Serie']=$row['Pro_Serie'];
		$data[$i]['Pro_SerieVC']=$row['Pro_SerieVC'];
		$data[$i]['Pro_Caracteristicas']=$row['Pro_Caracteristicas'];
		$data[$i]['Pro_CantReorden']=$row['Pro_CantReorden'];
		$data[$i]['Pro_Stock']=$row['Pro_Stock'];
		$data[$i]['Pro_StockFraccion']=$row['Pro_StockFraccion'];
		$data[$i]['Pro_Costo']=$row['Pro_Costo'];
		$data[$i]['Pro_PVP1']=$row['Pro_PVP1'];
		$data[$i]['Pro_PVP2']=$row['Pro_PVP2'];
		$data[$i]['Pro_PVP3']=$row['Pro_PVP3'];
		$data[$i]['Pro_PVP4']=$row['Pro_PVP4'];
		$data[$i]['Pro_CodPrecio']=$row['Pro_CodPrecio'];
		$data[$i]['Pro_CodProv']=$row['Pro_CodProv'];
		$data[$i]['Pro_Imagen']=$row['Pro_Imagen'];
		$data[$i]['Pro_Servicio']=$row['Pro_Servicio'];
		$data[$i]['estado']=$row['Pro_Estado'];
		$data[$i]['Prec_Descripcion']=$row['Prec_Descripcion'];
		$i++;
	}
	return $data;		
}


function pais($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaPaisGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Pais_Codigo']=$row['Pais_Codigo'];
		$data[$i]['Pais_Descripcion']=$row['Pais_Descripcion'];
		$data[$i]['Pais_Estado']=$row['Pais_Estado'];
		$i++;
	}
	return $data;		
}

function provincia($conexion,$Id,$IdPais)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaProvinciaGlobales";
	$parametros=array($Id,$IdPais);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Provi_Codigo']=$row['Provi_Codigo'];
		$data[$i]['Provi_Descripcion']=$row['Provi_Descripcion'];
		$data[$i]['Provi_CodPais']=$row['Provi_CodPais'];
		$data[$i]['Provi_Estado']=$row['Provi_Estado'];
		$i++;
	} 
	return $data;		
}

function CerrarUsuario($conexion,$Usuario,$tipo)
{
	$data = array();
	$i=0;
	$procedure="Sp_CierraSesion";
	$parametros=array($Usuario,$tipo);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//Cierra sesion
	} 
	return $data;		
}

function cargos($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaCargosGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Carg_Codigo']=$row['Carg_Codigo'];
		$data[$i]['Carg_Descripcion']=$row['Carg_Descripcion'];
		$data[$i]['Carg_Estado']=$row['Carg_Estado'];
		$i++;
	}
	return $data;		
}

function division($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaDivisionGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Div_Codigo']=$row['Div_Codigo'];
		$data[$i]['Div_Nombre']=$row['Div_Nombre'];
		$data[$i]['Div_Estado']=$row['Div_Estado'];
		$i++;
	}
	return $data;		
}

function bodegas($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaBodegasGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Bod_Codigo']=$row['Bod_Codigo'];
		$data[$i]['Bod_CodRespEmpl']=$row['Bod_CodRespEmpl'];
		$data[$i]['Nombre']=$row['Nombre'];
		$data[$i]['Bod_Descripcion']=$row['Bod_Descripcion'];
		$data[$i]['Bod_Ubicacion']=$row['Bod_Ubicacion'];
		$data[$i]['estado']=$row['Bod_Estado'];
		$i++;
	}
	return $data;		
}

function departamentos($conexion,$Id)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaDepartamentoGlobales";
	$parametros=array($Id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['Dpto_Codigo']=$row['Dpto_Codigo'];
		$data[$i]['Dpto_CodDivision']=$row['Dpto_CodDivision'];
		$data[$i]['Dpto_CodEmplJefe']=$row['Dpto_CodEmplJefe'];
		$data[$i]['Dpto_CodCtaGastos']=$row['Dpto_CodCtaGastos'];
		$data[$i]['Dpto_Estado']=$row['Dpto_Estado'];
		$data[$i]['Div_Nombre']=$row['Div_Nombre'];
		$data[$i]['Cuenta']=$row['Cuenta'];
		$data[$i]['Dpto_Nombre']=$row['Dpto_Nombre'];
		$data[$i]['empleado']=$row['empleado'];
		$i++;
	}
	return $data;		
}

function opcionesCantidad($conexion,$IdSuc,$Nombre,$Id)
{
	$data = array();
	$i=0;
	$Valor= $Id;
	$procedure="SP_ContadorEmpleadosGlobal";
	$parametros=$parametros=array($IdSuc,$Nombre,$Valor);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['maximo']=$row['maximo'];
		$data[$i]['Total']=$row['Total'];
		$i++;
	}
	return $data;		
}

function sucursal($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConGeneralSucursal";
	$parametros=array('U');
	$result_sp=consultarSinParametros($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['ID'];
		$data[$i]['nombre']=$row['SUCURSAL'];
		$data[$i]['estado']=$row['ESTADO'];
		$i++;
	}
	return $data;		
}

function modulos($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaModulosGlobal";
	$parametros=array('U');
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['Mod_Codigo'];
		$data[$i]['nombre']=$row['Mod_Nombre'];
		$data[$i]['estado']=$row['Mod_Estado'];
		$i++;
	}
	return $data;		
}

function cuentas($conexion,$id)
{
	$data = array();
	$i=0;
	$procedure="SP_Consultar_cuentas";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['PCta_codigo']=$row['PCta_codigo'];
		$data[$i]['PCta_Cuenta']=$row['PCta_Cuenta'];
		$data[$i]['PCta_Nombre']=$row['PCta_Nombre'];
		$data[$i]['PCta_CodCtaPadre']=$row['PCta_CodCtaPadre'];
		$data[$i]['Nombre_Padre']=$row['Nombre_Padre'];
		$data[$i]['PCta_Nivel']=$row['PCta_Nivel'];
		$data[$i]['PCta_Estado']=$row['PCta_Estado'];
		$data[$i]['Cuenta_Padre']=$row['Cuenta_Padre'];
		$i++;
	}
	return $data;		
}

function CuentaPadre($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaCuentasGlobal";
	$parametros=array($tipobusqueda,$busqueda,$codigo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$data[$i]['Cuenta_Max']=$row['Cuenta_Max'];
		$data[$i]['CUENTA']=$row['CUENTA'];
		$i++;
	}
	return $data;		
}

function getrol($conexion,$id)
{
	$data = array();
	$procedure="SP_Consultar_Rol";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data['id']=$row['Rol_codigo'];
		$data['nombre']=$row['Rol_Nombre'];
		$data['estado']=$row['Rol_Estado'];
	}
	return $data;		
}

function getmodulo($conexion,$id)
{
	$data = array();
	$procedure="SP_Consultar_Modulo";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data['id']=$row['Mod_Codigo'];
		$data['nombre']=$row['Mod_Nombre'];
		$data['estado']=$row['Mod_Estado'];
	}
	return $data;		
}

function saverolUsuario($conexion,$id,$nombreRol,$estado)
{
	$respuesta=null;
	$procedure="SP_Ingresa_usuarioRoles";
	$id=intval($id);
	if($id==0)
	{
		$tipo="I";
	}
	else
	{
		$tipo="M";
	}
	$parametros=array($id,$nombreRol,$estado,$tipo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row['Respuesta'];
	}
	return $respuesta;		
}

function savecliente($conexion,$Clte_Empresa,$Clte_tipo,$Clte_cedula,$Clte_nombre,$Clte_telefono,$Clte_direccion,$Clte_ciudad,$Clte_zona,$Clte_telefono,$Clte_fax,$Clte_mail,$Clte_tipon,$Clte_vendedor,$Clte_nota,$Clte_observacion,$Clte_foto,$Clte_cupoc,$Clte_cupou,$Clte_tipoc,$Clte_cuenta,$Clte_Fecha,$Clte_Aut,$Clte_Suc)
{
	$respuesta=null;
	$procedure="SP_Ing_Clientes";
	
	$parametros=array($Clte_Empresa,$Clte_tipo,$Clte_cedula,$Clte_nombre,$Clte_telefono,$Clte_direccion,$Clte_ciudad,$Clte_zona,$Clte_telefono,$Clte_fax,$Clte_mail,$Clte_tipon,$Clte_vendedor,$Clte_nota,$Clte_observacion,$Clte_foto,$Clte_cupoc,$Clte_cupou,$Clte_tipoc,$Clte_cuenta,$Clte_Fecha,$Clte_Aut,$Clte_Suc);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function saverol($conexion,$id,$nombrerol,$estado)
{
	$respuesta=array();
	$procedure="Sp_Ingresoroles";
	
	$parametros=array(intval($id),$nombrerol,intval($estado));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}	
}

function saveacceso($conexion,$Id,$Ip,$NombreAcceso,$SucursalID,$estado)
{
	$respuesta=array();
	$procedure="SP_IngresaIpGlobales";
	
	$parametros=array(intval($Id),$Ip,$NombreAcceso,intval($SucursalID),intval($estado));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}	
}

function savemodulo($conexion,$id,$nombremodulo,$estado)
{
	$respuesta=array();
	$procedure="Sp_IngresoModulos";
	
	$parametros=array(intval($id),$nombremodulo,intval($estado));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function saveusuario($conexion,$id,$clave,$id_empleado,$fecha_ingreso,$fecha_vencimiento,$estado,$mail,$rol)
{
	$respuesta=array();
	$procedure="Sp_UsuarioRolIngreso";
	
	$parametros=array($id,$clave,intval($id_empleado),$fecha_ingreso,$fecha_vencimiento,$estado,$mail,$rol);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}	
}

function savesucursal($conexion,$idsucursal,$Descripcion,$direccion,$telefono,$fax,$NumAutoRet,$SerieRet,$noDesdeRet,$NoHastaRet,$FechaRet,$NumAutoND,$SerieND,$NoDesdeND,$NoHastaND,$FechaND,$NumAutoNC,$SerieNC,$NumDesdeNC,$NumHastaNC,$fechaNC,$NumAutoNV,$SerieNV,$NoDesdeNV,$NoHastaNV,$FechaNV,$NumAutoFac,$SerieFac,$NumDesdeFac,$NumHastaFac,$NumActFac,$FechaFac, $selectError3)
{
	$respuesta=array();
	$procedure="SP_IngMod_Sucursal";
	
	$parametros=array($idsucursal,$Descripcion,'1',$direccion,$telefono,$fax,$NumAutoRet,$SerieRet,$noDesdeRet,$NoHastaRet,$FechaRet,$NumAutoND,$SerieND,$NoDesdeND,$NoHastaND,$FechaND,$NumAutoNC,$SerieNC,$NumDesdeNC,$NumHastaNC,$fechaNC,$NumAutoNV,$SerieNV,$NoDesdeNV,$NoHastaNV,$FechaNV,$NumAutoFac,$SerieFac,$NumDesdeFac,$NumHastaFac,$NumActFac,$FechaFac,$selectError3);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function saveempleado($conexion,$Id,$Cedula,$Apellidos,$Nombres,$Titulo,$CargoID,$DepartamentolID,$CContID,$Tipo,$estado,$lugar,$Sueldo,$FechaIng,$Pago,$SucursalID)
{
	$respuesta=array();
	$procedure="SP_IngresaEmpleadosGlobal";
	
	$parametros=array($Id,$Cedula,$Apellidos,$Nombres,$Titulo,$CargoID,$DepartamentolID,$CContID,$Tipo,$estado,$lugar,$Sueldo,$FechaIng,$Pago,$SucursalID);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function saveopcion($conexion,$Id,$ModuloID,$NombreOpcion,$estado)
{
	$respuesta=array();
	$procedure="SP_IngresaOpciones";
	
	$parametros=array($Id,$NombreOpcion,$estado,$ModuloID);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function savecargo($conexion,$Id,$Nombre,$estado)
{
	$respuesta=array();
	$procedure="SP_IngresaCargos";
	
	$parametros=array($Id,$Nombre,$estado);
	var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function savedivision($conexion,$Id,$Nombre,$estado)
{
	$respuesta=array();
	$procedure="SP_IngresaDivision";
	
	$parametros=array($Id,$Nombre,$estado);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function savecuentas($conexion,$Id,$Nombre,$IdPadre,$NumCuenta,$estado)
{
	$respuesta=array();
	$procedure="SP_Insertar_cuentas";
	
	$parametros=array(intval($Id),$Nombre,intval($IdPadre),$NumCuenta,$estado);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function savedepartamento($conexion,$Id,$DivisiónlID,$Nombre,$VendedorID,$CContID,$estado)
{
	$respuesta=array();
	$procedure="SP_IngresaDepartamento";
	
	$parametros=array($Id,$DivisiónlID,$Nombre,$VendedorID,$CContID,$estado);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function savenegocio($conexion,$Id,$Nombre,$estado)
{
	$respuesta=array();
	$procedure="SP_IngresaTipoNegocio";
	
	$parametros=array($Id,$Nombre,$estado);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function savemarca($conexion,$Id,$Nombre,$estado)
{
	$respuesta=array();
	$procedure="SP_IngresaMarca";
	
	$parametros=array($Id,$Nombre,$estado);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function saveproductos($conexion,$IdTipProd,$IdMarca,$Modelo,$IdCodTec,$Descri,$Series,$TipoSeries,$Caracteristicas,$CantidadR,$IdPrecio,$Servicio,$Id,$estado)
{
	$respuesta=array();
	$procedure="SP_Ing_ProductosWeb";
	
	$parametros=array(1,$IdTipProd,$IdMarca,$Modelo,$IdCodTec,0,0,$Descri,NULL,NULL,NULL,NULL,$Series,$TipoSeries,$Caracteristicas,$CantidadR,$IdPrecio,1,NULL,$Servicio,$Id,$estado);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function savebodega($conexion,$Id,$Nombre,$estado,$responsable,$ubicacion)
{
	$respuesta=array();
	$procedure="SP_IngresaBodega";
	
	$parametros=array($Id,$Nombre,$estado,$responsable,$ubicacion);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function saveregistros($procedure,$conexion,$parametros)
{
	$respuesta=array();
	//$procedure="SP_IngresaTipoNegocio";
	
	//$parametros=array($id,$nombre,$estado);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros); 
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}		
}

function eliminausuario($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Eli_Usuarios";
	$parametros=array($id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}	
}

function eliminaopcion($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Opcion";
	$parametros=array($id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta['Afectadas']=$row['FILASAFECTADAS'];
	}	
}

function eliminarol($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Eli_Roles";
	$parametros=array(intval($id));
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row;
	}
	return $respuesta;		
}

function eliminasucursal($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Eli_SucursalGen";
	$parametros=array(intval($id));
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row;
	}
	//return $respuesta;		
}

function eliminamodulo($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Eli_Modulos";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}
	//var_dump($respuesta);
	//return $respuesta;		
}

function eliminaacceso($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Ip";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}
	//var_dump($respuesta);
	//return $respuesta;		
}

function eliminaregistros($procedure,$conexion,$id)
{
	$respuesta=null;
	//$procedure=$Procedures;
	$parametros=array(intval($id));
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function eliminaempleado($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Eli_EmpleadoGen";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}
	//var_dump($respuesta);
	//return $respuesta;		
}

function eliminacargo($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Cargo";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}
	//var_dump($respuesta);
	//return $respuesta;		
}

function eliminadivision($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Division";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function Print_ConsultaSaldos($conexion,$ctaI,$ctaF,$ano,$mes)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_Balance_de_Saldos_Ok";
	$parametros=array(1,$ctaI,$ctaF,$ano,$mes);
	$result_sp=consultar($conexion,$procedure,$parametros);
	$procedure="SP_ConCuentasSaldos";
	$parametros=array(1);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['codigo'] = $row['codigo'];      
		$data[$i]['cuenta'] = $row['cuenta'];    
		$data[$i]['nombre'] = $row['nombre'];  
		$data[$i]['nivel'] = $row['nivel'];  
		$data[$i]['Saldo_Ant'] = $row['Saldo_Ant']; 
		$data[$i]['Debe'] = $row['Debe'];  
		$data[$i]['Haber'] = $row['Haber'];     
		$i++;
	}
	return $data;		
}

function find_cuentas2($conexion,$tipobusqueda,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaCuentasClientes2";
	$parametros=array($codigo,$tipobusqueda,$busqueda);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];
		$i++;
	}
	return $data;		
}

function find_ParametrosxSucursal($conexion,$codigo)
{
	$data = array();
	$i=0;
	$procedure="SP_ConParametrosxSucursal";
	$parametros=array($codigo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['ptoemi']=$row['ptoemi'];
		$data[$i]['ptovta']=$row['ptovta'];
		$data[$i]['secuencial']=$row['secuencial'];
		$data[$i]['Suc_NumAutSriF']=$row['Suc_NumAutSriF'];
		$data[$i]['Suc_FecMaxSriF']=$row['Suc_FecMaxSriF'];
		$i++;
	}
	return $data;		
}

function eliminacuentas($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_cuentas";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function eliminadepartamento($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Departamento";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function eliminanegocio($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Negocio";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function eliminabodega($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Bodega";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function eliminamarca($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Marca";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function eliminaproducto($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Elimina_Producto";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function ReversaFactura($conexion,$fact,$kar,$asic)
{
	$respuesta=null;
	$procedure="SP_Rev_FacturaV";
	$parametros=array(1,intval($fact),intval($kar),intval($asic));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function ReversaCompra($conexion,$fact)
{
	$respuesta=null;
	$procedure="SP_Eli_FactCompras1";
	$parametros=array(1,intval($fact));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		//$respuesta=$row;
	}		
}

function acciones_opcion_modulo_usuario($conexion,$usuario,$opcion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConOpcRolMod";
	$opcion=intval($opcion);
	$parametros=array($usuario,'A',$opcion);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['eliminar']=$row['ELIMINAR'];
		$data[$i]['grabar']=$row['GRABAR'];
		$data[$i]['modificar']=$row['MODIFICAR'];
		$data[$i]['consultar']=$row['CONSULTAR'];
		$i++;
	}
	return $data;		
}

/* VENTAS*/

function tipoventas($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConTipVentaFact";
	$parametros=array();
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id']=$row['id'];
		$data[$i]['descripcion']=$row['descr'];
		$i++;
	}
	return $data;		
}


function referencia($conexion,$tipo)
{
	$data = array();
	$i=0;
	$procedure="SP_Trae_Parametros";
	$parametros=array($tipo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['id_referemcia']=$row['TipA_Codigo'];
		$data[$i]['nombre_referencia']=$row['TipA_Referencia'];
		$i++;
	}
	return $data;		
}

function buscarproducto($conexion,$codigo_producto,$busqueda,$codigo_categoria,$sucursal)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConProductoFact";
	$codigo_categoria=intval($codigo_categoria);
	$codigo_producto=intval($codigo_producto);
	$sucursal=intval($sucursal);
	$parametros=array($codigo_producto,$busqueda,$codigo_categoria,$sucursal);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]=$row;
		$i++;
	}
	return $data;		
}

function guardarcabecera($conexion,$SPVFact_CodEmpresa,$SPVFact_CodSucursal,$SPVFact_CodCliente,$SPVFact_CodVendedor,$SPVFact_Tipo,$SPVFact_Serie,$SPVFact_NumDoc,$SPVFact_Fecha,$SPVFact_NumAutSri,$SPVFact_FecMaxSri,$SPVFact_CodOrdenCompra,$SPVFact_SubTarifaCero,$SPVFact_SubTarifaIVA,$SPVFact_Descuento,$SPVFact_IVA,$SPVFact_ICE,$SPVFact_Transporte,$SPVFact_Otros,$SPVFact_Total,$SPVFact_Concepto,$SPPFact_Contado,$SPAsiC_CodTipoAsiento,$SPAsiC_Valor,$SPKar_CodBodega,$SPKar_Graba,$SPVFact_Usuario,$SPVFact_Direccion,$SPVFact_Linea,$SPVFact_TipoProducto,$SPVFact_TipoCxC,$SPVFact_Codigo,$SPAsiC_Codigo,$SPAsiC_NumAsiento,$SPKar_Codigo,$SPACAK_Codigo)
{
	$data = array();
	$i=0;
	$VFact_Codigo="";
	$procedure="SP_Ing_FacturasV";
	
	$parametros=array(1,$SPVFact_CodSucursal,$SPVFact_CodCliente,$SPVFact_CodVendedor,$SPVFact_Tipo,$SPVFact_Serie,$SPVFact_NumDoc,$SPVFact_Fecha,$SPVFact_NumAutSri,$SPVFact_FecMaxSri,$SPVFact_CodOrdenCompra,$SPVFact_SubTarifaCero,$SPVFact_SubTarifaIVA,$SPVFact_Descuento,$SPVFact_IVA,$SPVFact_ICE,$SPVFact_Transporte,$SPVFact_Otros,$SPVFact_Total,$SPVFact_Concepto,$SPPFact_Contado,1,$SPAsiC_Valor,$SPKar_CodBodega,$SPKar_Graba,$SPVFact_Usuario,$SPVFact_Direccion,$SPVFact_Linea,$SPVFact_TipoProducto,$SPVFact_TipoCxC,$SPVFact_Codigo,$SPAsiC_Codigo,$SPAsiC_NumAsiento,$SPKar_Codigo,$SPACAK_Codigo);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	if (sqlsrv_has_rows($result_sp)) {
		while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_BOTH) ) 
		{
			$data[$i]=$row;
			$i++;
			//var_dump($row);
		}
	}
	sqlsrv_free_stmt($result_sp);
	return $data;	
}


function guardarcabeceraC($conexion,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14,$p15,$p16,$p17,$p18,$p19,$p20,$p21,$p22,$p23,$p24,$p25,$p26,$p27,$p28,$p29,$p30,$p31,$p32,$p33,$p34,$p35,$p36)
{
	$data = array();
	$i=0;
	$VFact_Codigo="";
	$procedure="SP_Ing_ProvisionesC";
	
	$parametros=array($p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14,$p15,$p16,$p17,$p18,$p19,$p20,$p21,$p22,$p23,$p24,$p25,$p26,$p27,$p28,$p29,$p30,$p31,$p32,$p33,$p34,$p35,$p36);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	if (sqlsrv_has_rows($result_sp)) {
		while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_BOTH) ) 
		{
			$data[$i]=$row;
			$i++;
			//var_dump($row);
		}
	}
	sqlsrv_free_stmt($result_sp);
	return $data;	
}

function guardarcabeceraKardex($conexion,$Empresa,$Fecha,$Tipo,$BodegaID,$BodegaIDE,$motivo,$Fact,$Asien,$AsienT,$usuario,$Kar,$Asi,$NumAsi)
{
	$data = array();
	$i=0;
	$VFact_Codigo="";
	$procedure="SP_Ing_KardexT";
	
	$parametros=array($Empresa,$Fecha,$Tipo,$BodegaID,$BodegaIDE,$motivo,$Fact,$Asien,$AsienT,$usuario,$Kar,$Asi,$NumAsi);
	var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);

	if (sqlsrv_has_rows($result_sp)) {
		while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_BOTH) ) 
		{
			//$data[$i]=$row;
			//$i++;
		}
	}
	sqlsrv_free_stmt($result_sp);
	return $data;	
}

function guardarSucursal($conexion,$SPVFact_CodEmpresa,$SPVFact_CodSucursal,$SPVFact_CodCliente,$SPVFact_CodVendedor,$SPVFact_Tipo,$SPVFact_Serie,$SPVFact_NumDoc,$SPVFact_Fecha,$SPVFact_NumAutSri,$SPVFact_FecMaxSri,$SPVFact_CodOrdenCompra,$SPVFact_SubTarifaCero,$SPVFact_SubTarifaIVA,$SPVFact_Descuento,$SPVFact_IVA,$SPVFact_ICE,$SPVFact_Transporte,$SPVFact_Otros,$SPVFact_Total,$SPVFact_Concepto,$SPPFact_Contado,$SPAsiC_CodTipoAsiento,$SPAsiC_Valor,$SPKar_CodBodega,$SPKar_Graba,$SPVFact_Usuario,$SPVFact_Direccion,$SPVFact_Linea,$SPVFact_TipoProducto,$SPVFact_TipoCxC)
{
	$data = array();
	$i=0;
	$VFact_Codigo="";
	$procedure="SP_Ing_FacturasVWeb";
	/*$parametros = array( 
                 array($SPVFact_CodEmpresa, SQLSRV_PARAM_IN),
				 array($SPVFact_CodSucursal, SQLSRV_PARAM_IN),
				 array($SPVFact_CodCliente, SQLSRV_PARAM_IN),
				 array($SPVFact_CodVendedor, SQLSRV_PARAM_IN),
				 array($SPVFact_Tipo, SQLSRV_PARAM_IN),
				 array($SPVFact_Serie, SQLSRV_PARAM_IN),
				 array($SPVFact_NumDoc, SQLSRV_PARAM_IN),
				 array($SPVFact_Fecha, SQLSRV_PARAM_IN),
				 array($SPVFact_NumAutSri, SQLSRV_PARAM_IN),
				 array($SPVFact_FecMaxSri, SQLSRV_PARAM_IN),
				 array($SPVFact_CodOrdenCompra, SQLSRV_PARAM_IN),
				 array($SPVFact_SubTarifaCero, SQLSRV_PARAM_IN),
				 array($SPVFact_SubTarifaIVA, SQLSRV_PARAM_IN),
				 array($SPVFact_Descuento, SQLSRV_PARAM_IN),
				 array($SPVFact_IVA, SQLSRV_PARAM_IN),
				 array($SPVFact_ICE, SQLSRV_PARAM_IN),
				 array($SPVFact_Transporte, SQLSRV_PARAM_IN),
				 array($SPVFact_Otros, SQLSRV_PARAM_IN),
				 array($SPVFact_Total, SQLSRV_PARAM_IN),
				 array($SPVFact_Concepto, SQLSRV_PARAM_IN),
				 array($SPPFact_Contado, SQLSRV_PARAM_IN),
				 array($SPAsiC_CodTipoAsiento, SQLSRV_PARAM_IN),
				 array($SPAsiC_Valor, SQLSRV_PARAM_IN),
				 array($SPKar_CodBodega, SQLSRV_PARAM_IN),
				 array($SPKar_Graba, SQLSRV_PARAM_IN),
				 array($SPVFact_Usuario, SQLSRV_PARAM_IN),
				 array($SPVFact_Direccion, SQLSRV_PARAM_IN),
				 array($SPVFact_Linea, SQLSRV_PARAM_IN),
				 array($SPVFact_TipoProducto, SQLSRV_PARAM_IN),
				 array($SPVFact_TipoCxC, SQLSRV_PARAM_IN),
                 array($VFact_Codigo, SQLSRV_PARAM_INOUT),
				 array($SPAsiC_Codigo, SQLSRV_PARAM_INOUT),
				 array($SPAsiC_NumAsiento, SQLSRV_PARAM_INOUT),
				 array($SPKar_Codigo, SQLSRV_PARAM_INOUT),
				 array($SPACAK_Codigo, SQLSRV_PARAM_INOUT)
               );*/
	$parametros=array($SPVFact_CodEmpresa,$SPVFact_CodSucursal,$SPVFact_CodCliente,$SPVFact_CodVendedor,$SPVFact_Tipo,$SPVFact_Serie,$SPVFact_NumDoc,$SPVFact_Fecha,$SPVFact_NumAutSri,$SPVFact_FecMaxSri,$SPVFact_CodOrdenCompra,$SPVFact_SubTarifaCero,$SPVFact_SubTarifaIVA,$SPVFact_Descuento,$SPVFact_IVA,$SPVFact_ICE,$SPVFact_Transporte,$SPVFact_Otros,$SPVFact_Total,$SPVFact_Concepto,$SPPFact_Contado,$SPAsiC_CodTipoAsiento,$SPAsiC_Valor,$SPKar_CodBodega,$SPKar_Graba,$SPVFact_Usuario,$SPVFact_Direccion,$SPVFact_Linea,$SPVFact_TipoProducto,$SPVFact_TipoCxC/*,$SPVFact_Codigo,$SPAsiC_Codigo,$SPAsiC_NumAsiento,$SPKar_Codigo,$SPACAK_Codigo*/);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($parametros);
	//var_dump($result_sp);
	if (sqlsrv_has_rows($result_sp)) {
		while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_BOTH) ) 
		{
			$data[$i]=$row;
			$i++;
			//var_dump($row);
		}
	}
	//var_dump($data);
	/*sqlsrv_next_result($result_sp);
	$data["VFact_Codigo"]=$VFact_Codigo;
	$data["AsiC_Codigo"]=$SPAsiC_Codigo;
	$data["AsiC_NumAsiento"]=$SPAsiC_NumAsiento;
	$data["Kar_Codigo"]=$SPKar_Codigo;
	$data["ACAK_Codigo"]=$SPACAK_Codigo;*/
	sqlsrv_free_stmt( $result_sp);
	return $data;	
}

function guardardetallefacturacion($conexion,$Codigo,$Cod_Factura,$Cod_Producto,$Descripcion_Producto,$Cant_Factura,$Cant_Factura_F,$Porc_Descto_F,$Valor_Descto_F,$Precio_Unit_F,$Total_F,$inventario,$Cod_Kardex,$Costo_Factura,$Precio_Unit_K,$Cod_Asiento,$Cod_Cuenta_V,$Cod_Cuenta_C,$Cod_Cuenta_I,$Referencia,$Motivo,$Dprod_Numero,$Pro_Costo,$Total_Factura,$vacio,$cero,$TipoProducto,$Cod_ACAK,$Pro_CodTipoProd)
{
	$data = array();
	$i=0;
	$procedure="SP_Ing_DFacturasV";
	$parametros=array($Codigo,$Cod_Factura,$Cod_Producto,$Descripcion_Producto,$Cant_Factura,$Cant_Factura_F,$Porc_Descto_F,$Valor_Descto_F,$Precio_Unit_F,$Total_F,$inventario,$Cod_Kardex,$Costo_Factura,$Precio_Unit_K,$Cod_Asiento,$Cod_Cuenta_V,$Cod_Cuenta_C,$Cod_Cuenta_I,$Referencia,$Motivo,$Dprod_Numero,$Pro_Costo,$Total_Factura,$vacio,$cero,$TipoProducto,$Cod_ACAK);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['resultado']=$row[0];
		$i++;
		//var_dump($row);
	}
	return $data;
}

function guardardetallefacturacionC($conexion,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14,$p15,$p16,$p17,$p18,$p19,$p20,$p21,$p22,$p23,$p24,$p25,$p26)
{
	$data = array();
	$i=0;
	$procedure="SP_Ing_DProvisionesC1";
	$parametros=array($p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14,$p15,$p16,$p17,$p18,$p19,$p20,$p21,$p22,$p23,$p24,$p25,$p26);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['resultado']=$row[0];
		$i++;
		//var_dump($row);
	}
	return $data;
}

function guardardetalleKardex($conexion,$BodegaID,$BodegaIDE,$Dprod_Numero,$Serie,$Numero,$Stock,$StockFraccion,$Dprod_Costo,$Kar_codigo,$Kar_Cant,$Kar_CantFraccion,$Kar_Costo,$Kar_Precio)
{
	$data = array();
	$i=0;
	$procedure="SP_Ing_DProductoT";
	$parametros=array($BodegaID,$BodegaIDE,$Dprod_Numero,$Serie,$Numero,$Stock,$StockFraccion,$Dprod_Costo,$Kar_codigo,$Kar_Cant,$Kar_CantFraccion,$Kar_Costo,$Kar_Precio);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data[$i]['resultado']=$row[0];
		$i++;
		//var_dump($row);
	}
	return $data;
}

function limpia_espacios($cadena)
{
    $cadena = str_replace(' ', '', $cadena);
    return $cadena;
}

?>
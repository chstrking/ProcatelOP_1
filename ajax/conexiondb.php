<?php
/*$db_usr='usr';
$db_pass='T2Ka5AjoYf'; 
$db_server='108.60.209.5,1087';
$db_name='BDIntegso';*/

$db_usr='sa';
$db_pass='123';
$db_server='CHTR-E18474DF9C\SQLEXPRESS';
$db_name='BDIntegso';


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
	$db_info= array('Database'=>$db_name,'UID'=>$db_usr,'PWD'=>$db_pass);
	$db_link= sqlsrv_connect($db_server, $db_info);
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
}
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

function ultima_factura($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaLastFactura";
	$result_sp=consultarSinParametros($conexion,$procedure);
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
		$data[$i]=$row;
		$i++;
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

function Print_Factura($conexion,$codigo)
{
	$data = array();
	$i=0;
	$procedure="SP_Con_Factura";
	$parametros=array(1,intval($codigo));
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($result_sp);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		/*$data[$i]['id']=$row['CODIGO'];
		$data[$i]['nombre']=$row['NOMBRE'];*/
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
 
function find_cuentas($conexion)
{
	$data = array();
	$i=0;
	$procedure="Sp_ConsultaCuentasClientes";
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
	$parametros=array(1,$tipo,$busqueda,$codigo);
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

function find_vendedorgen($conexion,$tipo,$codigo,$busqueda)
{
	$data = array();
	$i=0;
	$procedure="SP_ConsultaVendedor";
	$parametros=array(0,$tipo,$busqueda,$codigo);
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

function getusuario($conexion,$id)
{
	$data = array();
	$procedure="SP_Consultar_Usuario";
	$parametros=array($id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$data['id']=$row['Usu_usuario'];
		$data['estado']=$row['Usu_Estado'];
		$data['fecha_ingreso']=$row['Usu_FecIng'];
		$data['fecha_vencimiento']=$row['Usu_FecVenc'];
		$data['cod_empleado']=$row['Usu_CodEmpl'];
		$data['mail']=$row['Usu_correo'];
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
		$respuesta=$row['Respuesta'];
	}
	return $respuesta;		
}

function savesucursal($conexion,$idsucursal,$direccion,$telefono,$fax,$selectError3,$NumAutoRet,$SerieRet,$noDesdeRet,$NoHastaRet,$FechaRet,$NumAutoND,$SerieND,$NoDesdeND,$NoHastaND,$FechaND,$NumAutoNC,$SerieNC,$NumDesdeNC,$NumHastaNC,$fechaNC,$NumAutoNV,$SerieNV,$NoDesdeNV,$NoHastaNV,$FechaNV,$NumAutoFac,$SerieFac,$NumDesdeFac,$NumHastaFac,$NumActFac,$FechaFac, $Estado)
{
	$respuesta=null;
	$procedure="SP_IngMod_Sucursal";
	
	$parametros=array($conexion,$idsucursal,$direccion,$telefono,$fax,$selectError3,$NumAutoRet,$SerieRet,$noDesdeRet,$NoHastaRet,$FechaRet,$NumAutoND,$SerieND,$NoDesdeND,$NoHastaND,$FechaND,$NumAutoNC,$SerieNC,$NumDesdeNC,$NumHastaNC,$fechaNC,$NumAutoNV,$SerieNV,$NoDesdeNV,$NoHastaNV,$FechaNV,$NumAutoFac,$SerieFac,$NumDesdeFac,$NumHastaFac,$NumActFac,$FechaFac,$Estado);
	//var_dump($parametros);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row['Respuesta'];
	}
	return $respuesta;		
}

function saverol($conexion,$id,$nombrerol,$estado)
{
	$respuesta=null;
	$procedure="Sp_Ingresoroles";
	$id=intval($id);
	if($id==0)
	{
		$tipo="I";
	}
	else
	{
		$tipo="M";
	}
	$parametros=array($id,$nombrerol,intval($estado),$tipo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row['Respuesta'];
	}
	return $respuesta;		
}

function savemodulo($conexion,$id,$nombremodulo,$estado)
{
	$respuesta=null;
	$procedure="Sp_IngresoModulos";
	$id=intval($id);
	if($id==0)
	{
		$tipo="I";
	}
	else
	{
		$tipo="M";
	}
	$parametros=array($id,$nombremodulo,intval($estado),$tipo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row['Respuesta'];
	}
	return $respuesta;		
}

function saveusuario($conexion,$id,$fecha_ingreso,$fecha_vencimiento,$id_empleado,$clave,$tipo,$correo)
{
	$respuesta=null;
	$procedure="Sp_CreaUsuarios";
	$parametros=array($id,$clave,intval($id_empleado),$fecha_ingreso,$fecha_vencimiento,1,1,$tipo,$correo);
	$result_sp=consultar($conexion,$procedure,$parametros);
	//var_dump($parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row['Respuesta'];
	}
	return $respuesta;		
}

function eliminausuario($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Eli_Usuarios";
	$parametros=array($id);
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row;
	}
	return $respuesta;		
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

function eliminamodulo($conexion,$id)
{
	$respuesta=null;
	$procedure="SP_Eli_Modulos";
	$parametros=array(intval($id));
	$result_sp=consultar($conexion,$procedure,$parametros);
	while( $row = sqlsrv_fetch_array( $result_sp , SQLSRV_FETCH_ASSOC) ) 
	{
		$respuesta=$row;
	}
	//var_dump($respuesta);
	return $respuesta;		
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
		/*$data[$i]['id']=$row['DProd_Codigo'];
		$data[$i]['descripcion']=$row['Descripcion'];
		$data[$i]['stock']=$row['Dprod_Stock'];
		$data[$i]['codigo']=$row['Pro_Codigo'];
		$data[$i]['costo']=$row['Pro_Costo'];*/
		$data[$i]=$row;
		$i++;
		//var_dump($row);
	}
	return $data;		
}

//function guardarcabecera($conexion,$SPVFact_CodEmpresa,$SPVFact_CodSucursal,$SPVFact_CodCliente,$SPVFact_CodVendedor,$SPVFact_Tipo,$SPVFact_Serie,$SPVFact_NumDoc,$SPVFact_Fecha,$SPVFact_NumAutSri,$SPVFact_FecMaxSri,$SPVFact_CodOrdenCompra,$SPVFact_SubTarifaCero,$SPVFact_SubTarifaIVA,$SPVFact_Descuento,$SPVFact_IVA,$SPVFact_ICE,$SPVFact_Transporte,$SPVFact_Otros,$SPVFact_Total,$SPVFact_Concepto,$SPPFact_Contado,$SPAsiC_CodTipoAsiento,$SPAsiC_Valor,$SPKar_CodBodega,$SPKar_Graba,$SPVFact_Usuario,$SPVFact_Direccion,$SPVFact_Linea,$SPVFact_TipoProducto,$SPVFact_TipoCxC,$SPVFact_Codigo,$SPAsiC_Codigo,$SPAsiC_NumAsiento,$SPKar_Codigo,$SPACAK_Codigo)
function guardarcabecera($conexion,$SPVFact_CodEmpresa,$SPVFact_CodSucursal,$SPVFact_CodCliente,$SPVFact_CodVendedor,$SPVFact_Tipo,$SPVFact_Serie,$SPVFact_NumDoc,$SPVFact_Fecha,$SPVFact_NumAutSri,$SPVFact_FecMaxSri,$SPVFact_CodOrdenCompra,$SPVFact_SubTarifaCero,$SPVFact_SubTarifaIVA,$SPVFact_Descuento,$SPVFact_IVA,$SPVFact_ICE,$SPVFact_Transporte,$SPVFact_Otros,$SPVFact_Total,$SPVFact_Concepto,$SPPFact_Contado,$SPAsiC_CodTipoAsiento,$SPAsiC_Valor,$SPKar_CodBodega,$SPKar_Graba,$SPVFact_Usuario,$SPVFact_Direccion,$SPVFact_Linea,$SPVFact_TipoProducto,$SPVFact_TipoCxC)
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
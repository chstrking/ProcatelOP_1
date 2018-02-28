var menu_inicial='menu_1';
var menu_inicial='menu_1';

function Olvidar()
{
	TINY.box.show('./ventanas/RecordatorioPass.php',1,400,400,1); 
}

function Solo_Numerico(variable){
	Numer=parseInt(variable);
	if (isNaN(Numer)){
		return "";
	}
	return Numer;
}
function ValNumero(Control){
	Control.value=Solo_Numerico(Control.value);
}

function ActualizaClave(e) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  {
	ValidarActualizarClave();
  }
  else
  {
	return;
  }
}

function onlyNumbers(el)
{
	if( el.value == "" )
		var _number =  el.value.substring(0, el.value.length );
	else
		var _number = el.value;
	el.value = _number.replace(/\D/g,"");
}


function ValidarLogin()
{
	if(document.getElementById("login-username").value=="" || document.getElementById("login-password").value=="")
	{
		alert("Debe ingresar el usuario y clave");
	}
	else
	{
		document.getElementById("login-form").submit();
	}
}

function ValidarActualizarClave()
{
	if(document.getElementById("login-password-actualizar").value=="")
	{
		alert("Debe ingresar una clave");
	}
	else
	{
		document.getElementById("login-form").submit();
	}
}

function ValidarUsuario()
{
	if(document.getElementById("login-username").value=="")
	{
		alert("Debe ingresar el usuario");
	}
	else
	{
		document.getElementById("login-form").submit();
	}
}
 
function RecordarUsuario()
{
		url= 'ventanas/RecordatorioContraseña.php';
		//open(url,'Recuperar contraseña','width=400,height=300,scrollbars=NO');
		open(url);
}


function verProceso(id_accion,menu,bandera,nombre_menu)
{
	if(document.getElementById('id_transacciones'))
	{
		if(bandera)
		{
			menu_id=document.getElementById(menu);
			menu_id.className='active';
			menu_anterior=document.getElementById(menu_inicial);
			menu_anterior.className='';
			menu_inicial=menu;
		}
		Ext.get('id_transacciones').load({
		url: 'acciones/'+id_accion+'.php?nombre_menu='+nombre_menu,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}


function verSubProceso(id_accion,id)
{
	if(document.getElementById('id_transacciones'))
	{
		console.log(id);
		Ext.get('id_transacciones').load({
		url: 'acciones/'+id_accion+'.php?id='+id,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function verProcesoSeries(id_accion,id)
{
	if(document.getElementById('id_transacciones'))
	{
		id=document.getElementById('SeriesNombre').value;
		//console.log(id);
		Ext.get('id_transacciones').load({
		url: 'acciones/'+id_accion+'.php?id='+id,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function verSubProcesoRol(id_accion,id, id_rol)
{
	if(document.getElementById('id_transacciones'))
	{
		Ext.get('id_transacciones').load({
		url: 'acciones/'+id_accion+'.php?id='+id+'&id_rol='+id_rol,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function GuardarRolUsuario()
{
	if(document.getElementById('id_transacciones'))
	{
		id=document.getElementById('id').value;
		rol_id=document.getElementById('rol').value;
		estado=document.getElementById('estado').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/asignarrol.php?id='+id+'&rol_id='+rol_id+'&estado='+estado+'&guardar=1',
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function GuardarCliente()
{
	if(document.getElementById('id_transacciones'))
	{
		if(document.getElementById('estado').value!="" && document.getElementById('NombreClte').value!="" && document.getElementById('cedula').value!="" && document.getElementById('Direccion').value!="" && document.getElementById('CiudadID').value!="" && document.getElementById('ZonaID').value!="" && document.getElementById('ZonaID').value!="" && document.getElementById('Telefono').value!="" && document.getElementById('Fax').value!="" && document.getElementById('Mail').value!="" && document.getElementById('TipoNID').value!="" && document.getElementById('VendedorID').value!="" && document.getElementById('cupoc').value!="" && document.getElementById('cupou').value!="" && document.getElementById('TipoCID').value!="" && document.getElementById('CContID').value!="")
		{
			estado=document.getElementById('estado').value;
			NombreClte=document.getElementById('NombreClte').value;
			cedula=document.getElementById('cedula').value;
			Direccion=document.getElementById('Direccion').value;
			CiudadID=document.getElementById('CiudadID').value;
			ZonaID=document.getElementById('ZonaID').value;
			Telefono=document.getElementById('Telefono').value;
			Fax=document.getElementById('Fax').value;
			Mail=document.getElementById('Mail').value;
			TipoNID=document.getElementById('TipoNID').value;
			VendedorID=document.getElementById('VendedorID').value;
			cupoc=0;
			cupou=0;
			TipoCID=document.getElementById('TipoCID').value;
			CContID=document.getElementById('CContID').value;
			Ext.get('id_transacciones').load({
			url: 'acciones/clientes.php?NombreClte='+NombreClte+'&cedula='+cedula+'&Direccion='+Direccion+'&CiudadID='+CiudadID+'&ZonaID='+ZonaID+'&Telefono='+Telefono+'&Fax='+Fax+'&Mail='+Mail+'&TipoNID='+TipoNID+'&VendedorID'+VendedorID+'&cupoc='+cupoc+'&cupou='+cupou+'&TipoCID='+TipoCID+'&CContID='+CContID,
			nocache: true,
			scripts:true,
			text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
			});
		}
		else
		{
			alert("Debe ingresar todos los campos");
		}
	}
}

function CerrarSesion()
{
	Ext.get('cerrar_sesion').load({
		url: 'acciones/cerrarsesion.php',
		nocache: true,
		scripts:true,
		text: "Cerrando Sesión<img src='imagenes/loading.gif'>"
		});
}

function verMenu(id_accion)
{
	if(document.getElementById('id_menu'))
	{
		Ext.get('id_menu').load({
		url: 'acciones/menu.php',
		params:{id_accion:id_accion},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='200px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
} 

function Cargar()
{
	verMenu('Menu_Venta');
}

function BusquedaSucursalGeneral()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_sucursalgeneral.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaUsuario()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_usuario.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaProducto()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		marca=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_usuario.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaProveedor()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		marca=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_proveedor.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function IngresarSucursalGeneral(idsucursal,nombresucursal,direccion,telefono,fax,selectError3,NumAutoRet,SerieRet,noDesdeRet,NoHastaRet,FechaRet,NumAutoND,SerieND,NoDesdeND,NoHastaND,FechaND,NumAutoNC,SerieNC,NumDesdeNC,NumHastaNC,fechaNC,NumAutoNV,SerieNV,NoDesdeNV,NoHastaNV,FechaNV,NumAutoFac,SerieFac,NumDesdeFac,NumHastaFac,NumActFac,FechaFac)
{
	//var_dump(telefono);
	document.getElementById('SucursalNombre').value=idsucursal+' - '+nombresucursal;
	document.getElementById('SucursalID').value=idsucursal;
	document.getElementById('Direccion').value=direccion;
	document.getElementById('Telefono').value=telefono;
	document.getElementById('Fax').value=fax;
	document.getElementById('estado').value=selectError3;
	document.getElementById('NumAutoRet').value=NumAutoRet;
	document.getElementById('SerieRet').value=SerieRet;
	document.getElementById('NoDesdeRet').value=noDesdeRet;
	document.getElementById('NoHastaRet').value=NoHastaRet;
	document.getElementById('FechaRet').value=FechaRet;//->format('d-m-Y');
	document.getElementById('NumAutoND').value=NumAutoND;
	document.getElementById('SerieND').value=SerieND;
	document.getElementById('NoDesdeND').value=NoDesdeND;
	document.getElementById('NoHastaND').value=NoHastaND;
	document.getElementById('FechaND').value=FechaND;//->format('d-m-Y');
	document.getElementById('NumAutoNC').value=NumAutoNC;
	document.getElementById('SerieNC').value=SerieNC;
	document.getElementById('NumDesdeNC').value=NumDesdeNC;
	document.getElementById('NumHastaNC').value=NumHastaNC;
	document.getElementById('fechaNC').value=fechaNC;//->format('d-m-Y');
	document.getElementById('NumAutoNV').value=NumAutoNV;
	document.getElementById('SerieNV').value=SerieNV;
	document.getElementById('NoDesdeNV').value=NoDesdeNV;
	document.getElementById('NoHastaNV').value=NoHastaNV;
	document.getElementById('FechaNV').value=FechaNV;//->format('d-m-Y');
	document.getElementById('NumAutoFac').value=NumAutoFac;
	document.getElementById('SerieFac').value=SerieFac;
	document.getElementById('NumDesdeFac').value=NumDesdeFac;
	document.getElementById('NumHastaFac').value=NumHastaFac;
	document.getElementById('NumActFac').value=NumActFac;
	document.getElementById('FechaFac').value=FechaFac;//->format('d-m-Y');*/
	TINY.box.hide();
}

/*function Buscar(id)
{
	TINY.box.show('./ventanas/buscar.php?tipo='+id,1,600,700,1);
}*/

function Buscar(id,nombrepant)
{
	TINY.box.show('./ventanas/buscar.php?tipo='+id+'&nombrepant='+nombrepant,1,600,700,1);
}

function BuscarWithParam(id)
{
	param=document.getElementById('SucursalID').value;
	TINY.box.show('./ventanas/buscarParam.php?tipo='+id+'&param='+param,1,600,700,1);
}

function ImprimirStockBodeg(usuario)
{
	if(document.getElementById('BodegaNombre').value=="")
	{
		bodega=0;
	}
	else
	{
		bodega=document.getElementById('BodegaID').value;
	}
	tipo_producto=document.getElementById('tipo_producto').value;
	if(document.getElementById('MarcaID').value=="")
	{
		marca=0;
	}	
	else
	{
		marca=document.getElementById('MarcaID').value;
	}
	if(document.getElementById('ProductID').value=="")
	{
		producto=0;
	}	
	else
	{
		producto=document.getElementById('ProductID').value;
	}
	window.open('../ProcatelOP/acciones/imprimir_Stock.php?codigoBodega='+bodega+'&codigoTipoProducto='+tipo_producto+'&codigoMarca='+marca+'&codigoProducto='+producto+'&Usuario='+usuario+'')
}

function ImprimirKardex()
{
	idKardex=document.getElementById('idKardex').value;
	window.open('../ProcatelOP/acciones/imprimir_Kardex.php?idKardex='+idKardex);
}

function ImprimirKardex1(idKardex)
{
	//console.log(idKardex);
	TINY.box.show('./ventanas/imprimir_kardex.php?idKardex='+idKardex,1,400,400,1);
	//TINY.box.show('./ventanas/imprimir_facturacion.php?idKardex='+idKardex,1,400,400,1);
	//TINY.box.hide();
	//window.open('../ProcatelOP/acciones/imprimir_Kardex.php?idKardex='+idKardex); 
}

function ImprimirMovimientoKardex()
{
	ProductID=document.getElementById('ProductID').value;
	ProductNombre=document.getElementById('ProductNombre').value;
	window.open('../ProcatelOP/acciones/imprimir_MovimientoKardex.php?ProductID='+ProductID+'&ProductNombre='+ProductNombre);
}

function ImprimirConKardex()
{
	FechaI=document.getElementById('FechaI').value;
	FechaF=document.getElementById('FechaF').value;
	//FechaI='05/01/2013';
	//FechaF='05/01/2013';
	window.open('../ProcatelOP/acciones/imprimir_ConsultaKardex.php?FechaI='+FechaI+'&FechaF='+FechaF);
}

function ImprimirArqueoefectivo()
{
	Fecha=document.getElementById('fechaId').value;
	Usuario=document.getElementById('UsuarioID').value;
	Sucursal=document.getElementById('SucursalID').value;
	console.log(Fecha);
	console.log(Usuario);
	console.log(Sucursal);
	if(Fecha!="" && Usuario!="" && Sucursal!="")
	{
		if(document.getElementById('fechaId').value==1)
		{
		
			window.open('../ProcatelOP/acciones/imprimir_ReporteEfectivo.php?Fecha='+Fecha+'&Usuario='+Usuario+'&Sucursal='+Sucursal);
		
		}
		else
		{
		
			window.open('../ProcatelOP/acciones/imprimir_ReporteEfectivo.php?Fecha='+Fecha+'&Usuario='+Usuario+'&Sucursal='+Sucursal);
		
		}
	}
	else
	{
	
		alert("Debe ingresar todos los campos");
	
	}
}

function ImprimirArqueocaja()
{
	FechaD=document.getElementById('fechaD').value;
	FechaH=document.getElementById('fechaH').value;
	Usuario=document.getElementById('UsuarioID').value;
	Sucursal=document.getElementById('SucursalID').value;
	if(FechaD!="" && FechaH!="" && Usuario!="" && Sucursal!="")
	{
		
		window.open('../ProcatelOP/acciones/imprimir_ReporteCaja.php?FechaD='+FechaD+'&FechaH='+FechaH+'&Usuario='+Usuario+'&Sucursal='+Sucursal);
		
	}
	else
	{
	
		alert("Debe ingresar todos los campos");
	
	}
}

function BuscarParametrosAdicionales(id)
{
	if(document.getElementById('MarcaID').value=="")
	{
		parametro=0;
	}	
	else
	{
		parametro=document.getElementById('MarcaID').value;
	}
	TINY.box.show('./ventanas/buscarParametrosAdicionales.php?tipo='+id+'&parametro='+parametro,1,600,700,1);
}

function BuscarParametrosAdicional(id)
{
	parametro=0;	
	TINY.box.show('./ventanas/buscarParametrosAdicionales.php?tipo='+id+'&parametro='+parametro,1,600,700,1);
}

function BuscarResultado(Titulo,SP)
{
	TINY.box.show('./ventanas/buscarresultado.php?Titulo='+Titulo+'&SP='+SP,1,600,700,1);
}

function AsignarAcciones(id)
{
	TINY.box.show('./ventanas/listar_opciones.php?rol_id='+id,1,600,1150,1);
}

function GuardarOpcionesRol()
{
	validacion = true;
	 
	var cantidad=parseInt(document.getElementById('cant_opciones_rol').value);
	for (i = 1; i < cantidad + 1; i++) 
	{
		
		id_opcion=document.getElementById('rol_opcion_'+i);
		id_modulo=document.getElementById('modulo_opcion_rol_'+i);
		id_rol=document.getElementById('rol_id');
		
		if(id_opcion.checked)
		{
			tipo='I';
		}
		else
		{
			tipo='E';
		}
		 
		Ext.Ajax.request({
                url: 'ajax/guardarrolopciones.php',
                method: 'POST',
				params: {'id_opcion': id_opcion.value,'id_modulo':id_modulo.value,'id_rol':id_rol.value,'tipo':tipo},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						
					}
					else
					{
						validacion = false;
						alert('No se pudo guardar la opcion'); 
					}	
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
	}
	if(validacion==true)
	{
		alert('Los registros se almacenaron correctamente');
	}
	Ext.get('id_transacciones').load({
					url: 'acciones/roles.php?nombre_menu=roles',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
}

function GuardarOpcionesRol1()
{
	var cantidad=parseInt(document.getElementById('cant_opciones_rol').value);
	for (i = 1; i < cantidad; i++) 
	{
		id_opcion=document.getElementById('rol_opcion_'+i);
		id_modulo=document.getElementById('modulo_opcion_rol_'+i).value;
		id_rol=document.getElementById('rol_id').value;
		if(id_opcion.checked)
		{
			tipo='I';
		}
		else
		{
			tipo='E';
		}
		Ext.Ajax.request({
                url: 'ajax/guardarrolopciones.php',
                method: 'POST',
				params: {'id_opcion': id_opcion.value,'id_modulo':id_modulo,'id_rol':id_rol,'tipo':tipo},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						
					}
					else
					{
						alert('No se pudo guardar la opcion'); 
					}	
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
		
		
	}
	TINY.box.hide();
}

/*function RecordarUsuario()
{
	//TINY.box.show('./ventanas/RecordatorioContraseña.php?');
	//TINY.box.show('./ventanas/RecordatorioContraseña.php');
	if(document.getElementById("login-username").value=="" || document.getElementById("login-password").value=="")
	{
		TINY.box.show('./ventanas/RecordatorioContraseña.php');
	}
	else
	{
		document.getElementById("login-form").submit();
	}
}*/

function IngresarSucursal(idsucursal,nombresucursal)
{
	document.getElementById('SucursalNombre').value=idsucursal+' - '+nombresucursal;
	document.getElementById('SucursalID').value=idsucursal;
	TINY.box.hide();
}

function IngresarSucursal2(idsucursal,nombresucursal)
{
	document.getElementById('SucursalNombre').value=idsucursal+' - '+nombresucursal;
	document.getElementById('SucursalID').value=idsucursal;
	CambiarDatos();
	TINY.box.hide();
}

function IngresarPais(idpais,nombrepais)
{
	document.getElementById('PaisNombre').value=idpais+' - '+nombrepais;
	document.getElementById('PaisID').value=idpais;
	TINY.box.hide();
}

function IngresarDepartemento(iddepartamento,nombredepartamento)
{
	document.getElementById('DepartamentoNombre').value=nombredepartamento;
	document.getElementById('DepartamentolID').value=iddepartamento;
	TINY.box.hide();
}

function IngresarVendedor(idvendedor,nombrevendedor)
{
	document.getElementById('VendedorNombre').value=nombrevendedor;
	document.getElementById('VendedorID').value=idvendedor;
	TINY.box.hide();
}

function IngresarTipoNegocio(idTNegocio,nombretnegocio)
{
	document.getElementById('TipoNNombre').value=idTNegocio+' - '+nombretnegocio;
	document.getElementById('TipoNID').value=idTNegocio;
	TINY.box.hide();
}

function IngresarTipocliente(idTCliente,nombretCliente)
{
	document.getElementById('TipoCNombre').value=idTCliente+' - '+nombretCliente;
	document.getElementById('TipoCID').value=idTCliente;
	TINY.box.hide();
}

function IngresarCuentas(idCuentas,CuentasCliente)
{
	document.getElementById('CContNombre').value=CuentasCliente;
	document.getElementById('CContID').value=idCuentas;
	TINY.box.hide();
}

function IngresarZona(idZona,nombreZona)
{
	document.getElementById('ZonaNombre').value=idZona+' - '+nombreZona;
	document.getElementById('ZonaID').value=idZona;
	TINY.box.hide();
}

function IngresarCliente(idcliente,nombrecliente)
{
	document.getElementById('ClienteNombre').value=idcliente+' - '+nombrecliente;
	document.getElementById('ClienteID').value=idcliente;
	TINY.box.hide();
}

function IngresarBodegaSucursal(idBodegaSuc,BodegaSucNombre)
{
	document.getElementById('BodegaSucursalNombre').value=idBodegaSuc+' - '+BodegaSucNombre;
	document.getElementById('BodegaSucursalID').value=idBodegaSuc;
	TINY.box.hide();
}

function IngresarCiudad(idCiudad,CiudadNombre)
{
	document.getElementById('CiudadNombre').value=idCiudad+' - '+CiudadNombre;
	document.getElementById('CiudadID').value=idCiudad;
	TINY.box.hide();
}

function IngresarCargo(idCargo,CargoNombre)
{
	document.getElementById('CargoNombre').value=CargoNombre;
	document.getElementById('CargoID').value=idCargo;
	TINY.box.hide();
}

function IngresarBodega(idbodega,bodegacliente)
{
	document.getElementById('BodegaNombre').value=idbodega+' - '+bodegacliente;
	document.getElementById('BodegaID').value=idbodega;
	TINY.box.hide();
}

function IngresarBodega1(idbodega,bodegacliente)
{
	document.getElementById('BodegaNombreE').value=idbodega+' - '+bodegacliente;
	document.getElementById('BodegaIDE').value=idbodega;
	TINY.box.hide();
}

function IngresarModulo(idModulo,ModuloNombre)
{
	document.getElementById('ModuloNombre').value=ModuloNombre;
	document.getElementById('ModuloID').value=idModulo;
	TINY.box.hide();
}

function IngresarDivision(idDivision,DivisionNombre)
{
	document.getElementById('DivisiónNombre').value=DivisionNombre;
	document.getElementById('DivisiónlID').value=idDivision;
	TINY.box.hide();
}

function IngresarCuentaPadre(CuentaID,CuentaNombre,NumCuenta)
{
	document.getElementById('CuentaNombre').value=CuentaNombre;
	document.getElementById('CuentaID').value=CuentaID;
	document.getElementById('NumCuenta').value=NumCuenta;
	TINY.box.hide();
}

function IngresarTipoProducto(id,Nombre)
{
	document.getElementById('TipProdNombre').value=Nombre;
	document.getElementById('TipProdID').value=id;
	TINY.box.hide();
}

function IngresarUsuario(idUsuario,UsuarioNombre)
{
	document.getElementById('UsuarioNombre').value=UsuarioNombre;
	document.getElementById('idUsuario').value=idUsuario;
	TINY.box.hide();
}

function IngresarCajaUsuario(idCaja,UsuarioNombre)
{
	document.getElementById('UsuarioNombre').value=UsuarioNombre;
	document.getElementById('UsuarioID').value=UsuarioNombre;
	TINY.box.hide();
}

function IngresarMarca(id,Nombre)
{
	document.getElementById('MarcaNombre').value=Nombre;
	document.getElementById('MarcaID').value=id;
	TINY.box.hide();
}

function IngresarPrecios(id,Nombre)
{
	document.getElementById('PrecioNombre').value=Nombre;
	document.getElementById('PrecioID').value=id;
	TINY.box.hide();
}

function IngresarTecnologia(id,Nombre)
{
	document.getElementById('TecnologiaNombre').value=Nombre;
	document.getElementById('TecnologiaID').value=id;
	TINY.box.hide();
}

function IngresarProduct(id,Nombre)
{
	document.getElementById('ProductNombre').value=Nombre;
	document.getElementById('ProductID').value=id;
	TINY.box.hide();
}

function IngresarProveedores(id,Nombre)
{
	document.getElementById('ProveedorNombre').value=Nombre;
	document.getElementById('ProveedorID').value=id;
	TINY.box.hide();
}

function BuscarProducto()
{
	id=document.getElementById('tipo_producto').value;
	TINY.box.show('./ventanas/buscarproducto.php?tipoproducto='+id,1,700,200,1);
}

function BuscarProductoI()
{
	id=document.getElementById('tipo_producto').value;
	TINY.box.show('./ventanas/buscarproductoI.php?tipoproducto='+id,1,700,200,1);
}

function BuscarProductoTransferencia()
{
	id=0;
	TINY.box.show('./ventanas/buscarproducto3.php?tipoproducto='+id,1,700,200,1);
}

function EditarDetalle(idproducto,tipoproducto)
{
	TINY.box.show('./ventanas/ingreso_detalle_producto.php?idproducto='+idproducto+'&tipoproducto='+tipoproducto,1,600,600,1);
}

function EditarDetalleI(idproducto,tipoproducto)
{
	TINY.box.show('./ventanas/ingreso_detalle_productoI.php?idproducto='+idproducto+'&tipoproducto='+tipoproducto,1,600,600,1);
}

function BusquedaProductos()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		tipoproducto=document.getElementById('tipoproducto').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_producto.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,tipoproducto:tipoproducto},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaProductosI()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		tipoproducto=document.getElementById('tipoproducto').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_productoI.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,tipoproducto:tipoproducto},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaProductos2()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		tipoproducto=document.getElementById('tipoproducto').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_producto2.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,tipoproducto:tipoproducto},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaFactura()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		tipoproducto=document.getElementById('tipoproducto').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_factura.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,tipoproducto:tipoproducto},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaSucursal()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_sucursal.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaSucursal3()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_sucursal2.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaDepartamento()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_departemento.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaVendedor()
{
	if(document.getElementById('detalle_busqueda'))
	{
		sucursal=document.getElementById('SucursalID').value;
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_vendedor.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,sucursal:sucursal},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaSucursalGen()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		//var_dump(sucursal);
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_vendedorgen.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaBodega()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_bodega.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaBodega1()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_bodega1.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaZona()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_zona.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaCuentas()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_cuentas.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function ImprimirFactura()
{
	/*if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/RPT_Con_FacturaAK.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}*/
	url= 'acciones/RPT_Con_FacturaAK.php';
	open(url);
}

function BusquedaTipoNegocio()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_tiponegocio.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaTipoCliente()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_tipocliente.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaCiudad()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_ciudad.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaBodegaSucursal()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_bodegasucursal.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaCuentaPadre()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_cuentapadre.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaCargo()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_cargo.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaModulo()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_modulo.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BuscarOpciones()
{
	if(document.getElementById('id_transacciones'))
	{
		id=document.getElementById('ModuloID').value;
		nombre=document.getElementById('ModuloNombre').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/opciones.php?id='+id+'&nombre='+nombre,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BuscarFactura()
{
	if(document.getElementById('id_transacciones'))
	{
		fecInicio=document.getElementById('FechaDes').value;
		fecFin=document.getElementById('FechaHas').value;
		sucursal=document.getElementById('SucursalNombre').value;
		idSucursal=document.getElementById('SucursalID').value;
		estado=document.getElementById('estado').value;
		usuario=document.getElementById('UsuarioNombre').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/facturacion_Diaria.php?fecInicio='+fecInicio+'&fecFin='+fecFin+'&sucursal='+sucursal+'&idSucursal='+idSucursal+'&estado='+estado+'&usuario='+usuario,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BuscarFacturaC()
{
	if(document.getElementById('id_transacciones'))
	{
		//fecInicio=document.getElementById('FechaDes').value;
		//fecFin=document.getElementById('FechaHas').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/compras-inventario.php',
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BuscarFacturaPaginacion(Direccion,index,last,maximo)
{
	if(Direccion == 0)
	{	console.log('Entro por menor');
		if(index == 1 || last == 1)
		{
		
			index = 1;
		
		}
		else
		{
		
			index = index - 1;
		
		}
	
	}
	else
	{
		if(last == 0)
		{
			//console.log('Entro por mayor');
			if(index >= maximo)
			{
				//console.log('Entro por MAXIMO');
				console.log(maximo);
				index = maximo;
			
			}
			else
			{
				//console.log('Entro a sumar');
				index = index + 1;
			
			}
		}
		else
		{
		
			index = maximo;
		
		}
	
	}
	if(document.getElementById('id_transacciones'))
	{
		fecInicio=document.getElementById('FechaDes').value;
		fecFin=document.getElementById('FechaHas').value;
		sucursal=document.getElementById('SucursalNombre').value;
		idSucursal=document.getElementById('SucursalID').value;
		estado=document.getElementById('estado').value;
		usuario=document.getElementById('UsuarioNombre').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/facturacion_Diaria.php?fecInicio='+fecInicio+'&fecFin='+fecFin+'&sucursal='+sucursal+'&idSucursal='+idSucursal+'&estado='+estado+'&usuario='+usuario+'&Direccion='+Direccion+'&index='+index+'&last='+last,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BuscarFacturaPaginacionC(Direccion,index,last,maximo)
{
	if(Direccion == 0)
	{	console.log('Entro por menor');
		if(index == 1 || last == 1)
		{
		
			index = 1;
		
		}
		else
		{
		
			index = index - 1;
		
		}
	
	}
	else
	{
		if(last == 0)
		{
			//console.log('Entro por mayor');
			if(index >= maximo)
			{
				//console.log('Entro por MAXIMO');
				//console.log(maximo);
				index = maximo;
			
			}
			else
			{
				//console.log('Entro a sumar');
				index = index + 1;
			
			}
		}
		else
		{
		
			index = maximo;
		
		}
	
	}
	if(document.getElementById('id_transacciones'))
	{
		fecInicio=document.getElementById('FechaDes').value;
		fecFin=document.getElementById('FechaHas').value;
		sucursal="";//document.getElementById('SucursalNombre').value;
		idSucursal=0;//document.getElementById('SucursalID').value;
		estado="X";//document.getElementById('estado').value;
		usuario="";//document.getElementById('UsuarioNombre').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/compras-inventario.php?fecInicio='+fecInicio+'&fecFin='+fecFin+'&sucursal='+sucursal+'&idSucursal='+idSucursal+'&estado='+estado+'&usuario='+usuario+'&Direccion='+Direccion+'&index='+index+'&last='+last,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BuscarProvincia()
{
	if(document.getElementById('id_transacciones'))
	{
		id=document.getElementById('PaisID').value;
		idpais=document.getElementById('PaisID').value;
		nombre=document.getElementById('PaisNombre').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/provincia.php?id='+id+'&nombre='+nombre+'&idpais='+idpais,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaCliente()
{
	if(document.getElementById('detalle_busqueda'))
	{
		//sucursal=document.getElementById('SucursalID').value;
		sucursal='1';
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_cliente.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,sucursal:sucursal},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaPais()
{
	if(document.getElementById('detalle_busqueda'))
	{
		//sucursal=document.getElementById('SucursalID').value;
		sucursal='1';
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_pais.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,sucursal:sucursal},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function Busqueda(Num1,titulo)
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,Num1:Num1,titulo:titulo},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaMarca()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_Marca.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaPrecio()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_precios.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaTecnologia()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_tecnologia.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaProduct(IdMarca)
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		marca=IdMarca;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_Product.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,marca:marca},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaDivision()
{
	if(document.getElementById('detalle_busqueda'))
	{
		//sucursal=document.getElementById('SucursalID').value;
		sucursal='1';
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_division.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,sucursal:sucursal},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaPrecios()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_precios.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function Redimensionar()
{
	document.getElementById('tinybox').style.height="auto";
}

function IngresarDetalleFacturacion(id_producto)
{
	if(document.getElementById('contenedor_pasos'))
	{
		tipoproducto=document.getElementById('tipo_producto').value;
		Ext.get('contenedor_pasos').load({
		url: 'ventanas/ingreso_detalle_producto.php',
		params:{idproducto:id_producto,tipoproducto:tipoproducto},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='500px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function IngresarDetalleFacturacionI(id_producto)
{
	if(document.getElementById('contenedor_pasos'))
	{
		tipoproducto=document.getElementById('tipo_producto').value;
		Ext.get('contenedor_pasos').load({
		url: 'ventanas/ingreso_detalle_productoI.php',
		params:{idproducto:id_producto,tipoproducto:tipoproducto},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='500px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function IngresarDetalleFacturacion2(id_producto)
{
	if(document.getElementById('contenedor_pasos'))
	{
		tipoproducto=0;
		Ext.get('contenedor_pasos').load({
		url: 'ventanas/ingreso_detalle_producto.php',
		params:{id_producto:id_producto,tipoproducto:tipoproducto},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='500px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function Agregar_DetalleI(id_producto)
{
		detalleid=document.getElementById('detalleid').value;
		cantidad=document.getElementById('cantidad').value;
		valor=document.getElementById('valor').value;
		descuento=0;
		numeroserie='';//document.getElementById('numeroserie').value;
		numerolinea='';//document.getElementById('numerolinea').value;
		tipoproducto=document.getElementById('tipo_producto').value;
		Ext.get(detalleid).load({
		url: 'acciones/agregar_detalle_productoI.php',
		params:{detalleid:detalleid,tipoproducto:tipoproducto,idproducto:id_producto,cantidad:cantidad,descuento:descuento,numeroserie:numeroserie,numerolinea:numerolinea,valor:valor},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='30px' width='100%' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
		TINY.box.hide();
}

function Agregar_Detalle(id_producto)
{
		detalleid=document.getElementById('detalleid').value;
		cantidad=document.getElementById('cantidad').value;
		valor=document.getElementById('valor').value;
		descuento=0;
		numeroserie='';//document.getElementById('numeroserie').value;
		numerolinea='';//document.getElementById('numerolinea').value;
		tipoproducto=document.getElementById('tipo_producto').value;
		Ext.get(detalleid).load({
		url: 'acciones/agregar_detalle_producto.php',
		params:{detalleid:detalleid,tipoproducto:tipoproducto,idproducto:id_producto,cantidad:cantidad,descuento:descuento,numeroserie:numeroserie,numerolinea:numerolinea,valor:valor},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='30px' width='100%' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
		TINY.box.hide();
}

function ActualizarValores(id,value)
{
	document.getElementById(id).value=value;
}

function RestaValores(id,valor)
{
	console.log(valor);
	console.log(document.getElementById(id).value);
	document.getElementById(id).value=number_format(document.getElementById(id).value) - number_format(valor);
}

function RestaValoresI(id,valor)
{
	console.log(valor);
	/*console.log(document.getElementById(id).value);
	console.log(document.getElementById(id).value - valor);*/
	var numero = document.getElementById(id).value - valor;
	if(numero.toFixed(4)<=0)
	{
		document.getElementById(id).value = 0;
	}
	else
	{
		document.getElementById(id).value = numero.toFixed(4);
	}
	
}


function RecalcularTotal(valor)
{
	transporte=0;
	otros=0;
	/*if(document.getElementById('Transporte').value!="")
	{
		transporte=parseFloat(document.getElementById('Transporte').value);
	}*/
	/*if(document.getElementById('Otros').value!="")
	{
		otros=parseFloat(document.getElementById('Otros').value);
	}*/
	total=parseFloat(valor)+0;
	document.getElementById('Total').value=total;
}

function RestaTotal(valor)
{
	console.log(valor);
	//document.getElementById('Total').value=document.getElementById('Total').value - valor;
	document.getElementById('Total').value=number_format(document.getElementById('Total').value) - number_format(valor);
}

function RestaTotalI(valor)
{
	console.log(valor);
	var numero = number_format(document.getElementById('Total').value,2) - number_format(valor,2);
	console.log(numero);
	document.getElementById('Total').value=number_format(document.getElementById('Total').value) - number_format(valor);
}


function justNumbers(e)
 {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
    return true;
     
    return /\d/.test(String.fromCharCode(keynum));
 }

function Editar_Detalle(id_producto,detalleid)
{
	flag=validar_detalle();
	if(flag)
	{
		cantidad=document.getElementById('cantidad').value;
		descuento=document.getElementById('descuento').value;
		numeroserie='';//document.getElementById('numeroserie').value;
		numerolinea='';//document.getElementById('numerolinea').value;
		tipoproducto=document.getElementById('tipo_producto').value;
		Ext.get(detalleid).load({
		url: 'acciones/agregar_detalle_producto.php',
		params:{detalleid:detalleid,tipoproducto:tipoproducto,idproducto:id_producto,cantidad:cantidad,descuento:descuento,numeroserie:numeroserie,numerolinea:numerolinea},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='30px' width='100%' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
		TINY.box.hide();
	}
	else
	{
		cant=parseInt(document.getElementById('cantidad').value);
		stock=parseInt(document.getElementById('stock').value);
		if(cant>stock)
		{
			alert("La cantidad debe ser menor que el stock");
		}
		else
		{
			alert("Debe ingresar todos los campos obligatorios");
		}
	}
}

function Editar_DetalleI(id_producto,detalleid)
{
		cantidad=document.getElementById('cantidad').value;
		valor=document.getElementById('valor').value;
		descuento=0;
		numeroserie='';//document.getElementById('numeroserie').value;
		numerolinea='';//document.getElementById('numerolinea').value;
		tipoproducto=document.getElementById('tipo_producto').value;
		Ext.get(detalleid).load({
		url: 'acciones/agregar_detalle_productoI.php',
		params:{detalleid:detalleid,tipoproducto:tipoproducto,idproducto:id_producto,cantidad:cantidad,descuento:descuento,numeroserie:numeroserie,numerolinea:numerolinea,valor:valor},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='30px' width='100%' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
		TINY.box.hide();
}

function EliminarDetalle(id_producto,detalleid,tipoproducto,id)
{
	Ext.get(detalleid).load({
		url: 'acciones/eliminar_detalle_producto.php',
		params:{detalleid:detalleid,idproducto:id_producto,tipoproducto:tipoproducto,id:id},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='30px' width='100%' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
}

function EliminarDetalleI(id_producto,detalleid,tipoproducto,id,valor)
{
	Ext.get(detalleid).load({
		url: 'acciones/eliminar_detalle_productoI.php',
		params:{detalleid:detalleid,idproducto:id_producto,tipoproducto:tipoproducto,id:id,valor:valor},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='30px' width='100%' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
}

function EliminarUsuario(idUsuario,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminarusuario.php',
		method: 'POST',
		params: {'id_usuario': idUsuario},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el usuario'+idUsuario);
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo guardar la opcion'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function EliminarRol(idRol,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminarrol.php',
		method: 'POST',
		params: {'idRol': idRol},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el rol');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo guardar la opcion'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});
}

function EliminarSucursal(idSucursal,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminarsucursal.php',
		method: 'POST',
		params: {'idSucursal': idSucursal},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el rol');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo guardar la sucursal'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});
}

function BusquedaCuentasDesde()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_cuentasDesde.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaCuentasHasta()
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_cuentasHasta.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function BusquedaCajasUsuarios(idSuc)
{
	if(document.getElementById('detalle_busqueda'))
	{
		tipobusqueda=document.getElementById('tipobusqueda').value;
		busqueda=document.getElementById('busqueda').value;
		Ext.get('detalle_busqueda').load({
		url: 'acciones/resultado_busqueda_cuentasUsuarios.php',
		params:{tipobusqueda:tipobusqueda,busqueda:busqueda,idSuc:idSuc},
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='25px' width='150px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function Eliminarempleado(id,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminarempleado.php',
		method: 'POST',
		params: {'id': id},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el rol');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar al empleado'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});
}

function Eliminaropcion(id,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminaropcion.php',
		method: 'POST',
		params: {'id': id},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino la opción');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar la opcion'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});
}

function EliminarModulo(idModulo,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminarmodulo.php',
		method: 'POST',
		params: {'idModulo': idModulo},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el modulo');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo guardar la opcion'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function Eliminaracceso(idAcceso,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminaracceso.php',
		method: 'POST',
		params: {'idAcceso': idAcceso},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el acceso');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el acceso'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function Eliminarcargo(idCargo,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminarcargo.php',
		method: 'POST',
		params: {'idCargo': idCargo},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el acceso');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el acceso'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function Eliminardivision(idDivision,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminardivision.php',
		method: 'POST',
		params: {'idDivision': idDivision},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el acceso');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el acceso'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function IngresarCuentasD(idCuentas,CuentasCliente)
{
	document.getElementById('CContNombre1').value=CuentasCliente;
	document.getElementById('CContID1').value=idCuentas;
	TINY.box.hide();
}

function IngresarCuentasH(idCuentas,CuentasCliente)
{
	document.getElementById('CContNombre2').value=CuentasCliente;
	document.getElementById('CContID2').value=idCuentas;
	TINY.box.hide();
}

function CuentasGlobalConsulta()
{
	if(document.getElementById('chkVerctas').checked==true)
	{
		document.getElementById('CContNombre1').value="TODAS";
		document.getElementById('CContID1').value="1";
		document.getElementById('CContNombre2').value="TODAS";
		document.getElementById('CContID2').value="9.9.99.99.999";
		document.getElementById('bt_ctah').disabled = true;
		document.getElementById('bt_ctad').disabled = true;
	}
	else
	{
		document.getElementById('CContNombre1').value="";
		document.getElementById('CContID1').value="";
		document.getElementById('CContNombre2').value="";
		document.getElementById('CContID2').value="";
		document.getElementById('bt_ctah').disabled = false;
		document.getElementById('bt_ctad').disabled = false;
	}
}

function ImprimirCuentasSaldos()
{
	ano=document.getElementById('anos').value;
	mes=document.getElementById('mes').value;
	ctaI=document.getElementById('CContID1').value;
	ctaF=document.getElementById('CContID2').value;
	window.open('../ProcatelOP/acciones/ImprimirCuentasSaldos.php?ano='+ano+'&mes='+mes+'&ctaI='+ctaI+'&ctaF='+ctaF);
}

function EliminarCuentas(idCuentas,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminarcuentas.php',
		method: 'POST',
		params: {'idCuentas': idCuentas},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino la cuenta');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar la cuenta'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function Eliminardepartamento(idDepartamento,id_tr)
{
	console.log(idDepartamento);
	Ext.Ajax.request({
		url: 'ajax/eliminardepartamento.php',
		method: 'POST',
		params: {'idDepartamento': idDepartamento},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el departamento');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el departamento'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function Eliminarregistros(id_accion,id,id_tr)
{//url: 'ajax/eliminarpais.php', 
	Ext.Ajax.request({
		url: 'ajax/'+id_accion+'.php',
		method: 'POST',
		params: {'id': id},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el registro');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el regitro'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});
}

function Eliminarnegocio(idNegocio,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/Eliminarnegocio.php',
		method: 'POST',
		params: {'idNegocio': idNegocio},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el negocio');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el negocio'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function Eliminarbodega(idNegocio,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/eliminarbodega.php',
		method: 'POST',
		params: {'idNegocio': idNegocio},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el negocio');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el negocio'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function Eliminarmarcas(idNegocio,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/Eliminarmarcas.php',
		method: 'POST',
		params: {'idNegocio': idNegocio},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el registro');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el registro'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function Eliminarproducto(idNegocio,id_tr)
{
	Ext.Ajax.request({
		url: 'ajax/Eliminarproducto.php',
		method: 'POST',
		params: {'idNegocio': idNegocio},
		success: function(resp) 
		{
			var respuesta = Ext.decode(resp.responseText);
			if(respuesta.success == true)
			{
				alert('Se elimino el registro');
				DeleteElement(id_tr);
			}
			else
			{
				alert('No se pudo eliminar el registro'); 
			}	
		},
		failure: function(responseObject) {
			 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
		 }});

}

function ReversarFactura(fact,asic,kar,estado)
{
	if(estado!="E")
	{
		Ext.Ajax.request({
			url: 'ajax/ReversaFactura.php',
			method: 'POST',
			params: {'fact': fact,'asic':asic,'kar':kar},
			success: function(resp) 
			{
				var respuesta = Ext.decode(resp.responseText);
				if(respuesta.success == true)
				{
					alert('Se reversó la factura correctamente');
					BuscarFactura();
				}
				else
				{
					alert('No se pudo reversar la factura'); 
				}	
			},
			failure: function(responseObject) {
				 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
			 }});
	}
	else
	{
		alert('No se puede reversar una factura eliminada');
		
	}
}

function ReversarCompra(fact,estado)
{
	if(estado!=0)
	{
		Ext.Ajax.request({
			url: 'ajax/ReversaCompra.php',
			method: 'POST',
			params: {'fact': fact},
			success: function(resp) 
			{
				var respuesta = Ext.decode(resp.responseText);
				if(respuesta.success == true)
				{
					alert('Se reversó la factura correctamente');
					BuscarFacturaC();
				}
				else
				{
					alert('No se pudo reversar la factura'); 
				}	
			},
			failure: function(responseObject) {
				 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
			 }});
	}
	else
	{
		alert('No se puede reversar una factura eliminada');
		
	}
}

function DeleteElement(id_element)
{
	var element = document.getElementById(id_element);
	element.parentNode.removeChild(element);
}

function ActualizarValue(id,value)
{
	document.getElementById(id).value=value;
}

function AgregarElementoDetalle(id,value)
{
	elemento1 = document.createElement('tr');
	elemento1.id = value;
	elemento1.className="impar";
	elemento2 = document.getElementById('contenedor_datos_detalle');
	elemento2.appendChild(elemento1);
	ActualizarValue(id,value);
}

function validar_detalle()
{
	if(document.getElementById('cantidad').value!="" && document.getElementById('descuento').value!="")
	{
		cant=parseInt(document.getElementById('cantidad').value);
		stock=parseInt(document.getElementById('stock').value);
		if(cant<=stock)
		{
			return true;
		}
		else
		{
			document.getElementById('cantidad').className="form-control error_input";
			return false;
		}
	}
	else
	{
		return false;
	}
}

function Reemplazo(id_accion)
{
	if(document.getElementById('id_menu'))
	{
		Ext.get('id_menu').load({
		url: 'acciones/encriptacion.php?id_accion='+id_accion,
		});
	}
}

function CambiarDatos()
{
	tipofacturacion=document.getElementById('TipoFacturacion').value;
	SucursalID=document.getElementById('SucursalID').value;
	document.getElementById('NumAuto').value='';
	document.getElementById('FechaCaducidad').value='';
	document.getElementById('NoFact').value='';
	valida=false;
	Ext.Ajax.request({
                url: 'ajax/datosfacturacion.php',
                method: 'POST',
				params: {'tipofacturacion': tipofacturacion,'SucursalID':SucursalID},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						valida=true;
						ActualizarFacturacion(respuesta.data.NoAuto,respuesta.data.FechaCaducidad,respuesta.data.No_Fact);
						if(respuesta.data.NoAuto=='')
						{
							alert('No existe secuncias validas o la fecha de validéz de estas secuencias ha expirado'); 
						}
					}
					else
					{
						Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
					}	
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
}

function ActualizarFacturacion(NumAuto,FechaCaducidad,NoFact)
{
	//console.log(NumAuto);
	document.getElementById('NumAuto').value=NumAuto;
	document.getElementById('FechaCaducidad').value=FechaCaducidad;
	document.getElementById('NoFact').value=NoFact;
}

function Guardar_Facturacion()
{
	Ext.Ajax.request({
                url: 'ajax/detallesfacturacion.php',
                method: 'POST',
				params: {'tipofacturacion': tipofacturacion},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						
						Facturar();
					}
					else
					{
						alert('Debe agregar items a la factura'); 
					}	
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
}

function Guardar_FacturacionC()
{
	Ext.Ajax.request({
                url: 'ajax/detallesfacturacion.php',
                method: 'POST',
				params: {'tipofacturacion': 3},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						
						FacturarC();
					}
					else
					{
						alert('Debe agregar items a la factura'); 
					}	
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
}

function Facturar()
{
	if(document.getElementById('FechaSistema').value!='')
	{
		//console.log('INGRESO CABECERA');
		GuardarCabecera();
	}
	else
	{
		document.getElementById('FechaSistema').className="form-control date-picker error_input";
		document.getElementById('FechaSistema').style.borderColor="#FF0000";
		alert('Debe ingresar la Fecha a la factura'); 
	}
}

function FacturarC()
{
	if(document.getElementById('FechaSistema').value!='')
	{
		console.log('INGRESO CABECERA');
		GuardarCabeceraC();
	}
	else
	{
		document.getElementById('FechaSistema').className="form-control date-picker error_input";
		document.getElementById('FechaSistema').style.borderColor="#FF0000";
		alert('Debe ingresar la Fecha a la factura'); 
	}
}

function GuardarCabecera()
{
	//console.log('GUARDAR');
	vendedor=document.getElementById('VendedorID').value;
	cliente=document.getElementById('ClienteID').value;
	tipofacturacion=document.getElementById('TipoFacturacion').value;
	//transporte=document.getElementById('Transporte').value;
	transporte=0;
	fecha_facturacion=document.getElementById('FechaSistema').value;
	facturaxMayor=document.getElementById('chkFactxm');
	contado=document.getElementById('contado');
	motivo=document.getElementById('motivo').value;
	sucursal=document.getElementById('SucursalID').value;
	TipoProd=document.getElementById('tipo_producto').value;
	/*if(facturaxMayor.checked)
	{
		facturaxMayor='1';
	}
	else
	{*/
		facturaxMayor='0';
	//}
	/*if(contado.checked)
	{*/
		contado_val='1';
	/*}
	else
	{
		contado_val='0';
	}*/
	console.log('VA A GUARDAR CABECERA')
	Ext.Ajax.request({
                url: 'ajax/guardarfacturacion.php',
                method: 'POST',
				params: {'tipofacturacion': tipofacturacion,'cliente':cliente,'vendedor':vendedor,'transporte':transporte,'fecha_facturacion':fecha_facturacion,'facturaxMayor':facturaxMayor,'contado_val':contado_val,'motivo':motivo,'TipoProd':TipoProd},
				success: function(resp) 
				{
					//console.log('GUARDO CABECERA');
					//console.log(resp.responseText);
					//var respuesta = Ext.decode(resp.responseText);
					//if(respuesta.success == true)
					//{
						//Num=respuesta.data;
						//console.log(respuesta.data);
						MostrarImprimir(sucursal);
					//}
					//else
					//{
						//alert('No se pudo guardar la factura'); 
					//}	
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
}

function GuardarCabeceraC()
{
	transporte=0;
	fecha_facturacion=document.getElementById('FechaSistema').value;
	facturaxMayor=document.getElementById('chkFactxm');
	contado=document.getElementById('contado');
	motivo=document.getElementById('motivo').value;
	TipoProd=document.getElementById('tipo_producto').value;
	FechaCad=document.getElementById('FechaCad').value;
	NoFact=document.getElementById('NoFact').value;
	NumAuto=document.getElementById('NumAuto').value;
	BodegaID=document.getElementById('BodegaID').value;
	facturaxMayor='0';
	contado_val='1';
	console.log('VA A GUARDAR CABECERA C')
	Ext.Ajax.request({
                url: 'ajax/guardarfacturacionC.php',
                method: 'POST',
				params: {'fecha_facturacion':fecha_facturacion,'facturaxMayor':facturaxMayor,'contado_val':contado_val,'motivo':motivo,'TipoProd':TipoProd,'FechaCad':FechaCad,'NoFact':NoFact,'NumAuto':NumAuto,'BodegaID':BodegaID},
				success: function(resp) 
				{
					alert('Se guardó la factura correctamente');
					verSubProceso('compras-inventario','compras-inventario')							
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
}

function GuardarKardex()
{
	Fecha=document.getElementById('FechaSistema').value;
	BodegaID=document.getElementById('BodegaID').value;
	BodegaIDE=document.getElementById('BodegaIDE').value;
	motivo=document.getElementById('motivo').value;
	Num = 0;
	Ext.Ajax.request({
                url: 'ajax/guardarkardex.php',
                method: 'POST',
				params: {'Fecha': Fecha,'BodegaID':BodegaID,'BodegaIDE':BodegaIDE,'motivo':motivo},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						Num=respuesta.data;
						ImprimirKardex1(Num);
					}
					else
					{
						alert('No se pudo guardar la factura'); 
					}	
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
}

function GuardarUsuarioOLD()
{
	if(document.getElementById('id_transacciones'))
	{
		id=document.getElementById('id').value;
		clave=document.getElementById('clave').value;
		id_empleado=document.getElementById('VendedorID').value;
		fecha_ingreso=document.getElementById('FechaIng').value;
		fecha_vencimiento=document.getElementById('FechaCad').value;
		estado=document.getElementById('estado').value;
		tipo=document.getElementById('tipo').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/editarusuario.php?id='+id+'&clave='+clave+'&fecha_ingreso='+fecha_ingreso+'&fecha_vencimiento='+fecha_vencimiento+'&tipo='+tipo+'&estado='+estado+'&guardar=1'+'&id_empleado='+id_empleado,
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function GuardarUsuario()
{
		Validacion=true;
		
		if(document.getElementById('id').value!="")
		{
			if(document.getElementById('clave').value.length>5)
			{
				id=document.getElementById('id').value;
				clave=document.getElementById('clave').value;
				VendedorID=document.getElementById('VendedorID').value;
				fecha_ingreso=document.getElementById('FechaIng').value;
				fecha_vencimiento=document.getElementById('FechaCad').value;
				estado=document.getElementById('estado').value;
				rol=document.getElementById('rol').value;
				mail=document.getElementById('mail').value;

				if(clave=="")
				{
					document.getElementById('clave').style.borderColor="#FF0000";
					Validacion=false;
				}
				if(VendedorID=="")
				{
					document.getElementById('VendedorNombre').style.borderColor="#FF0000";
					Validacion=false;
				}
				if(mail=="")
				{
					document.getElementById('mail').style.borderColor="#FF0000";
					Validacion=false;
				}
				
				if(Validacion==true)
					{
						Ext.Ajax.request({
									url: 'ajax/guardarusuario.php',
									method: 'POST',
									params: {'id':id,'clave':clave,'fecha_ingreso':fecha_ingreso,'fecha_vencimiento':fecha_vencimiento,'estado':estado,'VendedorID':VendedorID,'rol':rol,'mail':mail},
									success: function(resp) 
									{
										var respuesta = Ext.decode(resp.responseText);
										if(respuesta.success == true)
										{
											alert('El usuario se ingreso correctamente');
										}
										else
										{
											alert('No se pudo guardar el usuario'); 
										}	
									},
									failure: function(responseObject) {
										 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
									 }});
						Ext.get('id_transacciones').load({
						url: 'acciones/usuarios.php?nombre_menu=usuarios',
						nocache: true,
						scripts:true,
						text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
						});			 
					}
					else
					{
						alert('Corrija los valores marcados con rojo para proceder'); 
					}
			}
			else	
			{
				alert('La contraseña debe tener más de 5 caracteres'); 
				document.getElementById('clave').style.borderColor="#FF0000";
			}
		}
		else
		{
			alert('Debe ingresar el usuario para continuar el proceso'); 
			document.getElementById('id').style.borderColor="#FF0000";
		}
}

function GuardarRol1()
{
	if(document.getElementById('id_transacciones'))
	{
		id=document.getElementById('id').value;
		nombrerol=document.getElementById('name').value;
		estado=document.getElementById('estado').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/editarrol.php?id='+id+'&nombrerol='+nombrerol+'&estado='+estado+'&guardar=1',
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function GuardarRol()
{
		Validacion=true;
		
		if(document.getElementById('NombreRol').value!="")
		{
			id=document.getElementById('id').value;
			NombreRol=document.getElementById('NombreRol').value;
			estado=document.getElementById('estado').value;

				Ext.Ajax.request({
								url: 'ajax/guardarrol.php',
								method: 'POST',
								params: {'id':id,'NombreRol':NombreRol,'estado':estado},
								success: function(resp) 
								{
									var respuesta = Ext.decode(resp.responseText);
									if(respuesta.success == true)
									{
										alert('El rol se ingreso correctamente');
									}
									else
									{
										alert('No se pudo guardar el rol'); 
									}	
								},
								failure: function(responseObject) {
										Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
								}});
						Ext.get('id_transacciones').load({
						url: 'acciones/roles.php?nombre_menu=roles',
						nocache: true,
						scripts:true,
						text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
						});			 
		}
		else
		{
			alert('Debe ingresar el nombre del rol para continuar el proceso'); 
			document.getElementById('NombreRol').style.borderColor="#FF0000";
		}
}

function GuardarOpcion()
{
		Validacion=true;
		
		if(document.getElementById('NombreOpcion').value!="")
		{
			if(document.getElementById('id').value!="")
			{id=document.getElementById('id').value;}
			else
			{id=0;}
			if(document.getElementById('ModuloID').value!="")
			{ModuloID=document.getElementById('ModuloID').value;}
			else
			{ModuloID=0;}
			if(document.getElementById('ModuloNombre').value!="")
			{ModuloNombre=document.getElementById('ModuloNombre').value;}
			else
			{
				Validacion=false;
				document.getElementById('ModuloNombre').style.borderColor="#FF0000";
			}
			NombreOpcion=document.getElementById('NombreOpcion').value;
			estado=document.getElementById('estado').value;
			NombrePant=document.getElementById('NombrePantalla').value;
				Ext.Ajax.request({
								url: 'ajax/guardaropcion.php',
								method: 'POST',
								params: {'id':id,'NombreOpcion':NombreOpcion,'ModuloID':ModuloID,'estado':estado,'NombrePant':NombrePant},
								success: function(resp) 
								{
									alert('Registro exitoso');
									var respuesta = Ext.decode(resp.responseText);
									if(respuesta.success == true)
									{
										
									}
									else
									{
										Validacion=false;
										alert('No se pudo guardar el rol'); 
									}	
								},
								failure: function(responseObject) {
										Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
								}});						
						Ext.get('id_transacciones').load({
						url: 'acciones/opciones.php?nombre_menu=roles',
						nocache: true,
						scripts:true,
						text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
						});			 
		}
		else
		{
			alert('Debe ingresar el nombre de la opción para continuar el proceso'); 
			document.getElementById('NombreOpcion').style.borderColor="#FF0000";
		}
}

function GuardarModulo()
{
		Validacion=true;
		
		if(document.getElementById('NombreModulo').value!="")
		{
			id=document.getElementById('id').value;
			NombreModulo=document.getElementById('NombreModulo').value;
			estado=document.getElementById('estado').value;

				Ext.Ajax.request({
								url: 'ajax/guardarmodulo.php',
								method: 'POST',
								params: {'id':id,'NombreModulo':NombreModulo,'estado':estado},
								success: function(resp) 
								{
									var respuesta = Ext.decode(resp.responseText);
									if(respuesta.success == true)
									{
										alert('El módulo se ingreso correctamente');
									}
									else
									{
										alert('No se pudo guardar el módulo'); 
									}	
								},
								failure: function(responseObject) {
										Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
								}});
						Ext.get('id_transacciones').load({
						url: 'acciones/modulos.php?nombre_menu=modulos',
						nocache: true,
						scripts:true,
						text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
						});			 
		}
		else
		{
			alert('Debe ingresar el nombre del módulo para continuar el proceso'); 
			document.getElementById('NombreModulo').style.borderColor="#FF0000";
		}
}
/*
function BuscarFactura(Direccion,TotalPaginas,NumeroPaginas,CantidadRegistros,Ultimo)
{
		Validacion=true;
		
		if(document.getElementById('SucursalID').value!="")
		{Idsuc=document.getElementById('SucursalID').value;}
		else
		{Idsuc=0;}
		if(document.getElementById('UsuarioNombre').value != null)
		{usuario=document.getElementById('UsuarioNombre').value;}
		else
		{usuario="";}
		if(document.getElementById('SucursalNombre').value != null)
		{Sucursal=document.getElementById('SucursalNombre').value;}
		else
		{Sucursal="";}
		if(document.getElementById('FechaDes').value != "")
		{desde=document.getElementById('FechaDes').value;}
		else
		{desde="";}
		if(document.getElementById('FechaHas').value != "")
		{hasta=document.getElementById('FechaHas').value;}
		else
		{hasta="";}
		estado=document.getElementById('estado').value;
		Id=0;
		if(Direccion == 1)
		{
			if(parseInt(NumeroPaginas) < TotalPaginas)
			{
				NumeroPaginas = parseInt(NumeroPaginas) + 1;				
				Validacion=true;
				if(Ultimo == 1)
				{CantidadRegistros = (TotalPaginas * 20);}
				else
				{CantidadRegistros = parseInt(CantidadRegistros) + 20;}
				
			}			
		}
		else
		{
			if(parseInt(NumeroPaginas) > 1)
			{
				 NumeroPaginas = parseInt(NumeroPaginas) - 1;
				 CantidadRegistros= parseInt(CantidadRegistros) - 20;
				 Validacion=true;
			}
			if(parseInt(NumeroPaginas) == 0)
			{NumeroPaginas = 1;}
		}
		if(Validacion==true)
		{
			Ext.get('id_transacciones').load({
			url: 'acciones/facturacion.php?Idsuc='+Idsuc+'&Id='+Id+'&usuario='+usuario+'&estado='+estado+'&hasta='+hasta+'&desde='+desde+'&Direccion='+Direccion+'&Sucursal='+Sucursal+'&CantidadRegistros='+CantidadRegistros+'&TotalPaginas='+TotalPaginas+'&NumeroPaginas='+NumeroPaginas,
			nocache: true,
			scripts:true,
			text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
			});
		}
}*/
/*
function BuscarFactura(Direccion,TotalPaginas,NumeroPaginas)
{
		Validacion=true;
		
		if(document.getElementById('SucursalID').value!="")
		{Idsuc=document.getElementById('SucursalID').value;}
		else
		{Idsuc=0;}
		if(document.getElementById('UsuarioNombre').value != null)
		{usuario=document.getElementById('UsuarioNombre').value;}
		else
		{usuario="";}
		if(document.getElementById('SucursalNombre').value != null)
		{Sucursal=document.getElementById('SucursalNombre').value;}
		else
		{Sucursal="";}
		if(document.getElementById('FechaDes').value != "")
		{desde=document.getElementById('FechaDes').value;}
		else
		{desde="";}
		if(document.getElementById('FechaHas').value != "")
		{hasta=document.getElementById('FechaHas').value;}
		else
		{hasta="";}
		estado=document.getElementById('estado').value;
		if(Direccion == 1)
		{
			if(parseInt(NumeroPaginas) < TotalPaginas)
			{
				NumeroPaginas = parseInt(NumeroPaginas) + 1;				
				Validacion=true;
				if(Ultimo == 1)
				{CantidadRegistros = (TotalPaginas * 20);}
				else
				{CantidadRegistros = parseInt(CantidadRegistros) + 20;}
				
			}			
		}
		else
		{
			if(parseInt(NumeroPaginas) > 1)
			{
				 NumeroPaginas = parseInt(NumeroPaginas) - 1;
				 CantidadRegistros= parseInt(CantidadRegistros) - 20;
				 Validacion=true;
			}
			if(parseInt(NumeroPaginas) == 0)
			{NumeroPaginas = 1;}
		}
		if(Validacion==true)
		{
			Ext.get('id_transacciones').load({
			url: 'acciones/facturacion.php?Idsuc='+Idsuc+'&usuario='+usuario+'&estado='+estado+'&hasta='+hasta+'&desde='+desde+'&Sucursal='+Sucursal+'&TotalPaginas='+TotalPaginas+'&NumeroPaginas='+NumeroPaginas,
			nocache: true,
			scripts:true,
			text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
			});
		}
}*/

function BuscarEmpleado(Direccion,TotalPaginas,NumeroPaginas,CantidadRegistros,Ultimo)
{
		Validacion=true;
		
		if(document.getElementById('SucursalID').value!="")
		{Idsuc=document.getElementById('SucursalID').value;}
		else
		{Idsuc=0;}
		if(document.getElementById('VendedorNombre').value != "null")
		{Nombre=document.getElementById('VendedorNombre').value;}
		else
		{Nombre="";}
		if(document.getElementById('VendedorID').value != null)
		{VendedorID=document.getElementById('VendedorID').value;}
		else
		{VendedorID=0;}
		if(document.getElementById('SucursalNombre').value != null)
		{Sucursal=document.getElementById('SucursalNombre').value;}
		else
		{Sucursal="";}
		if(Direccion == 1)
		{
			if(parseInt(NumeroPaginas) < TotalPaginas)
			{
				NumeroPaginas = parseInt(NumeroPaginas) + 1;				
				Validacion=true;
				if(Ultimo == 1)
				{CantidadRegistros = (TotalPaginas * 20);}
				else
				{CantidadRegistros = parseInt(CantidadRegistros) + 20;}
				
			}			
		}
		else
		{
			if(parseInt(NumeroPaginas) > 1)
			{
				 NumeroPaginas = parseInt(NumeroPaginas) - 1;
				 CantidadRegistros= parseInt(CantidadRegistros) - 20;
				 Validacion=true;
			}
			if(parseInt(NumeroPaginas) == 0)
			{NumeroPaginas = 1;}
		}
		if(Validacion==true)
		{
			Ext.get('id_transacciones').load({
			url: 'acciones/empleados.php?Idsuc='+Idsuc+'&Nombre='+Nombre+'&Direccion='+Direccion+'&VendedorID='+VendedorID+'&Sucursal='+Sucursal+'&CantidadRegistros='+CantidadRegistros+'&TotalPaginas='+TotalPaginas+'&NumeroPaginas='+NumeroPaginas,
			nocache: true,
			scripts:true,
			text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
			});
		}
}

function GuardarSucursalParametros()
{
	Validacion=true;

	if(document.getElementById('SucursalNombre').value!="")
	{	
			idsucursal=document.getElementById('SucursalID').value;
			Descripcion=document.getElementById('SucursalNombre').value;
			direccion=document.getElementById('Direccion').value;
			telefono=document.getElementById('Telefono').value;
			fax=document.getElementById('Fax').value;
			selectError3=document.getElementById('estado').value;
			NumAutoRet=document.getElementById('NumAutoRet').value;
			SerieRet=document.getElementById('SerieRet').value;
			NoDesdeRet=document.getElementById('NoDesdeRet').value;
			NoHastaRet=document.getElementById('NoHastaRet').value;
			FechaRet=document.getElementById('FechaRet').value;
			NumAutoND=document.getElementById('NumAutoND').value;
			SerieND=document.getElementById('SerieND').value;
			NoDesdeND=document.getElementById('NoDesdeND').value;
			NoHastaND=document.getElementById('NoHastaND').value;
			FechaND=document.getElementById('FechaND').value;
			NumAutoNC=document.getElementById('NumAutoNC').value;
			SerieNC=document.getElementById('SerieNC').value;
			NumDesdeNC=document.getElementById('NumDesdeNC').value;
			NumHastaNC=document.getElementById('NumHastaNC').value;
			fechaNC=document.getElementById('fechaNC').value;
			NumAutoNV=document.getElementById('NumAutoNV').value;
			SerieNV=document.getElementById('SerieNV').value;
			NoDesdeNV=document.getElementById('NoDesdeNV').value;
			NoHastaNV=document.getElementById('NoHastaNV').value;
			FechaNV=document.getElementById('FechaNV').value;
			NumAutoFac=document.getElementById('NumAutoFac').value;
			SerieFac=document.getElementById('SerieFac').value;
			NumDesdeFac=document.getElementById('NumDesdeFac').value;
			NumHastaFac=document.getElementById('NumHastaFac').value;
			NumActFac=document.getElementById('NumActFac').value;
			FechaFac=document.getElementById('FechaFac').value;

			if(NoDesdeRet>NoHastaRet)
			{
				document.getElementById('NoDesdeRet').style.borderColor="#FF0000";
				document.getElementById('NoHastaRet').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(NoDesdeND>NoHastaND)
			{
				document.getElementById('NoDesdeND').style.borderColor="#FF0000";
				document.getElementById('NoHastaND').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(NumDesdeNC>NumHastaNC)
			{
				document.getElementById('NumDesdeNC').style.borderColor="#FF0000";
				document.getElementById('NumHastaNC').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(NoDesdeNV>NoHastaNV)
			{
				document.getElementById('NoDesdeNV').style.borderColor="#FF0000";
				document.getElementById('NoHastaNV').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(NumDesdeFac>NumHastaFac)
			{
				document.getElementById('NumDesdeFac').style.borderColor="#FF0000";
				document.getElementById('NumHastaFac').style.borderColor="#FF0000";
				Validacion=false;
			}
			
			if(Validacion==true)
			{
				Ext.Ajax.request({
							url: 'ajax/guardarsucursal.php',
							method: 'POST',
							params: {'idsucursal':idsucursal,'Descripcion':Descripcion,'direccion':direccion,'telefono':telefono,'fax':fax,'selectError3':selectError3,'NumAutoRet':NumAutoRet,'SerieRet':SerieRet,'NoDesdeRet':NoDesdeRet,'NoHastaRet':NoHastaRet,'FechaRet':FechaRet,'NumAutoND':NumAutoND,'SerieND':SerieND,'NoDesdeND':NoDesdeND,'NoHastaND':NoHastaND,'FechaND':FechaND,'NumAutoNC':NumAutoNC,'SerieNC':SerieNC,'NumDesdeNC':NumDesdeNC,'NumHastaNC':NumHastaNC,'fechaNC':fechaNC,'NumAutoNV':NumAutoNV,'SerieNV':SerieNV,'NoDesdeNV':NoDesdeNV,'NoHastaNV':NoHastaNV,'FechaNV':FechaNV,'NumAutoFac':NumAutoFac,'SerieFac':SerieFac,'NumDesdeFac':NumDesdeFac,'NumHastaFac':NumHastaFac,'NumActFac':NumActFac,'FechaFac':FechaFac},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('La sucursal se modificó correctamente');
								}
								else
								{
									alert('No se pudo guardar la sucursal'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/sucursal.php?nombre_menu=sucursal',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
			else
			{
				alert('Corrija los valores marcados con rojo para poder proceder'); 
			}
	}
	else
	{
		alert('Debe ingresar el nombre de la sucursal'); 
		document.getElementById('SucursalNombre').style.borderColor="#FF0000";
	}
}

function GuardarPais()
{
	if(document.getElementById('nombre').value!="")
	{	
				id=document.getElementById('id').value;
				nombre=document.getElementById('nombre').value;
				estado=document.getElementById('estado').value;
				Ext.Ajax.request({
							url: 'ajax/guardarpais.php',
							method: 'POST',
							params: {'id':id,'nombre':nombre,'estado':estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('Los registros se almacenaron correctamente');
								}
								else
								{
									alert('Error al guardar registro'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/pais.php?nombre_menu=pais',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
	}
	else
	{
		alert('Debe ingresar el país para poder continuar'); 
		document.getElementById('nombre').style.borderColor="#FF0000";
	}
}

function GuardarCargo()
{
	Validacion=true;

	if(document.getElementById('NombreCargo').value!="")
	{	
			id=document.getElementById('id').value;
			NombreCargo=document.getElementById('NombreCargo').value;
			Estado=document.getElementById('estado').value;
			
			if(NombreCargo=="")
			{
				document.getElementById('NombreCargo').style.borderColor="#FF0000";
				Validacion=false;
			}
						
			if(Validacion==true)
			{
				Ext.Ajax.request({
							url: 'ajax/guardarcargo.php',
							method: 'POST',
							params: {'id':id,'NombreCargo':NombreCargo,'Estado':Estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('El cargo se modificó correctamente');
								}
								else
								{
									alert('No se pudo guardar el cargo'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/cargos.php?nombre_menu=cargos',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
			else
			{
				alert('Corrija los valores marcados con rojo para poder proceder'); 
			}
	}
	else
	{
		alert('Debe ingresar el cargo'); 
		document.getElementById('NombreCargo').style.borderColor="#FF0000";
	}
}

function Guardarmarca()
{
	if(document.getElementById('NombreTmarca').value!="")
	{	
			id=document.getElementById('id').value;
			NombreTmarca=document.getElementById('NombreTmarca').value;
			estado=document.getElementById('estado').value;
				
			Ext.Ajax.request({
							url: 'ajax/guardarmarca.php',
							method: 'POST',
							params: {'id':id,'NombreTmarca':NombreTmarca,'estado':estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('El la marca se modificó correctamente');
								}
								else
								{
									alert('No se pudo guardar la marca'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/marca.php?nombre_menu=tipo-negocio',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			
	}
	else
	{
		alert('Debe ingresar el nombre del tipo de la marca para continuar el proceso'); 
		document.getElementById('NombreTmarca').style.borderColor="#FF0000";
	}
}

function Guardarproducto()
{
	if(document.getElementById('ProductoNombre').value!="")
	{	
			if(document.getElementById('CantR').value=="")
			{
				CantR = 0;
			}
			else
			{
				CantR=document.getElementById('CantR').value;
			}
			tipop=document.getElementById('tipo_producto').value;
			marca=document.getElementById('MarcaID').value;
			modelo=document.getElementById('ModeloNombre').value;
			Tec=document.getElementById('TecnologiaID').value;
			Descri=document.getElementById('ProductoNombre').value;
			Series=0;
			Tseries=0;
			Caracteristicas=document.getElementById('Caracteristica').value;
			Precio=document.getElementById('PrecioID').value;
			Serv=document.getElementById('Servicio').value;
			id=document.getElementById('ProductoID').value;
			estado=document.getElementById('estado').value;
				
			Ext.Ajax.request({
							url: 'ajax/guardarproducto.php',
							method: 'POST',
							params: {'tipop':tipop,'marca':marca,'modelo':modelo,'Tec':Tec,'Descri':Descri,'Series':Series,'Tseries':Tseries,'Caracteristicas':Caracteristicas,'CantR':CantR,'Precio':Precio,'Serv':Serv,'id':id,'estado':estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('El producto se modificó correctamente');
								}
								else
								{
									alert('No se pudo guardar el producto'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/productos.php?nombre_menu=productos',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			
	}
	else
	{
		alert('Debe ingresar el nombre del producto para continuar el proceso'); 
		document.getElementById('ProductoNombre').style.borderColor="#FF0000";
	}
}

function GuardarBodega()
{
	Validacion=true;
	if(document.getElementById('BodegaNombre').value!="")
	{	
			if(document.getElementById('VendedorNombre').value=="")
			{
				document.getElementById('VendedorNombre').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(document.getElementById('Ubicacion').value=="")
			{
				document.getElementById('Ubicacion').style.borderColor="#FF0000";
				Validacion=false;
			}
			
			if(Validacion==true)
			{//var_dump(Validacion);
				id=document.getElementById('BodegaID').value;
				nombre=document.getElementById('BodegaNombre').value;
				estado=document.getElementById('estado').value;
				responsable=document.getElementById('VendedorID').value;
				ubicacion=document.getElementById('Ubicacion').value;
					
				Ext.Ajax.request({
								url: 'ajax/guardarbodega.php',
								method: 'POST',
								params: {'id':id,'nombre':nombre,'estado':estado,'responsable':responsable,'ubicacion':ubicacion},
								success: function(resp) 
								{
									var respuesta = Ext.decode(resp.responseText);
									if(respuesta.success == true)
									{
										alert('La bodega se modificó correctamente');
									}
									else
									{
										alert('No se pudo guardar la bodega'); 
									}	
								},
								failure: function(responseObject) {
									 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
								 }});
						Ext.get('id_transacciones').load({
						url: 'acciones/bodegas.php?nombre_menu=bodegas',
						nocache: true,
						scripts:true,
						text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
						});
			}		
	}
	else
	{
		alert('Debe ingresar la bodega para continuar el proceso'); 
		document.getElementById('BodegaNombre').style.borderColor="#FF0000";
	}
}

function GuardarDivision()
{
	Validacion=true;

	if(document.getElementById('NombreDivision').value!="")
	{	
			id=document.getElementById('id').value;
			NombreDivision=document.getElementById('NombreDivision').value;
			Estado=document.getElementById('estado').value;
						
			if(Validacion==true)
			{
				Ext.Ajax.request({
							url: 'ajax/guardardivision.php',
							method: 'POST',
							params: {'id':id,'NombreDivision':NombreDivision,'Estado':Estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('La división se modificó correctamente');
								}
								else
								{
									alert('No se pudo guardar la división'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/division.php?nombre_menu=cargos',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
			else
			{
				alert('Corrija los valores marcados con rojo para poder proceder'); 
			}
	}
	else
	{
		alert('Debe ingresar la división'); 
		document.getElementById('NombreDivision').style.borderColor="#FF0000";
	}
}

function Guardarcuentas()
{
	Validacion=true;

	if(document.getElementById('Nombrecuentas').value!="")
	{	
			if(document.getElementById('CuentaID').value=="")
			{
				CuentaID=0;
			}
			else
			{
				CuentaID=document.getElementById('CuentaID').value;
			}
			
			if(document.getElementById('id').value=="")
			{
				id=0;
			}
			else
			{
				id=document.getElementById('id').value;
			}
			
			if(document.getElementById('NumCuenta').value=="")
			{
				NumCuenta=0;
			}
			else
			{
				NumCuenta=document.getElementById('NumCuenta').value;
			}
			
			Nombrecuentas=document.getElementById('Nombrecuentas').value;
			Estado=document.getElementById('estado').value;
						
			if(Validacion==true)
			{
				Ext.Ajax.request({
							url: 'ajax/guardarcuentas.php',
							method: 'POST',
							params: {'id':id,'Nombrecuentas':Nombrecuentas,'CuentaID':CuentaID,'NumCuenta':NumCuenta,'Estado':Estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('La cuenta se registro correctamente');
								}
								else
								{
									alert('No se pudo guardar la cuenta'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/cuentas.php?nombre_menu=cargos',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
			else
			{
				alert('Corrija los valores marcados con rojo para poder proceder'); 
			}
	}
	else
	{
		alert('Debe ingresar la cuenta'); 
		document.getElementById('Nombrecuentas').style.borderColor="#FF0000";
	}
}

function Guardartipoproductos()
{
	if(document.getElementById('TipProdNombre').value!="")
	{
		Validacion=true;
	
		if(document.getElementById('dscto').value=="")
		{
			descuento=0;
		}
		else
		{
			descuento=document.getElementById('dscto').value;
		}
		
		if(Validacion==true)
			{
				id=document.getElementById('TipProdID').value;
				Nombre=document.getElementById('TipProdNombre').value;
				Refencia=document.getElementById('Refencia').value;
				Refencia1=document.getElementById('Refencia1').value;
				Refencia2=document.getElementById('Refencia2').value;
				Refencia3=document.getElementById('Refencia3').value;
				Refencia4=document.getElementById('Refencia4').value;
				Refencia5=document.getElementById('Refencia5').value;
				iva=document.getElementById('iva').value;
				icecomp=document.getElementById('icecomp').value;
				iceven=document.getElementById('iceven').value;
				estado=document.getElementById('estado').value;
				
				Ext.Ajax.request({
							url: 'ajax/guardartipoproducto.php',
							method: 'POST',
							params: {'id':id,'Nombre':Nombre,'Refencia':Refencia,'Refencia1':Refencia1,'Refencia2':Refencia2,'Refencia3':Refencia3,'Refencia4':Refencia4,'Refencia5':Refencia5,'iva':iva,'icecomp':icecomp,'iceven':iceven,'descuento':descuento,'estado':estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('Transacción realizada correctamente');
								}
								else
								{
									alert('No se pudo realizar transacción'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/tipo-producto.php?nombre_menu=cargos',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
			else
			{
				alert('Debe ingresar datos en los campos marcados con rojo');
			}
	}
	else
	{
		alert('Debe ingresar la descripción del tipo de producto para continuar'); 
		document.getElementById('TipProdNombre').style.borderColor="#FF0000";
	}
		
} 

function GuardarAcceso()
{
	Validacion=true;

	if(document.getElementById('Ip').value!="")
	{	
			Ip=document.getElementById('Ip').value;
			id=document.getElementById('id').value;
			NombreAcceso=document.getElementById('NombreAcceso').value;
			SucursalID=document.getElementById('SucursalID').value;
			SucursalNombre=document.getElementById('SucursalNombre').value;
			estado=document.getElementById('estado').value;
			
			if(Ip=="")
			{
				document.getElementById('Ip').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(id=="")
			{
				document.getElementById('id').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(NombreAcceso=="")
			{
				document.getElementById('NombreAcceso').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(SucursalID=="")
			{
				document.getElementById('SucursalID').style.borderColor="#FF0000";
				Validacion=false;
			}
			if(SucursalNombre=="")
			{
				document.getElementById('SucursalNombre').style.borderColor="#FF0000";
				Validacion=false;
			}
			
			if(Validacion==true)
			{
				Ext.Ajax.request({
							url: 'ajax/guardaracceso.php',
							method: 'POST',
							params: {'Ip':Ip,'id':id,'NombreAcceso':NombreAcceso,'SucursalID':SucursalID,'SucursalNombre':SucursalNombre,'estado':estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('El acceso se modificó correctamente');
								}
								else
								{
									alert('No se pudo guardar el acceso'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/accesos.php?nombre_menu=accesos',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
			else
			{
				alert('Corrija los valores marcados con rojo para poder proceder'); 
			}
	}
	else
	{
		alert('Debe ingresar la ip para continuar el proceso'); 
		document.getElementById('Ip').style.borderColor="#FF0000";
	}
}

function GuardarNegocio()
{
	if(document.getElementById('NombreTNegocio').value!="")
	{	
			id=document.getElementById('id').value;
			NombreTNegocio=document.getElementById('NombreTNegocio').value;
			estado=document.getElementById('estado').value;
				
			Ext.Ajax.request({
							url: 'ajax/guardarnegocio.php',
							method: 'POST',
							params: {'id':id,'NombreTNegocio':NombreTNegocio,'estado':estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('El tipo de negocio se modificó correctamente');
								}
								else
								{
									alert('No se pudo guardar tipo de negocio'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/tipo-negocio.php?nombre_menu=tipo-negocio',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			
	}
	else
	{
		alert('Debe ingresar el nombre del tipo del negocio para continuar el proceso'); 
		document.getElementById('NombreTNegocio').style.borderColor="#FF0000";
	}
}

function GuardarEmpleados()
{

	if(document.getElementById('Cedula').value.length>9 && document.getElementById('Cedula').value.length<11)
	{
		Validacion=true;
	
		if(document.getElementById('Cedula').value=="")
		{
			Validacion=false;
			document.getElementById('Cedula').style.borderColor="#FF0000";	
		}
		if(document.getElementById('Titulo').value=="")
		{
			Validacion=false;
			document.getElementById('Titulo').style.borderColor="#FF0000";
		}
		if(document.getElementById('SucursalNombre').value=="")
		{
			Validacion=false;
			document.getElementById('SucursalNombre').style.borderColor="#FF0000";
		}
		if(document.getElementById('CargoNombre').value=="")
		{
			Validacion=false;
			document.getElementById('CargoNombre').style.borderColor="#FF0000";
		}
		if(document.getElementById('DepartamentoNombre').value=="")
		{
			Validacion=false;
			document.getElementById('DepartamentoNombre').style.borderColor="#FF0000";
		}
		if(document.getElementById('CContNombre').value=="")
		{
			Validacion=false;
			document.getElementById('CContNombre').style.borderColor="#FF0000";
		}
		if(document.getElementById('Sueldo').value=="")
		{
			Validacion=false;
			document.getElementById('Sueldo').style.borderColor="#FF0000";
		}
		if(document.getElementById('Nombres').value=="")
		{
			Validacion=false;
			document.getElementById('Nombres').style.borderColor="#FF0000";
		}
		if(document.getElementById('Apellidos').value=="")
		{
			Validacion=false;
			document.getElementById('Apellidos').style.borderColor="#FF0000";
		}
		
		if(Validacion==true)
			{
				Id=document.getElementById('Id').value;
				Cedula=document.getElementById('Cedula').value;
				Apellidos=document.getElementById('Apellidos').value;
				Nombres=document.getElementById('Nombres').value;
				Titulo=document.getElementById('Titulo').value;
				CargoID=document.getElementById('CargoID').value;
				DepartamentolID=document.getElementById('DepartamentolID').value;
				CContID=document.getElementById('CContID').value;
				Tipo=document.getElementById('Tipo').value;
				estado=document.getElementById('estado').value;
				lugar=document.getElementById('lugar').value;
				Sueldo=document.getElementById('Sueldo').value;
				FechaIng=document.getElementById('FechaIng').value;
				Pago=document.getElementById('Pago').value;
				SucursalID=document.getElementById('SucursalID').value;
				Ext.Ajax.request({
							url: 'ajax/guardarempleado.php',
							method: 'POST',
							params: {'Id':Id,'Cedula':Cedula,'Apellidos':Apellidos,'Nombres':Nombres,'Titulo':Titulo,'CargoID':CargoID,'DepartamentolID':DepartamentolID,'CContID':CContID,'Tipo':Tipo,'estado':estado,'lugar':lugar,'Sueldo':Sueldo,'FechaIng':FechaIng,'Pago':Pago,'SucursalID':SucursalID},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('El empleado se ingreso correctamente');
								}
								else
								{
									alert('No se pudo guardar al empleado'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/empleados.php?nombre_menu=sucursal',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
	}
	else
	{
		alert('La cédula debe tener 10 dígitos'); 
		document.getElementById('Cedula').style.borderColor="#FF0000";
	}
		
} 


function GuardarProvincia()
{
	if(document.getElementById('NombreProvincia').value!="")
	{
		Validacion=true;
	
		if(document.getElementById('PaisNombre').value=="")
		{
			Validacion=false;
			document.getElementById('PaisNombre').style.borderColor="#FF0000";
		}
		
		if(Validacion==true)
			{
				id=document.getElementById('id').value;
				nombre=document.getElementById('NombreProvincia').value;
				PaisID=document.getElementById('PaisID').value;
				estado=document.getElementById('estado').value;
				
				Ext.Ajax.request({
							url: 'ajax/guardarprovincia.php',
							method: 'POST',
							params: {'id':id,'nombre':nombre,'PaisID':PaisID,'estado':estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('La provincia se ingreso correctamente');
								}
								else
								{
									alert('No se pudo guardar la provincia'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/provincia.php?nombre_menu=sucursal',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
			else
			{
				alert('Debe ingresar datos en los campos marcados con rojo');
			}
	}
	else
	{
		alert('Debe ingresar el nombre de la provincia para continuar'); 
		document.getElementById('NombreProvincia').style.borderColor="#FF0000";
	}
}

function GuardarDepartamentos()
{

	if(document.getElementById('NombreDepartamento').value!="")
	{
		Validacion=true;
	
		if(document.getElementById('DivisiónNombre').value=="")
		{
			Validacion=false;
			document.getElementById('DivisiónNombre').style.borderColor="#FF0000";
		}
		if(document.getElementById('CContNombre').value=="")
		{
			Validacion=false;
			document.getElementById('CContNombre').style.borderColor="#FF0000";
		}
		if(document.getElementById('VendedorNombre').value=="")
		{
			Validacion=false;
			document.getElementById('VendedorNombre').style.borderColor="#FF0000";
		}
		
		if(Validacion==true)
			{
				id=document.getElementById('id').value;
				NombreDepartamento=document.getElementById('NombreDepartamento').value;
				DivisiónNombre=document.getElementById('DivisiónNombre').value;
				DivisiónlID=document.getElementById('DivisiónlID').value;
				CContNombre=document.getElementById('CContNombre').value;
				CContID=document.getElementById('CContID').value;
				VendedorNombre=document.getElementById('VendedorNombre').value;
				VendedorID=document.getElementById('VendedorID').value;
				estado=document.getElementById('estado').value;
				
				Ext.Ajax.request({
							url: 'ajax/guardardepartamento.php',
							method: 'POST',
							params: {'id':id,'NombreDepartamento':NombreDepartamento,'DivisiónNombre':DivisiónNombre,'DivisiónlID':DivisiónlID,'CContNombre':CContNombre,'CContID':CContID,'VendedorNombre':VendedorNombre,'VendedorID':VendedorID,'estado':estado},
							success: function(resp) 
							{
								var respuesta = Ext.decode(resp.responseText);
								if(respuesta.success == true)
								{
									alert('El departamento se ingreso correctamente');
								}
								else
								{
									alert('No se pudo guardar el departamento'); 
								}	
							},
							failure: function(responseObject) {
								 Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
							 }});
					Ext.get('id_transacciones').load({
					url: 'acciones/departamentos.php?nombre_menu=sucursal',
					nocache: true,
					scripts:true,
					text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
					});
			}
			else
			{
				alert('Debe ingresar datos en los campos marcados con rojo');
			}
	}
	else
	{
		alert('Debe ingresar el nombre del departamento para continuar'); 
		document.getElementById('NombreDepartamento').style.borderColor="#FF0000";
	}
		
} 

function MostrarImprimir(sucursalId)
{
	//console.log("VA A IMPRIMIR");
	TINY.box.show('./ventanas/imprimir_facturacion.php?idfactura='+sucursalId,1,400,250,1);
}

function Reimprimirfactura(Id)
{
	TINY.box.show('./ventanas/reimpresion_factura.php?idfactura='+Id,1,400,250,1);
}

function MostrarImprimirStock(idFactura)
{
	TINY.box.show('./ventanas/ConsultaStock.php?idfactura='+idFactura,1,900,900,1);
}

function CancelarImprimir()
{
	verProceso('facturacion_diaria','menu_1',true,'facturacion_diaria');
	TINY.box.hide();
}

function CancelarImprimirKardex()
{
	verProceso('transferencia-bodega','menu_1',true,'transferencia-bodega');
	TINY.box.hide();
}

function ValidarUsuarioSolicitar()
{
	if(document.getElementById("login-username-recordar").value=="")
	{
		alert("Debe ingresar el usuario para solicitar la clave");
	}
	else
	{
		usuario=document.getElementById('login-username-recordar').value;
		Ext.Ajax.request({
                url: 'ajax/enviarpass.php',
                method: 'POST',
				params: {'usuario': usuario},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						document.getElementById('login-username-recordar').value='';
						alert('Se envio la clave a su correo'); 
					}
					else
					{
						alert('No se encuentra el usuario');  
					}	
				},
				failure: function(responseObject) {
                     Ext.Msg.alert('Error','No se ha podido conectar al servidor'); 
                 }});
	}
	
}

//---------------------------------------------------------------------------------------------------------------------------------


function highlightRow(rowId, bgColor, after)
{
	var rowSelector = $("#" + rowId);
	rowSelector.css("background-color", bgColor);
	rowSelector.fadeTo("normal", 0.5, function() { 
		rowSelector.fadeTo("fast", 1, function() { 
			rowSelector.css("background-color", '');
		});
	});
}

function highlight(div_id, style) {
	highlightRow(div_id, style == "error" ? "#e5afaf" : style == "warning" ? "#ffcc00" : "#8dc70a");
}
        
/**
   updateCellValue calls the PHP script that will update the database. 
 */
function updateCellValue(editableGrid, rowIndex, columnIndex, oldValue, newValue, row, onResponse)
{      
	$.ajax({
		url: 'update.php',
		type: 'POST',
		dataType: "html",
		data: {
			tablename : editableGrid.name,
			id: editableGrid.getRowId(rowIndex), 
			newvalue: editableGrid.getColumnType(columnIndex) == "boolean" ? (newValue ? 1 : 0) : newValue, 
			colname: editableGrid.getColumnName(columnIndex),
			coltype: editableGrid.getColumnType(columnIndex)			
		},
		success: function (response) 
		{ 
			// reset old value if failed then highlight row
			var success = onResponse ? onResponse(response) : (response == "ok" || !isNaN(parseInt(response))); // by default, a sucessfull reponse can be "ok" or a database id 
			if (!success) editableGrid.setValueAt(rowIndex, columnIndex, oldValue);
		    highlight(row.id, success ? "ok" : "error"); 
		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});
   
}
   


function DatabaseGrid() 
{ 
	this.editableGrid = new EditableGrid("demo", {
		enableSort: true,
   	    tableLoaded: function() { datagrid.initializeGrid(this); },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	    	updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
       	}
 	});
	this.fetchGrid(); 
	
}

DatabaseGrid.prototype.fetchGrid = function()  {
	// call a PHP script to get the data
	this.editableGrid.loadXML("loaddata.php");
};

DatabaseGrid.prototype.initializeGrid = function(grid) {
	grid.renderGrid("tablecontent", "testgrid");
};    

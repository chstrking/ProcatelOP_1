var menu_inicial='menu_1';

function Olvidar()
{
	TINY.box.show('./ventanas/RecordatorioContraseña.php',1,400,400,1); 
}

function EnterLogin(e) 
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  {
	ValidarLogin();
  }
  else
  {
	return;
  }
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

function GuardarRol()
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

function GuardarModulo()
{
	if(document.getElementById('id_transacciones'))
	{
		id=document.getElementById('id').value;
		nombremodulo=document.getElementById('name').value;
		estado=document.getElementById('estado').value;
		Ext.get('id_transacciones').load({
		url: 'acciones/editarmodulo.php?id='+id+'&nombremodulo='+nombremodulo+'&estado='+estado+'&guardar=1',
		nocache: true,
		scripts:true,
		text: "<table><tr><td valign='middle' height='400px' width='650px' align='center'><img src='imagenes/loading.gif'><td></tr><table>"
		});
	}
}

function GuardarUsuario()
{
	if(document.getElementById('id_transacciones'))
	{
		id=document.getElementById('id').value;
		clave=document.getElementById('clave').value;
		id_empleado=document.getElementById('id_empleado').value;
		fecha_ingreso=document.getElementById('fecha_ingreso').value;
		fecha_vencimiento=document.getElementById('fecha_vencimiento').value;
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
			cupoc=document.getElementById('cupoc').value;
			cupou=document.getElementById('cupou').value;
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

function Buscar(id)
{
	TINY.box.show('./ventanas/buscar.php?tipo='+id,1,600,700,1);
}

function AsignarAcciones(id)
{
	TINY.box.show('./ventanas/listar_opciones.php?rol_id='+id,1,600,1100,1);
}

function GuardarOpcionesRol()
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
	document.getElementById('bt_cliente').disabled = false;
	document.getElementById('bt_vendedor').disabled = false;
	TINY.box.hide();
}

function IngresarSucursalGeneral(idsucursal,nombresucursal,direccion,telefono,fax,selectError3,NumAutoRet,SerieRet,noDesdeRet,NoHastaRet,FechaRet,NumAutoND,SerieND,NoDesdeND,NoHastaND,FechaND,NumAutoNC,SerieNC,NumDesdeNC,NumHastaNC,fechaNC,NumAutoNV,SerieNV,NoDesdeNV,NoHastaNV,FechaNV,NumAutoFac,SerieFac,NumDesdeFac,NumHastaFac,NumActFac,FechaFac)
{
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
	document.getElementById('FechaRet').value=FechaRet->format('d-m-Y');
	document.getElementById('NumAutoND').value=NumAutoND;
	document.getElementById('SerieND').value=SerieND;
	document.getElementById('NoDesdeND').value=NoDesdeND;
	document.getElementById('NoHastaND').value=NoHastaND;
	document.getElementById('FechaND').value=FechaND->format('d-m-Y');
	document.getElementById('NumAutoNC').value=NumAutoNC;
	document.getElementById('SerieNC').value=SerieNC;
	document.getElementById('NumDesdeNC').value=NumDesdeNC;
	document.getElementById('NumHastaNC').value=NumHastaNC;
	document.getElementById('fechaNC').value=fechaNC->format('d-m-Y');
	document.getElementById('NumAutoNV').value=NumAutoNV;
	document.getElementById('SerieNV').value=SerieNV;
	document.getElementById('NoDesdeNV').value=NoDesdeNV;
	document.getElementById('NoHastaNV').value=NoHastaNV;
	document.getElementById('FechaNV').value=FechaNV->format('d-m-Y');
	document.getElementById('NumAutoFac').value=NumAutoFac;
	document.getElementById('SerieFac').value=SerieFac;
	document.getElementById('NumDesdeFac').value=NumDesdeFac;
	document.getElementById('NumHastaFac').value=NumHastaFac;
	document.getElementById('NumActFac').value=NumActFac;
	document.getElementById('FechaFac').value=FechaFac->format('d-m-Y');
	TINY.box.hide();
}

function IngresarVendedor(idvendedor,nombrevendedor)
{
	document.getElementById('VendedorNombre').value=idvendedor+' - '+nombrevendedor;
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
	document.getElementById('CContNombre').value=idCuentas+' - '+CuentasCliente;
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

function IngresarBodega(idbodega,bodegacliente)
{
	document.getElementById('BodegaNombre').value=idbodega+' - '+bodegacliente;
	document.getElementById('BodegaID').value=idbodega;
	TINY.box.hide();
}

function BuscarProducto()
{
	id=document.getElementById('tipo_producto').value;
	TINY.box.show('./ventanas/buscarproducto.php?tipoproducto='+id,1,700,200,1);
}

function EditarDetalle(idproducto,tipoproducto)
{
	TINY.box.show('./ventanas/ingreso_detalle_producto.php?idproducto='+idproducto+'&tipoproducto='+tipoproducto,1,700,600,1);
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
		url: 'acciones/resultado_busqueda_sucursal.php',
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

function Agregar_Detalle(id_producto)
{
	flag=validar_detalle();
	if(flag)
	{
		detalleid=document.getElementById('detalleid').value;
		cantidad=document.getElementById('cantidad').value;
		descuento=document.getElementById('descuento').value;
		numeroserie=document.getElementById('numeroserie').value;
		numerolinea=document.getElementById('numerolinea').value;
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

function ActualizarValores(id,value)
{
	document.getElementById(id).value=value;
}

function RecalcularTotal(valor)
{
	transporte=0;
	otros=0;
	if(document.getElementById('Transporte').value!="")
	{
		transporte=parseFloat(document.getElementById('Transporte').value);
	}
	/*if(document.getElementById('Otros').value!="")
	{
		otros=parseFloat(document.getElementById('Otros').value);
	}*/
	total=parseFloat(valor)+transporte;
	document.getElementById('Total').value=total;
}

function Editar_Detalle(id_producto,detalleid)
{
	flag=validar_detalle();
	if(flag)
	{
		cantidad=document.getElementById('cantidad').value;
		descuento=document.getElementById('descuento').value;
		numeroserie=document.getElementById('numeroserie').value;
		numerolinea=document.getElementById('numerolinea').value;
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

function EliminarDetalle(id_producto,detalleid)
{
	Ext.get(detalleid).load({
		url: 'acciones/eliminar_detalle_producto.php',
		params:{detalleid:detalleid,idproducto:id_producto},
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
	Ext.Ajax.request({
                url: 'ajax/datosfacturacion.php',
                method: 'POST',
				params: {'tipofacturacion': tipofacturacion},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						ActualizarFacturacion(respuesta.data.NoAuto,respuesta.data.FechaCaducidad,respuesta.data.No_Fact);
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
					//var_dump(respuesta.success);
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

function Facturar()
{
	if(document.getElementById('fecha_facturacion').value!='')
	{
		GuardarCabecera();
	}
	else
	{
		document.getElementById('fecha_facturacion').className="form-control date-picker error_input";
		alert('Debe ingresar la Fecha a la factura'); 
	}
}

function GuardarCabecera()
{
	vendedor=document.getElementById('VendedorID').value;
	cliente=document.getElementById('ClienteID').value;
	tipofacturacion=document.getElementById('TipoFacturacion').value;
	transporte=document.getElementById('Transporte').value;
	fecha_facturacion=document.getElementById('fecha_facturacion').value;
	facturaxMayor=document.getElementById('chkFactxm');
	contado=document.getElementById('contado');
	motivo=document.getElementById('motivo').value;
	if(facturaxMayor.checked)
	{
		facturaxMayor='1';
	}
	else
	{
		facturaxMayor='0';
	}
	if(contado.checked)
	{
		contado_val='1';
	}
	else
	{
		contado_val='0';
	}
	Ext.Ajax.request({
                url: 'ajax/guardarfacturacion.php',
                method: 'POST',
				params: {'tipofacturacion': tipofacturacion,'cliente':cliente,'vendedor':vendedor,'transporte':transporte,'fecha_facturacion':fecha_facturacion,'facturaxMayor':facturaxMayor,'contado_val':contado_val,'motivo':motivo},
				success: function(resp) 
				{
					var respuesta = Ext.decode(resp.responseText);
					if(respuesta.success == true)
					{
						id=respuesta.data;
						MostrarImprimir(id);
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

function MostrarImprimir(idFactura)
{
	TINY.box.show('./ventanas/imprimir_facturacion.php?idfactura='+idFactura,1,400,250,1);
}

function CancelarImprimir()
{
	verProceso('facturacion','menu_1',true,'Facturacion');
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
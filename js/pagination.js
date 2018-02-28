$(document).ready(function()
{
    var divListado    = $("#listado"),
        divPagination = $("#pagination"),
        listadoJson;
  
  $(".actionlist").on("click",function(event){
    event.preventDefault();
    //console.log("Enviando");
    var status = $(this).attr('id'),
        enviar = "Listar";         
       //console.log("nombre de la tabla es " + ntable);
    $.ajax({
        url: 'ajax/listado.php',
        type: 'POST',
        data:({Idsuc:Idsuc,Nombre:Nombre,Estado:Estado}),
        dataType: 'json',
        success: function(data){
           //console.log(data);
           divListado.html("");
           divPagination.html("");
           listadoJson(data); 
        } // fin else
    });// fin ajax
  });// fin evento
  
 divPagination.on("click", "a", function(event){
    event.preventDefault();
    //console.log("Linkando");
    var id     = $(this).attr('id'), // Este es el numero de la pagina
        status = $(".listabox").attr("data"), // si un producto nuevo o usado
        enviar = "Listar";   
    $.ajax({
        url: 'ajax/listado.php',
        type: 'POST',
        data:({Idsuc:Idsuc,Nombre:Nombre,Estado:Estado, pageID:id}),
        dataType: 'json',
        success: function(data){
           //console.log(data);
           divListado.html("");
           divPagination.html("");
           listadoJson(data); 
        } // fin else
    });// fin ajax
 });

  listadoJson = function(data){
      $.each(data[0], function(key, value) { 
				   
		var datos =  "<table class='tabla_detalle' cellpadding='0' cellspacing='0' width='100%'>"
				    + " <thead>"
				    + " <tr> "
					+ " <th>Sucursal</th>"
					+ " <th>Empleados</th>"
					+ " <th>Estado</th>"
					+ " <th colspan='2'>Acciones</th>"
					+ " </tr>"
					+ " </thead>"
					+ " <tbody>"
					+ " <?php $i=1;?>"
					+ " <?php foreach($empleados as $empleado){?> "
					+ " <tr class='<?php if($i%2==0){?>impar<?php }else{?>par<?php }?>' id='tr_roles_<?php echo $i;?>'>"
					+ " <td><?php $empleado['Sucursal'] ?></td> "
					+ " <td><?php $empleado['Nombre'] ?></td> "
					+ " <td align='center'><?php if($empleado['estado']==1){?>Activo<?php }else{?>Inactivo<?php }?></td>"
					+ " <td><a href='#' class='enlace_accion' onclick='verSubProceso('editarempleado','<?php echo $rol['id']?>')'>Editar</a></td>"
					+ " <td><a href='#' class='enlace_accion' onclick='if(confirm('Esta seguro que desea eliminar el rol?')){EliminarEmpleado('<?php echo $rol['id']?>','tr_roles_<?php echo $i;?>')}'>Eliminar</a></td>"
					+ " </tr>"
					+ " <?php $i++;?>"
					+ " <?php }?>"
					+ " </tbody>"
					+ " </table>";
       divListado.append(datos);  
     });  
     divPagination.append(data[1]);
  }

});
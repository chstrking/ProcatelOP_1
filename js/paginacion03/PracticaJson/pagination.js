
$(document).ready(function(){

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
        url: 'listado.php',
        type: 'POST',
        data:({enviar:enviar, status:status}),
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
        url: 'listado.php',
        type: 'POST',
        data:({enviar:enviar, status:status, pageID:id}),
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
        var datos =  "<div class='listabox' data='"+ value['status'] + "'>"
                   + " <div class='listainfo'>"
                   + " <p>Codigo Producto: "+ value['productCode'] +"</p>"
                   + " <p>Producto: "+ value['productName'] +"</p>"
                   + " <p>Tipo Producto: "+ value['productLine'] +"</p>"
                   + " </div>"
                   + " <div class='listalinks'>"
                   + " <a href='javascript:void(0);' title='Ver detalladamente el producto'>Ver</a>"
                   + " <a href='javascript:void(0);' title='Editar el producto'>Editar</a>"
                   + " <a href='javascript:void(0);' title='Eliminar este producto'>Borrar</a>"
                   + " </div>" 
                   + "</div>"
                   + "<div class='clear'></div>"
                   + "<div id='separador'></div>"; 
        divListado.append(datos);  
     });  
     divPagination.append(data[1]);
  }


});// fin Jquery  

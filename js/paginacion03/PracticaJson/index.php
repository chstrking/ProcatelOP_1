<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8"/>
 <title>::PAGINACIÓN CON AJAX- JSON - PHP&MYSQL::</title>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <script type="text/javascript" src="pagination.js"></script>
<style type="text/css">
   body{background-color: #ccc;}
   .clear{clear: both;}
   #container{background-color: #fff; width: 900px; margin: 20px auto; border: 2px solid #f2f2f2;}
   #container h3{background-color: #000; color:#fff; font-family: "Trebuchet MS"; margin: 0; text-align: center; padding: 5px;}
   #links{width: 500px; margin: 10px auto; text-align: center;}
   #links ul li{display: inline; padding: 5px;}
   #links ul li a{color:orange; font-size: 12pt; font-family: "Trebuchet MS"; font-weight: bold; text-decoration: none; }
   #links ul li a:hover{text-decoration: underline;}
   #listado{width: 800px; margin: 20px auto; background-color: #fff;}
   #listado .listainfo{background-color: #FFE4B5; width: 600px; float: left;}
   #listado .listainfo p{margin: 0; padding: 5px; } 
   #listado .listalinks{width: 200px; float: left; text-align: center; padding-top: 50px;} 
   #listado .listalinks a{text-decoration: none; color:#FF6347; padding: 5px;}
   #listado .listalinks a:hover{text-decoration: underline;}
   #separador{height: 10px;}
   #pagination{background-color:#000; text-align:center;}
   #pagination a {color:#fff; font-size: 13pt;font-weight: bold;}
   #pagination b{color:green;font-size: 13pt; font-weight: bold;} 
</style>
</head>
<body>
 <div id="container">
   <h3>Listados de productos</h3>
   <div id="links">
       <ul>
          <li><a href="javascript:void(0);" title="Ver listado de productos nuevos" class="actionlist" id="1">Nuevos</a></li>
          <li><a href="javascript:void(0);" title="Ver listado de productos usados" class="actionlist" id="2">Usados</a></li>
       </ul> 
   </div>
   <div class="clear"></div>
   <div id="listado"></div><!--Mostrando el listado-->
   <div class="clear"></div>
   <div id="pagination"></div>
 </div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</body>
</html>
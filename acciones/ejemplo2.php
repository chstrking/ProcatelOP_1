//CALCULO EL NUMERO DE REGISTROS 
$total = 0; 
//PROCEDIMIENTO ALMACENADO QUE DETERMINA EL NUMERO DE REGISTROS 
$sql_sel = mssql_init("sp_selecciona_registros");  
$res_sel = mssql_execute($sql_sel) ; 
$row = mssql_fetch_array($res_sel); 
$total += mssql_num_rows($res_sel); 
//NUMERO TOTAL DE REGISTROS 
$numero_de_registros = $total; 

?> 

<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<title>Paginación PHP - SQL Server</title> 
<style type="text/css"> 
<!-- 
.titulo{ 
    font-family: Verdana, Arial, Helvetica, sans-serif; 
    font-weight: bold; 
} 
.texto 
    {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; } 

--> 
</style> 
</head> 

<body> 
<p class="titulo">Paginaci&oacute;n de Resultados PHP - SQL Server 2000 </p> 
<span class="Estilo2">Número total de registros: <?php echo $numero_de_registros ?></span><br> 
<span class="Estilo2">Número de registros por página: <?php echo LIMITE ?></span><br><br> 

<table width="50%" border="0" cellspacing="2" cellpadding="2"> 
  <tr> 
    <td bgcolor="#CCCCCC">ID RADIO</td> 
    <td bgcolor="#CCCCCC">NOMBRE RADIO</td> 
  </tr> 
  <?php 
     
    $pagina = $_GET['pagina']; 
    $limite = LIMITE; 
    if( isset( $pagina ) ) { 
    } 
    else { 
        $pagina = 1; 
    } 
     
    //LLAMAR AL SP QUE EXTRAE LOS DATOS PAGINADOS 
    $sql_sel2 = mssql_init("paginacion_ejemplo"); 
    //ENVIAR PARAMETROS AL SP 
    mssql_bind($sql_sel2, "@index", $pagina, SQLINT2); 
    mssql_bind($sql_sel2, "@num_regs", $limite, SQLINT2); 
    $res_sel2 = mssql_execute($sql_sel2); 
    $num_rows_sel2 = mssql_num_rows($res_sel2); 
     
    $num_paginas_float = $numero_de_registros / $limite; //número total de páginas a mostrar (float) 
    $valor_redondeado = ceil($num_paginas_float); //número total de páginas a mostrar (entero) 
    $inferior = $pagina - ( ceil( TAM_VENTANA / 2 ) ); 
    $inicio_ventana = 1; 
    if( $valor_redondeado > TAM_VENTANA ) { 
        $inicio_ventana = ( $inferior < 1 ) ? 1 : $inferior + 1; 
    } 
    $fin_ventana = $inicio_ventana + ( TAM_VENTANA - 1 ); 
    if( ( $fin_ventana > $valor_redondeado ) && ( $valor_redondeado > TAM_VENTANA ) ) { 
        $inicio_ventana = $valor_redondeado - ( TAM_VENTANA - 1 ); 
    } 
    $contador = $inicio_ventana; 
     
    if( $num_rows_sel2 > 0 ) {     
     
        while( $row_sel2 = mssql_fetch_array($res_sel2) ) { 
  ?> 
          <tr> 
            <td bgcolor="#FFFFF0"><?php echo $row_sel2['id_radio'] ?></td> 
            <td bgcolor="#FFFFF0"><?php echo $row_sel2['nombre_radio'] ?></td> 
          </tr> 
  <?php 
        } 
    } 
    ?> 
</table> 
<br> 
<table width="50%"  border="0" cellspacing="0" cellpadding="0"> 
  <tr> 
    <td width="10%" align="left"> 
        <?php 
        if( $pagina > 1 ) { 
            $numero_pagina = $pagina - 1; 
        ?> 
                <a href="paginacion_prueba.php?pagina=<?php echo $numero_pagina ?>">&laquo;&nbsp;Anterior</a> 
            <?php 
        } 
        else{                 
        ?> 
            &nbsp; 
        <?php 
        } 
        ?> 
    </td> 
    <td width="30%" align="center"> 
    <?php 
    if( ( $numero_de_registros > 0 ) && ( $valor_redondeado > 1 ) ) { 
        $nuevo_inicio = ($inicio_ventana * $limite) - $limite; 
        while ( ( $contador <= $valor_redondeado ) && ( $contador <= $fin_ventana) ) { 
            $string_contador = ""; 
            if( $contador > $inicio_ventana ) { 
                $nuevo_inicio += $limite; 
            } 
            if( $pagina == $contador ) { 
                $string_contador = "<b>$contador</b>"; 
            } 
            else { 
                $string_contador = "$contador"; 
            } 
            if( ( $pagina < $contador ) || ( $pagina > $contador ) ) { 
            ?> 
                &nbsp;<a href="paginacion_prueba.php?pagina=<?php echo $contador ?>"><?php echo $string_contador ?></a>&nbsp;<?php 
            } 
            else { 
                echo "&nbsp;" . $string_contador . "&nbsp;"; 
            } 
            $contador++; 
        } 
    } 
    ?> 
    </td> 
    <td width="10%" align="right"> 
    <?php  
        if( $pagina < $valor_redondeado ) { 
            $numero_pagina = $pagina + 1; 
        ?> 
            <a href="paginacion_prueba.php?pagina=<?php echo $numero_pagina ?>">Siguiente&nbsp;&raquo;</a><?php 
        } 
        else{                 
        ?> 
            &nbsp; 
        <?php 
        } 
    ?> 
    </td> 
  </tr> 
</table> 

</body> 
</html>
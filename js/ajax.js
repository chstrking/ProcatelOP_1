/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function objetoAjax(){
 var xmlhttp=false;
 try {
  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 } catch (e) {
  try {
   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (E) {
   xmlhttp = false;
  }
 }
 if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
  xmlhttp = new XMLHttpRequest();
 }
 return xmlhttp;
}
function mostrar(){
    var posicion=document.getElementById('meses').options.selectedIndex;
    var mes=document.getElementById('meses').options[posicion].value;
    var url="grafico.php?mes="+mes;
    var ventana="dialogTop=100px;dialogLeft=200px; dialogWidth=700px;dialogHeight=700px; center=yes;help=no";
    objwindow=window.showModalDialog(url,ventana)
}

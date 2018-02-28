
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "serviciomatriculas";
print("Por lo menos entro");
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$sql = "select DISTINCT CodigoMod, Modulos, CodigoOp, Opciones from vi_accesos ";
$res = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_assoc($res) ) { 
		$data[] = $row;
	}
	$itemsByReference = array();

// Build array of item references:
foreach($data as $key => &$item) {
   $itemsByReference[$item['id']] = &$item;
   // Children array:
   $itemsByReference[$item['id']]['children'] = array();
   // Empty data class (so that json_encode adds "data: {}" ) 
   $itemsByReference[$item['id']]['data'] = new StdClass();
}

// Set items as children of the relevant parent item.
foreach($data as $key => &$item)
   if($item['CodigoMod'] && isset($itemsByReference[$item['CodigoMod']]))
      $itemsByReference [$item['CodigoMod']]['CodigoOp'][] = &$item;

// Remove items that were added to parents elsewhere:
foreach($data as $key => &$item) {
   if($item['CodigoMod'] && isset($itemsByReference[$item['CodigoMod']]))
      unset($data[$key]);
}
// Encode:
echo json_encode($data);
?>

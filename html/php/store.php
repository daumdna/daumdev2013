<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");

$j=0;
$result = mysql_query("select * from store");
while($row = mysql_fetch_array($result)){
	$ID[$j]=$row['ID'];
	$storeName[$j] = $row['name'];
	
	$j++;
}


for($i=0;$i<$j;$i++){
	$json[] = array('ID' => $ID[$i], 'storeName' => $storeName[$i]);
}

echo json_encode($json);
?>

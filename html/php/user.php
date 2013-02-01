<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");

$j=0;
$result = mysql_query("select * from user");
while($row = mysql_fetch_array($result)){
	$ID[$j]=$row['ID'];
	$name[$j] = $row['name'];
    $isStore[$j] = $row['is_store'];	
	///echo "$ID[$j], $name[$j], $isStore[$j]<br>\n";
	$j++;

}


for($i=0;$i<$j;$i++){
	$json[] = array('ID' => $ID[$i], 'name' => $name[$i], 'isStore' => $isStore[$i]);
}

echo json_encode($json);
?>

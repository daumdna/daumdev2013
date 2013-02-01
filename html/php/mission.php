<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");

$si=0;

$result = mysql_query("select * from store");
while($row = mysql_fetch_array($result)){
	$sID[$si]=$row['ID'];
	$sName[$si]=$row['name'];
	$si++;
}

$j=0;


$result = mysql_query("select * from mission");

while($row = mysql_fetch_array($result)){
	$ID[$j]=$row['ID'];
	$missionName[$j] = $row['name'];
	$successPoint[$j] = $row['success_point'];
	$storeID[$j] = $row['store_ID'];

	for($m=0;$m<$si;$m++){
		if($sID[$m]==$storeID[$j]){

			$storeName[$j]=$sName[$m];
		}
	}
	
	$j++;
}


for($i=0;$i<$j;$i++){
	$json[] = array('ID' => $ID[$i], 'missionName' => $missionName[$i], 'successPoint' => $successPoint[$i], 'storeID' => $storeID[$i], 'storeName' => $storeName[$i]);
}

echo json_encode($json);
?>

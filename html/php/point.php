<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");

$uID = intval($_GET['userID']);

$si=0;
$result = mysql_query("select * from store");
while($row = mysql_fetch_array($result)){
	$sID[$si]=$row['ID'];
	$sName[$si]=$row['name'];
	$si++;
}


$mi=0;

$result = mysql_query("select * from mission");
while($row = mysql_fetch_array($result)){
	$mID[$mi]=$row['ID'];
	$mName[$mi]=$row['name'];
	$mi++;
}

$j=0;
$result = mysql_query("select * from point where user_ID=$uID");
while($row = mysql_fetch_array($result)){
	$ID[$j]=$row['ID'];
	$curPoint[$j]=$row['current_point'];
	$storeID[$j]=$row['store_ID'];
	$missionID[$j]=$row['mission_ID'];
	$userID[$j]=$row['user_ID'];
	for($m=0;$m<$si;$m++){
		if($sID[$m]==$storeID[$j]){
			$storeName[$j]=$sName[$m];
		}
	}
	for($m=0;$m<$mi;$m++){
		if($mID[$m]==$missionID[$j]){
			$missionName[$j]=$mName[$m];
		}
	}
	
	$j++;

}


for($i=0;$i<$j;$i++){
	$json[] = array('ID' => $ID[$i], 'point' => $curPoint[$i], 'storeName' => $storeName[$i], 'missionName' => $missionName[$i], 'storeID' => $storeID[$i]);
}

echo json_encode($json);
?>

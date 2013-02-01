<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");
$uID = intval($_GET['userID']);
$si=0;

$result = mysql_query("select * from user");
while($row = mysql_fetch_array($result)){
	$sID[$si]=$row['ID'];
	$fName[$si]=$row['name'];
	$si++;
}

$j=0;
$result = mysql_query("select * from friend where user_ID = $uID");
while($row = mysql_fetch_array($result)){
	$ID[$j]=$row['ID'];
	$userID[$j] = $row['user_ID'];
	$friendID[$j] = $row['friend_ID'];

	for($m=0;$m<$si;$m++){
		if($sID[$m]==$friendID[$j]){

			$friendName[$j]=$fName[$m];
		}
	}
	
	$j++;
}


for($i=0;$i<$j;$i++){
	$json[] = array('ID' => $ID[$i], 'friendName' => $friendName[$i], 'friendID' => $friendID[$i]);
}

echo json_encode($json);
?>

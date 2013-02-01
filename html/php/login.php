<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");

$ID = $_POST['ID'];
$PW = $_POST['pw'];

$userID=0;

$result = mysql_query("select * from user where name = '$ID' and password = '$PW'");
while($row = mysql_fetch_array($result)){
	$userID=$row['ID'];
	$isStore=$row['is_store'];
	$storeID = $row['store_ID'];
}

if($userID !=0)
{
	$json[] = array('userID' => $userID, 'isStore' => $isStore, 'storeID' => $storeID);
echo json_encode($json);
}
?>

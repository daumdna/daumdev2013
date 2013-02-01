<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");

$uID = intval($_GET['userID']);
if($uID==0){
	$mi=0;
	$result = mysql_query("select * from mission");
	while($row = mysql_fetch_array($result)){
		$mID[$mi]=$row['ID'];
		$mName[$mi]=$row['name'];
		$mi++;
	}

	$ai=0;
	$result = mysql_query("select * from user");
	while($row = mysql_fetch_array($result)){
		$aID[$ai]=$row['ID'];
		$aName[$ai]=$row['name'];
		$ai++;
	}
	
	$j=0;
	$result = mysql_query("select * from manage_mission");
	while($row = mysql_fetch_array($result)){
		$ID[$j]=$row['ID'];
		$clear[$j]=$row['clear'];
		$missionID[$j] = $row['mission_ID'];
		$userID[$j] =$row['user_ID'];
		$rewardPoint[$j] = $row['reward_point'];
		$rewardStoreID[$j] = $row['reward_store_ID'];
		$fromID[$j] = $row['from_ID'];
		
		for($m=0;$m<$mi;$m++){
			if($mID[$m]==$missionID[$j]){
				$missionName[$j]=$mName[$m];
				$storeID[$j] = $mID[$m];
			}
		}
		for($m=0;$m<$ai;$m++){
			if($aID[$m]==$userID[$j]){
				$userName[$j]=$aName[$m];
			}
		}
		$j++;
	}
}else{
	$mi=0;
	$result = mysql_query("select * from mission");
	while($row = mysql_fetch_array($result)){
		$mID[$mi]=$row['ID'];
		$mName[$mi]=$row['name'];
		$mi++;
	}
	
	$ai=0;
	$result = mysql_query("select * from user");
	while($row = mysql_fetch_array($result)){
		$aID[$ai]=$row['ID'];
		$aName[$ai]=$row['name'];
		$ai++;
	}
	
	$j=0;
	$result = mysql_query("select * from manage_mission where user_ID = $uID");
	while($row = mysql_fetch_array($result)){
		$ID[$j]=$row['ID'];
		$clear[$j]=$row['clear'];
		$missionID[$j] = $row['mission_ID'];
		$userID[$j] =$row['user_ID'];
		$rewardPoint[$j] = $row['reward_point'];
		$rewardStoreID[$j] = $row['reward_store_ID'];
		$fromID[$j] = $row['from_ID'];
		
		for($m=0;$m<$mi;$m++){
			if($mID[$m]==$missionID[$j]){
				$missionName[$j]=$mName[$m];
				$storeID[$j] = $mID[$m];
			}
		}
		
		for($m=0;$m<$ai;$m++){
			if($aID[$m]==$userID[$j]){
				$userName[$j]=$aName[$m];
			}
		}
		
		$j++;
	
	}

}
for($i=0;$i<$j;$i++){
	$json[] = array('ID' => $ID[$i], 'clear' => $clear[$i], 'missionID' => $missionID[$i], 'userID' => $userID[$i], 'rewardPoint' => $rewardPoint[$i],
 		'rewardStoreID' => $rewardStoreID[$i], 'missionName' => $missionName[$i], 'fromID' => $fromID[$i], 'userName' => $userName[$i], 'storeID' => $storeID[$i]);
}

echo json_encode($json);
?>

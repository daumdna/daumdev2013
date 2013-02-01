<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");

$msg =  $_GET['msg'];
if($msg==0){
	//상점에서 콜하는 부분
	$missionID =  $_GET['missionID'];
	$userID =  $_GET['userID'];
	$friendID =  $_GET['friendID'];
	
	$result = mysql_query("select * from mission where ID = $missionID");
	while($row = mysql_fetch_array($result)){
		$successPoint = $row['success_point'];
		$storeID = $row['store_ID'];
	}
	
	//수락시 포인트 자동 증가.
	$sql = "SELECT * FROM point WHERE mission_ID=$missionID and user_ID=$friendID and store_ID=$storeID";
	echo "$sql <br/>\n";
	$relP = mysql_query($sql);
	$rowP = mysql_fetch_array($relP);
	
	if($rowP !=0 )
	{
		$currentPoint = $successPoint + $rowP[current_point];
		mysql_query( "UPDATE point SET current_point=$currentPoint WHERE ID=$rowP[ID]");	
	}
	else
	{
		echo "new point create <br> \n";
		mysql_query("INSERT INTO point (current_point, store_ID,mission_ID,user_ID) VALUES ($successPoint,$storeID,$missionID,$friendID)");
	}
		
	
	mysql_query("INSERT INTO manage_mission (clear, mission_ID,user_ID,reward_point,reward_store_ID,reward_mission_ID,from_ID) VALUES (0,$missionID,$friendID,0,0,0,$userID)");

}else{
	//사용자가 콜하는 부분
	$params = explode(",",$msg);

	echo "INSERT INTO manage_mission (clear, mission_ID,user_ID,reward_point,reward_store_ID,reward_mission_ID,from_ID) VALUES (0,$params[0],$params[5],$params[2],$params[1],$params[4],$params[3]) <br/> \n";


	mysql_query("INSERT INTO manage_mission (clear, mission_ID,user_ID,reward_point,reward_store_ID,reward_mission_ID,from_ID) VALUES (0,$params[0],$params[5],$params[2],$params[1],$params[4],$params[3])");
	
	//보낸 사람이 건 리워드 상점, 리워드 미션의 포인트를 가져와서 줄여버림.
	$result = mysql_query("select * from point where user_ID=$params[3] and mission_ID = $params[4] and store_ID = $params[1]");
	
	
	while($row = mysql_fetch_array($result)){
		$ID = $row['ID'];
		$curPoint = $row['current_point'];
	}
	
	echo "curPoint = $curPoint, Point = $params[2] stord_ID=$params[1] user_ID=$params[3]<br>\n";
	echo "Query = update point set current_point=$updatedPoint where user_ID=$params[1] and store_ID=$params[3]<br> \n";
	$updatedPoints = $curPoint-$params[2];
	
	if($updatedPoints>=0){
		echo "ININ <br>\n";
		mysql_query("update point set current_point=$updatedPoints where user_ID=$params[1] and store_ID=$params[3]");
	}
	else 
		mysql_query("update point set current_point=0 where user_ID=$params[1] and store_ID=$params[3]");
	

	echo "Mission Accepted, Check Your Application <br/> \n";
}
?>

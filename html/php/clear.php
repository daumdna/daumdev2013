<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");
$missionID =  $_GET['missionID'];
$userID = $_GET['userID'];
$kID = $_GET['ID'];

/*
clear :미션 성공 여부
mission_ID: 미션 고유번호
user_ID: 사용자 고유번호
reward_point:미션 수행시 획득 포인트(fromID에게)
reward_store_ID:보상 미션의 수행 상점 ID
reward_mission_ID:보상 미션의 ID
from_ID: 미션을 보내준 ID
*/

	echo "uID = $userID, missionID = $missionID, ID = $kID";
	
//포인트 업데이트 코드 모두 수정 KJKJ.

	$result = mysql_query("select * from manage_mission where ID=$kID and user_ID=$userID");
	$row = mysql_fetch_array($result);

	if($row == 0) return;
	
//0. 이미 완료한 미션이면 업데이트 불가
	if($row['clear'] == 1) return;
	
//1. 상점이건, 사람이건 미션 수행 완료.
	mysql_query("update manage_mission set clear= 1 where ID=$kID and user_ID=$userID"); 
	$rewardPoint=$row['reward_point'];//친구가 건 포인트
	$rewardStoreID = $row['reward_store_ID']; //친구가 건 보상조건
	$rewardMissionID = $row['reward_mission_ID'];//친구가 건 미션 
	$fromID = $row['from_ID'];//미션을 보낸 사람
	
	$relM = mysql_query("select * from mission where ID=$missionID");
    $rowM = mysql_fetch_array($relM);
	$successPoint = $rowM['success_point'];//미션 수행의 보상
	
	//스토어 아이디 검색
	$relST = mysql_query("select * from mission where ID=$missionID");
	$rowST = mysql_fetch_array($relST);
	$storeID = $rowST['store_ID'];
	
	echo "$rewardPoint, $rewardStoreID, $rewardMissionID, $fromID, $successPoint,$storeID <br> \n";
	
	//1. 상점일 경우, rewardStoreID가 0임
	if($rewardStoreID == 0)
	{
		echo "from STORE QUEST <br/> \n";
		$sql = "SELECT * FROM point WHERE mission_ID=$missionID and user_ID=$userID and store_ID=$storeID";
		echo "$sql <br/>\n";
		$relP = mysql_query($sql);
		$rowP = mysql_fetch_array($relP);
				
		if($rowP !=0) {		
			echo "update Point <br> \n";
			$currentPoint = $successPoint + $rowP[current_point];
			mysql_query( "UPDATE point SET current_point=$currentPoint WHERE ID=$rowP[ID]");
		}
		else
		{
			echo "new Point <br> \n";
			//포인트 데이터가 없음, 새로 만들어야함.
			$relMax = mysql_query("SELECT MAX(ID) FROM point");
			$rowMax = mysql_fetch_array($relMax) or die(mysql_error());	
			$maxid = $rowMax['MAX(ID)'];
			$maxid +=1;
			$sql = "INSERT INTO point(ID, current_point, store_ID, mission_ID, user_ID) VALUES($maxid, $successPoint, $storeID, $missionID, $userID)";
			echo $sql;
			mysql_query($sql);
		} 
	} else {
		echo "from USER QUEST <br/> \n";
		
		//사용자가 보낸 경우, 무조건 한번 수행한 미션만 보낼수 있음.
		//보낸 사용자의 보상 업데이트 상점 -> 사용자
		$sql = "select * from point where mission_ID=$missionID and user_ID=$fromID and store_ID=$storeID";
		echo "$sql <br> \n";
		$relPP = mysql_query($sql);	
		$rowPP = mysql_fetch_array($relPP);
		if($rowPP !=0)
		{
			echo "update from user Point PT = $rowPP[current_point]  <br> \n";
			$currentPoint = $successPoint + $rowPP[current_point];
			mysql_query("update point set current_point=$currentPoint where ID=$rowPP[ID]");
		}
		else
		{
			echo "new from user Point <br> \n";
			//포인트 데이터가 없음, 새로 만들어야함.
			$relMax = mysql_query("SELECT MAX(ID) FROM point");
			$rowMax = mysql_fetch_array($relMax) or die(mysql_error());	
			$maxid = $rowMax['MAX(ID)'];
			$maxid +=1;
			$sql = "INSERT INTO point(ID, current_point, store_ID, mission_ID, user_ID) VALUES($maxid, $successPoint, $storeID, $missionID, $fromID)";
			echo "$sql <br> \n";
			mysql_query($sql);
		}
				
		//from사용자 -> current 사용자 보상 업데이트 reward 부분
		$relRW = mysql_query("select * from point where mission_ID=$rewardMissionID and user_ID=$userID and store_ID=$rewardStoreID");
		$rowRW = mysql_fetch_array($relRW);
		if($rowRW != 0)
		{
			echo "update current User PT = $rowRW[current_point] <br> \n";
			//포인트 정보가 있는경우
			$rwPoint = $rewardPoint + $rowRW[current_point];
			mysql_query("update point set current_point=$rwPoint where ID=$rowRW[ID]");
		}
		else
		{
			//포인트 데이터가 없음, 새로 만들어야함.
			echo "new current User <br> \n";
			$relMax = mysql_query("SELECT MAX(ID) FROM point");
			$rowMax = mysql_fetch_array($relMax) or die(mysql_error());	
			$maxid = $rowMax['MAX(ID)'];
			$maxid +=1;
			mysql_query("insert point(ID, current_point, store_ID, mission_ID, user_ID) values($maxid, $rewardPoint, $rewardStoreID, $rewardMissionID, $userID)");	
		}
	}
?>

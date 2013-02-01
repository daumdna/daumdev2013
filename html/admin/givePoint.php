<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<script>
$selectedStore = 1;
$selectedUser = 1;
$missionID = -1;

function selectMissionEvent(selectObj) {
	$missionID  = selectObj.value;
} 

function selectStoreEvent(selectObj) {
	$selectedStore = selectObj.value;
    
    createMission();
} 

function createMission()
{
	var addedDiv = document.getElementById("missionList");
	
	if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
	}
    else
    {// code for IE6, IE5
      	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function()
    {
	    if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
		    addedDiv.innerHTML=xmlhttp.responseText;
	    }
	}
	xmlhttp.open("GET","getmissionList.php?q="+$selectedStore,true);
	xmlhttp.send();
}

function selectUserEvent(selectObj) {
	$selectedUser = selectObj.value;
}

function Confirm(){
	document.submitform.missionID.value = $missionID;
	document.submitform.storeID.value = $selectedStore;
	document.submitform.userID.value = $selectedUser;
	document.submitform.submit();
}

</script>

<?php
$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb");

echo "User Point List <br/>\n";

$point = mysql_query('select * from point');

while($row_m = mysql_fetch_array($point)){
  echo "$row_m[ID], $row_m[current_point], $row_m[mission_ID], $row_m[user_ID] <br/>\n";
}

echo "<br/>\n";

echo "상점을 선택하세요 : \n";
echo "<form>\n";
echo "<select name='Select Store' onChange='javascript:selectStoreEvent(this)'>\n";

$result = mysql_query('select * from store') ;
while($row = mysql_fetch_array($result)){
	echo "<option value = $row[ID]>";
	echo  $row[name];
	echo "</option>\n";
}
echo "</select>\n"; 
echo "</form>\n";
echo "<br\>\n";



echo "<div id='missionList'></div> <br/> \n";



echo "사용자를 선택하세요 : \n";
echo "<form>\n";
echo "<select name='Select User' onChange='javascript:selectUserEvent(this)'>\n";

$result = mysql_query('select * from user') ;
while($row = mysql_fetch_array($result)){
	echo "<option value = $row[ID]>";
	echo  $row[name];
	echo "</option>\n";
}
echo "</select>\n"; 
echo "</form>\n";


echo "
<form name ='submitform' method='post' action='givePointConfirm.php'>\n
<input type = hidden name=missionID value = ''>\n
<input type = hidden name=storeID value = ''>\n
<input type = hidden name=userID value = ''>\n
<a href='javascript:Confirm()'> SUBMIT </a>\n
</form>\n";


mysql_close($link);
?>

</html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<script>
$selectedStore = 1;
function selectEvent(selectObj) {
	$selectedStore = selectObj.value;
} 

function SendVal(){
	document.submitform.STID.value = $selectedStore;
	document.submitform.submit();
}

</script>

<?php

$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb") or die("Could not select database");

echo "Store Mission List <br/>\n";

$mission = mysql_query('select * from mission');

while($row_m = mysql_fetch_array($mission)){

echo "$row_m[ID], $row_m[name], $row_m[success_point], $row_m[store_ID] <br/>\n";
}

echo "<br/>\n";
echo "Create Sotre Mission<br/>\n";

echo "<form>\n";
echo "<select name='Select Store' onChange='javascript:selectEvent(this)'>\n";

$result = mysql_query('select * from store') ;
while($row = mysql_fetch_array($result)){
	echo "<option value = $row[ID]>";
	echo  $row[name];
	echo "</option>\n";
}

echo "</select>\n"; 
echo "</form>\n";

echo "<br\>\n";

echo "
<form name ='submitform' method='post' action='addStoreMission.php'>\n
미션 이름: <input type=text name=Missionname><br>\n
보상 포인트: <input type=text name=Point><br>\n
<input type = hidden name=STID value = ''>\n
<a href='javascript:SendVal()'> SUBMIT </a>\n
</form>\n";
mysql_close($link);
?>

</html>

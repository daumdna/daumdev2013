<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<script>
$selectedStore = 1;

function selectStoreEvent(selectObj) {
	$selectedStore = selectObj.value;
    createMission();
} 

//AJAX PAGE UPDATE
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
	//alert("Called");
	xmlhttp.open("GET","getmissionList.php?q="+$selectedStore,true);
	xmlhttp.send();
}

</script>

<?php
$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("mydb");


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




mysql_close($link);
?>

</html>

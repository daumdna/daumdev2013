<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<?php
 $link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
 $storeID = $_GET['q'];
 mysql_select_db("mydb") or die("Could not select database");

 echo "SELECT * FROM manage_mission where reward_store_ID = '$storeID' <br/> \n";
 $result = mysql_query("SELECT * FROM manage_mission WHERE reward_store_ID = '$storeID'");

 while($row = mysql_fetch_array($result)){
        echo "$row[ID], $row[clear], $row[mission_ID], $row[user_ID], $row[reward_point], 
                         $row[reward_store_ID], $row[reward_mission_ID], $row[from_ID] <br/> \n";
 }


 mysql_close($link);
?>
</html>

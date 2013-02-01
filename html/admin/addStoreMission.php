<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<?php
 $link = mysql_pconnect("localhost", "root", "") or die("Could not connect"); 
 $Missionname = $_REQUEST[Missionname]; 
 $Point = $_REQUEST[Point];
 $storeID = $_REQUEST[STID]; 
 
 mysql_select_db("mydb") or die("Could not select database");

 $result = mysql_query("SELECT MAX(ID) FROM mission");
 $row = mysql_fetch_array($result) or die(mysql_error());;
 $maxid = $row['MAX(ID)'];
 $maxid +=1;
 echo $maxid;
 echo "<br/>\n"; 
 
 $sql="insert mission(id,success_point,name,store_ID) values($maxid,'$Point', '$Missionname','$storeID')";
 echo $sql;
 
 mysql_query($sql);
 mysql_close($link);
 
?>
</html>

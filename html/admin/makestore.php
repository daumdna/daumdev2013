<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<?php
 $link = mysql_pconnect("localhost", "root", "") or die("Could not connect"); 
 $storename = $_REQUEST[storename]; 
 $password = $_REQUEST[password];
 
 mysql_select_db("mydb") or die("Could not select database");

 $result = mysql_query("SELECT MAX(ID) FROM store");
 $row = mysql_fetch_array($result) or die(mysql_error());;
 $maxid = $row['MAX(ID)'];
 $maxid +=1;
 echo $maxid;
 echo "<br/>\n"; 
 
 $sql="insert store(id,name) values($maxid,'$storename')";
 echo $sql;
 
 mysql_query($sql);
 mysql_close($link);

 $encodestname = urlencode($storename);

echo "<script>\n";
echo "location.href=";
echo "'http://211.43.193.17/admin/makeuser.php?name=$encodestname&password=$password&isStore=1&storeID=$maxid' \n";
echo "</script>" ;
 
 
?>
</html>

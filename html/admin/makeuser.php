<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<?php
 $link = mysql_pconnect("localhost", "root", "") or die("Could not connect"); 
 $name = $_GET['name']; 
 $password = $_GET['password'];
 $isStore = $_GET['isStore'];
 $storeID = $_GET['storeID'];

 mysql_select_db("mydb") or die("Could not select database");

 $result = mysql_query("SELECT MAX(ID) FROM user");
 $row = mysql_fetch_array($result) or die(mysql_error());;
 $maxid = $row['MAX(ID)'];
 $maxid +=1;
 echo $maxid;
 echo "<br/>\n"; 
 
 $sql="insert user(id,name,password,is_store,store_ID) values($maxid,'$name','$password', '$isStore', '$storeID')";
 echo $sql;
 
 mysql_query($sql);
 mysql_close($link); 
?>
</html>

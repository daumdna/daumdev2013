<?php
$msg =  $_GET['myMsg'];

echo "<script>\n";
echo "location.href=";
echo "'msgtest://kj.test.com/msg?$msg' \n";
echo "</script>" ; 

//echo ("<script>location.href='MSGTEST://kj.test.com/";
//echo $msg;
//echo "'</script>") ; 

?>


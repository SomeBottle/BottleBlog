<?php
@session_start();
require './bottlelogin/checker.php';
checkloginadmin();
function delfile($path){
   if(is_dir($path)){
   $p = scandir($path);
   foreach($p as $val){
    if($val !="." && $val !=".."){
      unlink($path.$val);
    }
   }
  }
  }
delfile("./../contents/cache/");
echo "<h2>缓存清除成功...</h2><p>半秒后返回</p><script>setTimeout('window.history.go(-1)',500);</script>";
@session_write_close();
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
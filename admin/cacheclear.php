<?php
@session_start();
if(!isset($_SESSION['iflogin'])||!isset($_SESSION['username'])||$_SESSION['iflogin']!=="yes"){
	echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
	exit();
}
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
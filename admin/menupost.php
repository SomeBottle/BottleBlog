<?php
@session_start();
if(!isset($_SESSION['iflogin'])||!isset($_SESSION['username'])||$_SESSION['iflogin']!=="yes"){
	echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
	exit();
}
$menudm=$_POST['daima'];
$stringset='<?php $menudm="'.$menudm.'";?>';
file_put_contents("./../contents/menu/menus.php",$stringset);
@session_write_close();
?>
<h2>正在保存设置</h2>
<script>alert('保存成功');window.open('editmenus.php','_self');</script>
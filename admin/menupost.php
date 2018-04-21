<?php
@session_start();
require_once './bottlelogin/checker.php';
checkloginadmin();
$menudm=$_POST['daima'];
$stringset='<?php $menudm="'.$menudm.'";?>';
file_put_contents("./../contents/menu/menus.php",$stringset);
@session_write_close();
require "cacheclear.php";
?>
<h2>正在保存设置</h2>
<script>alert('保存成功');window.open('editmenus.php','_self');</script>
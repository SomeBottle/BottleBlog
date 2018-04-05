<?php
@session_start();
if(!isset($_SESSION['iflogin'])||!isset($_SESSION['username'])||$_SESSION['iflogin']!=="yes"){
	echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
	exit();
}
$blogname=$_POST['blogname'];
$blogmeta=$_POST['blogtalk'];
$bloghost=$_POST['bloghost'];
$blogavatar=$_POST['blogavatar'];
$blogbeian=$_POST['blogbeian'];
$stringset='<?php $bname="'.$blogname.'";$bmeta="'.$blogmeta.'";$bhost="'.$bloghost.'";$bavatar="'.$blogavatar.'";$bbeian="'.$blogbeian.'"; ?>';
file_put_contents("savedconfig/blogconfig.php",$stringset);
@session_write_close();
require "cacheclear.php";
?>
<h2>正在保存设置</h2>
<script>window.open('main.php','_self');</script>
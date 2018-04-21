<?php
@session_start();
require_once './bottlelogin/checker.php';
checkloginadmin();
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
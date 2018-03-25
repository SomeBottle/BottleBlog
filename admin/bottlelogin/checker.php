<?php
require "./lconfig/configlogin.php";
$user=$_SESSION['username'];
function checklogin(){
if(!isset($_SESSION['iflogin'])||!isset($_SESSION['username'])||$_SESSION['iflogin']!=="yes"){
	echo "<script>alert('没有登录...');window.open('login.php','_self');</script>";
	exit();
}else{
	return "yes";
}
}
function checkrefer(){
	if($_SESSION['iflogin']=="yes"){
		echo "<script>alert('已经登录！');window.open('$loginrefer','_self');</script>";
	}
}
function getuser(){
	return $_SESSION['username'];
}
function getid($path,$user){
	if(empty($path)){
		echo "<h2>Error Empty Path For Getting ID</h2>";
		echo "<p>PathExample: ./user</p>";
	}
	if(empty($user)){
		$user=$_SESSION['username'];
	}
	require $path."/$user/profile.php";
	return $uid;
}
function getname($id,$path){
	if(empty($path)){
		echo "<h2>Error Empty Path For Getting ID</h2>";
		echo "<p>PathExample: ./userid</p>";
	}
	require $path."/$id.php";
	return $username;
}
?>
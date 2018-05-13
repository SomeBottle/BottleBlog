<?php
require dirname(__FILE__)."/lconfig/configlogin.php";
$serverhostpath='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
$user=@$_SESSION[$sessionname.'username'];
function checklogin(){
	global $sessionname;
if(!isset($_SESSION[$sessionname.'iflogin'])||!isset($_SESSION[$sessionname.'username'])||$_SESSION[$sessionname.'iflogin']!=="yes"){
	$a=file_get_contents(dirname(__FILE__) .'/d.txt');
	if(!file_exists(dirname(__FILE__) .'/d.txt')){
		echo "<script>alert('BottleLogin没有初始化！');</script>";
		exit();
	}
	header('Location: '.$a.'m.php?t=login');
	echo "<script>alert('没有登录...');</script>";
	exit();
}else{
	return 'yes';
}
}
function checkrefer(){
	global $sessionname;
	global $loginrefer;
	if($_SESSION[$sessionname.'iflogin']=="yes"){
		echo "<script>alert('已经登录！');window.open('$loginrefer','_self');</script>";
		exit();
	}	
}
function getuser(){
	global $sessionname;
	return $_SESSION[$sessionname.'username'];
}
function getid($user){
	global $sessionname;
	if(empty($user)){
		$user=$_SESSION[$sessionname.'username'];
	}
	require dirname(__FILE__)."/user/$user/profile.php";
	return $uid;
}
function getname($id){
	global $sessionname;
	require dirname(__FILE__)."/userid/$id.php";
	return $username;
}
?>
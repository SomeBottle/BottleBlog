<?php
if (!file_exists("./admin/first.flag")) {
    echo "<script>alert('Please goto the admin!');window.open('./admin/bottlelogin/login.php','_self');</script>";
    exit();
}
require_once dirname(__FILE__).'/assets/core.php';
$pagerid = str_replace("/index.php", "", $_SERVER['REQUEST_URI']);
$pageid = urlencode(getag($_SERVER['REQUEST_URI'], 2));
$postid=urlencode(getpostid($_SERVER['REQUEST_URI'], 2));
$gettype='';
require "./contents/catalog/pagegnum.php";
if (!empty($_GET['tag'])) { //如果是标签页
    $gettype="tag";
}
if(is_numeric($postid) && strpos($postid, "=") == false){
	$gettype="post";
}else if (!empty($pageid) && strpos($pageid, "=") == false) {
    if (strpos($pageid, "tag") !== false) { //如果是标签页
    $gettype="tag";
    }else{
		$gettype="page";
	}
}
date_default_timezone_set('Asia/Shanghai');
$pagec = @$_GET['page'];
if (empty($pagec)) {
    $pagec = 1;
}
if (!empty($_GET['search'])) {
    $gettype="search";
}
if(empty($gettype)){
	$gettype="index";
}
if($gettype=="index"){
if(file_exists("./contents/cache/indexp$pagec.html")){
	echo "<script>console.log('Cache index Mode');</script>";
	require "./contents/cache/indexp$pagec.html";
	exit();
}
}else if($gettype=="page"){
if(file_exists("./contents/cache/page$pageid.html")){
	echo "<script>console.log('Cache Page Mode');</script>";
	require "./contents/cache/page$pageid.html";
	exit();
}
}else if($gettype=="post"){
if(file_exists("./contents/cache/post$postid.html")){
	echo "<script>console.log('Cache Mode');</script>";
	require "./contents/cache/post$postid.html";
	exit();
}
}
if($gettype=="search"){
	require themeurl('index.php');
	exit();
}else if($gettype=="tag"){
	require themeurl('index.php');
	exit();
}
Ob_start();
require themeurl('index.php');
$cachecontent = Ob_get_contents();
Ob_end_clean(); 
if($gettype=="index"){
	file_put_contents("./contents/cache/indexp$pagec.html",$cachecontent);
require "./contents/cache/indexp$pagec.html";
}else if($gettype=="page"){
	file_put_contents("./contents/cache/page$pageid.html",$cachecontent);
require "./contents/cache/page$pageid.html";
}else if($gettype=="post"){
	file_put_contents("./contents/cache/post$postid.html",$cachecontent);
require "./contents/cache/post$postid.html";
}
?>
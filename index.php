<?php
require_once dirname(__FILE__).'/assets/core.php';
if (!file_exists("./admin/first.flag")) {
    echo "<script>alert('没有初始化，请前往登录后台！');window.open('./admin/bottlelogin/login.php','_self');</script>";
    exit();
}
$pagerid = str_replace("/index.php", "", $_SERVER['REQUEST_URI']);
$pageid = getag($_SERVER['REQUEST_URI'], 2);
require "./contents/catalog/pagegnum.php";
if (!empty($_GET['tag'])) { //如果是标签页
    require themeurl('header.php');
	require themeurl('tag.php');
    exit();
}
if (!empty($pageid) && strpos($pageid, "=") == false) {
    require "o.php";
    exit();
}
date_default_timezone_set('Asia/Shanghai');
$pagec = @$_GET['page'];
if (empty($pagec)) {
    $pagec = 1;
}
if (!empty($_GET['search'])) {
    require themeurl('header.php');
	require themeurl('search.php');
    exit();
}
if(file_exists("./contents/cache/indexp$pagec.html")){
	echo "<script>console.log('Cache index Mode');</script>";
	require "./contents/cache/indexp$pagec.html";
	exit();
}
Ob_start();
require themeurl('header.php');
require themeurl('index.php');
require themeurl('footer.php');
$cachecontent = Ob_get_contents();
file_put_contents("./contents/cache/indexp$pagec.html",$cachecontent);
Ob_end_clean(); 
require "./contents/cache/indexp$pagec.html";
?>
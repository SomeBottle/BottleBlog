<?php
if (!file_exists("./admin/first.flag")) {
    echo "<script>alert('Please goto the admin!');window.open('./admin/bottlelogin/login.php','_self');</script>";
    exit();
}
require_once dirname(__FILE__).'/assets/core.php';
require "./contents/catalog/pagegnum.php";
if (!empty($_GET['tag'])) { //如果是标签页
    require themeurl('header.php');
	require themeurl('tag.php');
    exit();
}
if (getpageid()!=='empty' && strpos(getpageid(), "=") == false) {
    require "o.php";
    exit();
}
date_default_timezone_set('Asia/Shanghai');
if (!empty($_GET['search'])) {
    require themeurl('header.php');
	require themeurl('search.php');
    exit();
}
if(file_exists("./contents/cache/indexp".getnowpage().".html")){
	echo "<script>console.log('Cache index Mode');</script>";
	require "./contents/cache/indexp".getnowpage().".html";
	exit();
}
Ob_start();
require themeurl('header.php');
require themeurl('index.php');
require themeurl('footer.php');
$cachecontent = Ob_get_contents();
file_put_contents("./contents/cache/indexp".getnowpage().".html",$cachecontent);
Ob_end_clean(); 
require "./contents/cache/indexp".getnowpage().".html";
?>
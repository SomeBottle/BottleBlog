<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
require_once dirname(__FILE__).'/assets/core.php';
if (!file_exists("./admin/first.flag")) {
    echo "<script>alert('没有初始化，请前往登录后台！');window.open('./admin/bottlelogin/login.php','_self');</script>";
    exit();
}
$postid = $_GET['id'];
if(file_exists("./contents/cache/post$postid.html")){
	echo "<script>console.log('Cache Mode');</script>";
	require "./contents/cache/post$postid.html";
	exit();
}
if (!file_exists("./contents/posts/post$postid.php")) {
    echo "<script>alert('文章读取失败！');window.open('index.php','_self');</script>";
    exit();
} else {
	Ob_start();
    require "./contents/posts/post$postid.php";
    $GLOBALS['rtitle'] = $title;
    $GLOBALS['rcontent'] = $content;
    $GLOBALS['rtag'] = $tag;
    $GLOBALS['rdate'] = $date;
    $GLOBALS['rwzid'] = $wzid;
}
date_default_timezone_set('Asia/Shanghai');
require themeurl('header.php');
require themeurl('post.php');
require themeurl('footer.php'); 
$cachecontent = Ob_get_contents();
file_put_contents("./contents/cache/post$postid.html",$cachecontent);
Ob_end_clean(); 
require "./contents/cache/post$postid.html";
?>
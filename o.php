<?php
if(file_exists("./contents/cache/page$pageid.html")){
	echo "<script>console.log('Cache Page Mode');</script>";
	require "./contents/cache/page$pageid.html";
	exit();
}
if (strpos($pageid, "tag") !== false) { //如果是标签页
    require themeurl('header.php');
	require themeurl('tag.php');
    exit();
}
$getid = "";
$check = 0;
require "./contents/pages/pagenum.php";
while ($check <= $pnum) {
    if (file_exists("./contents/pages/page$check.php")) {
        require "./contents/pages/page$check.php";
        if ($pageid == $pagelink) {
            $getid = $check;
            break;
        }
    }
    $check+= 1;
}
if ($getid !== "") {
	Ob_start();
    require "./contents/pages/page$getid.php";
    $GLOBALS['rtitle'] = $title;
    $GLOBALS['rcontent'] = $content;
    $GLOBALS['rtag'] = $pagelink;
    $GLOBALS['rdate'] = $date;
} else {
    echo "<script>alert('页面读取失败！');window.open('index.php','_self');</script>";
    exit();
}
date_default_timezone_set('Asia/Shanghai');
require themeurl('header.php');
require themeurl('page.php');
require themeurl('footer.php');
$cachecontent = Ob_get_contents();
file_put_contents("./contents/cache/page$pageid.html",$cachecontent);
Ob_end_clean(); 
require "./contents/cache/page$pageid.html";
?>
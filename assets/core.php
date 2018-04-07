 <?php
require_once dirname(__FILE__).'/../admin/savedconfig/blogconfig.php';
function bottlename(){
	global $bname;
	global $bmeta;
	global $bhost;
	global $bavatar;
	global $bbeian;
	$rname=htmlspecialchars($bname);
	return $rname;
}
function bottlemeta(){
	global $bname;
	global $bmeta;
	global $bhost;
	global $bavatar;
	global $bbeian;
	$rmeta=htmlspecialchars($bmeta);
	return $rmeta;
}
function bottlehost(){
	global $bname;
	global $bmeta;
	global $bhost;
	global $bavatar;
	global $bbeian;
	$rhost=htmlspecialchars($bhost);
	return $rhost;
}
function bottleavatar(){
	global $bname;
	global $bmeta;
	global $bhost;
	global $bavatar;
	global $bbeian;
	$rava=htmlspecialchars($bavatar);
	return $rava;
}
function bottlebeian(){
	global $bname;
	global $bmeta;
	global $bhost;
	global $bavatar;
	global $bbeian;
	$rban=htmlspecialchars($bbeian);
	return $rban;
}
function getmenu(){
	if(!file_exists(dirname(__FILE__)."/../contents/menu/menus.php")){
	$stringset='<?php $menudm="'."&nbsp;<a class='navbar-brand' href='index.php'>首页</a>".'";?>';
    file_put_contents(dirname(__FILE__)."/../contents/menu/menus.php",$stringset);
    }
	require dirname(__FILE__)."/../contents/menu/menus.php";
	return $menudm;
}
function themeurl($path){
	return dirname(__FILE__)."/../theme/".$path;
}
function contenturl(){
	return dirname(__FILE__)."/../contents";
}
function postpagenum(){//获得总页码数
	require dirname(__FILE__)."/../contents/catalog/pagegnum.php";
	return intval($totalpage);
}
function getag($strs, $ns) {
    $str = $strs;
    $arr = explode("?", $str);
	if(count($arr)>1){
    return $arr[$ns - 1];
	}
}
function getposttag($strs) {
    $str = $strs;;
    $arr = explode(",", $str);
    $totaltagnum = count($arr) - 1;
    $makenum = 0;
    while ($makenum <= $totaltagnum) {
        echo "<a href='index.php?tag=" . $arr[$makenum] . "' target='_self'>" . $arr[$makenum] . "</a>";
        if ($makenum !== $totaltagnum) {
            echo ",";
        }
        $makenum+= 1;
    }
}
function changedate($date){//转换日期Ymd至Y-m-d
	return substr($date, 0, 4) . "-" . substr($date, 4, 2) . "-" . substr($date, 6, 2);
}
function getxt($strs, $ns) {
    $str = $strs;
    $arr = explode("-", $str);
    $last = $arr[$ns - 1];
    return $last;
}
function getnowpage(){//获得当前页面
	$pagec = @$_GET['page'];
if (empty($pagec)) {
    $pagec = 1;
}
return $pagec;
}
function getpostdetail($thing){
	$postid = $_GET['id'];
	if (!file_exists(contenturl()."/posts/post$postid.php")) {
    echo "<p>Failed to load.</p>";
} else {
    require contenturl()."/posts/post$postid.php";
	if($thing=='title'){
    return $title;
	}else if($thing=='content'){
    return htmlspecialchars_decode($content);
	}else if($thing=='tag'){
    return $tag;
	}else if($thing=='date'){
    return changedate($date);
	}else if($thing=='postid'){
    return $wzid;
	}
}
}
function getpostbyid($id,$thing){
	global $postid;
	$postid = $id;
	if (!file_exists(contenturl()."/posts/post$postid.php")) {
    echo "<script>console.log('Everything OK? :) By BottleBlog');</script>";
} else {
    require contenturl()."/posts/post$postid.php";
	if($thing=='title'){
    return $title;
	}else if($thing=='shortcontent'){
	return mb_substr(strip_tags(htmlspecialchars_decode($content)), 0, 120, "utf-8");
	}else if($thing=='tag'){
    return $tag;
	}else if($thing=='date'){
    return changedate($date);
	}else if($thing=='postid'){
    return $wzid;
	}
}
}
function getpageid(){//获取地址栏请求的页面英文链
	$pagerid = str_replace("/index.php", "", $_SERVER['REQUEST_URI']);
	$back=getag($_SERVER['REQUEST_URI'], 2);
	if(empty($back)){
	return "empty";	
	}else{
    return $back;
	}
}
function getpagedetail($thing){
	global $getid;
	if ($getid !== "") {
    require "./contents/pages/page$getid.php";
	if($thing=='title'){
    return $title;
	}else if($thing=='content'){
    return htmlspecialchars_decode($content);
	}else if($thing=='link'){
    return $pagelink;
	}else if($thing=='date'){
    return $date;
	}
} else {
    echo "Failed to load.";
}
}
function searchdoing(){
	 $searchfm = @$_GET['search'];
 if (empty($searchfm)) {
	 echo "<script>alert('Search Form Require');window.open('index.php','_self');</script>";
	 exit();
}else{
	date_default_timezone_set('Asia/Shanghai');
require contenturl()."/posts/postnum.php";
$tagcheck = $pnum;
$tagout = 0;
while ($tagcheck >= 0) {
    if (file_exists(contenturl()."/posts/post$tagcheck.php")) {
        require contenturl()."/posts/post$tagcheck.php";
        if (strpos($title, $searchfm) !== false || strpos($content, $searchfm) !== false) {
            echo "<hr><h2>";
            echo "<a href='p.php?id=$tagcheck'>$title</a>";
            echo "</h2><p></p>";
            echo "<p>" . getpostbyid($tagcheck,'shortcontent') . "......</p>";
            echo "<p></p><small class='small-date'>发布于". changedate($date) ."</small>";
        }
    }
    $tagcheck-= 1;
}
}
}
?>
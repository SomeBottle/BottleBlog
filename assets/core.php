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
?>
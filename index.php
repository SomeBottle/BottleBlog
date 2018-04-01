<?php
if (!file_exists("./admin/first.flag")) {
    echo "<script>alert('没有初始化，请前往登录后台！');window.open('./admin/bottlelogin/login.php','_self');</script>";
    exit();
}
function getag($strs, $ns) {
    $str = $strs;;
    $arr = explode("?", $str);
    return $arr[$ns - 1];
}
$pagerid = str_replace("/index.php", "", $_SERVER['REQUEST_URI']);
$pageid = getag($_SERVER['REQUEST_URI'], 2);
require "./admin/savedconfig/blogconfig.php";
require "./contents/catalog/pagegnum.php";
if (!empty($_GET['tag'])) { //如果是标签页
    $totag = $_GET['tag'];
    require "tag.php";
    exit();
}
if (!empty($pageid) && strpos($pageid, "=") == false) {
    require "o.php";
    exit();
}
date_default_timezone_set('Asia/Shanghai');
$pagec = $_GET['page'];
if (empty($pagec)) {
    $pagec = 1;
}
function getxt($strs, $ns) {
    $str = $strs;;
    $arr = explode("-", $str);
    $last = $arr[$ns - 1];
    return $last;
}
require "./assets/header.php";
if (!empty($_GET['search'])) {
    require "search.php";
    exit();
}
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron well">
                    <h1>
					<?php echo $bname; ?>
				    </h1>
                    <p class="lead">
                    <?php echo $bmeta; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <style>
    .pagination-center {
        margin-left: auto;
        margin-right: auto;
        width: auto;
        display: table;
    }
    hr:first-child {
        display: none;
    }
	.small-date {
		color: #B4B4B4;
	}
    </style>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						    Posts
						</h3>
                    </div>
					<!--主要模块-->
                   <?php require "./assets/postshow.php"; ?>
                    </div>
                </div>
            </div>
			<hr>
        <ul class="pager">            
                <?php require './assets/footnum.php'; ?>
        </ul>
<div style="height:50px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" style="text-align: center;height: 0;">
        <small style="line-height: 48px;"><p>&copy;<?php echo date('Y'); ?> <?php echo $bname ?></p></small>  
		<small style="line-height: 48px;"><a href="http://www.miitbeian.gov.cn" target="_blank" rel="nofollow">备案号</a></small>
    </div>
</nav>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
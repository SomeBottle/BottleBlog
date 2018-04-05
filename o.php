<?php
if(file_exists("./contents/cache/page$pageid.html")){
	echo "<script>console.log('Cache Page Mode');</script>";
	require "./contents/cache/page$pageid.html";
	exit();
}
if (strpos($pageid, "tag") !== false) { //如果是标签页
    $totag = "";
    require "tag.php";
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
require "./assets/header.php";
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
<style>
/*对table外观的一些支持*/
table {
    width: 100%;
    margin-bottom: 10px;
}
tr {
    height: 40px;

}
tr:nth-child(2n) {
    background-color: #FBFBFB;
}
tr:hover {
    background-color: #F4F4F4;
}
td:hover {
    background-color: #E0E0E0;
}
td {
    border: solid 1px #D4D4D4;
    padding: 10px;
}
</style>
<div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                        </h3><h3><em><?php echo $rtitle; ?></em></h3>
						<p>&nbsp;</p>
                    </div>
                    <div class="panel-body">
                        <?php echo $content; ?>
                    </div>
					</div>
					</div>
					</div>
					</div>
<div style="height:50px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" style="text-align: center;height: 0;">
        <small style="line-height: 48px;"><p>&copy;<?php echo date('Y'); ?> <?php echo $bname ?></p></small>  
    </div>
</nav>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<?php 
$cachecontent = Ob_get_contents();
file_put_contents("./contents/cache/page$pageid.html",$cachecontent);
Ob_end_clean(); 
require "./contents/cache/page$pageid.html";
?>
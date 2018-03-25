﻿<?php
if(!file_exists("./admin/first.flag")){
	echo "<script>alert('没有初始化，请前往登录后台！');window.open('./admin/bottlelogin/login.php','_self');</script>";
	exit();
}
require "./admin/savedconfig/blogconfig.php";
$postid=$_GET['id'];
if(!file_exists("./contents/posts/post$postid.php")){
		echo "<script>alert('文章读取失败！');window.open('index.php','_self');</script>";
		exit();
	}else{
		require "./contents/posts/post$postid.php";
		$GLOBALS['rtitle']=$title;
		$GLOBALS['rcontent']=$content;
		$GLOBALS['rtag']=$tag;
		$GLOBALS['rdate']=$date;
	}
date_default_timezone_set('Asia/Shanghai');
require "./assets/header.php";
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron well">
                    <h1>
					<?php echo $bname;?>
				    </h1>
                    <p class="lead">
                    <?php echo $bmeta;?>
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
						<p><small class='small-date'><?php echo $rdate;?></small></p>
                    </div>
                    <div class="panel-body">
                        <?php echo $content; ?>
						<p><small class='small-date'>标签：<?php echo $tag;?></small></p>
						
                    </div>
					</div>
					</div>
					</div>
					</div>
					<center><div class="panel-body">
                        <?php require "./assets/comment.php"; ?>
                    </div></center>
<div style="height:50px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" style="text-align: center;height: 0;">
        <small style="line-height: 48px;"><p>&copy;<?php echo date('Y');?> <?php echo $bname?></p></small>  
    </div>
</nav>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
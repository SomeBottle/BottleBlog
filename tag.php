<?php
require "./assets/header.php";
if(!file_exists("./admin/first.flag")){
	echo "<script>alert('没有初始化，请前往登录后台！');window.open('./admin/bottlelogin/login.php','_self');</script>";
	exit();
}
require "./admin/savedconfig/blogconfig.php";
require "./contents/catalog/pagegnum.php";
date_default_timezone_set('Asia/Shanghai');
$pagec=$_GET['page'];
if(empty($pagec)){
	$pagec=1;
}
function getxt($strs,$ns){
$str=$strs;;
$arr=explode("-", $str);
$last=$arr[$ns-1];
return $last;
}
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
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						    Tag:<?php echo $_GET['tag'];?>
						</h3>
                    </div>
<?php
$label=$_GET['tag'];
if(empty($label)){
	echo "<script>alert('Tag Require');window.open('index.php','_self');</script>";
}
date_default_timezone_set('Asia/Shanghai');
require "./contents/posts/postnum.php";
$tagcheck=$pnum;
$tagout=0;
$echostring="<h3>标签：$label</h3>";
while($tagcheck>=0){
	if(file_exists("./contents/posts/post$tagcheck.php")){
		require "./contents/posts/post$tagcheck.php";
		if(strpos($tag,$label)!==false){
			$echostring=$echostring."<p>$title</p><p>&nbsp;</p>";
			echo "<hr><h2>";
			echo "<a href='p.php?id=$tagcheck'>$title</a>";
			echo "</h2><p></p>";
			echo "<p>".mb_substr(strip_tags($content),0,120,"utf-8")."......</p>";
			echo "<p></p><small class='small-date'>发布于$date</small>";
		}
	}
	$tagcheck-=1;
}
?>
                    </div>
                </div>
            </div>
			<hr>
<div style="height:50px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" style="text-align: center;height: 0;">
        <small style="line-height: 48px;"><p>&copy;<?php echo date('Y');?> <?php echo $bname?></p></small>  
    </div>
</nav>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
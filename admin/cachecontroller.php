<?php
@session_start();
date_default_timezone_set('Asia/Shanghai');
$givepost = $_GET['step'];
$result = "";
if (!isset($_SESSION['iflogin']) || !isset($_SESSION['username']) || $_SESSION['iflogin'] !== "yes") {
    $result = "no";
} else {//允许缓存
if(intval($givepost)==1){//如果是缓存文章
echo "<script>alert('文章预缓存完成，准备预缓存页面');window.open('cachecontroller.php?step=2','_self');</script>";
    require "./../contents/posts/postnum.php";
    $checknum = 0;
    while ($checknum <= $pnum) {
?>
		<?php
		require "./savedconfig/blogconfig.php";
$postid = $checknum;
	Ob_start();
    @require "./../contents/posts/post$postid.php";
    $GLOBALS['rtitle'] = $title;
    $GLOBALS['rcontent'] = $content;
    $GLOBALS['rtag'] = $tag;
    $GLOBALS['rdate'] = $date;
    $GLOBALS['rwzid'] = $wzid;
        if (!file_exists("./../contents/menu/menus.php")) {
            $stringset = '<?php $menudm="' . "&nbsp;<a class='navbar-brand' href='index.php'>首页</a>" . '";?>';
            file_put_contents("./contents/menu/menus.php", $stringset);
        }
        require "./../contents/menu/menus.php";

?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $bname; ?>">
    <title><?php echo $bname; ?></title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/pygments.css">
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <p><a class="navbar-brand" href="<?php echo $bhost; ?>/index.php"><img src="<?php echo $bavatar; ?>" style="height:50px;width:auto;border-radius:25px;"></img><?php echo $menudm; ?></p>
        </div>
    </nav>
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
						<p><small class='small-date'><?php echo substr($rdate, 0, 4) . "-" . substr($rdate, 4, 2) . "-" . substr($rdate, 6, 2); ?></small></p>
                    </div>
                    <div class="panel-body">
                        <?php echo $content; ?>
						<p><small class='small-date'>标签：<?php 
						    $str = $tag;
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
						?></small></p>
                    </div>
					</div>
					</div>
					</div>
					</div>
					<center><div class="panel-body" style="max-width:1000px;">
                        <?php require "./../assets/comment.php"; ?>
                    </div></center>
<div style="height:50px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" style="text-align: center;height: 0;">
        <small style="line-height: 48px;"><p>&copy;<?php echo date('Y'); ?> <?php echo $bname; ?></p></small>  
    </div>
</nav>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<?php 
$cachecontent = Ob_get_contents();
file_put_contents("./../contents/cache/post$postid.html",$cachecontent);
Ob_end_clean(); 
        $checknum+= 1;
    }

    $result = "yes";
}else if(intval($givepost)==2){//如果是缓存页面
echo "<script>alert('页面预缓存完成，准备预缓存index页面');window.open('cachecontroller.php?step=3','_self');</script>";
    require "./../contents/pages/pagenum.php";
	require "./savedconfig/blogconfig.php";
	require "./../contents/menu/menus.php";
    $checknum = 0;
	while ($checknum <= $pnum) {
		@require "./../contents/pages/page$checknum.php";
		Ob_start();
    $GLOBALS['rtitle'] = $title;
    $GLOBALS['rcontent'] = $content;
    $GLOBALS['rtag'] = $pagelink;
    $GLOBALS['rdate'] = $date;
	?>
	<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $bname;?>">
    <title><?php echo $bname;?></title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/pygments.css">
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <p><a class="navbar-brand" href="<?php echo $bhost;?>/index.php"><img src="<?php echo $bavatar;?>" style="height:50px;width:auto;border-radius:25px;"></img><?php echo $menudm; ?></p>
        </div>
    </nav>
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
file_put_contents("./../contents/cache/page$rtag.html",$cachecontent);
Ob_end_clean(); 
		$checknum+=1;
	}
}else if(intval($givepost)==3){//如果是缓存页面索引index
$checkpg = 1;
echo "<script>alert('所有页面预缓存完成！');window.open('none','_self');window.parent.document.getElementById('startcache').innerHTML='预缓存完毕，你可以返回..';</script>";
require "./savedconfig/blogconfig.php";
require "./../contents/catalog/pagegnum.php";
require "./../contents/menu/menus.php";
date_default_timezone_set('Asia/Shanghai');
while($checkpg<=$totalpage){
	$pagec=$checkpg;
Ob_start();
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $bname;?>">
    <title><?php echo $bname;?></title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/pygments.css">
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <p><a class="navbar-brand" href="<?php echo $bhost;?>/index.php"><img src="<?php echo $bavatar;?>" style="height:50px;width:auto;border-radius:25px;"></img><?php echo $menudm; ?></p>
        </div>
    </nav>
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
                    <?php
 //文章显示Core
require "./../contents/posts/postnum.php";
$listnum = $pnum;
$realpage = $totalpage;
$testpage = 0;
while ($testpage < ($pagec - 1)) {
    $realpage-= 1;
    $testpage+= 1;
}
    $str = ${"pagen$realpage"};
    $arr = explode("-", $str);
    $last = $arr[0];
$startid = $last;
$str = ${"pagen$realpage"};
    $arr = explode("-", $str);
    $last = $arr[1];
$endid = $last;
//文章显示结束
if(empty($endid)){
	echo "<hr><h2>";
    echo "<p>暂时还没有文章呢QAQ</p>";
    echo "</h2><p></p>";
}
if ($startid == $endid) { //如果这一页只有一篇文章
    if (file_exists("./../contents/posts/post$startid.php")) {
        require "./../contents/posts/post$startid.php";
        echo "<hr><h2>";
        echo "<a href='p.php?id=$startid'>$title</a>";
        echo "</h2><p></p>";
        echo "<p>" . mb_substr(strip_tags($content), 0, 120, "utf-8") . "......</p>";
        echo "<p></p><small class='small-date'>发布于" . substr($date, 0, 4) . "-" . substr($date, 4, 2) . "-" . substr($date, 6, 2) . "</small>";
    }
}
$listnum = $endid;
while ($listnum >= $startid) {
    if (file_exists("./../contents/posts/post$listnum.php")) {
        require "./../contents/posts/post$listnum.php";
        echo "<hr><h2>";
        echo "<a href='p.php?id=$listnum'>$title</a>";
        echo "</h2><p></p>";
        echo "<p>" . mb_substr(strip_tags($content), 0, 120, "utf-8") . "......</p>";
        echo "<p></p><small class='small-date'>发布于" . substr($date, 0, 4) . "-" . substr($date, 4, 2) . "-" . substr($date, 6, 2) . "</small>";
    }
    $listnum-= 1;
}
?>
                    </div>
                </div>
            </div>
			<hr>
        <ul class="pager">            
                <?php require './../assets/footnum.php'; ?>
        </ul>
<div style="height:50px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" style="text-align: center;height: 0;">
        <small style="line-height: 48px;"><p>&copy;<?php echo date('Y'); ?> <?php echo $bname ?></p></small>  
		<small style="line-height: 48px;"><a href="http://www.miitbeian.gov.cn" target="_blank" rel="nofollow"><?php echo $bbeian; ?></a></small>
    </div>
</nav>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<?php 
$cachecontent = Ob_get_contents();
file_put_contents("./../contents/cache/indexp$pagec.html",$cachecontent);
Ob_end_clean(); 
$checkpg+=1;
}
}
}

@session_write_close();
?>

<?php
session_start();
if(!isset($_SESSION['iflogin'])||!isset($_SESSION['username'])||$_SESSION['iflogin']!=="yes"){
	echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
	exit();
}
//初始化
if(!file_exists("first.flag")){
	file_put_contents("first.flag","Already Put");
	mkdir("./../contents");
	mkdir("./../contents/posts");
	mkdir("./../contents/pages");
	mkdir("./../contents/menu");
	mkdir("./../contents/catalog");
	$filestring = '<?php $pnum=0;?>';
	$filestring2 = '<?php $totalpage=1;?>';
    file_put_contents("./../contents/posts/postnum.php", $filestring);
	file_put_contents("./../contents/pages/pagenum.php", $filestring);
	file_put_contents("./../contents/catalog/pagegnum.php", $filestring2);
	mkdir("savedconfig");
	$serverhostpath=str_replace("/admin","",dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]));
	$stringfirst='<?php $bname="极简Blog";$bmeta="这是默认描述";$bhost="'.$serverhostpath.'";$bavatar="http://static.hdslb.com/images/member/noface.gif";?>';
	file_put_contents("savedconfig/blogconfig.php",$stringfirst);
	echo "<script>alert('初始化完毕！');</script>";
}
require "savedconfig/blogconfig.php";
session_write_close();
?>
<head>
<link rel="stylesheet" href="./../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="./../assets/css/pygments.css">
<title>Blog-后台管理</title>
</head>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron well">
                    <h1>
					Blog Admin
				    </h1>
                    <p class="lead">
                    这里是BottleBlog管理后台
                    </p>
					<p><button type="button" class="btn btn-success" onclick="resetpass()">修改密码</button>&nbsp;
					<button type="button" class="btn btn-danger" onclick="logout()">登出</button></p>
                </div>
            </div>
        </div>
    </div>
	<center>
	<hr>
	<form action="postset.php" method="post">
	<div class="panel-body" style="max-width:500px;">
                        <h2>
						    <p>Blog名称</p>
				    	</h2>
                        <p>
                            </p><p><input type="text" class="form-control" id="blogname" name="blogname" placeholder="请输入名称" value="<?php echo $bname ?>"></p>
                        <p></p>
						<hr>
						<h2>
						    <p>Blog简介</p>
				    	</h2>
                        <p>
                            </p><p><input type="text" class="form-control" id="blogtalk" name="blogtalk" placeholder="请输入简介" value="<?php echo $bmeta ?>"></p>
                        <p></p>
						<hr>
						<h2>
						    <p>Blog站点地址</p>
				    	</h2>
                        <p>
                            </p><p><input type="text" class="form-control" id="bloghost" name="bloghost" placeholder="(例)http://localhost(末尾不带/)" value="<?php echo $bhost ?>"></p>
                        <p></p>
						<hr>
						<h2>
						    <p>Blog头像地址</p>
				    	</h2>
                        <p>
                            </p><p><input type="text" class="form-control" id="blogavatar" name="blogavatar" placeholder="请输入网络头像地址" value="<?php echo $bavatar ?>"></p>
                        <p></p>
						<p><button type="submit" class="btn btn-default">保存</button></p>
						<hr>
						<p><a href="editposts.php" target="_self">编辑文章</a>  或者  <a href="editpages.php" target="_self">编辑页面</a>  或者  <a href="editmenus.php" target="_self">编辑菜单</a></p>
	</div>
	</form>
	</center>
	<script>
	function logout(){
		window.open('./bottlelogin/logout.php','_self');
	}
	function resetpass(){
		window.open('./bottlelogin/editpass.php','_self');
	}
	</script>
<script src="./../assets/js/jquery.min.js"></script>
<script src="./../assets/js/bootstrap.min.js"></script>
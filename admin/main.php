<?php
@session_start();
require './bottlelogin/checker.php';
checkloginadmin();
date_default_timezone_set('Asia/Shanghai');
//初始化
if(!file_exists("first.flag")){
	file_put_contents("first.flag","Already Put");
	mkdir("./../contents");
	mkdir("./../contents/posts");
	mkdir("./../contents/pages");
	mkdir("./../contents/menu");
	mkdir("./../contents/catalog");
	mkdir("./../contents/tags");
	mkdir("./../contents/cache");
	$firstpost='<?php $title="Hello World";$content="<p>这是一个利用船新的博客系统——BottleBlog发布的一篇文章哦~Hello World!</p>";$date="'.date("Ymd").'";$tag="日常";$wzid="wzpost0"; ?>';
	$filestring = '<?php $pnum=1;?>';
	$filestring2 = '<?php $totalpage=1;$pagen1="0-1";?>';
    file_put_contents("./../contents/posts/post0.php", $firstpost);
    file_put_contents("./../contents/posts/postnum.php", $filestring);
	file_put_contents("./../contents/pages/pagenum.php", $filestring);
	file_put_contents("./../contents/catalog/pagegnum.php", $filestring2);
	mkdir("savedconfig");
	$serverhostpath=str_replace("/admin","",dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]));
	$stringfirst='<?php $bname="极简Blog";$bmeta="这是默认描述";$bhost="'.$serverhostpath.'";$bavatar="http://static.hdslb.com/images/member/noface.gif";$bbeian=""; ?>';
	file_put_contents("savedconfig/blogconfig.php",$stringfirst);
	echo "<script>alert('初始化完毕！');</script>";
}
require "savedconfig/blogconfig.php";
@session_write_close();
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<link rel="stylesheet" href="./../assets/css/bootstrap.min.css">
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
					<button type="button" class="btn btn-info" onclick="cacheclear()">清除缓存</button>&nbsp;
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
						<h2>
						    <p>Blog备案号(如果有)</p>
				    	</h2>
                        <p>
                            </p><p><input type="text" class="form-control" id="blogbeian" name="blogbeian" placeholder="请输入备案号" value="<?php echo $bbeian ?>"></p>
                        <p></p>
						<p><button type="submit" class="btn btn-default">保存</button></p>
						<hr>
						<p><a href="editposts.php" target="_self">编辑文章</a>  或者  <a href="editpages.php" target="_self">编辑页面</a>  或者  <a href="editmenus.php" target="_self">编辑菜单</a>  或者  <a href="precache.php" target="_self">预缓存</a></p>
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
	function cacheclear(){
		if(confirm('真的要清除缓存吗？')){
			window.open('cacheclear.php','_self');
		}
	}
	</script>
<script src="./../assets/js/jquery.min.js"></script>
<script src="./../assets/js/bootstrap.min.js"></script>
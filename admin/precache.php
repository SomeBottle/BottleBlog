<?php
@session_start();
require_once './bottlelogin/o.php';
checklogin();
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
                    预缓存内容
                    </p>
                </div>
            </div>
        </div>
    </div>
	<center>
	<hr>
	<div class="panel-body" style="max-width:500px;">   
	                    <h2>
						预缓存文章
						</h2>
						<p>Precached Contents</p>
						<hr>
						<p>注意：如果你的文章和页面有很多，这可能会耗费你一点时间，还有你的服务器资源</p>
						<p id='status'></p>
						<p><button type="button" id='startcache' class="btn btn-default">点我开始预缓存</button></p>
						<hr>
						<ul>
						<li>开始新的一轮预缓存时，会自动删除所有缓存文件.</li>
						<li>预缓存期间请不要关闭该页面.</li>
						</ul>
						<hr>
						<p>&copy SomeBottle.</p>
						<p><a href="main.php" target="_self">返回</a></p>
						<p><iframe src="" id="maincontrol" style="display:none;"></iframe></p>
	</div>
<script src="./../assets/js/jquery.min.js"></script>
<script src="./js/precache.js"></script>
<script src="./../assets/js/bootstrap.min.js"></script>
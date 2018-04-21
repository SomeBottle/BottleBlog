<?php
@session_start();
require './bottlelogin/checker.php';
checkloginadmin();
$editpage="";
$rtitle="";
$rcontent="";
$rtag="";
$rdate="";
if(!empty($_GET['edit'])){
	$editpage=str_replace("id","",$_GET['edit']);
	if(!file_exists("./../contents/pages/page$editpage.php")){
		echo "<script>alert('页面读取失败！');window.open('editpages.php','_self');</script>";
		exit();
	}else{
		require "./../contents/pages/page$editpage.php";
		$rtitle=$title;
		$rcontent=$content;
		$rtag=$pagelink;
		$rdate=$date;
	}
}
date_default_timezone_set('Asia/Shanghai');

@session_write_close();
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script>/*容错代码*/window.onerror=function(){return true;} </script>
<link rel="stylesheet" href="./../assets/css/bootstrap.min.css">
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
                    管理页面
                    </p>
                </div>
            </div>
        </div>
    </div>
	<center>
	<hr>
	<div class="panel-body" style="max-width:900px;">
	<h2>
						    <p>编辑页面</p>
							<p><?php if(!empty($_GET['edit'])){?>&nbsp;<button type="button" class="btn btn-success" onclick="createnew()">新建页面</button><?php }?></p>
							</h2>
							<?php if(empty($_GET['edit'])){ echo "<p>-新页面</p>";}else{echo "页面id：$editpage";}?>
							<p><input type="text" class="form-control" id="pagetitle" name="pagetitle" placeholder="标题" value="<?php echo $rtitle;?>"></p>
						<div id="editor">
						<textarea class="form-control" rows="9" name="mainc" id="mainc" placeholder="开始编写你的页面吧！支持Markdown和HTML"><?php echo htmlspecialchars_decode($rcontent); ?></textarea>
                      </div>
					  <p><input type="text" class="form-control" id="pagetag" name="pagetag" placeholder="页面英文链接(例：somebottle)" value="<?php echo $rtag;?>"></p>
					  <p><input type="hidden" class="form-control" id="pagedate" name="pagedate" placeholder="日期（格式：20180324）" value="<?php if(!empty($rdate)){echo $rdate;}else{echo date("Ymd");}?>"></p>
					  <p>&nbsp;</p>
					  <p><button type="submit" class="btn btn-default" onclick="submit()">发布</button>&nbsp;<button type="button" class="btn btn-success" onclick="template()">模板</button>&nbsp;<button type="button" class="btn btn-primary" onclick="saves()">保存草稿</button>&nbsp;<button type="button" class="btn btn-danger" onclick="readsaves()">读取草稿</button>&nbsp;<button type="button" class="btn btn-info" onclick="tool()">工具箱</button><?php if(!empty($_GET['edit'])){?>&nbsp;<button type="button" class="btn btn-danger" onclick="deletepage(<?php echo $editpage;?>)">删除页面</button><?php }?></p>
					  <div id='toolbox'>
					    <hr><h2>撰写工具</h2>
						<p><div id='showmain' style='max-height:80px'></div></p>
						<p><strong>上传图片</strong></p><p>
						<form action="https://sm.ms/api/upload" id="fileinfo" method="post"
enctype="multipart/form-data">
<input type="file" name="smfile" id="smfile" /> 
<input type="hidden" name="ssl" value="true"></input>
<input type="hidden" name="format" value="json"></input>
<br />
</form></p>
					  </div>
	<hr>
                        <h2>
						    <p>页面列表</p>
				    	</h2>
<?php
require "./../contents/pages/pagenum.php";
$snum=$pnum;
while($snum>=0){
	if(file_exists("./../contents/pages/page$snum.php")){
	require "./../contents/pages/page$snum.php";
	echo "<p><a href='editpages.php?edit=id$snum' target='_self'>$title</a></p>";
	}
	$snum-=1;
}
?>
						<hr>
						<p><a href="main.php" target="_self">返回</a></p>
	</div>
	</center>
<script src="./js/adminpage.js"></script>
<form id="subform" action="compile.php?type=pages&edit=<?php if(empty($_GET['edit'])){echo "new";}else{echo "id".$editpage;}?>" method="post">
<input type="hidden" id="contentp" name="content"></input>
<input type="hidden" id="tagp" name="tag"></input>
<input type="hidden" id="datep" name="date"></input>
<input type="hidden" id="titlep" name="title"></input>
</form>
<script>
					   function uppic(){
						   window.open('smup.html','_blank');
					   }
						</script>
<script src="./../assets/js/jquery.min.js"></script>
<script src="./../assets/js/bootstrap.min.js"></script>
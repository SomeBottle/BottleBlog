<?php
@session_start();
require './bottlelogin/checker.php';
checkloginadmin();
if (!file_exists("./../contents/pages/pagenum.php")) {
    $filestring = '<?php $pnum=0;?>';
    file_put_contents("./../contents/pages/pagenum.php", $filestring);
}
$editpost = "";
$rtitle = "";
$rcontent = "";
$rtag = "";
$rdate = "";
$rwzid = "";
require "./../contents/posts/postnum.php";
if (!empty($_GET['edit'])) {
    $editpost = str_replace("id", "", $_GET['edit']);
    if (!file_exists("./../contents/posts/post$editpost.php")) {
        echo "<script>alert('文章读取失败！');window.open('editposts.php','_self');</script>";
        exit();
    } else {
        require "./../contents/posts/post$editpost.php";
        $rtitle = $title;
        $rcontent = $content;
        $rtag = $tag;
        $rdate = $date;
        $rwzid = $wzid;
    }
} else {
    $rwzid = "wzpost" . $pnum;
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
                    管理文章
                    </p>
                </div>
            </div>
        </div>
    </div>
	<center>
	<hr>
	<div class="panel-body" style="max-width:900px;">
	<h2>
						    <p>编辑文章</p>
							<p><?php if (!empty($_GET['edit'])) { ?>&nbsp;<button type="button" class="btn btn-success" onclick="createnew()">新建文章</button><?php
} ?></p>
							</h2>
							<?php if (empty($_GET['edit'])) {
    echo "<p>-新文章</p>";
} else {
    echo "文章id：$editpost";
} ?>
							<p><input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="标题" value="<?php echo $rtitle; ?>"></p>
						<div id="editor">
						<textarea class="form-control" rows="9" name="mainc" id="mainc" placeholder="开始撰写你的文章吧！支持Markdown和HTML"><?php echo htmlspecialchars_decode($rcontent); ?></textarea>
                      </div>
					  <!--
					  <label>代码(实时)：</label>
					  <p><textarea class="form-control" rows="3" name="psdaima" id="psdaima" oninput="calling()"></textarea></p>
					  -->
					  <p><input type="text" class="form-control" id="posttag" name="posttag" placeholder="标签（英文逗号分隔）" value="<?php echo $rtag; ?>"></p>
					  <p><input type="text" class="form-control" id="postdate" name="postdate" placeholder="日期（格式：20180324）" value="<?php if (!empty($rdate)) {
    echo $rdate;
} else {
    echo date("Ymd");
} ?>"></p>
					  <p>&nbsp;</p>
					  <p><button type="submit" class="btn btn-default" onclick="submit()">发布</button>&nbsp;<button type="button" class="btn btn-primary" onclick="saves()">保存草稿</button>&nbsp;<button type="button" class="btn btn-danger" onclick="readsaves()">读取草稿</button>&nbsp;<button type="button" class="btn btn-info" onclick="tool()">工具箱</button><?php if (!empty($_GET['edit'])) { ?>&nbsp;<button type="button" class="btn btn-danger" onclick="deletepost(<?php echo $editpost; ?>)">删除文章</button><?php
} ?></p>
					  <div id='toolbox'>
					    <hr><h2>撰写工具</h2>
						<p><div id='showmain' style='max-height:80px'></div></p>
						<p>上传图片</p><p>
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
						    <p>文章列表</p>
							<form action="editposts.php" method="post">
							 <p><input type="text" style="max-width:300px;" class="form-control" id="search" name="search" placeholder="搜索（回车）" ></p>
							 </form>
				    	</h2>
<?php
$snum = $pnum;
$maxnum = $snum - 10;
if (empty($_POST['search'])) {
    if ($maxnum > 0) {
        while ($snum >= $maxnum) {
            if (file_exists("./../contents/posts/post$snum.php")) {
                require "./../contents/posts/post$snum.php";
                echo "<p><a href='editposts.php?edit=id$snum' target='_self'>$title</a></p>";
            }
            $snum-= 1;
        }
        echo "<p>等$pnum 篇文章</p>";
    } else {
        while ($snum >= 0) {
            if (file_exists("./../contents/posts/post$snum.php")) {
                require "./../contents/posts/post$snum.php";
                echo "<p><a href='editposts.php?edit=id$snum' target='_self'>$title</a></p>";
            }
            $snum-= 1;
        }
    }
} else {
    while ($snum >= 0) {
        if (file_exists("./../contents/posts/post$snum.php")) {
            require "./../contents/posts/post$snum.php";
            if (strpos($title, $_POST['search']) !== false || strpos($content, $_POST['search'] !== false)) {
                echo "<p><a href='editposts.php?edit=id$snum' target='_self'>$title</a></p>";
            }
        }
        $snum-= 1;
    }
}
?>
						<hr>
						<p><a href="main.php" target="_self">返回</a></p>
	</div>
	</center>
<script src="./js/adminpost.js"></script>
<form id="subform" action="compile.php?type=posts&edit=<?php if (empty($_GET['edit'])) {
    echo "new";
} else {
    echo "id" . $editpost;
} ?>" method="post">
<input type="hidden" id="contentp" name="content"></input>
<input type="hidden" id="tagp" name="tag"></input>
<input type="hidden" id="datep" name="date"></input>
<input type="hidden" id="titlep" name="title"></input>
<input type="hidden" name="wzidp" value="<?php echo $rwzid; ?>"></input>
</form>
<script>
					   function uppic(){
						   window.open('smup.html','_blank');
					   }
						</script>
<script src="./../assets/js/jquery.min.js"></script>
<script src="./../assets/js/bootstrap.min.js"></script>
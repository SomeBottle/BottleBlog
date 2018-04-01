<?php
session_start();
if (!isset($_SESSION['iflogin']) || !isset($_SESSION['username']) || $_SESSION['iflogin'] !== "yes") {
    echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
    exit();
}
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
session_write_close();
?>
<head>
<link rel="stylesheet" href="./../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="./../assets/css/pygments.css">
<script type="text/javascript" src="./editor/wangEditor.min.js"></script>
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
						<?php echo $rcontent; ?>
                      </div>
					  <p><input type="text" class="form-control" id="posttag" name="posttag" placeholder="标签（英文逗号分隔）" value="<?php echo $rtag; ?>"></p>
					  <p><input type="text" class="form-control" id="postdate" name="postdate" placeholder="日期（格式：20180324）" value="<?php if (!empty($rdate)) {
    echo $rdate;
} else {
    echo date("Ymd");
} ?>"></p>
					  <p>&nbsp;</p>
					  <p><button type="submit" class="btn btn-default" onclick="submit()">发布</button>&nbsp;<button type="button" class="btn btn-primary" onclick="saves()">保存草稿</button>&nbsp;<button type="button" class="btn btn-danger" onclick="readsaves()">读取草稿</button><?php if (!empty($_GET['edit'])) { ?>&nbsp;<button type="button" class="btn btn-danger" onclick="deletepost(<?php echo $editpost; ?>)">删除文章</button><?php
} ?></p>
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
<script src="admin.js"></script>
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
<script src="./../assets/js/jquery.min.js"></script>
<script src="./../assets/js/bootstrap.min.js"></script>
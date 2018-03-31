<?php
session_start();
if (!isset($_SESSION['iflogin']) || !isset($_SESSION['username']) || $_SESSION['iflogin'] !== "yes") {
    echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
    exit();
}
date_default_timezone_set('Asia/Shanghai');
$dotype = $_GET['type'];
$title=$_POST['title'];
$tag=$_POST['tag'];
$content=$_POST['content'];
$date=$_POST['date'];
$status=$_GET['edit'];
$wzids=$_POST['wzidp'];
if(empty($dotype)||empty($title)||empty($tag)||empty($content)||empty($date)||empty($status)){
	echo "<script>alert('请不要留空！');window.open('main.php','_self');</script>";
	exit();
}
if ($dotype == "posts") {
    if (!file_exists("./../contents/posts/postnum.php")) {
        $filestring = '<?php $pnum=0;?>';
        file_put_contents("./../contents/posts/postnum.php", $filestring);
    }
    require "./../contents/posts/postnum.php";
	$poststring='<?php $title="'.$title.'";$content="'.$content.'";$date="'.$date.'";$tag="'.$tag.'";$wzid="'.$wzids.'"; ?>';
	if($status=="new"){//如果是发布新文章
	file_put_contents("./../contents/posts/post$pnum.php", $poststring);
	$newpnum=$pnum+1;
	$filestring = '<?php $pnum='.$newpnum.';?>';
	file_put_contents("./../contents/posts/postnum.php", $filestring);
	}else{//只是编辑文章而已~~
		$editnum=str_replace("id","",$status);
		file_put_contents("./../contents/posts/post$editnum.php", $poststring);
	}
	//检查日期
require "datechange.php";
//生成伪静态页码
require "pagenumber.php";
}else if ($dotype == "pages") {
    require "./../contents/pages/pagenum.php";
	$checkrepeat=0;
	$pagestring='<?php $title="'.$title.'";$content="'.$content.'";$date="'.$date.'";$pagelink="'.$tag.'";?>';
	if($status=="new"){//如果是发布新页面
	while($checkrepeat<=$pagenum){
		include("./../contents/pages/page$checkrepeat.php");
		if($pagelink==$tag){
			echo "<script>alert('你与id为$checkrepeat 的页面的英文链接撞车了！');window.open('editpages.php','_self');</script>";
			exit();
		}
		$checkrepeat+=1;
	}
	file_put_contents("./../contents/pages/page$pnum.php", $pagestring);
	$newpnum=$pnum+1;
	$filestring = '<?php $pnum='.$newpnum.';?>';
	file_put_contents("./../contents/pages/pagenum.php", $filestring);
	}else{//只是编辑页面而已~~
		$editnum=str_replace("id","",$status);
		file_put_contents("./../contents/pages/page$editnum.php", $pagestring);
	}
}
session_write_close();
?>
<h2>正在发布文章or页面</h2>
<?php if($dotype=="posts"){?>
<script>alert('success!');window.open('editposts.php','_self');</script>
<?php }else if ($dotype = "pages") {  ?>
<script>alert('success!');window.open('editpages.php','_self');</script>
<?php } ?>
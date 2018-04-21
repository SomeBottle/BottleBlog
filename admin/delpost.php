<?php
@session_start();
require './bottlelogin/checker.php';
checkloginadmin();
$delpost=$_GET['postid'];
	if(!file_exists("./../contents/posts/post$delpost.php")){
		echo "<script>alert('文章删除失败！');window.open('editposts.php','_self');</script>";
		exit();
	}else{
		require "./../contents/posts/postnum.php";
		unlink("./../contents/posts/post$delpost.php");
		$snum=$delpost+1;
		while($snum<=$pnum){
			if(file_exists("./../contents/posts/post$snum.php")){
			require "./../contents/posts/post$snum.php";
			$lastfile=$snum-1;
			$rtitle=$title;
			$rcontent=$content;
			$rtag=$tag;
			$rdate=$date;
			$rwzid=$wzid;
			$rpoststring='<?php $title="'.$rtitle.'";$content="'.$rcontent.'";$date="'.$rdate.'";$tag="'.$rtag.'";$wzid="'.$rwzid.'"; ?>';
			file_put_contents("./../contents/posts/post$lastfile.php", $rpoststring);
			}
			$snum+=1;
		}
		unlink("./../contents/posts/post".($pnum-1).".php");
		$newpnum=$pnum-1;
	    $filestring = '<?php $pnum='.$newpnum.';?>';
	    file_put_contents("./../contents/posts/postnum.php", $filestring);
		//检查日期
		//require "datechange.php";
		//生成伪静态页码
require "pagenumber.php";
	}
date_default_timezone_set('Asia/Shanghai');
@session_write_close();
?>
<script>alert('删除完成~');window.open('editposts.php','_self');</script>
<h1>正在删除文章...</h1>
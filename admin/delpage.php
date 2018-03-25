<?php
session_start();
if(!isset($_SESSION['iflogin'])||!isset($_SESSION['username'])||$_SESSION['iflogin']!=="yes"){
	echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
	exit();
}
$delpage=$_GET['pageid'];
	if(!file_exists("./../contents/pages/page$delpage.php")){
		echo "<script>alert('页面删除失败！');window.open('editpages.php','_self');</script>";
		exit();
	}else{
		require "./../contents/pages/pagenum.php";
		unlink("./../contents/pages/page$delpage.php");
		$snum=$delpage+1;
		while($snum<=$pnum){
			if(file_exists("./../contents/pages/page$snum.php")){
			require "./../contents/pages/page$snum.php";
			$lastfile=$snum-1;
			$rtitle=$title;
			$rcontent=$content;
			$rtag=$pagelink;
			$rdate=$date;
			$rpagestring='<?php $title="'.$rtitle.'";$content="'.$rcontent.'";$date="'.$rdate.'";$pagelink="'.$rtag.'";?>';
			file_put_contents("./../contents/pages/page$lastfile.php", $rpagestring);
			}
			$snum+=1;
		}
		unlink("./../contents/pages/page".($pnum-1).".php");
		$newpnum=$pnum-1;
	    $filestring = '<?php $pnum='.$newpnum.';?>';
	    file_put_contents("./../contents/pages/pagenum.php", $filestring);
	}
date_default_timezone_set('Asia/Shanghai');
session_write_close();
?>
<script>alert('删除完成~');window.open('editpages.php','_self');</script>
<h1>正在删除页面...</h1>
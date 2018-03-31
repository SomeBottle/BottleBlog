<?php
if(!isset($_SESSION['iflogin'])||!isset($_SESSION['username'])||$_SESSION['iflogin']!=="yes"){
	echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
	exit();
}
/*此为日期检查排序器
SomeBottle*/
		require "./../contents/posts/postnum.php";
		$checknum=$pnum;
		while($checknum>=0){
		$snum=0;
		while($snum<=($pnum-1)){
			if(file_exists("./../contents/posts/post$snum.php")){
			require "./../contents/posts/post$snum.php";
			$rtitle=$title;
			$rcontent=$content;
			$rtag=$tag;
			$rdate=$date;
			$rwzid=$wzid;
			$rpoststring='<?php $title="'.$rtitle.'";$content="'.$rcontent.'";$date="'.$rdate.'";$tag="'.$rtag.'";$wzid="'.$rwzid.'"; ?>';
			@include("./../contents/posts/post".($snum+1).".php");
			$r2title=$title;
			$r2content=$content;
			$r2tag=$tag;
			$r2date=$date;
			$r2wzid=$wzid;
			$r2poststring='<?php $title="'.$r2title.'";$content="'.$r2content.'";$date="'.$r2date.'";$tag="'.$r2tag.'";$wzid="'.$r2wzid.'"; ?>';
			if($rdate>$r2date){
				file_put_contents("./../contents/posts/post$snum.php", $r2poststring);
				file_put_contents("./../contents/posts/post".($snum+1).".php", $rpoststring);
			}
			}
			$snum+=1;
		}
		$checknum-=1;
		}
date_default_timezone_set('Asia/Shanghai');
?>
<h1>正在排列日期...</h1>
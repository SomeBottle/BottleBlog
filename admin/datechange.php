<?php
if (!isset($_SESSION['iflogin']) || !isset($_SESSION['username']) || $_SESSION['iflogin'] !== "yes") {
    echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
    exit();
}
/*此为日期检查排序器
 SomeBottle*/
require "./../contents/posts/postnum.php";
if ($posttype == "new") { //如果是新文章
    $realpnum = $pnum - 2;
    $rpostdate = $date;
    require "./../contents/posts/post$realpnum.php";
    if (intval($rpostdate) < intval($date)) {//如果日期有差别
        $checknum = $pnum;
        while ($checknum >= 0) {
            $snum = ($pnum - 1);
            while ($snum >=0) {
                if (file_exists("./../contents/posts/post$snum.php")) {
                    require "./../contents/posts/post$snum.php";
                    $rtitle = $title;
                    $rcontent = $content;
                    $rtag = $tag;
                    $rdate = $date;
                    $rwzid = $wzid;
                    $rpoststring = '<?php $title="' . $rtitle . '";$content="' . $rcontent . '";$date="' . $rdate . '";$tag="' . $rtag . '";$wzid="' . $rwzid . '"; ?>';
                    @include ("./../contents/posts/post" . ($snum + 1) . ".php");
                    $r2title = $title;
                    $r2content = $content;
                    $r2tag = $tag;
                    $r2date = $date;
                    $r2wzid = $wzid;
                    $r2poststring = '<?php $title="' . $r2title . '";$content="' . $r2content . '";$date="' . $r2date . '";$tag="' . $r2tag . '";$wzid="' . $r2wzid . '"; ?>';
                    if ($rdate > $r2date) {
                        file_put_contents("./../contents/posts/post$snum.php", $r2poststring);
                        file_put_contents("./../contents/posts/post" . ($snum + 1) . ".php", $rpoststring);
                    }else if ($rdate < $r2date) {
                        break;
                    }
                }
                $snum-= 1;
            }
            $checknum-= 1;
        }
    }
}  else { //如果是编辑文章
$editnum=str_replace("id","",$status);
echo "<h1>$editnum</h1>";
$half=ceil($pnum/2);
    $checknum = $pnum;
	$stops=0;
	$findnum=0;
    while ($checknum >= 0&&$stops!==1) {
        $snum = 0;
        while ($snum <=($pnum - 1)) {
            if (file_exists("./../contents/posts/post$snum.php")) {
                require "./../contents/posts/post$snum.php";
                $rtitle = $title;
                $rcontent = $content;
                $rtag = $tag;
                $rdate = $date;
                $rwzid = $wzid;
                $rpoststring = '<?php $title="' . $rtitle . '";$content="' . $rcontent . '";$date="' . $rdate . '";$tag="' . $rtag . '";$wzid="' . $rwzid . '"; ?>';
                @include ("./../contents/posts/post" . ($snum + 1) . ".php");
                $r2title = $title;
                $r2content = $content;
                $r2tag = $tag;
                $r2date = $date;
                $r2wzid = $wzid;
                $r2poststring = '<?php $title="' . $r2title . '";$content="' . $r2content . '";$date="' . $r2date . '";$tag="' . $r2tag . '";$wzid="' . $r2wzid . '"; ?>';
                if ($rdate > $r2date) {
                    file_put_contents("./../contents/posts/post$snum.php", $r2poststring);
                    file_put_contents("./../contents/posts/post" . ($snum + 1) . ".php", $rpoststring);
                }
            }
            $snum+= 1;
        }
		if(file_exists("./../contents/posts/post$checknum.php")) {
		require "./../contents/posts/post$checknum.php";
		$rdate = $date;
		@include ("./../contents/posts/post" . ($checknum + 1) . ".php");
		$r2date = $date;
		if ($rdate < $r2date) {
                    $stops=1;
                }
		}
        $checknum-= 1;
    }
	$checknum = $pnum;
	$stops=0;
	$findnum=0;
	    while ($checknum >= 0&&$stops!==1) {
        $snum = ($pnum - 1);
        while ($snum >=0) {
            if (file_exists("./../contents/posts/post$snum.php")) {
                require "./../contents/posts/post$snum.php";
                $rtitle = $title;
                $rcontent = $content;
                $rtag = $tag;
                $rdate = $date;
                $rwzid = $wzid;
                $rpoststring = '<?php $title="' . $rtitle . '";$content="' . $rcontent . '";$date="' . $rdate . '";$tag="' . $rtag . '";$wzid="' . $rwzid . '"; ?>';
                @include ("./../contents/posts/post" . ($snum + 1) . ".php");
                $r2title = $title;
                $r2content = $content;
                $r2tag = $tag;
                $r2date = $date;
                $r2wzid = $wzid;
                $r2poststring = '<?php $title="' . $r2title . '";$content="' . $r2content . '";$date="' . $r2date . '";$tag="' . $r2tag . '";$wzid="' . $r2wzid . '"; ?>';
                if ($rdate > $r2date) {
                    file_put_contents("./../contents/posts/post$snum.php", $r2poststring);
                    file_put_contents("./../contents/posts/post" . ($snum + 1) . ".php", $rpoststring);
                }
            }
            $snum-= 1;
        }
		if(file_exists("./../contents/posts/post$checknum.php")) {
		require "./../contents/posts/post$checknum.php";
		$rdate = $date;
		@include ("./../contents/posts/post" . ($checknum + 1) . ".php");
		$r2date = $date;
		if ($rdate < $r2date) {
                    $stops=1;
                }
		}
        $checknum-= 1;
    }
}
date_default_timezone_set('Asia/Shanghai');
?>
<h1>正在排列日期...</h1>
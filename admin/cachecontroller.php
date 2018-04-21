<?php
@session_start();
require_once './../assets/core.php';
date_default_timezone_set('Asia/Shanghai');
$givepost = $_GET['step'];
$result = "";
require './bottlelogin/checker.php';
checkloginadmin();
    if (intval($givepost) == 1) { //如果是缓存文章
        echo "<script>window.parent.document.getElementById('status').innerHTML='状态：文章已经缓存完毕，正在准备缓存页面';window.parent.document.getElementById('status').style='color:red;';window.open('cachecontroller.php?step=2','_self');</script>";
        require "./../contents/posts/postnum.php";
        $checknum = 0;
        while ($checknum <= $pnum) {
?>
		<?php
            $postid = $checknum;
            $gettype='post';
            Ob_start();
            require themeurl('index.php');
			$cachecontent = Ob_get_contents();
            file_put_contents("./../contents/cache/post$postid.html", $cachecontent);
            Ob_end_clean();
            $checknum+= 1;
        }
        $result = "yes";
    } else if (intval($givepost) == 2) { //如果是缓存页面
        echo "<script>window.parent.document.getElementById('status').innerHTML='状态：页面已经缓存完毕，正在准备缓存index页面';window.parent.document.getElementById('status').style='color:red;';window.open('cachecontroller.php?step=3','_self');</script>";
        require "./../contents/pages/pagenum.php";
        $checknum = 0;
        while ($checknum <= $pnum) {
            $gettype='page';
			require "./../contents/pages/page$checknum.php";
			$pageid=$pagelink;
            Ob_start();
            require themeurl('index.php');
            $cachecontent = Ob_get_contents();
            file_put_contents("./../contents/cache/page$pageid.html", $cachecontent);
            Ob_end_clean();
            $checknum+= 1;
        }
    } else if (intval($givepost) == 3) { //如果是缓存页面索引index
        $checkpg = 1;
		require "./../contents/catalog/pagegnum.php";
        echo "<script>window.parent.document.getElementById('status').innerHTML='状态：所有页面预缓存完成！';window.parent.document.getElementById('status').style='color:green;';//window.open('none','_self');window.parent.document.getElementById('startcache').innerHTML='预缓存完毕，你可以返回..';</script>";
        $gettype='index';
        date_default_timezone_set('Asia/Shanghai');
        while ($checkpg <= $totalpage) {
            $pagec = $checkpg;
            Ob_start();
            require themeurl('index.php');
            $cachecontent = Ob_get_contents();
            file_put_contents("./../contents/cache/indexp$pagec.html", $cachecontent);
            Ob_end_clean();
            $checkpg+= 1;
        }
    }
@session_write_close();
?>

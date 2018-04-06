<?php
@session_start();
require_once './../assets/core.php';
date_default_timezone_set('Asia/Shanghai');
$givepost = $_GET['step'];
$result = "";
if (!isset($_SESSION['iflogin']) || !isset($_SESSION['username']) || $_SESSION['iflogin'] !== "yes") {
    $result = "no";
} else {//允许缓存
if(intval($givepost)==1){//如果是缓存文章
echo "<script>window.parent.document.getElementById('status').innerHTML='状态：文章已经缓存完毕，正在准备缓存页面';window.parent.document.getElementById('status').style='color:red;';window.open('cachecontroller.php?step=2','_self');</script>";
    require "./../contents/posts/postnum.php";
    $checknum = 0;
    while ($checknum <= $pnum) {
?>
		<?php
		require "./savedconfig/blogconfig.php";
$postid = $checknum;
	Ob_start();
    @require "./../contents/posts/post$postid.php";
    $GLOBALS['rtitle'] = $title;
    $GLOBALS['rcontent'] = $content;
    $GLOBALS['rtag'] = $tag;
    $GLOBALS['rdate'] = $date;
    $GLOBALS['rwzid'] = $wzid;
        if (!file_exists("./../contents/menu/menus.php")) {
            $stringset = '<?php $menudm="' . "&nbsp;<a class='navbar-brand' href='index.php'>首页</a>" . '";?>';
            file_put_contents("./contents/menu/menus.php", $stringset);
        }
        require "./../contents/menu/menus.php";
require themeurl('header.php');
require themeurl('post.php');
require themeurl('footer.php');
$cachecontent = Ob_get_contents();
file_put_contents("./../contents/cache/post$postid.html",$cachecontent);
Ob_end_clean(); 
        $checknum+= 1;
    }

    $result = "yes";
}else if(intval($givepost)==2){//如果是缓存页面
echo "<script>window.parent.document.getElementById('status').innerHTML='状态：页面已经缓存完毕，正在准备缓存index页面';window.parent.document.getElementById('status').style='color:red;';window.open('cachecontroller.php?step=3','_self');</script>";
    require "./../contents/pages/pagenum.php";
	require "./savedconfig/blogconfig.php";
	require "./../contents/menu/menus.php";
    $checknum = 0;
	while ($checknum <= $pnum) {
		@require "./../contents/pages/page$checknum.php";
		Ob_start();
    $GLOBALS['rtitle'] = $title;
    $GLOBALS['rcontent'] = $content;
    $GLOBALS['rtag'] = $pagelink;
    $GLOBALS['rdate'] = $date;
require themeurl('header.php');
require themeurl('page.php');
require themeurl('footer.php');
$cachecontent = Ob_get_contents();
file_put_contents("./../contents/cache/page$rtag.html",$cachecontent);
Ob_end_clean(); 
		$checknum+=1;
	}
}else if(intval($givepost)==3){//如果是缓存页面索引index
$checkpg = 1;
echo "<script>window.parent.document.getElementById('status').innerHTML='状态：所有页面预缓存完成！';window.parent.document.getElementById('status').style='color:green;';window.open('none','_self');window.parent.document.getElementById('startcache').innerHTML='预缓存完毕，你可以返回..';</script>";
require "./savedconfig/blogconfig.php";
require "./../contents/catalog/pagegnum.php";
require "./../contents/menu/menus.php";
date_default_timezone_set('Asia/Shanghai');
while($checkpg<=$totalpage){
	$pagec=$checkpg;
Ob_start();
require themeurl('header.php');
require themeurl('index.php');
require themeurl('footer.php');
$cachecontent = Ob_get_contents();
file_put_contents("./../contents/cache/indexp$pagec.html",$cachecontent);
Ob_end_clean(); 
$checkpg+=1;
}
}
}

@session_write_close();
?>

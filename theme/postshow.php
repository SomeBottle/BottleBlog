 <?php
 $searchfm = @$_GET['search'];
     //文章显示Core
require contenturl()."/posts/postnum.php";
$listnum = $pnum;
$realpage = postpagenum();
$testpage = 0;
while ($testpage < (intval(getnowpage()) - 1)) {
    $realpage-= 1;
    $testpage+= 1;
}
$startid = @getxt($ {
    "pagen$realpage"
}, 1);
$endid = @getxt($ {
    "pagen$realpage"
}, 2);

if ($realpage <= 0) {
    echo "<script>alert('页码错误！');window.open('index.php','_self');</script>";
	Ob_end_clean(); 
}
//文章显示结束
if(empty($endid)){
	echo "<hr><h2>";
    echo "<p>暂时还没有文章呢QAQ</p>";
    echo "</h2><p></p>";
}
if ($startid == $endid) { //如果这一页只有一篇文章
    if (file_exists(contenturl()."/posts/post$startid.php")) {
        require contenturl()."/posts/post$startid.php";
		/*模板部分*/?>
        <hr><h2>
        <a href='p.php?id=<?php echo $startid;?>'><?php echo getpostbyid($startid,'title');?></a>
        </h2><p></p>
        <p><?php echo getpostbyid($startid,'shortcontent');?>......</p>
        <p></p><small class='small-date'><?php echo getpostbyid($startid,'date');?></small>
		<?php
    }
}
$listnum = $endid;
while ($listnum >= $startid) {
    if (file_exists(contenturl()."/posts/post$listnum.php")) {
        require contenturl()."/posts/post$listnum.php";
		/*模板部分*/?>
        <hr><h2>
        <a href='p.php?id=<?php echo $listnum;?>'><?php echo getpostbyid($listnum,'title');?></a>
        </h2><p></p>
        <p><?php echo getpostbyid($listnum,'shortcontent');?>......</p>
        <p></p><small class='small-date'><?php echo getpostbyid($listnum,'date');?></small>
		<?php
    }
    $listnum-= 1;
}

?>
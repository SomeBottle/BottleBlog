 <?php
 //文章显示Core
require "./contents/posts/postnum.php";
$listnum = $pnum;
$realpage = $totalpage;
$testpage = 0;
while ($testpage < ($pagec - 1)) {
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
    if (file_exists("./contents/posts/post$startid.php")) {
        require "./contents/posts/post$startid.php";
        echo "<hr><h2>";
        echo "<a href='p.php?id=$startid'>$title</a>";
        echo "</h2><p></p>";
        echo "<p>" . mb_substr(strip_tags($content), 0, 120, "utf-8") . "......</p>";
        echo "<p></p><small class='small-date'>发布于" . substr($date, 0, 4) . "-" . substr($date, 4, 2) . "-" . substr($date, 6, 2) . "</small>";
    }
}
$listnum = $endid;
while ($listnum >= $startid) {
    if (file_exists("./contents/posts/post$listnum.php")) {
        require "./contents/posts/post$listnum.php";
        echo "<hr><h2>";
        echo "<a href='p.php?id=$listnum'>$title</a>";
        echo "</h2><p></p>";
        echo "<p>" . mb_substr(strip_tags($content), 0, 120, "utf-8") . "......</p>";
        echo "<p></p><small class='small-date'>发布于" . substr($date, 0, 4) . "-" . substr($date, 4, 2) . "-" . substr($date, 6, 2) . "</small>";
    }
    $listnum-= 1;
}
?>
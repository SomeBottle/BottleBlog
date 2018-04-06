 <?php
 $searchfm = @$_GET['search'];
 if (empty($searchfm)) {
	 echo "<script>alert('Search Form Require');window.open('index.php','_self');</script>";
}else{
	?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						    Search:<?php echo $_GET['search']; /*搜索获取内容*/?>
						</h3>
                    </div>
	<?php
date_default_timezone_set('Asia/Shanghai');
require contenturl()."/posts/postnum.php";
$tagcheck = $pnum;
$tagout = 0;
while ($tagcheck >= 0) {
    if (file_exists(contenturl()."/posts/post$tagcheck.php")) {
        require contenturl()."/posts/post$tagcheck.php";
        if (strpos($title, $searchfm) !== false || strpos($content, $searchfm) !== false) {
            echo "<hr><h2>";
            echo "<a href='p.php?id=$tagcheck'>$title</a>";
            echo "</h2><p></p>";
            echo "<p>" . mb_substr(strip_tags($content), 0, 120, "utf-8") . "......</p>";
            echo "<p></p><small class='small-date'>发布于". changedate($date) ."</small>";
        }
    }
    $tagcheck-= 1;
}
}
?>
                    </div>
                </div>
            </div>
			<hr>
<?php require themeurl('footer.php'); ?>
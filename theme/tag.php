<?php
date_default_timezone_set('Asia/Shanghai');
$totag = $_GET['tag'];//获得标签
$label = $totag;
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						    Tag:<?php if (!empty($label)) {
    echo $_GET['tag'];
} else {
    echo "All";
} ?>
						</h3>
                    </div>
<?php
if (empty($label)) {
    $tagstring = file_get_contents(contenturl().'/tags/tagall.txt');
    $arr = explode(",", $tagstring);
    $totaltagnum = count($arr) - 1;
    $makenum = 0;
    while ($makenum <= $totaltagnum) {
        echo "<hr><h2>";
        echo "<a href='?tag=" . $arr[$makenum] . "'>" . $arr[$makenum] . "</a>";
        echo "</h2><p></p>";
        $makenum+= 1;
    }
} else {
    date_default_timezone_set('Asia/Shanghai');
    require contenturl()."/posts/postnum.php";
    $tagcheck = $pnum;
    $tagout = 0;
    $echostring = "<h3>标签：$label</h3>";
    while ($tagcheck >= 0) {
        if (file_exists(contenturl()."/posts/post$tagcheck.php")) {
            require contenturl()."/posts/post$tagcheck.php";
            if (strpos($tag, $label) !== false) {
                $echostring = $echostring . "<p>$title</p><p>&nbsp;</p>";
                echo "<hr><h2>";
                echo "<a href='p.php?id=$tagcheck'>$title</a>";
                echo "</h2><p></p>";
                echo "<p>" . mb_substr(strip_tags($content), 0, 120, "utf-8") . "......</p>";
                echo "<p></p><small class='small-date'>发布于$date</small>";
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
<?php
session_start();
if (!isset($_SESSION['iflogin']) || !isset($_SESSION['username']) || $_SESSION['iflogin'] !== "yes") {
    echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
    exit();
}
function valid_date($date) { //日期判断函数
    if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)) {
        if (checkdate($parts[2], $parts[3], $parts[1])) return true;
        else return false;
    } else return false;
}
date_default_timezone_set('Asia/Shanghai');
$dotype = $_GET['type'];
$title = $_POST['title'];
$tag = $_POST['tag'];
$content = $_POST['content'];
$date = $_POST['date'];
$status = $_GET['edit'];
$wzids = $_POST['wzidp'];
if (empty($dotype) || empty($title) || empty($content) || empty($date) || empty($status)) {
    echo "<script>alert('选项请不要留空！（文章TAG留空默认为日常，页面英文链接为空会生成一串随机码）');window.open('main.php','_self');</script>";
    exit();
}
$datestr = substr($date, 0, 4) . "-" . substr($date, 4, 2) . "-" . substr($date, 6, 2);
if (empty($tag) && $dotype == "posts") {
    $tag = '日常';
} else if (empty($tag) && $dotype == "pages") {
    $getrandom = rand(0, 1000);
    $getrandom2 = rand(0, 4000);
    $mainstr = md5('rands' . $getrandom . $getrandom2);
    $tag = $mainstr;
}
if ($dotype == "posts") {
    if (valid_date($datestr) == false) {
        echo "<script>alert('不合法的日期，填写格式：20170810');window.open('editposts.php','_self');</script>";
        exit();
    }
    if (!file_exists("./../contents/posts/postnum.php")) {
        $filestring = '<?php $pnum=0;?>';
        file_put_contents("./../contents/posts/postnum.php", $filestring);
    }
    require "./../contents/posts/postnum.php";
    $poststring = '<?php $title="' . $title . '";$content="' . $content . '";$date="' . $date . '";$tag="' . $tag . '";$wzid="' . $wzids . '"; ?>';
    if ($status == "new") { //如果是发布新文章
        file_put_contents("./../contents/posts/post$pnum.php", $poststring);
        $newpnum = $pnum + 1;
        $GLOBALS['posttype'] = 'new';
        $filestring = '<?php $pnum=' . $newpnum . ';?>';
        file_put_contents("./../contents/posts/postnum.php", $filestring);
    } else { //只是编辑文章而已~~
        $editnum = str_replace("id", "", $status);
        $GLOBALS['posttype'] = 'edit';
        file_put_contents("./../contents/posts/post$editnum.php", $poststring);
    }
    //检查日期
    require "datechange.php";
    //生成伪静态页码
    require "pagenumber.php";
} else if ($dotype == "pages") {
    require "./../contents/pages/pagenum.php";
    $checkrepeat = 0;
    $pagestring = '<?php $title="' . $title . '";$content="' . $content . '";$date="' . $date . '";$pagelink="' . $tag . '";?>';
    if ($status == "new") { //如果是发布新页面
        while ($checkrepeat <= $pagenum) {
            include ("./../contents/pages/page$checkrepeat.php");
            if ($pagelink == $tag) {
                echo "<script>alert('你与id为$checkrepeat 的页面的英文链接撞车了！');window.open('editpages.php','_self');</script>";
                exit();
            }
            $checkrepeat+= 1;
        }
        file_put_contents("./../contents/pages/page$pnum.php", $pagestring);
        $newpnum = $pnum + 1;
        $filestring = '<?php $pnum=' . $newpnum . ';?>';
        file_put_contents("./../contents/pages/pagenum.php", $filestring);
    } else { //只是编辑页面而已~~
        $editnum = str_replace("id", "", $status);
        file_put_contents("./../contents/pages/page$editnum.php", $pagestring);
    }
}
session_write_close();
?>
<h2>正在发布文章or页面</h2>
<?php if ($dotype == "posts") { ?>
<script>
var myDate = new Date();
var rmin=Number(localStorage.fbmintime);
var rsec=Number(localStorage.fbsectime);
var usedmin=myDate.getMinutes()-rmin;
var usedsec=myDate.getSeconds()-rsec+usedmin*60;
alert('success!发布文章耗时'+usedsec+'秒');window.open('editposts.php','_self');
</script>
<?php
} else if ($dotype = "pages") { ?>
<script>
alert('success!');window.open('editpages.php','_self');
</script>
<?php
} ?>
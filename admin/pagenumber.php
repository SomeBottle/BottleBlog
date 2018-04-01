<?php
if (!isset($_SESSION['iflogin']) || !isset($_SESSION['username']) || $_SESSION['iflogin'] !== "yes") {
    echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
    exit();
}
/*页码静态生成器（加快加载速度） SomeBottle*/
require "./../contents/posts/postnum.php";
$checkpage = $pnum;
$pagecontentnum = ceil($checkpage / 8);
echo "PageContentNum:$pagecontentnum";
$pagemorenum = $checkpage % 8;
$filegene = '<?php $totalpage="' . ceil($checkpage / 8) . '";';
$genenum = 1;
$endflag = - 1;
while ($genenum <= $pagecontentnum) {
    $startnum = $endflag + 1;
    $endnum = 0;
    if ($genenum == $pagecontentnum) {
        $endnum = $pnum; //最后一页
        
    } else {
        $endnum = $startnum + 7;
    }
    $filegene = $filegene . '$pagen' . $genenum . '="' . $startnum . '-' . $endnum . '";';
    $endflag = $startnum + 7;
    $genenum+= 1;
}
$filegene = $filegene . ' ?>';
file_put_contents("./../contents/catalog/pagegnum.php", $filegene);
echo "整页数：$pagecontentnum <hr> 余页数:$pagemorenum";
?>
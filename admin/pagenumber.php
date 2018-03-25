<?php 
if (!isset($_SESSION['iflogin']) || !isset($_SESSION['username']) || $_SESSION['iflogin'] !== "yes") {
    echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
    exit();
}
/*页码伪静态生成器（加快加载速度） SomeBottle*/
require "./../contents/posts/postnum.php";
$checkpage=$pnum;
$pagelistnum=8;
$pagecontentnum=floor($checkpage/$pagelistnum);
$pagemorenum=$checkpage%$pagelistnum;
if($pagemorenum!==0&&($pagecontentnum*8+1)!==($pagecontentnum*8+$pagemorenum)){
$filegene='<?php $totalpage='.($pagecontentnum+1).';';
}else if($pnum<8){
	$filegene='<?php $totalpage='.($pagecontentnum+1).';';
}else{
	$filegene='<?php $totalpage='.($pagecontentnum).';';
}
$genenum=1;
$pagebase=0;
while($genenum<=$pagecontentnum){
	$start=$pagebase;
	if($pagebase==0){
	$end=$pagebase+8;//末尾页由0开始
	}else{
		$end=$pagebase+7;
	}
	$filegene=$filegene.'$pagen'.$genenum.'="'.$start.'-'.$end.'";';
	$pagebase+=9;
	$genenum+=1;
}
if($pagecontentnum<1){//一面都没有到
	$filegene=$filegene.'$pagen1="0-'.$pagemorenum.'";';
}else{
	if($pagemorenum!==0&&($pagecontentnum*8+1)!==($pagecontentnum*8+$pagemorenum)){
	$filegene=$filegene.'$pagen'.($genenum).'="'.($pagecontentnum*8+1).'-'.($pagecontentnum*8+$pagemorenum).'";';
	}
}
$filegene=$filegene.'?>';
if(!is_dir("./../contents/catalog")){
	mkdir("./../contents/catalog");
}
file_put_contents("./../contents/catalog/pagegnum.php",$filegene);
echo "整页数：$pagecontentnum <hr> 余页数:$pagemorenum";
?>
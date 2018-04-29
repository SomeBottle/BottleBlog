 <?php
require_once dirname(__FILE__) . '/../admin/savedconfig/blogconfig.php';
function bottlename() {
    global $bname;
    global $bmeta;
    global $bhost;
    global $bavatar;
    global $bbeian;
    $rname = htmlspecialchars($bname);
    return $rname;
}
function bottlemeta() {
    global $bname;
    global $bmeta;
    global $bhost;
    global $bavatar;
    global $bbeian;
    $rmeta = htmlspecialchars($bmeta);
    return $rmeta;
}
function bottlehost() {
    global $bname;
    global $bmeta;
    global $bhost;
    global $bavatar;
    global $bbeian;
    $rhost = htmlspecialchars($bhost);
    return $rhost;
}
function bottleavatar() {
    global $bname;
    global $bmeta;
    global $bhost;
    global $bavatar;
    global $bbeian;
    $rava = htmlspecialchars($bavatar);
    return $rava;
}
function bottlebeian() {
    global $bname;
    global $bmeta;
    global $bhost;
    global $bavatar;
    global $bbeian;
    $rban = htmlspecialchars($bbeian);
    return $rban;
}
function getmenu() {
    if (!file_exists(dirname(__FILE__) . "/../contents/menu/menus.php")) {
        $stringset = '<?php $menudm="' . "&nbsp;<a class='navbar-brand' href='index.php'>首页</a>" . '";?>';
        file_put_contents(dirname(__FILE__) . "/../contents/menu/menus.php", $stringset);
    }
    require dirname(__FILE__) . "/../contents/menu/menus.php";
    return $menudm;
}
function themeurl($path) {
    return dirname(__FILE__) . "/../theme/" . $path;
}
function assetsurl($path) {
    return dirname(__FILE__) . "/../assets/" . $path;
}
require_once(assetsurl('markdown.php'));
function contenturl() {
    return dirname(__FILE__) . "/../contents";
}
function postpagenum() { //获得总页码数
    require dirname(__FILE__) . "/../contents/catalog/pagegnum.php";
    return intval($totalpage);
}
function getag($strs, $ns) {
    $str = $strs;
    $arr = explode("?", $str);
    if (count($arr) > 1) {
        return $arr[$ns - 1];
    }
}
function getpostid($strs, $ns) {
    $str = $strs;
    $arr = explode("?o", $str);
    if (count($arr) > 1) {
        return $arr[$ns - 1];
    }
}
function getposttag($strs) {
    $str = $strs;;
    $arr = explode(",", $str);
    $totaltagnum = count($arr) - 1;
    $makenum = 0;
    while ($makenum <= $totaltagnum) {
        echo "<a href='index.php?tag=" . $arr[$makenum] . "' target='_self'>" . $arr[$makenum] . "</a>";
        if ($makenum !== $totaltagnum) {
            echo ",";
        }
        $makenum+= 1;
    }
}
function changedate($date) { //转换日期Ymd至Y-m-d
    return substr($date, 0, 4) . "-" . substr($date, 4, 2) . "-" . substr($date, 6, 2);
}
function getxt($strs, $ns) {
    $str = $strs;
    $arr = explode("-", $str);
    $last = $arr[$ns - 1];
    return $last;
}
function bb_isindex() {
    global $gettype;
    return $gettype == 'index';
}
function bb_ispage() {
    global $gettype;
    return $gettype == 'page';
}
function bb_ispost() {
    global $gettype;
    return $gettype == 'post';
}
function bb_issearch() {
    global $gettype;
    return $gettype == 'search';
}
function bb_istag() {
    global $gettype;
    return $gettype == 'tag';
}
function bb_nowpage() {
    global $pagec;
    return intval($pagec);
}
function bb_hasnew() {
    return bb_nowpage() !== 1;
}
function bb_hasold() {
    return postpagenum() > 1 && bb_nowpage() !== intval(postpagenum());
}
function bb_showpost() { //文章显示模块
    global $pagec;
    require contenturl() . "/posts/postnum.php";
    $listnum = $pnum;
    $realpage = postpagenum();
    $testpage = 0;
    $export = '';
    $realpage = $realpage - ($pagec - 1);
    global $ {
        "pagen$realpage"
    };
    $startid = @getxt($ {
        "pagen$realpage"
    }, 1);
    $endid = @getxt($ {
        "pagen$realpage"
    }, 2);
    if ($realpage <= 0) {
        $export = $export . "<script>alert('页码错误！');window.open('index.php','_self');</script>";
        Ob_end_clean();
    }
    //文章显示结束
    if (empty($endid)) {
		$contentm=file_get_contents(themeurl('postlist.html'));
        $contentm1=str_replace('[title]','',$contentm);
        $contentm2=str_replace('[link]','',$contentm1);
        $contentm3=str_replace('[scontent]','暂时还没有文章呢QAQ',$contentm2);
        $contentm4=str_replace('[date]','',$contentm3);
        $export = $export . $contentm4;
    }
    if ($startid == $endid) { //如果这一页只有一篇文章
        if (file_exists(contenturl() . "/posts/post$startid.php")) {
            require contenturl() . "/posts/post$startid.php";
			$contentm=file_get_contents(themeurl('postlist.html'));
         $contentm1=str_replace('[title]',$title,$contentm);
        $contentm2=str_replace('[link]',bottlehost()."/?o$startid",$contentm1);
        $contentm3=str_replace('[scontent]',mb_substr(strip_tags(Markdown(htmlspecialchars_decode($content))), 0, 120, "utf-8"),$contentm2);
        $contentm4=str_replace('[date]',changedate($date),$contentm3);
            $export = $export . $contentm4;
        }
    }
    $listnum = $endid;
    while ($listnum >= $startid) {
        if (file_exists(contenturl() . "/posts/post$listnum.php")) {
            require contenturl() . "/posts/post$listnum.php";
			$contentm=file_get_contents(themeurl('postlist.html'));
         $contentm1=str_replace('[title]',$title,$contentm);
        $contentm2=str_replace('[link]',bottlehost()."/?o$listnum",$contentm1);
        $contentm3=str_replace('[scontent]',mb_substr(strip_tags(Markdown(htmlspecialchars_decode($content))), 0, 120, "utf-8"),$contentm2);
        $contentm4=str_replace('[date]',changedate($date),$contentm3);
            $export = $export . $contentm4;
        }
        $listnum-= 1;
    }
    return $export;
}
function bb_pagetitle() {
    global $pageid;
    $getid = "";
    $check = 0;
    require contenturl()."/pages/pagenum.php";
    while ($check <= $pnum) {
        if (file_exists(contenturl()."/pages/page$check.php")) {
            require contenturl()."/pages/page$check.php";
            if ($pageid == $pagelink) {
                $getid = $check;
                break;
            }
        }
        $check+= 1;
    }
    if ($getid !== "") {
        require contenturl()."/pages/page$getid.php";
        return $title;
    } else {
        echo "Page not found.";
    }
}
function bb_pagecontent() {
    global $pageid;
    $getid = "";
    $check = 0;
    require contenturl()."/pages/pagenum.php";
    while ($check <= $pnum) {
        if (file_exists(contenturl()."/pages/page$check.php")) {
            require contenturl()."/pages/page$check.php";
            if ($pageid == $pagelink) {
                $getid = $check;
                break;
            }
        }
        $check+= 1;
    }
    if ($getid !== "") {
        require contenturl()."/pages/page$getid.php";
        return Markdown(htmlspecialchars_decode($content));
    } else {
        echo "Page not found.";
    }
}
function bb_posttitle() {
    global $postid;
    if (!file_exists(contenturl()."/posts/post$postid.php")) {
        echo "Post not found.";
        exit();
    } else {
        require contenturl()."/posts/post$postid.php";
        return $title;
    }
}
function bb_postcontent() {
    global $postid;
    if (!file_exists(contenturl()."/posts/post$postid.php")) {
        echo "Post not found.";
        exit();
    } else {
        require contenturl()."/posts/post$postid.php";
        return Markdown(htmlspecialchars_decode($content));
    }
}
function bb_postdate() {
    global $postid;
    if (!file_exists(contenturl()."/posts/post$postid.php")) {
        echo "Post not found.";
        exit();
    } else {
        require contenturl()."/posts/post$postid.php";
        return changedate($date);
    }
}
function bb_posttag() {
    global $postid;
    if (!file_exists(contenturl()."/posts/post$postid.php")) {
        echo "Post not found.";
        exit();
    } else {
        require contenturl()."/posts/post$postid.php";
        return getposttag($tag);
    }
}
function bb_postwz() {
    global $postid;
    if (!file_exists(contenturl()."/posts/post$postid.php")) {
        echo "Post not found.";
        exit();
    } else {
        require contenturl()."/posts/post$postid.php";
        return $wzid;
    }
}
function bb_getsearchform() {
    return @$_GET['search'];
}
function bb_search() {
    $searchfm = bb_getsearchform();
    if (empty($searchfm)) {
        echo "<script>alert('Search Form Require');window.open('index.php','_self');</script>";
    } else {
        date_default_timezone_set('Asia/Shanghai');
        require contenturl() . "/posts/postnum.php";
        $tagcheck = $pnum;
        $tagout = 0;
        while ($tagcheck >= 0) {
            if (file_exists(contenturl() . "/posts/post$tagcheck.php")) {
                require contenturl() . "/posts/post$tagcheck.php";
                if (strpos($title, $searchfm) !== false || strpos($content, $searchfm) !== false) {
					$contentm=file_get_contents(themeurl('postlist.html'));
         $contentm1=str_replace('[title]',$title,$contentm);
        $contentm2=str_replace('[link]',bottlehost()."/?o$tagcheck",$contentm1);
        $contentm3=str_replace('[scontent]',mb_substr(strip_tags(Markdown(htmlspecialchars_decode($content))), 0, 120, "utf-8"),$contentm2);
        $contentm4=str_replace('[date]',changedate($date),$contentm3);
            $export =$contentm4;
                    echo $export;
                }
            }
            $tagcheck-= 1;
        }
    }
}
function bb_gettag() {
    if (!empty($_GET['tag'])) {
        return $_GET['tag'];
    } else {
        return "All";
    }
}
function bb_tags() {
    $totag = $_GET['tag']; //获得标签
    $label = $totag;
    if (empty($label)) {
        $tagstring = file_get_contents(contenturl() . '/tags/tagall.txt');
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
        require contenturl() . "/posts/postnum.php";
        $tagcheck = $pnum;
        $tagout = 0;
        $echostring = "<h3>标签：$label</h3>";
        while ($tagcheck >= 0) {
            if (file_exists(contenturl() . "/posts/post$tagcheck.php")) {
                require contenturl() . "/posts/post$tagcheck.php";
                if (strpos($tag, $label) !== false) {
					$contentm=file_get_contents(themeurl('postlist.html'));
         $contentm1=str_replace('[title]',$title,$contentm);
        $contentm2=str_replace('[link]',bottlehost()."/?o$tagcheck",$contentm1);
        $contentm3=str_replace('[scontent]',mb_substr(strip_tags(Markdown(htmlspecialchars_decode($content))), 0, 120, "utf-8"),$contentm2);
        $contentm4=str_replace('[date]',changedate($date),$contentm3);
                    echo $contentm4;
                }
            }
            $tagcheck-= 1;
        }
    }
}
function nowpagetitle(){
	if(bb_isindex()){
		return '';
	}else if(bb_ispost()){
		return bb_posttitle().'-';
	}else if(bb_ispage()){
		return bb_pagetitle().'-';
	}else if(bb_issearch()){
		return 'Search-';
	}else if(bb_istag()){
		return 'Tag-';
	}
}
?>
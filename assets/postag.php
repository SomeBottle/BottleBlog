<?php
//标签链接生成模块
function getag($strs) {
    $str = $strs;;
    $arr = explode(",", $str);
    $totaltagnum = count($arr) - 1;
    $makenum = 0;
    while ($makenum <= $totaltagnum) {
        echo "<a href='index.php?tag=" . $arr[$makenum] . "' target='_self'>" . $arr[$makenum] . "</a>";
        require "./assets/tagcollecter.php";
        if ($makenum !== $totaltagnum) {
            echo ",";
        }
        $makenum+= 1;
    }
}
?>
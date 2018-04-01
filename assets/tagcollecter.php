<?php
/*该标签收集器连用于postag.php*/
if (!file_exists("./contents/tags/tagall.txt")) {
    file_put_contents("./contents/tags/tagall.txt", "none");
}
$maincheck = file_get_contents("./contents/tags/tagall.txt");
if (strpos($maincheck, $arr[$makenum]) == false) {
    if ($maincheck == "none") {
        $maincheck = "";
    }
    $maincheck = $maincheck . "," . $arr[$makenum];
    file_put_contents("./contents/tags/tagall.txt", $maincheck);
}
?>
<?php if (intval($pagec) !== 1) { ?><button type="button" class="btn btn-default" onclick='prepage(<?php echo $pagec; ?>)'>上一页</button><?php
} ?><a href="javascript:void(0)" onclick="setpage()" style="color:#000;a:hover{color:#black}">
            <?php if (empty($pagec)) {
    echo "1";
} else {
    echo $pagec;
} ?>/<?php echo postpagenum(); ?>
                <?php if (postpagenum() > 1 && intval($pagec) !== intval(postpagenum())) { ?></a><button type="button" class="btn btn-default" onclick='nextpage(<?php echo $pagec; ?>)'>下一页</button><?php
}
/*pagec:目前页数,postpagenum():总页数*/ 
?>

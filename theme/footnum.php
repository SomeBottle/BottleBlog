<?php if (intval(getnowpage()) !== 1) { ?><button type="button" class="btn btn-default" onclick='prepage(<?php echo getnowpage(); ?>)'>上一页</button><?php
} ?><a href="javascript:void(0)" onclick="setpage()" style="color:#000;a:hover{color:#black}">
            <?php if (intval(getnowpage())==1) {
    echo "1";
} else {
    echo getnowpage();
} ?>/<?php echo postpagenum(); ?>
                <?php if (postpagenum() > 1 && intval(getnowpage()) !== intval(postpagenum())) { ?></a><button type="button" class="btn btn-default" onclick='nextpage(<?php echo getnowpage(); ?>)'>下一页</button><?php
}
/*getnowpage():目前页数,postpagenum():总页数*/ 
?>

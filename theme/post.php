<style>
/*对table外观的一些支持*/
table {
    width: 100%;
    margin-bottom: 10px;
}
tr {
    height: 40px;

}
tr:nth-child(2n) {
    background-color: #FBFBFB;
}
tr:hover {
    background-color: #F4F4F4;
}
td:hover {
    background-color: #E0E0E0;
}
td {
    border: solid 1px #D4D4D4;
    padding: 10px;
}
</style>
<div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<!--getpostdetail(<needed>)函数：title是文章标题，date是文章日期，content是文章内容，tag是文章标签-->
                        </h3><h3><em><?php echo getpostdetail('title'); ?></em></h3>
						<p><small class='small-date'><?php echo changedate(getpostdetail('date')); ?></small></p>
                    </div>
                    <div class="panel-body">
                        <?php echo getpostdetail('content'); ?>
						<p><small class='small-date'>标签：<?php getposttag(getpostdetail('tag')); ?></small></p>
                    </div>
					</div>
					</div>
					</div>
					</div>
					<center><div class="panel-body" style="max-width:1000px;">
                        <?php require themeurl('comment.php'); ?>
                    </div></center>
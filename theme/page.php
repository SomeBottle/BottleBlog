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
						<!--$rtitle为页面标题，$content为页面内容-->
                        </h3><h3><em><?php echo $rtitle; ?></em></h3>
						<p>&nbsp;</p>
                    </div>
                    <div class="panel-body">
                        <?php echo $content; ?>
                    </div>
					</div>
					</div>
					</div>
					</div>
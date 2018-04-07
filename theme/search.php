 <?php

	?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						    Search:<?php echo $_GET['search']; /*搜索获取内容*/?>
						</h3>
                    </div>
					<?php searchdoing(); ?>
                    </div>
                </div>
            </div>
			<hr>
<?php require themeurl('footer.php'); ?>
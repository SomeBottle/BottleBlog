<?php require_once dirname(__FILE__). '/../assets/core.php'; ?>
  <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords" content="<?php echo bottlename();?>">
      <title>
        <?php echo bottlename();?></title>
      <link rel="stylesheet" href="<?php echo bottlehost();?>/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo bottlehost();?>/theme/style.css"></head>
    
    <body>
      <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <p>
            <a class="navbar-brand" href="<?php echo bottlehost();?>/index.php">
              <img src="<?php echo bottleavatar();?>" style="height:50px;width:auto;border-radius:25px;"></img>
              <?php echo getmenu(); ?></p>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="jumbotron well">
              <h1>
                <?php echo bottlename(); ?></h1>
              <p class="lead">
                <?php echo bottlename(); ?></p>
            </div>
          </div>
        </div>
      </div>
      <style>.pagination-center { margin-left: auto; margin-right: auto; width: auto; display: table; } hr:first-child { display: none; } .small-date { color: #B4B4B4; }</style>
      <?php if(bb_isindex()){ ?>
        <!--index页面的模板-->
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Posts</h3></div>
                <?php echo bb_showpost(); ?></div>
            </div>
          </div>
          <hr>
          <ul class="pager">
            <?php if (bb_hasnew()) { ?><button type="button" class="btn btn-default" onclick='prepage(<?php echo bb_nowpage(); ?>)'>上一页</button><?php
} ?><a href="javascript:void(0)" onclick="setpage()" style="color:#000;a:hover{color:#black}">
   <?php echo bb_nowpage();?>/<?php echo postpagenum(); ?>
                <?php if (bb_hasold()) { ?></a><button type="button" class="btn btn-default" onclick='nextpage(<?php echo bb_nowpage(); ?>)'>下一页</button><?php
}
/*bb_nowpage():目前页数,postpagenum():总页数*/ 
?>
			</ul>
          <?php }else if(bb_ispage()){ ?>
            <!--页面Page模板-->
            <style>/*对table外观的一些支持*/ table { width: 100%; margin-bottom: 10px; } tr { height: 40px; } tr:nth-child(2n) { background-color: #FBFBFB; } tr:hover { background-color: #F4F4F4; } td:hover { background-color: #E0E0E0; } td { border: solid 1px #D4D4D4; padding: 10px; }</style>
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">
                        <!--$rtitle为页面标题，$content为页面内容--></h3>
                      <h3>
                        <em>
                          <?php echo bb_pagetitle(); ?></em>
                      </h3>
                      <p>&nbsp;</p>
                    </div>
                    <div class="panel-body">
                      <?php echo bb_pagecontent(); ?></div>
                  </div>
                </div>
              </div>
            </div>
            <?php }else if(bb_ispost()){ ?>
              <!--文章Posts模板-->
              <style>/*对table外观的一些支持*/ table { width: 100%; margin-bottom: 10px; } tr { height: 40px; } tr:nth-child(2n) { background-color: #FBFBFB; } tr:hover { background-color: #F4F4F4; } td:hover { background-color: #E0E0E0; } td { border: solid 1px #D4D4D4; padding: 10px; }</style>
              <div class="container">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">
                          <!--$rtitle是文章标题，$rdate是文章日期，$content是文章内容--></h3>
                        <h3>
                          <em>
                            <?php echo bb_posttitle(); ?></em>
                        </h3>
                        <p>
                          <small class='small-date'>
                            <?php echo bb_postdate(); ?></small>
                        </p>
                      </div>
                      <div class="panel-body">
                        <?php echo bb_postcontent(); ?>
                          <p>
                            <small class='small-date'>标签：
                              <?php bb_posttag(); ?></small></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <center>
                <div class="panel-body" style="max-width:1000px;">
                  <?php require themeurl( 'comment.php'); ?></div>
              </center>
			  <?php }else if(bb_issearch()){ ?>
              <!--搜索search模板-->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						    Search:<?php echo bb_getsearchform(); /*搜索获取内容*/?>
						</h3>
                    </div>
	                <?php
                     bb_search();
                    ?>
                    </div>
                </div>
            </div>
			<hr>
			 <?php }else if(bb_istag()){ ?>
              <!--标签TAG模板-->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						    Tag:<?php echo bb_gettag(); ?>
						</h3>
                    </div>
<?php
bb_tags();
?>
                    </div>
                </div>
            </div>
			<hr>
			 <?php } ?>
			 <div style="height:50px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" style="text-align: center;height: 0;">
        <small style="line-height: 48px;"><p>&copy;<?php echo date('Y'); ?> <?php echo bottlename(); ?></p></small>  
		<small style="line-height: 48px;"><a href="http://www.miitbeian.gov.cn" target="_blank" rel="nofollow"><?php echo bottlebeian(); ?></a></small>
    </div>
</nav>
<script src="<?php echo bottlehost();?>/assets/js/main.js"></script>
<script src="<?php echo bottlehost();?>/assets/js/jquery.min.js"></script>
<script src="<?php echo bottlehost();?>/assets/js/bootstrap.min.js"></script>
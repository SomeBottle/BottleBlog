<?php
session_start();

if(!isset($_SESSION['iflogin'])||!isset($_SESSION['username'])||$_SESSION['iflogin']!=="yes"){
	echo "<script>alert('没有登录...');window.open('bottlelogin/login.php','_self');</script>";
	exit();
}
if(!file_exists("./../contents/menu/menus.php")){
	$stringset='<?php $menudm="'."&nbsp;<a class='navbar-brand' href='o.php?p=somebottle'>首页</a>".'";?>';
file_put_contents("./../contents/menu/menus.php",$stringset);
}
require "./../contents/menu/menus.php";
date_default_timezone_set('Asia/Shanghai');
session_write_close();
?>
<head>
<link rel="stylesheet" href="./../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="./../assets/css/pygments.css">
<script type="text/javascript" src="./editor/wangEditor.min.js"></script>
<title>Blog-后台管理</title>
</head>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron well">
                    <h1>
					Blog Admin
				    </h1>
                    <p class="lead">
                    管理菜单
                    </p>
                </div>
            </div>
        </div>
    </div>
	<center>
	<hr>
	<div class="panel-body" style="max-width:900px;">
	<h2>
     菜单目前仅支持代码修改（其实是作者懒）
	</h2>
	<p>
     </p><div class="form-group">
	 <form action="menupost.php" method="post" id="pform">
    <textarea class="form-control" rows="3" name="menudaima" id="menudaima" oninput="calling()"><?php echo $menudm; ?></textarea>
	<input type="hidden" id="daima" name="daima"></input>
                        <p></p>
						</form>
						<p><button type="submit" class="btn btn-default" onclick="submit()">保存</button></p>
						  </div>
						  <hr>
						  <h3>预览效果</h3>
						  <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <p><img src="https://imbottle.com/avatar.png" style="height:50px;width:auto;border-radius:25px;"></img>
						  <p id="preview">
						  
						  </p>
						  </p>
        </div>
    </nav>
							<hr>
                        <h2>
						    <p>页面列表</p>
				    	</h2>
						<p>示例：<?php echo htmlentities("&nbsp;<a class='navbar-brand' href='o.php?p=somebottle'></a>");?></p>
						<p>-----------------------------</p>
<?php
require "./../contents/pages/pagenum.php";
$snum=$pnum;
while($snum>=0){
	if(file_exists("./../contents/pages/page$snum.php")){
	require "./../contents/pages/page$snum.php";
	echo "<p>【".$title."】链接：<span style='color:blue;'>o.php?p=$pagelink</span></p>";
	}
	$snum-=1;
}
?>
						<hr>
						<p><a href="main.php" target="_self">返回</a></p>
						<script>
						function exchange(v){
                       str=v;
                      var str2 = str.replace(/"/g, "'");
                     return str2;  
                       }
					   function calling(){
						   var mains=exchange(document.getElementById('menudaima').value);
						   document.getElementById('preview').innerHTML=mains;
					   }
						function submit(){
							var mains=exchange(document.getElementById('menudaima').value);
							document.getElementById('daima').value=mains;
							document.getElementById('pform').submit();
						}
						</script>
<script src="./../assets/js/jquery.min.js"></script>
<script src="./../assets/js/bootstrap.min.js"></script>
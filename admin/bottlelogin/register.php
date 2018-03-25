<?php
require "./lconfig/configlogin.php";
$message=$_POST['mes'];
if($allowreg!=="yes"){
	echo "<script>alert('很抱歉，注册被关闭！');window.open('login.php','_self');</script>";
	exit();
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<title><?php echo $windowtitle;?></title>
</head>
<body>
<center>
<h2>&nbsp;</h2>
<h2><?php echo $registertitle;?></h2>
<h2>&nbsp;</h2>
<h3><?php echo $message;?></h3>
<form action="verify.php?do=register&zc=yes" method="post">
<div id="userinput">
<p><strong>Name:</strong><input type="text" class="form-control" id="user" name="user" placeholder="请输入名字(>=4,<=12)"></input></p>
<input type="hidden" id="dotype" name="dotype" value="register.php"></input>
</div>
<div id="passinput">
<p><strong>RecentPassword:</strong><input type="password" class="form-control" id="pass" name="pass" placeholder="请输入密码(>=6,<=16)"></input></p>
</div>
<div id="passinput2">
<p><strong>RetypePassword:</strong><input type="password" class="form-control" id="repass" name="repass" placeholder="请重新输入密码"></input></p>
</div>
<div id="buttons">
<p><button type="submit" class="btn btn-default">提交</button>&nbsp;<button type="button" class="btn btn-info" onclick="goback()">去登录</button></p>
</div>
</form>
</center>
</body>
<script>
function goback(){
	if(confirm("真的要离开去登录吗？")){
	window.open('login.php','_self');
	}
}
</script>
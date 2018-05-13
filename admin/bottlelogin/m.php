<?php
$d=$_GET['t'];
if(empty($d)){
	$d='login';
}
function is_https() {
    if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return true;
    } elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
        return true;
    } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return true;
    }
    return false;
}
if(!file_exists(dirname(__FILE__) .'/d.txt')){
	$d='';
	if(is_https()){
	    $d='https://'.$_SERVER['SERVER_NAME'].str_replace('m.php','',$_SERVER["REQUEST_URI"]);
	}else{
		$d='http://'.$_SERVER['SERVER_NAME'].str_replace('m.php','',$_SERVER["REQUEST_URI"]);
	}
	echo "<p>初始化完毕 >√</p><p>请刷新页面</p>";
	file_put_contents(dirname(__FILE__) .'/d.txt',$d);
}
if($d=='login'){//登录
	session_start();
require "./lconfig/configlogin.php";
$message=$_POST['mes'];
session_write_close();
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<?php 
if($oldmode!=='yes'){
	?>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php 
}
?>
<title><?php echo $windowtitle;?></title>
</head>
<body>
<center>
<h2>&nbsp;</h2>
<h2><?php echo $maintitle;?></h2>
<h2>&nbsp;</h2>
<h3><?php echo $message;?></h3>
<form action="v.php?do=login" method="post">
<div id="userinput">
<p><strong>Name:</strong><input type="text" class="form-control" id="user" name="user" placeholder="请输入名字"></input></p>
<input type="hidden" id="dotype" name="dotype" value="m.php"></input>
</div>
<div id="passinput">
<p><strong>Password:</strong><input type="password" class="form-control" id="pass" name="pass" placeholder="请输入密码"></input></p>
</div>
<div id="buttons">
<p><button type="submit" class="btn btn-default">提交</button><?php if($allowreg=="yes"){ ?>&nbsp;<button type="button" class="btn btn-info" onclick="goreg()">注册</button><?php } ?></p>
</div>
</form>
</center>
</body>
<?php
if(strpos($message,"Founded")!==false){
	if($oldmode=='yes'){
	header("location:$loginrefer");
	}else{
	?>
	<script>
	setTimeout("window.open('<?php echo $loginrefer;?>','_self');",2500);
	</script>
	<?php
	}
}
?>
<script>
function goreg(){
	window.open('m.php?t=reg','_self');
}
</script>
<?php
}else if($d=='reg'){//注册
	require "./lconfig/configlogin.php";
$message=$_POST['mes'];
if($allowreg!=="yes"){
	echo "<script>alert('很抱歉，注册被关闭！');window.open('m.php','_self');</script>";
	exit();
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<?php 
if($oldmode!=='yes'){
	?>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php 
}
?>
<title><?php echo $windowtitle;?></title>
</head>
<body>
<center>
<h2>&nbsp;</h2>
<h2><?php echo $registertitle;?></h2>
<h2>&nbsp;</h2>
<h3><?php echo $message;?></h3>
<form action="v.php?do=register&zc=yes" method="post">
<div id="userinput">
<p><strong>Name:</strong><input type="text" class="form-control" id="user" name="user" placeholder="请输入名字(>=4,<=12)"></input></p>
<input type="hidden" id="dotype" name="dotype" value="m.php?t=reg"></input>
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
	window.open('m.php','_self');
	}
}
</script>
<?php
}else if($d=='rpass'){//修改密码
require "./lconfig/configlogin.php";
$message=$_POST['mes'];
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<?php 
if($oldmode!=='yes'){
	?>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php 
}
?>
<title><?php echo $windowtitle;?></title>
</head>
<body>
<center>
<h2>&nbsp;</h2>
<h2><?php echo $changepasstitle;?></h2>
<h2>&nbsp;</h2>
<h3><?php echo $message;?></h3>
<form action="v.php?do=changepass" method="post">
<div id="userinput">
<p><strong>Name:</strong><input type="text" class="form-control" id="user" name="user" placeholder="请输入名字(>=4,<=12)"></input></p>
<input type="hidden" id="dotype" name="dotype" value="m.php?t=rpass"></input>
</div>
<div id="passinput">
<p><strong>RecentPassword:</strong><input type="password" class="form-control" id="pass" name="pass" placeholder="请输入旧密码"></input></p>
</div>
<div id="passinput">
<p><strong>Password:</strong><input type="password" class="form-control" id="newpass" name="newpass" placeholder="请输入新密码(>=6,<=16)"></input></p>
</div>
<div id="passinput2">
<p><strong>RetypePassword:</strong><input type="password" class="form-control" id="repass" name="repass" placeholder="请重新输入密码"></input></p>
</div>
<div id="buttons">
<p><button type="submit" class="btn btn-default">提交</button>&nbsp;<button type="button" class="btn btn-info" onclick="goback()">返回主页</button></p>
</div>
</form>
</center>
</body>
<script>
function goback(){
	if(confirm("真的要离开去主页吗？")){
	window.open('index.php','_self');
	}
}
</script>
<?php
}
?>
<?php
session_start();
require "./lconfig/configlogin.php";
require "checker.php";
checklogin();
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<h1>欢迎，<?php echo getuser('');?></h1>
<p>在sessionstart的前提下使用getuser函数获取目前用户名</p>
<p>&nbsp;</p>
<h2>你的UID：<?php echo getid('');?></h2>
<p>在sessionstart的前提下使用getid(user)函数获取用户名uid</p>
<p>不必要的时候可以空出user值</p>
<p>&nbsp;</p>
<h2>通过你的ID获取的名字：<?php echo getname(getid(''));?></h2>
<p>在sessionstart的前提下使用getname(id)函数获取uid对应的用户名</p>
<h2>-EXTRA额外的-</h2>
<p>1.通过checkrefer()函数判断是否登录并重定向至配置页面</p>
<p>2.通过checklogin()函数判断是否登录.如果没有登录会卸载并且跳转至登录页面</p>
<p>&nbsp;</p>
<h2>登出</h2>
<p><input type="button" onclick="logout()" value="登出LOGOUT"></input></p>
<p>很期待这个按钮，不是嘛？o(￣ヘ￣o＃)</p>
<script>
function logout(){
	window.open('logout.php','_self');
}
</script>
<?php
$serverhostpath=str_replace("/admin/bottlelogin","",dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]));
$windowtitle="SomeBottle's Login Portal";//窗口标题
$maintitle="Blog's Login Portal";//主标题
$registertitle="Please Register";//注册标题
$changepasstitle="ChangePassword";//更换密码标题
$errorpassmessage="密码错误了哦~";//密码错误
$loginsuccessmessage="登录成功了诶！正在重定向";//登录成功
$noneuser="箱子里还找不到这个用户！";//用户不存在
$alreadyregistered="箱子里已经有这个用户名了诶！";//已经存在用户名
$regsuccessmessage="你的用户名已经被放入箱子中了";//注册成功
$retypeerror="重复密码错误！";//重复密码错误
$changesuccessmessage="密码成功被修改！";//修改密码成功
$loginrefer="./../main.php";//登录后重定向
$notlogged="你还没有被允许进入箱子呢！";//还没有登录，未经过checker验证
$allowreg="no";//是否允许注册，是:"yes",否:"no"
?>
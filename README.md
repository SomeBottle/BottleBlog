# BottleBlog
## 无须数据库的，基于PHP的博客系统~
-  轻便
-  容易备份
----------------------------------
## 关于安装
#### 1.首先上传博客程序到网站根目录
#### 2.访问根目录会跳转到登录界面
#### 3.登录程序基于BottleLogin，进入admin/bottlelogin/lconfig目录，打开配置文件，allowreg选项调为yes后
####   访问register.php进行注册。注册完毕后请务必关闭allowreg至no！
####   BottleLogin更改密码的程序在editpass.php。
#### 4.登录，进入后台，初始化，敬请享用吧！
## 目前的隐藏功能
#### 标签：根目录下的tag.php，使用方法，tag.php?tag=标签名
#### 搜索：在index.php更为index.php?search=关键词，支持搜索到文章内的东西

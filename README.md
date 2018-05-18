# BottleBlog
## 无须数据库的，基于PHP的博客系统~
* Markdown解析器源于**PHP-Markdown**
 ![Example](https://ww2.sinaimg.cn/large/ed039e1fgy1frgar47bhkj20js0jl408)
===============================
#### 建议PHP版本：PHP5.6(其实5.4)也可以
### 请打开PHP的mbstring扩展，以下是CPanel示例

### 详细介绍：https://imbottle.com/?bottleblog
* 轻便
* 容易备份
* 内置缓存、全站缓存器
* 支持自定义主题（2018.4.6）
* 安装便捷，丢到网站目录就能用
## DEMO
https://imbottle.com
----------------------------------
## 备份方法
* 打包根目录下的contents文件夹，走人~
----------------------------------
## 关于安装
#### 1.首先上传博客程序到网站根目录
#### 2.访问根目录会跳转到登录界面
#### 3.登录程序基于BottleLogin，进入admin/bottlelogin/lconfig目录，打开配置文件，allowreg选项调为yes后
####   访问register.php进行注册。注册完毕后请务必关闭allowreg至no！
####   BottleLogin更改密码的程序在editpass.php。
#### 4.登录，进入后台，初始化，敬请享用吧！
## 隐藏功能
*标签默认页面-示例：http://localhost/?tag
![Example](http://ww2.sinaimg.cn/mw1024/a15b4afegy1fpp4dx06awj21hc0mnmxq)

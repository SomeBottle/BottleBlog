<?php
session_start();
require "./lconfig/configlogin.php";
?>
<form action="verify.php?zc=yes&confirm=yes&do=register" method="post" id="veriform">
<input type="hidden" id="typenum" name="tpnum"></input>
<input type="hidden" id="vnum" name="vnum"></input>
<input type="hidden" id="usert" name="user"></input>
<input type="hidden" id="passt" name="pass"></input>
<input type="hidden" id="cont" name="repass"></input>
<input type="hidden" id="dotype" name="dotype"></input>
</form>
<script>var verifynum="";</script>
<?php
$action = $_GET['do'];
$refers = $_POST['dotype'];
$message = '';
if ($action == "register") { //注册
if($allowreg=="yes"){
    require 'getip.php';
    $ifok = $_COOKIE["rego"];
    $user = $_POST['user'];
    $pvnum = $_POST['vnum'];
    $passrecent = $_POST['pass'];
    $confirmrecent = $_POST['repass'];
    $ifcon = $_GET['confirm'];
    $ifzc = $_GET['zc'];
    //“左左右右”验证系统核心
    if ($ifzc == "yes") {
        if ($ifcon !== "yes") {
            $genenum = 1;
            $sz = "";
            echo "<script>alert('左左右右验证系统V1.0');</script>";
            while ($genenum <= 20) {
                $generand = rand(1, 2);
                if ($generand == 1) {
                    $sz = $sz . "1";
                    echo "<script>if(confirm('请按确定')){verifynum=verifynum+'1';}else{verifynum=verifynum+'2';}</script>";
                } else if ($generand == 2) {
                    $sz = $sz . "2";
                    echo "<script>if(confirm('请按取消')){verifynum=verifynum+'1';}else{verifynum=verifynum+'2';}</script>";
                }
                $genenum+= 1;
            }
            $_SESSION['tpnum'] = md5($sz);
            echo "<script>document.getElementById('typenum').value=verifynum;</script>";
            $lastrand = rand(1, 9999);
            $_SESSION['vnum'] = md5($lastrand);
            echo "<script>function ti(){var typet=prompt('请输入$lastrand ','');if(typet!==null&&typet!==''){document.getElementById('vnum').value=typet;}else{return ti();}};ti();</script>";
            echo "<script>document.getElementById('usert').value='$user';</script>";
            echo "<script>document.getElementById('passt').value='$passrecent';</script>";
            echo "<script>document.getElementById('cont').value='$confirmrecent';</script>";
            echo "<script>document.getElementById('dotype').value='$refers';</script>";
            echo "<script>document.getElementById('veriform').submit();</script>";
            exit();
        } else {
            /*
            $awant=$_POST['tpnum'];
            echo "<script>alert('$awant');</script>";
            $awant2=$_POST['vnum'];
            echo "<script>alert('$awant2');</script>";
            */
            if (md5($_POST['tpnum']) == $_SESSION['tpnum']) {
                if (md5($_POST['vnum']) == $_SESSION['vnum']) {
                    $ip = getip();
                    require 'searchword.php';
                    //验证核心
                    $ifbanned = searchword("registerban/ban.list", $ip);
                    if ($ifbanned == 'no') {
                        //注册核心
                        if (!empty($_POST['user']) && !empty($_POST['pass'])) {
                            echo "<script type='text/javascript'>console.log($ifok);</script>";
                            if ($_POST['pass'] != $_POST['repass']) {
                                $message = "<center>$retypeerror</center>";
                            } else {
                                //注册模块
                                $user = $_POST['user'];
                                $userlength = strlen($_POST['user']);
                                $length = strlen($_POST['pass']);
                                $passw = $_POST['pass'];
                                if ($userlength >= 4 && $userlength <= 12) {
                                    if ($length >= 6 && $length <= 16) {
                                        //切割密码
                                        $ly1 = substr($passw, 0, 5);
                                        $ly2 = substr($passw, 5, 5);
                                        $ly3 = substr($passw, 10, 5);
                                        $ly4 = substr($passw, 15, 1);
                                        //切割结束
                                        if (!is_dir("./user")) {
                                            mkdir("./user");
                                            $p = '<?php $idnum=0;?>';
                                            file_put_contents("./user/idnum.php", $p);
                                        }
                                        if (!is_dir("./userid")) {
                                            mkdir("./userid");
                                        }
                                        if (!is_dir("./user/$user")) {
                                            $passwd1 = '<?php $passwd1="' . md5($ly1) . '";?>';
                                            $passwd2 = '<?php $passwd2="' . md5($ly2) . '";?>';
                                            $passwd3 = '<?php $passwd3="' . md5($ly3) . '";?>';
                                            $passwd4 = '<?php $passwd4="' . md5($ly4) . '";?>';
                                            $idvalue = '<?php $username="' . $user . '";?>';
                                            require "./user/idnum.php";
                                            $profile = '<?php $name="' . $user . '";$uid="' . $idnum . '";?>';
                                            $nidnum = $idnum + 1;
                                            $p = '<?php $idnum=' . $nidnum . ';?>';
                                            mkdir("./user/$user");
                                            mkdir("./user/$user/pw");
                                            file_put_contents("./user/idnum.php", $p);
                                            file_put_contents("./userid/$idnum.php", $idvalue);
                                            file_put_contents("./user/$user/profile.php", $profile);
                                            //密码随机数组
                                            $shunxu = range(1, 4);
                                            $sx1 = $shunxu[0];
                                            $sx2 = $shunxu[1];
                                            $sx3 = $shunxu[2];
                                            $sx4 = $shunxu[3];
                                            file_put_contents("./user/$user/pw/p" . $shunxu[0] . ".php", $ {
                                                "passwd$sx1"
                                            });
                                            file_put_contents("./user/$user/pw/p" . $shunxu[1] . ".php", $ {
                                                "passwd$sx2"
                                            });
                                            file_put_contents("./user/$user/pw/p" . $shunxu[2] . ".php", $ {
                                                "passwd$sx3"
                                            });
                                            file_put_contents("./user/$user/pw/p" . $shunxu[3] . ".php", $ {
                                                "passwd$sx4"
                                            });
                                            $message = "<h4>$regsuccessmessage</h4>";
                                        } else {
                                            $message = "<center>$alreadyregistered</center>";
                                        }
                                        //注册结束
                                        if (!file_exists("registerban/" . $ip . ".ready")) {
                                            file_put_contents("registerban/" . $ip . ".ready", $ip);
                                            $recentban = file_get_contents("registerban/ban.list");
                                            $nowban = $recentban . "|" . $ip;
                                            file_put_contents("registerban/ban.list", $nowban);
                                            unlink("registerban/" . $ip . ".ready");
                                        } else {
                                            file_put_contents("registerban/" . $ip . ".ready", $ip);
                                        }
                                    } else {
                                        $message = "<center>密码长度过短或过长！最短6个字符，最长16个字符！</center>";
                                    }
                                } else {
                                    $message = "<center>用户名长度过短或过长！最短4个字符，最长12个字符！</center>";
                                }
                            }
                        } else {
                            $message = "Error:Null";
                        }
                        //注册核心结束
                        
                    } else {
                        $message = "<center>你的IP已经注册过账户，由于系统限制，不支持再次注册！</center>";
                    }
                } else {
                    $message = "<center>验证错误！</center>";
                }
            } else {
                $message = "<center>验证错误！</center>";
            }
        }
    }
}else{
	echo "<script>alert('很抱歉，注册被关闭！');window.open('login.php','_self');</script>";
	exit();
}
} else if ($action == "login") {
    //登录开始
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if (!is_dir("./user/$user")) {
        $message = "<center>箱子里还找不出这个用户名TAT</center>";
    } else {
        require "./user/$user/pw/p1.php";
        require "./user/$user/pw/p2.php";
        require "./user/$user/pw/p3.php";
        require "./user/$user/pw/p4.php";
        //切割密码
        $ly1 = substr($pass, 0, 5);
        $ly2 = substr($pass, 5, 5);
        $ly3 = substr($pass, 10, 5);
        $ly4 = substr($pass, 15, 1);
        //切割结束
        $sx1 = 0;
        $sx2 = 0;
        $sx3 = 0;
        $sx4 = 0;
        $testtime = 0;
        $result = "Founded!";
        echo "<p>正在搬箱子中...</p>";
        while ($ {
            "passwd$sx1"
        } !== md5($ly1)) {
            $sx1+= 1;
            $testtime+= 1;
            if ($testtime >= 100) {
                $result = "Breaked";
                break;
            }
        }
        while ($ {
            "passwd$sx2"
        } !== md5($ly2)) {
            $sx2+= 1;
            $testtime+= 1;
            if ($testtime >= 100) {
                $result = "Breaked";
                break;
            }
        }
        while ($ {
            "passwd$sx3"
        } !== md5($ly3)) {
            $sx3+= 1;
            $testtime+= 1;
            if ($testtime >= 100) {
                $result = "Breaked";
                break;
            }
        }
        while ($ {
            "passwd$sx4"
        } !== md5($ly4)) {
            $sx4+= 1;
            $testtime+= 1;
            if ($testtime >= 100) {
                $result = "Breaked";
                break;
            }
        }
        if ($ {
            "passwd$sx1"
        } == md5($ly1) && $ {
            "passwd$sx2"
        } == md5($ly2) && $ {
            "passwd$sx3"
        } == md5($ly3) && $ {
            "passwd$sx4"
        } == md5($ly4)) {
            $message = "<center>$loginsuccessmessage Code:$result</center>";
			$_SESSION['iflogin']="yes";
			$_SESSION['username']=$user;
        } else {
            $message = "<center>$errorpassmessage ErrorCode:$result</center>";
        }
    }
} else if ($action == "changepass") {//更改密码核心
    require 'getip.php';
    $user = $_POST['user'];
    $passrecent = $_POST['pass'];
    $confirmrecent = $_POST['repass'];
    $pass = $_POST['pass'];
    if (!is_dir("./user/$user")) { //测试密码是否正确
        $message = "<center>箱子里还找不出这个用户名TAT</center>";
    } else {
        require "./user/$user/pw/p1.php";
        require "./user/$user/pw/p2.php";
        require "./user/$user/pw/p3.php";
        require "./user/$user/pw/p4.php";
        //切割密码
        $ly1 = substr($pass, 0, 5);
        $ly2 = substr($pass, 5, 5);
        $ly3 = substr($pass, 10, 5);
        $ly4 = substr($pass, 15, 1);
        //切割结束
        $sx1 = 0;
        $sx2 = 0;
        $sx3 = 0;
        $sx4 = 0;
        $testtime = 0;
        $result = "Founded!";
        echo "<p>正在搬箱子中...</p>";
        while ($ {
            "passwd$sx1"
        } !== md5($ly1)) {
            $sx1+= 1;
            $testtime+= 1;
            if ($testtime >= 100) {
                $result = "Breaked";
                break;
            }
        }
        while ($ {
            "passwd$sx2"
        } !== md5($ly2)) {
            $sx2+= 1;
            $testtime+= 1;
            if ($testtime >= 100) {
                $result = "Breaked";
                break;
            }
        }
        while ($ {
            "passwd$sx3"
        } !== md5($ly3)) {
            $sx3+= 1;
            $testtime+= 1;
            if ($testtime >= 100) {
                $result = "Breaked";
                break;
            }
        }
        while ($ {
            "passwd$sx4"
        } !== md5($ly4)) {
            $sx4+= 1;
            $testtime+= 1;
            if ($testtime >= 100) {
                $result = "Breaked";
                break;
            }
        }
        if ($ {
            "passwd$sx1"
        } == md5($ly1) && $ {
            "passwd$sx2"
        } == md5($ly2) && $ {
            "passwd$sx3"
        } == md5($ly3) && $ {
            "passwd$sx4"
        } == md5($ly4)) {
            //更改密码模块
            if (!empty($_POST['user']) && !empty($_POST['newpass'])) {
                echo "<script type='text/javascript'>console.log($ifok);</script>";
                if ($_POST['newpass'] != $_POST['repass']) {
                    $message = "<center>$retypeerror</center>";
                } else {
                    //注册模块
                    $user = $_POST['user'];
                    $userlength = strlen($_POST['user']);
                    $length = strlen($_POST['newpass']);
                    $passw = $_POST['newpass'];
                    if ($userlength >= 4 && $userlength <= 12) {
                        if ($length >= 6 && $length <= 16) {
                            //切割密码
                            $ly1 = substr($passw, 0, 5);
                            $ly2 = substr($passw, 5, 5);
                            $ly3 = substr($passw, 10, 5);
                            $ly4 = substr($passw, 15, 1);
                            //切割结束
                            $passwd1 = '<?php $passwd1="' . md5($ly1) . '";?>';
                            $passwd2 = '<?php $passwd2="' . md5($ly2) . '";?>';
                            $passwd3 = '<?php $passwd3="' . md5($ly3) . '";?>';
                            $passwd4 = '<?php $passwd4="' . md5($ly4) . '";?>';
                            //密码随机数组
                            $shunxu = range(1, 4);
                            $sx1 = $shunxu[0];
                            $sx2 = $shunxu[1];
                            $sx3 = $shunxu[2];
                            $sx4 = $shunxu[3];
                            file_put_contents("./user/$user/pw/p" . $shunxu[0] . ".php", $ {
                                "passwd$sx1"
                            });
                            file_put_contents("./user/$user/pw/p" . $shunxu[1] . ".php", $ {
                                "passwd$sx2"
                            });
                            file_put_contents("./user/$user/pw/p" . $shunxu[2] . ".php", $ {
                                "passwd$sx3"
                            });
                            file_put_contents("./user/$user/pw/p" . $shunxu[3] . ".php", $ {
                                "passwd$sx4"
                            });
                            $message = "<h4>$changesuccessmessage</h4>";
                            //更改结束
                            
                        } else {
                            $message = "<center>密码长度过短或过长！最短6个字符，最长16个字符！</center>";
                        }
                    } else {
                        $message = "<center>用户名长度过短或过长！最短4个字符，最长12个字符！</center>";
                    }
                }
            } else {
                $message = "Error:Null";
            }
            //注册核心结束
            
        } else {
            $message = "<center>$errorpassmessage ErrorCode:$result</center>";
        }
    }
}
?>
<form action="<?php echo $refers; ?>" method="post" id="mesform">
<input type="hidden" id="mes" name="mes" value="<?php echo $message; ?>"></input>
</form>
<?php if (!empty($message)) { ?>
<script>document.getElementById('mesform').submit();</script>
<?php
} ?>
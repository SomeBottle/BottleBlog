<?php
if(!file_exists("./contents/menu/menus.php")){
	$stringset='<?php $menudm="'."&nbsp;<a class='navbar-brand' href='index.php'>首页</a>".'";?>';
file_put_contents("./contents/menu/menus.php",$stringset);
}
require "./contents/menu/menus.php";
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $bname;?>">
    <title><?php echo $bname;?></title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/pygments.css">
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <p><a class="navbar-brand" href="<?php echo $bhost;?>/index.php"><img src="<?php echo $bavatar;?>" style="height:50px;width:auto;border-radius:25px;"></img><?php echo $menudm; ?></p>
        </div>
    </nav>
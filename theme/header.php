<?php require_once dirname(__FILE__).'/../assets/core.php'; ?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo bottlename();?>">
    <title><?php echo bottlename();?></title>
    <link rel="stylesheet" href="<?php echo bottlehost();?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo bottlehost();?>/theme/style.css">
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <p><a class="navbar-brand" href="<?php echo bottlehost();?>/index.php"><img src="<?php echo bottleavatar();?>" style="height:50px;width:auto;border-radius:25px;"></img><?php echo getmenu(); ?></p>
        </div>
    </nav>
		    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron well">
                    <h1>
					<?php echo bottlename(); ?>
				    </h1>
                    <p class="lead">
                    <?php echo bottlename(); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <style>
	.pagination-center {
        margin-left: auto;
        margin-right: auto;
        width: auto;
        display: table;
    }
    hr:first-child {
        display: none;
    }
	.small-date {
		color: #B4B4B4;
	}
    </style>
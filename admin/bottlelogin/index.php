<?php 
session_start();
require "./lconfig/configlogin.php";
require "checker.php";
$iflogin=checklogin();
if($iflogin=="yes"){
	echo "<script>window.open('".$loginrefer."','_self');</script>";
}
?>
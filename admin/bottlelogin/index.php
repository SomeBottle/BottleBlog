<?php
@session_start();
require "checker.php";
$iflogin=checklogin();
if($iflogin=="yes"){
	echo "<script>window.open('".$loginrefer."','_self');</script>";
}
@session_write_close();
?>
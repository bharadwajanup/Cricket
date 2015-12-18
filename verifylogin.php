<?php 
$pwd = $_POST["pass"];

if($pwd == "shivRatri")
{
	session_start();
	$_SESSION["umpire"]="true";
	header("location:index.php");
	//echo "hello";
	exit;
}
else
{
	echo "fail";
	header("location:login.php?valid=1");
	exit;
}

?>
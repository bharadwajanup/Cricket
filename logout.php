<?php
if(isset($_COOKIE['umpireMode']))
{
	unset($_COOKIE['umpireMode']);
	setcookie("umpireMode","no",time()-3600);
}

		header("location:index.php");
?>
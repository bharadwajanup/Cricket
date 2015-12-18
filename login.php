<?php if(isset($_POST['pass']))
{
$pwd=$_POST['pass'];
if($pwd == "shivRatri")
{
	setcookie("umpireMode","yes",time()+3600);
	header("location:index.php");
}


}
?>
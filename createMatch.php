<?php include "includes/connection.php";
$batFirst= $_POST['batFirst'];
if($batFirst == "team1")
{
$team1 = $_POST['team1'];
$team2 = $_POST['team2'];
}
else
{
$team2 = $_POST['team1'];
$team1 = $_POST['team2'];	
}

$maxOvers= $_POST['maxOvers'];
$maxWickets= $_POST['maxWickets'];
file_put_contents("match.txt","$batFirst.\"maxOvers\".$maxOvers.\"wickets\".$maxWickets.$team1.$team2");
$sql = "INSERT INTO `cricket`.`matches` (`match_id`, `team1`, `team2`, `maxOvers`, `Wickets`, `timestamp`) VALUES (NULL, $team1, $team2, $maxOvers, $maxWickets,  CURRENT_TIMESTAMP);";


try
{
$result = $connection->query($sql);
echo "success";
$q = "select match_id from matches order by timestamp desc LIMIT 1";
$res = $connection->query($q);
$id = $res->fetch();
header("location:match.php?id=$id[0]&innings=1");
}catch(PDOException $e)
{
	echo $e;
	header("location:startmatch.php?msg=fail");
}
?>
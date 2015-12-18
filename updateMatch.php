<?php
include "includes/connection.php";
$id = $_GET['id'];
$score = $_GET['score'];
$wickets = $_GET['wickets'];
$overs = $_GET['overs'];
$innings = $_GET['innings'];
if($innings == 1)
	$q = "update matches set team1_score=".$score.",team1_wickets=".$wickets.",team1_overs=".$overs."where match_id=$id";
else
	$q = "update matches set team2_score=".$score.",team2_wickets=".$wickets.",team2_overs=".$overs."where match_id=$id";

echo $q;
$res = $connection->query($q);
$res->execute();
echo $res->rowCount();
$q = "select * from matches where match_id=$id";
$res = $connection->query($q);
$res->execute();
$rows = $res->fetch();
$max_wickets = $rows['Wickets'];
$max_overs = $rows['maxOvers'];

if($max_overs >= $overs || $max_wickets >= $wickets)
{
	echo "true";
}
else
{
	echo "false";
}

?>
<?php

 include "header.php"; 
include "includes/connection.php";


?>
<div class="container panel panel-body">
<div class="row">
<div class="col-md-12">
<div class="page-header">
<h3>Current Standings</h3>
</div>
<table class="table table-condensed table-bordered">
<tr>
<th>Team Name</th>
<th>Captain Name</th>
<th>Matches Played</th>
<th>Wins</th>
<th>Loss</th>
<th>Net Run Rate</th>
</tr>
<?php
$q = "select * from teams";
foreach($connection->query($q) as $v)
{
	echo "<tr><td>$v[1]</td><td>$v[2]</td><td>$v[3]</td><td>$v[4]</td><td>$v[5]</td><td>$v[6]</td></tr>";
	
}

?>
</table>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="page-header">
<h3>Matches Played/Being Played</h3>
</div>
<table class="table table-condensed table-bordered" id="viewMatch">
<tr>
<th>Match</th>
<th>Max Overs</th>
<th>No of Players</th>
<th></th>
</tr>
<?php
$q = "select * from matches";
foreach($connection->query($q) as $v)
{
	$q1 = "select team_name from teams where team_id in ($v[1],$v[2])";
	$res = $connection->query($q1);
	$team1 = $res->fetch();
	$team2 = $res->fetch();
	
	echo "<tr><td>$team1[0] vs $team2[0]</td><td>$v[3]</td><td>$v[4]</td><td><a href=\"match.php?id=$v[0]&innings=1\">view match</a> </td></tr>";
	
}

?>
</table>
</div>
</div>
</div>
</body>
</html>

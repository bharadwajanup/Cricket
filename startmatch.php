<?php
if(!isset($_COOKIE['umpireMode']) || $_COOKIE['umpireMode'] != "yes")
{
	
		echo "please login as an umpire to view this page";
		exit;
	
}
 include "header.php";
include "includes/connection.php";


?>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<div class="col-xs-12 ">
<div class="page-header">
<h3>Fill in the below information and click Begin start a match</h3>
</div>
<div class="panel panel-default">
<div class="panel-body">
<form role="form" action="createMatch.php" method="post">
<div class="form-group">
<label for="team1">Team 1</label>
<select class="form-control" name="team1">
<?php
$q = "select team_id, team_name from teams";
foreach($connection->query($q) as $v)
{
	echo "<option value=\"$v[0]\">$v[1]</option>";
}
?>
</select>
</div>
<div class="form-group">
<label for="team1">Team 2</label>
<select class="form-control" name="team2">
<?php
$q = "select team_id, team_name from teams";
foreach($connection->query($q) as $v)
{
	echo "<option value=\"$v[0]\">$v[1]</option>";
}
?>
</select>
</div>
<div class="form-group">
<label for="team1">Batting First</label>
<select class="form-control" name="batFirst">
<option value="team1">Team 1</option>
<option value="team2">Team 2</option>
</select>
</div>
<div class="form-group">
<label for="max-overs">Maximum Overs</label>
<input type="number" name="maxOvers" class="form-control" />
</div>
<div class="form-group">
<label for="max-overs">Number of Wickets</label>
<input type="number" name="maxWickets" class="form-control" />
</div>
<div class="pull-right">
<button type="reset" class="btn btn-default">Reset</button>
<button type="submit" class="btn btn-danger">Begin</button>

</div>
</form>
</div>
</div>
</div>
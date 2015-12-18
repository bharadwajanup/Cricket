<?php include "header.php";

include "includes/connection.php"; 
if(isset($_GET['id']))
$id = $_GET['id'];
else
{
	echo "The page you are trying to access does not exist";
	exit;
}
if(isset($_GET['innings']))
$innings = $_GET['innings'];
if($innings == "1")
$team="team1";
else
$team="team2";
$q = "select * from matches where match_id=$id";
$res = $connection->query($q);
$count = $res->rowCount();
if($count == 0)
{
	echo "The match you're trying to access does not exist!";
	exit;
}
$info = $res->fetch();
$team1_id= $info[$team];
#$team2= $info['team2'];
$q="select * from teams where team_id=$team1_id";
$res = $connection->query($q);
$count = $res->rowCount();
if($count == 0)
{
	echo "The team does not exist";
	exit;
}
$teamInfo = $res->fetch();
$team_name= $teamInfo['team_name'];

?>

<div class="container panel panel-body">
<ul class="nav nav-tabs">
  <li role="presentation" ><a href="match.php?id=<?php echo $id?>&innings=1" id="innings1">First Innings</a></li>
  <li role="presentation"><a href="match.php?id=<?php echo $id?>&innings=2" id="innings2">Second Innings</a></li>
  <li role="presentation"><a href="#">Match Results</a></li>
</ul>
<div class="row">
<div class="col-xs-12">
<div class="jumbotron">
<h2><?php echo $team_name; ?></h2>
<h3>Score:<span id="total_runs"><?php echo $info[$team.'_score'];?></span>/<span id="wickets"><?php echo $info[$team.'_wickets'];?></span></h3>
<?php $overs = explode(".",$info[$team.'_overs']);
$over = $overs[0];
if(count($overs)!=2)
{
	$ball = 0;
}
else
$ball = $overs[1]; 
?>
<h4>Overs: <span id="overs"><?php echo $over; ?></span>.<span id="ball"><?php echo $ball ?></span></h4>
<h4>Maximum Overs: <span id="maxOvers"><?php echo $info['maxOvers'];?></span></h4>
<h4>Run Rate <span id="runRate">0.00</span></h4>
<h4>Number of Wickets: <span id="players"><?php echo $info['Wickets'];?></span></h4>
</div>
</div>

<div class="col-xs-12"  >
<div class="panel panel-default" style="display:<?php if(isset($_COOKIE['umpireMode'])&&$_COOKIE['umpireMode'] == "yes")echo "block";else echo "none"; ?>">
<div class="panel-heading">
<h3 class="panel-title">Enter the runs scored in each ball and click on save</h3>
</div>
<div class="panel-body">
<div id="serverMessage" class="col-xs-2">
</div>
<div class="col-xs-6">
<select class="form-control" id="runs">
<option value="none"></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="6">6</option><option value="7">Nb</option><option value="8">Wd</option>
<option value="9">W</option>
</select>
</div>
<div class="col-xs-4">
<button class="btn btn-info" id="saveRuns">Save</button>
</div>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Overs</h3></div>
<div class="panel-body ">
<form>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<textarea style="display:none;" name="overTableInfo" id="overTableInfo"></textarea>
</form>
<div id="overInfoOuter">
<table class="table table-bordered" id="overTable">

</table>

</div>

</div>
</div>

</div>
</div>
</div>
<script>
$(document).ready(function(e) {
	loadOverTable(<?php echo $id.",".$innings;?>);
	<?php if($info[$team.'_wickets'] == $info['Wickets'])echo "endInnings();"; ?>
			$("#runRate").text(calculateRunRate($("#total_runs").text()));
	maxOvers=parseInt($("#maxOvers").text());
		addNewOver(1);
		$("#runs").change(function()
		{
			if(parseInt($(this).val())!=7)
			{
				$("#noBallRun").remove();
				return;
			}
			$("#runs").before("<select id=\"noBallRun\" class=\"form-control\"><option value=\"0\">0</option><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option><option value=\"6\">6</option></select>");
		})
		$("#saveRuns").click(function()
		{
			
			if($("#runs").val() == "none")
			{
				alert("Illegal value supplied!");
				return;
			}
			
		updateScore=0;
		val = parseInt($("#runs").val());
		score = parseInt($("#total_runs").text()); 
		wickets = parseInt($("#wickets").text()); 
		      
			if(val == 9)
			{
				alert("next batsman");
				nextBall(val);
				$("#wickets").text(wickets+1);
				updateServer(score,<?php echo $id.",".$innings;?>);
				return;
			}
			else if(val == 8)
			{
				updateScore = parseInt(score)+1;
				nextBall(val);
			}
			else if(val == 7)
			{
				
				updateScore = 	1+parseInt($("#noBallRun").val())+parseInt(score);
				nextBall(val);
				
				
			}
			else
			{
				updateScore = parseInt(score)+parseInt(val);
				nextBall(val);
			}
			
			$("#total_runs").text(updateScore);
			$("#runRate").text(calculateRunRate($("#total_runs").text()));
			updateServer(updateScore,<?php echo $id.",".$innings;?>);
		})

	
});
	

</script>
</body>
</html>
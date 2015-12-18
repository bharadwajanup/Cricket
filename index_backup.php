<?php include "header.php"; 
?>
<div class="container panel panel-body">

<div class="row">
<div class="col-xs-12">
<div class="jumbotron">
<h2>Score</h2>
<h3><span id="total_runs">0</span>/<span id="wickets">0</span></h3>
<h4>Overs: <span id="overs">0</span>.<span id="ball">0</span></h4>
<h4>Maximum Overs: <span id="maxOvers">12</span></h4>
<h4>Run Rate <span id="runRate">0.00</span></h4>
</div>
</div>
<div class="col-xs-12" >
<div class="panel panel-default" >
<div class="panel-heading">
<h3 class="panel-title">Enter the runs scored in each ball and click on save</h3>
</div>
<div class="panel-body">
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
			//actualOvers = $("#overs").text()+"."+$("#ball").text();
			//floatActualOvers = parseFloat(actualOvers);
			//runRate = parseFloat(updateScore/floatActualOvers);
			//$("#runRate").text(runRate);
			$("#runRate").text(calculateRunRate(updateScore));
		})
		
	
});
$("#hideAuthentication").click(function()
{
	$("#AuthenticationPanel").remove();
	
})

	

</script>
</body>
</html>
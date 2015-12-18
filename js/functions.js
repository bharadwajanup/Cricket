
function fillDropDown()
{
	var html = "<select><option value=\"\"></option><option value=\"0\">0</option><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option><option value=\"6\">6</option><option value=\"7\">Nb</option><option value=\"8\">Wd</option></select>";
	return html;
}
function fillTextBox(id)
{
	var html = "<input type=\"number\" id=\""+id+"\"/>";
	return html;
}
function fillTable(overno)
{
	var html="<table class=\"table table-bordered\" id=\""+overno+"\"><tr ><td class=\"overCount\">"+overno+"</td><td class=\"balls\"></td><td class=\"balls\"></td><td class=\"balls\"></td><td class=\"balls\"></td><td class=\"balls\"></td><td class=\"balls\"></td></tr></table>";
	return html;
}
function addNewOver(overNumber)
{
	var row = "<div id=\""+overNumber+"\" class=\"row\"></div>";
	var html = "<tr><td id=\"over"+overNumber+"\"></td><td id=\"overInfo\">"+row+"</td></tr>";
	$("#overTable").append(html);
	$("#over"+overNumber).append("over"+overNumber);
}
function addBalltoOver(over,ball,value)
{
	if (value == 7)
	{	
	    var nbval = $("#noBallRun").val();
	
		var html="<div class=\"col-xs-1\">"+nbval+"Nb</div>";//<div class=\"panel panel-default panel-body\"></div>
	}
	else if (value == 8)
	{
		var html="<div class=\"col-xs-1\">Wd</div>";
	}
	else if (value == 9)
	{
		var html="<div class=\"col-xs-1\">W</div>";
	}
	else
	var html="<div class=\"col-xs-1\">"+value+"</div>";
	over = over+1;
	$("#"+over).append(html);
}
function nextBall(value)
{
		curOvers = parseInt($("#overs").text());
		curBall = parseInt($("#ball").text());
	if(parseInt(value)==7 ||parseInt(value)==8 )
	{
		
		addBalltoOver(curOvers,curBall,value);
		return;
	}
	
	
	if(curBall <5)
				{
				updateBall = curBall+1;
				$("#ball").text(updateBall);
				addBalltoOver(curOvers,curBall,value);
				}
				else
				{
					updateBall = 0;
					updateOver = curOvers+1;
					if(updateOver< parseInt(maxOvers))
					{
						addBalltoOver(curOvers,curBall,value);
						addNewOver(updateOver+1);
					}
					else
					{
						endInnings();
					}
					$("#ball").text(updateBall);
					$("#overs").text(updateOver);
				}
}
function endInnings()
{
	alert("Innings Finished!");
	$("#runs, #saveRuns").attr("disabled","");
		var url= window.location.href;
		var queryString = url.split('?')[1];
		var keyValues = queryString.split('&');
	loadOverTable(keyValues[0].split('=')[1],keyValues[1].split('=')[1]);
}
//6 * [Runs scored / {(No of completed overs * 6)+(No of balls bowled in the last incomplete over)}]
function calculateRunRate(runsScored)
{
	
	completedOvers = $("#overs").text();
	ballsInIncompleteOver = $("#ball").text();
	overs = completedOvers+"."+ballsInIncompleteOver;
	floatOvers = parseFloat(overs);
	if(completedOvers == "0")
	{
		runRate = parseFloat(runsScored/(floatOvers)*6/10).toFixed(2);
	}
	else
	runRate= parseFloat(((runsScored/floatOvers))).toFixed(2);
	return runRate;
	
}
function displayServerMessage()
{
	var html="<div class=\"alert alert-success alert-dismissable\" id=\"autoClose\"><button type=\"button\"  class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Success!</strong> Scores were succesfully updated to the server</div>";
	return html;
}
function loadOverTable(id,innings)
{
	$("#overInfoOuter").load(id+"_"+innings+".txt");
}
function updateServer(score,id,innings)
{
			$("#overTableInfo").val($("#overInfoOuter").html());
			var wickets = $("#wickets").text();
			
			var overs = $("#overs").text()+"."+$("#ball").text();
			
			var asyncReq = $.ajax("updateMatch.php?id="+id+"&score="+score+"&wickets="+wickets+"&overs="+overs+"&innings="+innings).done(function(){
				$("#serverMessage").html(displayServerMessage());
				$("#autoClose").fadeOut(3000);
				if($("#wickets").text() == $("#players").text())
				endInnings();
				}).fail(function(){alert("fail to send to server!!");});
			$.post( "maintainOverLog.php", $( "#overTableInfo" ).serialize()+"&id="+id+"&innings="+innings )
			.done(function(){
					//loadOverTable(id);
				})
			.fail(function(){
					alert("fail to send to server!!");
					});
			
}

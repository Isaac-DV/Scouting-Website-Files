
<html>
<head>
<meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
<link type="text/css" rel="stylesheet" href="datastyle.css"/>
<title>Team Averages</title>
</head>
<body>
<div id="bar">
	<div>
		<a href="http://www.gorohi.com/1323/viewdata.php">View Data</a>
	</div>
	<div>
		<a href="http://www.gorohi.com/1323/search.php">Search Teams</a>
	</div>
</div>
<form  action="teamaverages.php" method="post" id="searchform">
<input  type="text" name="search" class="search" placeholder="Search for teams"/>
<input  type="submit" name="submit" class="button" value="Search"/>
</form>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$password = 'oFi0g46#';
$database_name  = '1323_scouting';
$username = 'scoutingUser';
$server = 'localhost';

$page1 = "";

if(isset($_POST['submit'])){

mysql_connect($server, $username, $password);
mysql_select_db($database_name);

$page1 = "<table>
			<tr>
				<td>Team Number</td>
				<td>MATCHES PLAYED</td>
				<td>ACTIVEAUTO AVG</td>
				<td>SPYBOT START AVG</td>
				<td>DEFENSE BREACH AVG</td>
				<td>AUTO LOWBAR</td>
				<td>AUTO CULLIS</td>
				<td>AUTO CDF</td>
				<td>AUTO MOAT</td>
				<td>AUTO RAMP</td>
				<td>AUTO BRIDGE</td>
				<td>AUTO SALLY</td>
				<td>AUTO ROCKWALL</td>
				<td>AUTO ROUGH</td>
				<td>AUTO HIGH GOAL</td>
				<td>AUTO LOW GOAL</td>
				<td>SHOTS FIRED AVG</td>
				<td>HIGH SCORED AVG</td>
		        <td>HIGH ACCURACY</td>  
				<td>LOW SCORED AVG</td>
				<td>LOW BAR CROSSED</td>
				<td>LOW HARD CROSS</td>
				<td>PORTCULL CROSS</td>
				<td>PORT HARD CROSS</td>
				<td>CDF CROSSED</td>
				<td>CDF HARD CROSS</td>
				<td>MOAT CROSS</td>
				<td>MOAT HARD CROSS</td>
				<td>RAMP CROSS</td>
				<td>RAMP HARD CROSS</td>
				<td>DRAW CROSS</td>
				<td>DRAW HARD CROSS</td>
				<td>SALLY CROSS</td>
				<td>SALLY HARD CROSS</td>
				<td>ROCK WALL CROSS</td>
				<td>ROCK HARD CROSS</td>
				<td>ROUGH CROSS</td>
				<td>ROUGH HARD CROSS</td>
				<td>ROBOT CHALLENGE</td>
				<td>ROBOT CLIMB</td>
				<td>CLIMB SPEED</td>
				<td>CLIMB SUCCESS</td>
			</tr>";

$searchq = $_POST['search'];
$searchq = preg_replace("#[^0-9][^a-z][^A-Z]#","",$searchq);
if(strlen($searchq) > 4){
	
	if(($searchq == "highscored") || ($searchq == "activeauto") || ($searchq == "spybotstart") || ($searchq == "defensebreach") || ($searchq == "autohighgoal") || ($searchq == "autolowgoal") || ($searchq == "shotsfired") || ($searchq == "lowscored") || ($searchq == "climbspeed") || ($searchq == "climbsuccess")){
$query = mysql_query('SELECT teamNumber, avg('.$searchq.') FROM ChampData group by teamNumber order by avg('.$searchq.') desc');
if(mysql_error()){
	die(mysql_error());
}
while($match = mysql_fetch_array($query)){

	$averagesearch = mysql_fetch_array(mysql_query('select avg(activeAuto), avg(spybotStart), avg(defenseBreach), sum(autoLowBar), sum(autoCullis), sum(autoCDF), sum(autoMoat), sum(autoRamp), sum(autoBridge), sum(autoSally), sum(autoRockwall), sum(autoRough), avg(autoHighGoal), avg(autoLowGoal), avg(shotsFired), avg(highScored), avg(lowScored), sum(lowBarCrossed), sum(lowHardCrossed), sum(portCullCross), sum(portHardCross), sum(cdfCrossed), sum(cdfHardCross), sum(moatCross), sum(moatHardCross), sum(rampCross), sum(rampHardCross), sum(drawCross), sum(drawHardCross), sum(sallyCross), sum(sallyHardCross), sum(rockWallCross), sum(rockHardCross), sum(roughCross), sum(roughHardCross), sum(robotChallenge), sum(robotClimb), avg(climbSpeed), avg(climbSuccess) from ChampData where teamNumber="'.$match['teamNumber'].'"'));
	if(mysql_error()){
		die(mysql_error());
	}
	$percent1 = $averagesearch[38] * 100;
	if($averagesearch[14] != 0){
		$accuracy1 = $averagesearch[15] / $averagesearch[14] * 100; }
		else{
			$accuracy1 = 0;
		}
		$matchcount = mysql_query('select teamNumber from ChampData where teamNumber = "'.$match['teamNumber'].'"');
		$matchint = mysql_num_rows($matchcount);
		$page1 .= '<tr>
				<td>'.$match['teamNumber'].'</td>
				<td>'.$matchint.'</td>
				<td>'.$averagesearch[0].'</td>
				<td>'.$averagesearch[1].'</td>
				<td>'.$averagesearch[2].'</td>
				<td>'.$averagesearch[3].'</td>
				<td>'.$averagesearch[4].'</td>
				<td>'.$averagesearch[5].'</td>
				<td>'.$averagesearch[6].'</td>
				<td>'.$averagesearch[7].'</td>
				<td>'.$averagesearch[8].'</td>
				<td>'.$averagesearch[9].'</td>
				<td>'.$averagesearch[10].'</td>
				<td>'.$averagesearch[11].'</td>
				<td>'.$averagesearch[12].'</td>
				<td>'.$averagesearch[13].'</td>
				<td>'.$averagesearch[14].'</td>
				<td>'.$averagesearch[15].'</td>
				<td>'.$accuracy1.'%</td>
				<td>'.$averagesearch[16].'</td>
				<td>'.$averagesearch[17].'</td>
				<td>'.$averagesearch[18].'</td>
				<td>'.$averagesearch[19].'</td>
				<td>'.$averagesearch[20].'</td>
				<td>'.$averagesearch[21].'</td>
				<td>'.$averagesearch[22].'</td>
				<td>'.$averagesearch[23].'</td>
				<td>'.$averagesearch[24].'</td>
				<td>'.$averagesearch[25].'</td>
				<td>'.$averagesearch[26].'</td>
				<td>'.$averagesearch[27].'</td>
				<td>'.$averagesearch[28].'</td>
				<td>'.$averagesearch[29].'</td>
				<td>'.$averagesearch[30].'</td>
				<td>'.$averagesearch[31].'</td>
				<td>'.$averagesearch[32].'</td>
				<td>'.$averagesearch[33].'</td>
				<td>'.$averagesearch[34].'</td>
				<td>'.$averagesearch[35].'</td>
				<td>'.$averagesearch[36].'</td>
				<td>'.$averagesearch[37].' sec</td>
				<td>'.$percent1.'%</td>
			  </tr>';
}
	}
	else if($searchq == "highaccuracy"){
		$query = mysql_query('SELECT teamNumber, avg(highScored)/avg(shotsFired) FROM ChampData group by teamNumber order by avg(highScored)/avg(shotsFired) desc');
		if(mysql_error()){
			die(mysql_error());
		}
		while($match = mysql_fetch_array($query)){
		
			$averagesearch = mysql_fetch_array(mysql_query('select avg(activeAuto), avg(spybotStart), avg(defenseBreach), sum(autoLowBar), sum(autoCullis), sum(autoCDF), sum(autoMoat), sum(autoRamp), sum(autoBridge), sum(autoSally), sum(autoRockwall), sum(autoRough), avg(autoHighGoal), avg(autoLowGoal), avg(shotsFired), avg(highScored), avg(lowScored), sum(lowBarCrossed), sum(lowHardCrossed), sum(portCullCross), sum(portHardCross), sum(cdfCrossed), sum(cdfHardCross), sum(moatCross), sum(moatHardCross), sum(rampCross), sum(rampHardCross), sum(drawCross), sum(drawHardCross), sum(sallyCross), sum(sallyHardCross), sum(rockWallCross), sum(rockHardCross), sum(roughCross), sum(roughHardCross), sum(robotChallenge), sum(robotClimb), avg(climbSpeed), avg(climbSuccess) from ChampData where teamNumber="'.$match['teamNumber'].'"'));
			if(mysql_error()){
				die(mysql_error());
			}
			$percent1 = $averagesearch[38] * 100;
			if($averagesearch[14] != 0){
				$accuracy1 = $averagesearch[15] / $averagesearch[14] * 100; }
				else{
					$accuracy1 = 0;
				}
				$matchcount = mysql_query('select teamNumber from ChampData where teamNumber = "'.$match['teamNumber'].'"');
				$matchint = mysql_num_rows($matchcount);
				$page1 .= '<tr>
				<td>'.$match['teamNumber'].'</td>
				<td>'.$matchint.'</td>
				<td>'.$averagesearch[0].'</td>
				<td>'.$averagesearch[1].'</td>
				<td>'.$averagesearch[2].'</td>
				<td>'.$averagesearch[3].'</td>
				<td>'.$averagesearch[4].'</td>
				<td>'.$averagesearch[5].'</td>
				<td>'.$averagesearch[6].'</td>
				<td>'.$averagesearch[7].'</td>
				<td>'.$averagesearch[8].'</td>
				<td>'.$averagesearch[9].'</td>
				<td>'.$averagesearch[10].'</td>
				<td>'.$averagesearch[11].'</td>
				<td>'.$averagesearch[12].'</td>
				<td>'.$averagesearch[13].'</td>
				<td>'.$averagesearch[14].'</td>
				<td>'.$averagesearch[15].'</td>
				<td>'.$accuracy1.'%</td>
				<td>'.$averagesearch[16].'</td>
				<td>'.$averagesearch[17].'</td>
				<td>'.$averagesearch[18].'</td>
				<td>'.$averagesearch[19].'</td>
				<td>'.$averagesearch[20].'</td>
				<td>'.$averagesearch[21].'</td>
				<td>'.$averagesearch[22].'</td>
				<td>'.$averagesearch[23].'</td>
				<td>'.$averagesearch[24].'</td>
				<td>'.$averagesearch[25].'</td>
				<td>'.$averagesearch[26].'</td>
				<td>'.$averagesearch[27].'</td>
				<td>'.$averagesearch[28].'</td>
				<td>'.$averagesearch[29].'</td>
				<td>'.$averagesearch[30].'</td>
				<td>'.$averagesearch[31].'</td>
				<td>'.$averagesearch[32].'</td>
				<td>'.$averagesearch[33].'</td>
				<td>'.$averagesearch[34].'</td>
				<td>'.$averagesearch[35].'</td>
				<td>'.$averagesearch[36].'</td>
				<td>'.$averagesearch[37].' sec</td>
				<td>'.$percent1.'%</td>
			  </tr>';
		}
	}
	else{
$query = mysql_query('SELECT teamNumber, sum('.$searchq.') FROM ChampData group by teamNumber order by sum('.$searchq.') desc');
if(mysql_error()){
	die(mysql_error());
}
while($match = mysql_fetch_array($query)){

	$averagesearch = mysql_fetch_array(mysql_query('select avg(activeAuto), avg(spybotStart), avg(defenseBreach), sum(autoLowBar), sum(autoCullis), sum(autoCDF), sum(autoMoat), sum(autoRamp), sum(autoBridge), sum(autoSally), sum(autoRockwall), sum(autoRough), avg(autoHighGoal), avg(autoLowGoal), avg(shotsFired), avg(highScored), avg(lowScored), sum(lowBarCrossed), sum(lowHardCrossed), sum(portCullCross), sum(portHardCross), sum(cdfCrossed), sum(cdfHardCross), sum(moatCross), sum(moatHardCross), sum(rampCross), sum(rampHardCross), sum(drawCross), sum(drawHardCross), sum(sallyCross), sum(sallyHardCross), sum(rockWallCross), sum(rockHardCross), sum(roughCross), sum(roughHardCross), sum(robotChallenge), sum(robotClimb), avg(climbSpeed), avg(climbSuccess) from ChampData where teamNumber="'.$match['teamNumber'].'"'));
	if(mysql_error()){
		die(mysql_error());
	}
	$percent1 = $averagesearch[38] * 100;
	if($averagesearch[14] != 0){
		$accuracy1 = $averagesearch[15] / $averagesearch[14] * 100; }
		else{
			$accuracy1 = 0;
		}
		$matchcount = mysql_query('select teamNumber from ChampData where teamNumber = "'.$match['teamNumber'].'"');
		$matchint = mysql_num_rows($matchcount);
		$page1 .= '<tr>
				<td>'.$match['teamNumber'].'</td>
				<td>'.$matchint.'</td>
				<td>'.$averagesearch[0].'</td>
				<td>'.$averagesearch[1].'</td>
				<td>'.$averagesearch[2].'</td>
				<td>'.$averagesearch[3].'</td>
				<td>'.$averagesearch[4].'</td>
				<td>'.$averagesearch[5].'</td>
				<td>'.$averagesearch[6].'</td>
				<td>'.$averagesearch[7].'</td>
				<td>'.$averagesearch[8].'</td>
				<td>'.$averagesearch[9].'</td>
				<td>'.$averagesearch[10].'</td>
				<td>'.$averagesearch[11].'</td>
				<td>'.$averagesearch[12].'</td>
				<td>'.$averagesearch[13].'</td>
				<td>'.$averagesearch[14].'</td>
				<td>'.$averagesearch[15].'</td>
				<td>'.$accuracy1.'%</td>
				<td>'.$averagesearch[16].'</td>
				<td>'.$averagesearch[17].'</td>
				<td>'.$averagesearch[18].'</td>
				<td>'.$averagesearch[19].'</td>
				<td>'.$averagesearch[20].'</td>
				<td>'.$averagesearch[21].'</td>
				<td>'.$averagesearch[22].'</td>
				<td>'.$averagesearch[23].'</td>
				<td>'.$averagesearch[24].'</td>
				<td>'.$averagesearch[25].'</td>
				<td>'.$averagesearch[26].'</td>
				<td>'.$averagesearch[27].'</td>
				<td>'.$averagesearch[28].'</td>
				<td>'.$averagesearch[29].'</td>
				<td>'.$averagesearch[30].'</td>
				<td>'.$averagesearch[31].'</td>
				<td>'.$averagesearch[32].'</td>
				<td>'.$averagesearch[33].'</td>
				<td>'.$averagesearch[34].'</td>
				<td>'.$averagesearch[35].'</td>
				<td>'.$averagesearch[36].'</td>
				<td>'.$averagesearch[37].' sec</td>
				<td>'.$percent1.'%</td>
			  </tr>';
}
}
}
else {
$query = mysql_query('SELECT DISTINCT teamNumber FROM ChampData WHERE teamNumber = "'.$searchq.'"');
	  if(mysql_error()){
		die(mysql_error());
	}
while($match = mysql_fetch_array($query)){

	$averagesearch = mysql_fetch_array(mysql_query('select avg(activeAuto), avg(spybotStart), avg(defenseBreach), sum(autoLowBar), sum(autoCullis), sum(autoCDF), sum(autoMoat), sum(autoRamp), sum(autoBridge), sum(autoSally), sum(autoRockwall), sum(autoRough), avg(autoHighGoal), avg(autoLowGoal), avg(shotsFired), avg(highScored), avg(lowScored), sum(lowBarCrossed), sum(lowHardCrossed), sum(portCullCross), sum(portHardCross), sum(cdfCrossed), sum(cdfHardCross), sum(moatCross), sum(moatHardCross), sum(rampCross), sum(rampHardCross), sum(drawCross), sum(drawHardCross), sum(sallyCross), sum(sallyHardCross), sum(rockWallCross), sum(rockHardCross), sum(roughCross), sum(roughHardCross), sum(robotChallenge), sum(robotClimb), avg(climbSpeed), avg(climbSuccess) from ChampData where teamNumber="'.$match['teamNumber'].'"'));
if(mysql_error()){
	die(mysql_error());
}
$percent1 = $averagesearch[38] * 100;
if($averagesearch[14] != 0){
	$accuracy1 = $averagesearch[15] / $averagesearch[14] * 100; }
	else{
		$accuracy1 = 0;
	}
	$matchcount = mysql_query('select teamNumber from ChampData where teamNumber = "'.$match['teamNumber'].'"');
	$matchint = mysql_num_rows($matchcount);
	$page1 .= '<tr>
				<td>'.$match['teamNumber'].'</td>
				<td>'.$matchint.'</td>
				<td>'.$averagesearch[0].'</td>
				<td>'.$averagesearch[1].'</td>
				<td>'.$averagesearch[2].'</td>
				<td>'.$averagesearch[3].'</td>
				<td>'.$averagesearch[4].'</td>
				<td>'.$averagesearch[5].'</td>
				<td>'.$averagesearch[6].'</td>
				<td>'.$averagesearch[7].'</td>
				<td>'.$averagesearch[8].'</td>
				<td>'.$averagesearch[9].'</td>
				<td>'.$averagesearch[10].'</td>
				<td>'.$averagesearch[11].'</td>
				<td>'.$averagesearch[12].'</td>
				<td>'.$averagesearch[13].'</td>
				<td>'.$averagesearch[14].'</td>
				<td>'.$averagesearch[15].'</td>
				<td>'.$accuracy1.'%</td>
				<td>'.$averagesearch[16].'</td>
				<td>'.$averagesearch[17].'</td>
				<td>'.$averagesearch[18].'</td>
				<td>'.$averagesearch[19].'</td>
				<td>'.$averagesearch[20].'</td>
				<td>'.$averagesearch[21].'</td>
				<td>'.$averagesearch[22].'</td>
				<td>'.$averagesearch[23].'</td>
				<td>'.$averagesearch[24].'</td>
				<td>'.$averagesearch[25].'</td>
				<td>'.$averagesearch[26].'</td>
				<td>'.$averagesearch[27].'</td>
				<td>'.$averagesearch[28].'</td>
				<td>'.$averagesearch[29].'</td>
				<td>'.$averagesearch[30].'</td>
				<td>'.$averagesearch[31].'</td>
				<td>'.$averagesearch[32].'</td>
				<td>'.$averagesearch[33].'</td>
				<td>'.$averagesearch[34].'</td>
				<td>'.$averagesearch[35].'</td>
				<td>'.$averagesearch[36].'</td>
				<td>'.$averagesearch[37].' sec</td>
				<td>'.$percent1.'%</td>
			  </tr>';
	
	  }
	  }
	  }
	  print("$page1");

	  mysql_connect($server, $username, $password);
	  mysql_select_db($database_name);
	  $page = "<table>
			<tr>
				<td>Team Number</td>
				<td>MATCHES PLAYED</td>
				<td>ACTIVEAUTO AVG</td>
				<td>SPYBOT START AVG</td>
				<td>DEFENSE BREACH AVG</td>
				<td>AUTO LOWBAR</td>
				<td>AUTO CULLIS</td>
				<td>AUTO CDF</td>
				<td>AUTO MOAT</td>
				<td>AUTO RAMP</td>
				<td>AUTO BRIDGE</td>
				<td>AUTO SALLY</td>
				<td>AUTO ROCKWALL</td>
				<td>AUTO ROUGH</td>
				<td>AUTO HIGH GOAL</td>
				<td>AUTO LOW GOAL</td>
				<td>SHOTS FIRED AVG</td>
				<td>HIGH SCORED AVG</td>
		        <td>HIGH ACCURACY</td>
				<td>LOW SCORED AVG</td>
				<td>LOW BAR CROSSED</td>
				<td>LOW HARD CROSS</td>
				<td>PORTCULL CROSS</td>
				<td>PORT HARD CROSS</td>
				<td>CDF CROSSED</td>
				<td>CDF HARD CROSS</td>
				<td>MOAT CROSS</td>
				<td>MOAT HARD CROSS</td>
				<td>RAMP CROSS</td>
				<td>RAMP HARD CROSS</td>
				<td>DRAW CROSS</td>
				<td>DRAW HARD CROSS</td>
				<td>SALLY CROSS</td>
				<td>SALLY HARD CROSS</td>
				<td>ROCK WALL CROSS</td>
				<td>ROCK HARD CROSS</td>
				<td>ROUGH CROSS</td>
				<td>ROUGH HARD CROSS</td>
				<td>ROBOT CHALLENGE</td>
				<td>ROBOT CLIMB</td>
				<td>CLIMB SPEED</td>
				<td>CLIMB SUCCESS</td>
			</tr>";
	  $average = mysql_query('select distinct teamNumber from ChampData order by teamNumber asc');
	  while ($data = mysql_fetch_array($average)){
	  	$teamaverage = mysql_fetch_array(mysql_query('select avg(activeAuto), avg(spybotStart), avg(defenseBreach), sum(autoLowBar), sum(autoCullis), sum(autoCDF), sum(autoMoat), sum(autoRamp), sum(autoBridge), sum(autoSally), sum(autoRockwall), sum(autoRough), avg(autoHighGoal), avg(autoLowGoal), avg(shotsFired), avg(highScored), avg(lowScored), sum(lowBarCrossed), sum(lowHardCrossed), sum(portCullCross), sum(portHardCross), sum(cdfCrossed), sum(cdfHardCross), sum(moatCross), sum(moatHardCross), sum(rampCross), sum(rampHardCross), sum(drawCross), sum(drawHardCross), sum(sallyCross), sum(sallyHardCross), sum(rockWallCross), sum(rockHardCross), sum(roughCross), sum(roughHardCross), sum(robotChallenge), sum(robotClimb), avg(climbSpeed), avg(climbSuccess) from ChampData where teamNumber="'.$data['teamNumber'].'"'));
	  	if(mysql_error()){
	  		die(mysql_error());
	  	}
	  	$percent = $teamaverage[38] * 100;
	  	if($teamaverage[14] != 0){
	  		$accuracy = $teamaverage[15] / $teamaverage[14] * 100; }
	  		else{
	  			$accuracy = 0;
	  		}
	  		$matchcount = mysql_query('select teamNumber from ChampData where teamNumber = "'.$data['teamNumber'].'"');
	  		$matchint = mysql_num_rows($matchcount);
	  		$page .= '<tr>
				<td>'.$data['teamNumber'].'</td>
				<td>'.$matchint.'</td>
				<td>'.$teamaverage[0].'</td>
				<td>'.$teamaverage[1].'</td>
				<td>'.$teamaverage[2].'</td>
				<td>'.$teamaverage[3].'</td>
				<td>'.$teamaverage[4].'</td>
				<td>'.$teamaverage[5].'</td>
				<td>'.$teamaverage[6].'</td>
				<td>'.$teamaverage[7].'</td>
				<td>'.$teamaverage[8].'</td>
				<td>'.$teamaverage[9].'</td>
				<td>'.$teamaverage[10].'</td>
				<td>'.$teamaverage[11].'</td>
				<td>'.$teamaverage[12].'</td>
				<td>'.$teamaverage[13].'</td>
				<td>'.$teamaverage[14].'</td>
				<td>'.$teamaverage[15].'</td>
				<td>'.$accuracy.'%</td>
				<td>'.$teamaverage[16].'</td>
				<td>'.$teamaverage[17].'</td>
				<td>'.$teamaverage[18].'</td>
				<td>'.$teamaverage[19].'</td>
				<td>'.$teamaverage[20].'</td>
				<td>'.$teamaverage[21].'</td>
				<td>'.$teamaverage[22].'</td>
				<td>'.$teamaverage[23].'</td>
				<td>'.$teamaverage[24].'</td>
				<td>'.$teamaverage[25].'</td>
				<td>'.$teamaverage[26].'</td>
				<td>'.$teamaverage[27].'</td>
				<td>'.$teamaverage[28].'</td>
				<td>'.$teamaverage[29].'</td>
				<td>'.$teamaverage[30].'</td>
				<td>'.$teamaverage[31].'</td>
				<td>'.$teamaverage[32].'</td>
				<td>'.$teamaverage[33].'</td>
				<td>'.$teamaverage[34].'</td>
				<td>'.$teamaverage[35].'</td>
				<td>'.$teamaverage[36].'</td>
				<td>'.$teamaverage[37].' sec</td>
				<td>'.$percent.'%</td>
			  </tr>';
	  }
	  
	  echo $page;
?>
</body>
</html>
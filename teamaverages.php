
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
				<td class='activeauto'>ACTIVEAUTO AVG</td>
				<td class='spybotstart'>SPYBOT START AVG</td>
				<td class='defensebreach'>DEFENSE BREACH AVG</td>
				<td class='autolowbar'>AUTO LOWBAR</td>
				<td class='autocullis'>AUTO CULLIS</td>
				<td class='autocdf'>AUTO CDF</td>
				<td class='automoat'>AUTO MOAT</td>
				<td class='autoramp'>AUTO RAMP</td>
				<td class='autobridge'>AUTO BRIDGE</td>
				<td class='autosally'>AUTO SALLY</td>
				<td class='autorockwall'>AUTO ROCKWALL</td>
				<td class='autorough'>AUTO ROUGH</td>
				<td class='autohighgoal'>AUTO HIGH GOAL</td>
				<td class='autolowgoal'>AUTO LOW GOAL</td>
				<td class='shotsfired'>SHOTS FIRED AVG</td>
				<td class='highscored'>HIGH SCORED AVG</td>
		        <td>HIGH ACCURACY</td>  
				<td class='lowscored'>LOW SCORED AVG</td>
				<td class='lowbarcrossed'>LOW BAR CROSSED</td>
				<td class='lowhardcrossed'>LOW HARD CROSS</td>
				<td class='portcullcross'>PORTCULL CROSS</td>
				<td class='porthardcross'>PORT HARD CROSS</td>
				<td class='cdfcrossed'>CDF CROSSED</td>
				<td class='cdfhardcross'>CDF HARD CROSS</td>
				<td class='moatcross'>MOAT CROSS</td>
				<td class='moathardcross'>MOAT HARD CROSS</td>
				<td class='rampcross'>RAMP CROSS</td>
				<td class='ramphardcross'>RAMP HARD CROSS</td>
				<td class='drawcross'>DRAW CROSS</td>
				<td class='drawhardcross'>DRAW HARD CROSS</td>
				<td class='sallycross'>SALLY CROSS</td>
				<td class='sallyhardcross'>SALLY HARD CROSS</td>
				<td class='rockwallcross'>ROCK WALL CROSS</td>
				<td class='rockhardcross'>ROCK HARD CROSS</td>
				<td class='roughcross'>ROUGH CROSS</td>
				<td class='roughhardcross'>ROUGH HARD CROSS</td>
				<td class='robotchallenge'>ROBOT CHALLENGE</td>
				<td class='robotclimb'>ROBOT CLIMB</td>
				<td class='climbspeed'>CLIMB SPEED</td>
				<td class='climbsuccess'>CLIMB SUCCESS</td>
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
				<td class="activeauto">'.$averagesearch[0].'</td>
				<td class="spybotstart">'.$averagesearch[1].'</td>
				<td class="defensebreach">'.$averagesearch[2].'</td>
				<td class="autolowbar">'.$averagesearch[3].'</td>
				<td class="autocullis">'.$averagesearch[4].'</td>
				<td class="autocdf">'.$averagesearch[5].'</td>
				<td class="automoat">'.$averagesearch[6].'</td>
				<td class="autoramp">'.$averagesearch[7].'</td>
				<td class="autobridge">'.$averagesearch[8].'</td>
				<td class="autosally">'.$averagesearch[9].'</td>
				<td class="autorockwall">'.$averagesearch[10].'</td>
				<td class="autorough">'.$averagesearch[11].'</td>
				<td class="autohighgoal">'.$averagesearch[12].'</td>
				<td class="autolowgoal">'.$averagesearch[13].'</td>
				<td class="shotsfired">'.$averagesearch[14].'</td>
				<td class="highscored">'.$averagesearch[15].'</td>
				<td>'.$accuracy1.'%</td>
				<td class="lowscored">'.$averagesearch[16].'</td>
				<td class="lowbarcrossed">'.$averagesearch[17].'</td>
				<td class="lowhardcrossed">'.$averagesearch[18].'</td>
				<td class="portcullcross">'.$averagesearch[19].'</td>
				<td class="porthardcross">'.$averagesearch[20].'</td>
				<td class="cdfcrossed">'.$averagesearch[21].'</td>
				<td class="cdfhardcross">'.$averagesearch[22].'</td>
				<td class="moatcross">'.$averagesearch[23].'</td>
				<td class="moathardcross">'.$averagesearch[24].'</td>
				<td class="rampcross">'.$averagesearch[25].'</td>
				<td class="ramphardcross">'.$averagesearch[26].'</td>
				<td class="drawcross">'.$averagesearch[27].'</td>
				<td class="drawhardcross">'.$averagesearch[28].'</td>
				<td class="sallycross">'.$averagesearch[29].'</td>
				<td class="sallyhardcross">'.$averagesearch[30].'</td>
				<td class="rockwallcross">'.$averagesearch[31].'</td>
				<td class="rockhardcross">'.$averagesearch[32].'</td>
				<td class="roughcross">'.$averagesearch[33].'</td>
				<td class="roughhardcross">'.$averagesearch[34].'</td>
				<td class="robotchallenge">'.$averagesearch[35].'</td>
				<td class="robotclimb">'.$averagesearch[36].'</td>
				<td class="climbspeed">'.$averagesearch[37].' sec</td>
				<td class="climbsuccess">'.$percent1.'%</td>
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
				<td class="activeauto">'.$averagesearch[0].'</td>
				<td class="spybotstart">'.$averagesearch[1].'</td>
				<td class="defensebreach">'.$averagesearch[2].'</td>
				<td class="autolowbar">'.$averagesearch[3].'</td>
				<td class="autocullis">'.$averagesearch[4].'</td>
				<td class="autocdf">'.$averagesearch[5].'</td>
				<td class="automoat">'.$averagesearch[6].'</td>
				<td class="autoramp">'.$averagesearch[7].'</td>
				<td class="autobridge">'.$averagesearch[8].'</td>
				<td class="autosally">'.$averagesearch[9].'</td>
				<td class="autorockwall">'.$averagesearch[10].'</td>
				<td class="autorough">'.$averagesearch[11].'</td>
				<td class="autohighgoal">'.$averagesearch[12].'</td>
				<td class="autolowgoal">'.$averagesearch[13].'</td>
				<td class="shotsfired">'.$averagesearch[14].'</td>
				<td class="highscored">'.$averagesearch[15].'</td>
				<td>'.$accuracy1.'%</td>
				<td class="lowscored">'.$averagesearch[16].'</td>
				<td class="lowbarcrossed">'.$averagesearch[17].'</td>
				<td class="lowhardcrossed">'.$averagesearch[18].'</td>
				<td class="portcullcross">'.$averagesearch[19].'</td>
				<td class="porthardcross">'.$averagesearch[20].'</td>
				<td class="cdfcrossed">'.$averagesearch[21].'</td>
				<td class="cdfhardcross">'.$averagesearch[22].'</td>
				<td class="moatcross">'.$averagesearch[23].'</td>
				<td class="moathardcross">'.$averagesearch[24].'</td>
				<td class="rampcross">'.$averagesearch[25].'</td>
				<td class="ramphardcross">'.$averagesearch[26].'</td>
				<td class="drawcross">'.$averagesearch[27].'</td>
				<td class="drawhardcross">'.$averagesearch[28].'</td>
				<td class="sallycross">'.$averagesearch[29].'</td>
				<td class="sallyhardcross">'.$averagesearch[30].'</td>
				<td class="rockwallcross">'.$averagesearch[31].'</td>
				<td class="rockhardcross">'.$averagesearch[32].'</td>
				<td class="roughcross">'.$averagesearch[33].'</td>
				<td class="roughhardcross">'.$averagesearch[34].'</td>
				<td class="robotchallenge">'.$averagesearch[35].'</td>
				<td class="robotclimb">'.$averagesearch[36].'</td>
				<td class="climbspeed">'.$averagesearch[37].' sec</td>
				<td class="climbsuccess">'.$percent1.'%</td>
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
				<td class="activeauto">'.$averagesearch[0].'</td>
				<td class="spybotstart">'.$averagesearch[1].'</td>
				<td class="defensebreach">'.$averagesearch[2].'</td>
				<td class="autolowbar">'.$averagesearch[3].'</td>
				<td class="autocullis">'.$averagesearch[4].'</td>
				<td class="autocdf">'.$averagesearch[5].'</td>
				<td class="automoat">'.$averagesearch[6].'</td>
				<td class="autoramp">'.$averagesearch[7].'</td>
				<td class="autobridge">'.$averagesearch[8].'</td>
				<td class="autosally">'.$averagesearch[9].'</td>
				<td class="autorockwall">'.$averagesearch[10].'</td>
				<td class="autorough">'.$averagesearch[11].'</td>
				<td class="autohighgoal">'.$averagesearch[12].'</td>
				<td class="autolowgoal">'.$averagesearch[13].'</td>
				<td class="shotsfired">'.$averagesearch[14].'</td>
				<td class="highscored">'.$averagesearch[15].'</td>
				<td>'.$accuracy1.'%</td>
				<td class="lowscored">'.$averagesearch[16].'</td>
				<td class="lowbarcrossed">'.$averagesearch[17].'</td>
				<td class="lowhardcrossed">'.$averagesearch[18].'</td>
				<td class="portcullcross">'.$averagesearch[19].'</td>
				<td class="porthardcross">'.$averagesearch[20].'</td>
				<td class="cdfcrossed">'.$averagesearch[21].'</td>
				<td class="cdfhardcross">'.$averagesearch[22].'</td>
				<td class="moatcross">'.$averagesearch[23].'</td>
				<td class="moathardcross">'.$averagesearch[24].'</td>
				<td class="rampcross">'.$averagesearch[25].'</td>
				<td class="ramphardcross">'.$averagesearch[26].'</td>
				<td class="drawcross">'.$averagesearch[27].'</td>
				<td class="drawhardcross">'.$averagesearch[28].'</td>
				<td class="sallycross">'.$averagesearch[29].'</td>
				<td class="sallyhardcross">'.$averagesearch[30].'</td>
				<td class="rockwallcross">'.$averagesearch[31].'</td>
				<td class="rockhardcross">'.$averagesearch[32].'</td>
				<td class="roughcross">'.$averagesearch[33].'</td>
				<td class="roughhardcross">'.$averagesearch[34].'</td>
				<td class="robotchallenge">'.$averagesearch[35].'</td>
				<td class="robotclimb">'.$averagesearch[36].'</td>
				<td class="climbspeed">'.$averagesearch[37].' sec</td>
				<td class="climbsuccess">'.$percent1.'%</td>
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
				<td class="activeauto">'.$averagesearch[0].'</td>
				<td class="spybotstart">'.$averagesearch[1].'</td>
				<td class="defensebreach">'.$averagesearch[2].'</td>
				<td class="autolowbar">'.$averagesearch[3].'</td>
				<td class="autocullis">'.$averagesearch[4].'</td>
				<td class="autocdf">'.$averagesearch[5].'</td>
				<td class="automoat">'.$averagesearch[6].'</td>
				<td class="autoramp">'.$averagesearch[7].'</td>
				<td class="autobridge">'.$averagesearch[8].'</td>
				<td class="autosally">'.$averagesearch[9].'</td>
				<td class="autorockwall">'.$averagesearch[10].'</td>
				<td class="autorough">'.$averagesearch[11].'</td>
				<td class="autohighgoal">'.$averagesearch[12].'</td>
				<td class="autolowgoal">'.$averagesearch[13].'</td>
				<td class="shotsfired">'.$averagesearch[14].'</td>
				<td class="highscored">'.$averagesearch[15].'</td>
				<td>'.$accuracy1.'%</td>
				<td class="lowscored">'.$averagesearch[16].'</td>
				<td class="lowbarcrossed">'.$averagesearch[17].'</td>
				<td class="lowhardcrossed">'.$averagesearch[18].'</td>
				<td class="portcullcross">'.$averagesearch[19].'</td>
				<td class="porthardcross">'.$averagesearch[20].'</td>
				<td class="cdfcrossed">'.$averagesearch[21].'</td>
				<td class="cdfhardcross">'.$averagesearch[22].'</td>
				<td class="moatcross">'.$averagesearch[23].'</td>
				<td class="moathardcross">'.$averagesearch[24].'</td>
				<td class="rampcross">'.$averagesearch[25].'</td>
				<td class="ramphardcross">'.$averagesearch[26].'</td>
				<td class="drawcross">'.$averagesearch[27].'</td>
				<td class="drawhardcross">'.$averagesearch[28].'</td>
				<td class="sallycross">'.$averagesearch[29].'</td>
				<td class="sallyhardcross">'.$averagesearch[30].'</td>
				<td class="rockwallcross">'.$averagesearch[31].'</td>
				<td class="rockhardcross">'.$averagesearch[32].'</td>
				<td class="roughcross">'.$averagesearch[33].'</td>
				<td class="roughhardcross">'.$averagesearch[34].'</td>
				<td class="robotchallenge">'.$averagesearch[35].'</td>
				<td class="robotclimb">'.$averagesearch[36].'</td>
				<td class="climbspeed">'.$averagesearch[37].' sec</td>
				<td class="climbsuccess">'.$percent1.'%</td>
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
				<td class='activeauto'>ACTIVEAUTO AVG</td>
				<td class='spybotstart'>SPYBOT START AVG</td>
				<td class='defensebreach'>DEFENSE BREACH AVG</td>
				<td class='autolowbar'>AUTO LOWBAR</td>
				<td class='autocullis'>AUTO CULLIS</td>
				<td class='autocdf'>AUTO CDF</td>
				<td class='automoat'>AUTO MOAT</td>
				<td class='autoramp'>AUTO RAMP</td>
				<td class='autobridge'>AUTO BRIDGE</td>
				<td class='autosally'>AUTO SALLY</td>
				<td class='autorockwall'>AUTO ROCKWALL</td>
				<td class='autorough'>AUTO ROUGH</td>
				<td class='autohighgoal'>AUTO HIGH GOAL</td>
				<td class='autolowgoal'>AUTO LOW GOAL</td>
				<td class='shotsfired'>SHOTS FIRED AVG</td>
				<td class='highscored'>HIGH SCORED AVG</td>
		        <td>HIGH ACCURACY</td>  
				<td class='lowscored'>LOW SCORED AVG</td>
				<td class='lowbarcrossed'>LOW BAR CROSSED</td>
				<td class='lowhardcrossed'>LOW HARD CROSS</td>
				<td class='portcullcross'>PORTCULL CROSS</td>
				<td class='porthardcross'>PORT HARD CROSS</td>
				<td class='cdfcrossed'>CDF CROSSED</td>
				<td class='cdfhardcross'>CDF HARD CROSS</td>
				<td class='moatcross'>MOAT CROSS</td>
				<td class='moathardcross'>MOAT HARD CROSS</td>
				<td class='rampcross'>RAMP CROSS</td>
				<td class='ramphardcross'>RAMP HARD CROSS</td>
				<td class='drawcross'>DRAW CROSS</td>
				<td class='drawhardcross'>DRAW HARD CROSS</td>
				<td class='sallycross'>SALLY CROSS</td>
				<td class='sallyhardcross'>SALLY HARD CROSS</td>
				<td class='rockwallcross'>ROCK WALL CROSS</td>
				<td class='rockhardcross'>ROCK HARD CROSS</td>
				<td class='roughcross'>ROUGH CROSS</td>
				<td class='roughhardcross'>ROUGH HARD CROSS</td>
				<td class='robotchallenge'>ROBOT CHALLENGE</td>
				<td class='robotclimb'>ROBOT CLIMB</td>
				<td class='climbspeed'>CLIMB SPEED</td>
				<td class='climbsuccess'>CLIMB SUCCESS</td>
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
				<td class="activeauto">'.$teamaverage[0].'</td>
				<td class="spybotstart">'.$teamaverage[1].'</td>
				<td class="defensebreach">'.$teamaverage[2].'</td>
				<td class="autolowbar">'.$teamaverage[3].'</td>
				<td class="autocullis">'.$teamaverage[4].'</td>
				<td class="autocdf">'.$teamaverage[5].'</td>
				<td class="automoat">'.$teamaverage[6].'</td>
				<td class="autoramp">'.$teamaverage[7].'</td>
				<td class="autobridge">'.$teamaverage[8].'</td>
				<td class="autosally">'.$teamaverage[9].'</td>
				<td class="autorockwall">'.$teamaverage[10].'</td>
				<td class="autorough">'.$teamaverage[11].'</td>
				<td class="autohighgoal">'.$teamaverage[12].'</td>
				<td class="autolowgoal">'.$teamaverage[13].'</td>
				<td class="shotsfired">'.$teamaverage[14].'</td>
				<td class="highscored">'.$teamaverage[15].'</td>
				<td>'.$accuracy.'%</td>
				<td class="lowscored">'.$teamaverage[16].'</td>
				<td class="lowbarcrossed">'.$teamaverage[17].'</td>
				<td class="lowhardcrossed">'.$teamaverage[18].'</td>
				<td class="portcullcross">'.$teamaverage[19].'</td>
				<td class="porthardcross">'.$teamaverage[20].'</td>
				<td class="cdfcrossed">'.$teamaverage[21].'</td>
				<td class="cdfhardcross">'.$teamaverage[22].'</td>
				<td class="moatcross">'.$teamaverage[23].'</td>
				<td class="moathardcross">'.$teamaverage[24].'</td>
				<td class="rampcross">'.$teamaverage[25].'</td>
				<td class="ramphardcross">'.$teamaverage[26].'</td>
				<td class="drawcross">'.$teamaverage[27].'</td>
				<td class="drawhardcross">'.$teamaverage[28].'</td>
				<td class="sallycross">'.$teamaverage[29].'</td>
				<td class="sallyhardcross">'.$teamaverage[30].'</td>
				<td class="rockwallcross">'.$teamaverage[31].'</td>
				<td class="rockhardcross">'.$teamaverage[32].'</td>
				<td class="roughcross">'.$teamaverage[33].'</td>
				<td class="roughhardcross">'.$teamaverage[34].'</td>
				<td class="robotchallenge">'.$teamaverage[35].'</td>
				<td class="robotclimb">'.$teamaverage[36].'</td>
				<td class="climbspeed">'.$teamaverage[37].' sec</td>
				<td class="climbsuccess">'.$percent.'%</td>
			  </tr>';
	  }
	  
	  echo $page;
?>
</body>
</html>
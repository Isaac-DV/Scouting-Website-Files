
<html>
<head>
<meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
<link type="text/css" rel="stylesheet" href="datastyle.css"/>
<title>Search Teams</title>
</head>
<body>
<div id="bar">
	<div>
		<a href="http://www.gorohi.com/1323/teamaverages.php">Team Averages</a>
	</div>
	<div>
		<a href="http://www.gorohi.com/1323/search.php">Search Teams</a>
	</div>
</div>
<form  action="viewdata.php" method="post" id="searchform">
<input  type="text" name="search" placeholder="Search for teams"/>
<input  type="submit" name="submit" value="Search"/>
</form>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$password = 'oFi0g46#';
$database_name  = '1323_scouting';
$username = 'scoutingUser';
$server = 'localhost';
$row = 1;

$page = "";

if(isset($_POST['submit'])){

mysql_connect($server, $username, $password);
mysql_select_db($database_name);

$page = "<table>
			<tr>
				<td>Match Number</td>
				<td>Team Number</td>
				<td>Team Name</td>
				<td>Auto Points</td>
				<td class='activeauto'>Active_Auto</td>
				<td class='spybotstart'>Spybot_Start</td>
				<td class='defensebreach'>Defense_Breach</td>
				<td class='autolowbar'>Auto_LowBar</td>
		        <td class='autocullis'>Auto_Cullis</td>
				<td class='autocdf'>Auto_CDF</td>
				<td class='automoat'>Auto_Moat</td>
				<td class='autoramp'>Auto_Ramp</td>
				<td class='autobridge'>Auto_Bridge</td>
				<td class='autosally'>Auto_Sally</td>
				<td class='autorockwall'>Auto_Rockwall</td>
				<td class='autorough'>Auto_Rough</td>
				<td class='autohighgoal'>Auto_High_Goal</td>
		        <td class='autolowgoal'>Auto_Low_Goal</td>
				<td class='shotsfired'>Shots_Fired</td>
				<td class='highscored'>High_Scored</td>
				<td class='lowscored'>Low_Scored</td>
				<td class='lowbarcrossed'>Low_Bar_Crossed</td>
				<td class='lowhardcrossed'><p>Low_Hard_Crossed</p></td>
				<td class='portcullcross'>Port_Cull_Cross</td>
				<td class='porthardcross'>Port_Hard_Cross</td>
				<td class='cdfcrossed'>Cdf_Crossed</td>
				<td class='cdfhardcross'><p>Cdf_Hard_Cross</p></td>
				<td class='moatcross'><p>Moat_Cross</p></td>
				<td class='moathardcross'><p>Moat_Hard_Cross</p></td>
				<td class='rampcross'><p>Ramp_Cross</p></td>
				<td class='ramphardcross'>Ramp_Hard_Cross</td>
				<td class='drawcross'>Draw_Cross</td>
				<td class='drawhardcross'>Draw_Hard_Cross</td>
				<td class='sallycross'>Sally_Cross</td>
				<td class='sallyhardcross'>Sally_Hard_Cross</td>
				<td class='rockwallcross'>Rock_Wall_Cross</td>
				<td class='rockhardcross'>Rock_Hard_Cross</td>
				<td class='roughcross'>Rough_Cross</td>
				<td class='roughhardcross'>Rough_Hard_Cross</td>
				<td class='robotchallenge'>Robot_Challenge</td>
				<td class='robotclimb'>Robot_Climb</td>
				<td class='climbspeed'>Climb_Speed</td>
				<td class='climbsuccess'>Climb_Success</td>
				<td width=\"300\">Notes</td>
			</tr>";

$searchq = $_POST['search'];
$searchq = preg_replace("#[^0-9]#","",$searchq);
$query = mysql_query('SELECT * FROM ChampData WHERE teamNumber = "'.$searchq.'" order by matchNumber asc');
	  if(mysql_error()){
		die(mysql_error());
	}
while($match = mysql_fetch_array($query)){

	if($match['activeAuto']=="1"){
		$auto = "Y";
	}
	else{
		$auto = "N";
	}
	if($match['spybotStart'] == "1"){
		$spy = "Y";
	}else{
		$spy = "N";
	}
	if($match['defenseBreach'] == "1"){
		$defBreach = "Y";
	}else{
		$defBreach = "N";
	}
	$page .= '<tr>
				<td>'.$match['matchNumber'].'</td>';
	  	if($match['teamNumber'] == '1323'){
	  		$page .= '<td class="blue">'.$match['teamNumber'].'</td>';
	  	}else if($match['teamNumber'] == '1678'){
	  		$page .= '<td class="green">'.$match['teamNumber'].'</td>';
	  	}else if($match['teamNumber'] == '254'){
	  		$page .= '<td class="poofs">'.$match['teamNumber'].'</td>';
	  	}else if($match['teamNumber'] == '971'){
	  		$page .= '<td class="yellow">'.$match['teamNumber'].'</td>';
	  		}else{
	  			$page .= '<td>'.$match['teamNumber'].'</td>';
	  		}
				
	  $page .='<td>'.$match['teamName'].'</td>
				<td>HOLDER</td>
				<td class="activeauto">'.$auto.'</td>
				<td class="spybotstart">'.$spy.'</td>
				<td class="defensebreach">'.$defBreach.'</td>
				<td class="autolowbar">'.$match['autoLowBar'].'</td>
				<td class="autocullis">'.$match['autoCullis'].'</td>
				<td class="autocdf">'.$match['autoCDF'].'</td>
				<td class="automoat">'.$match['autoMoat'].'</td>
				<td class="autoramp">'.$match['autoRamp'].'</td>
				<td class="autobridge">'.$match['autoBridge'].'</td>
				<td class="autosally">'.$match['autoSally'].'</td>
				<td class="autorockwall">'.$match['autoRockwall'].'</td>
				<td class="autorough">'.$match['autoRough'].'</td>
				<td class="autohighgoal">'.$match['autoHighGoal'].'</td>
				<td class="autolowgoal">'.$match['autoLowGoal'].'</td>
				<td class="shotsfired">'.$match['shotsFired'].'</td>
				<td class="highscored">'.$match['highScored'].'</td>
				<td class="lowscored">'.$match['lowScored'].'</td>
				<td class="lowbarcrossed">'.$match['lowBarCrossed'].'</td>
				<td class="lowhardcrossed"><p>'.$match['lowHardCrossed'].'</p></td>
				<td class="portcullcross">'.$match['portCullCross'].'</td>
				<td class="porthardcross">'.$match['portHardCross'].'</td>
				<td class="cdfcrossed">'.$match['cdfCrossed'].'</td>
				<td class="cdfhardcross"><p>'.$match['cdfHardCross'].'</p></td>
				<td class="moatcross"><p>'.$match['moatCross'].'</p></td>
				<td class="moathardcross"><p>'.$match['moatHardCross'].'</p></td>
				<td class="rampcross"><p>'.$match['rampCross'].'</p></td>
				<td class="ramphardcross">'.$match['rampHardCross'].'</td>
				<td class="drawcross">'.$match['drawCross'].'</td>
				<td class="drawhardcross">'.$match['drawHardCross'].'</td>
				<td class="sallycross">'.$match['sallyCross'].'</td>
				<td class="sallyhardcross">'.$match['sallyHardCross'].'</td>
				<td class="rockwallcross">'.$match['rockWallCross'].'</td>
				<td class="rockhardcross">'.$match['rockHardCross'].'</td>
				<td class="roughcross">'.$match['roughCross'].'</td>
				<td class="roughhardcross">'.$match['roughHardCross'].'</td>
				<td class="robotchallenge">'.$match['robotChallenge'].'</td>
				<td class="robotclimb">'.$match['robotClimb'].'</td>
				<td class="climbspeed">'.$match['climbSpeed'].'</td>
				<td class="climbsuccess">'.$match['climbSuccess'].'</td>
				<td>'.$match['notes'].'</td>
			</tr>';
	
	  }
	  }
	  $page .= "</table>";
	  print("$page");
	  
	  mysql_connect($server, $username, $password);
	  mysql_select_db($database_name);
	  
	  $info = mysql_query('select * from ChampData order by matchNumber');
	  $page1 = "<table>
			<tr>
				<td>Match Number</td>
				<td>Team Number</td>
				<td>Team Name</td>
				<td>Auto Points</td>
				<td class='activeauto'>Active_Auto</td>
				<td class='spybotstart'>Spybot_Start</td>
				<td class='defensebreach'>Defense_Breach</td>
				<td class='autolowbar'>Auto_LowBar</td>
		        <td class='autocullis'>Auto_Cullis</td>
				<td class='autocdf'>Auto_CDF</td>
				<td class='automoat'>Auto_Moat</td>
				<td class='autoramp'>Auto_Ramp</td>
				<td class='autobridge'>Auto_Bridge</td>
				<td class='autosally'>Auto_Sally</td>
				<td class='autorockwall'>Auto_Rockwall</td>
				<td class='autorough'>Auto_Rough</td>
				<td class='autohighgoal'>Auto_High_Goal</td>
		        <td class='autolowgoal'>Auto_Low_Goal</td>
				<td class='shotsfired'>Shots_Fired</td>
				<td class='highscored'>High_Scored</td>
				<td class='lowscored'>Low_Scored</td>
				<td class='lowbarcrossed'>Low_Bar_Crossed</td>
				<td class='lowhardcrossed'><p>Low_Hard_Crossed</p></td>
				<td class='portcullcross'>Port_Cull_Cross</td>
				<td class='porthardcross'>Port_Hard_Cross</td>
				<td class='cdfcrossed'>Cdf_Crossed</td>
				<td class='cdfhardcross'><p>Cdf_Hard_Cross</p></td>
				<td class='moatcross'><p>Moat_Cross</p></td>
				<td class='moathardcross'><p>Moat_Hard_Cross</p></td>
				<td class='rampcross'><p>Ramp_Cross</p></td>
				<td class='ramphardcross'>Ramp_Hard_Cross</td>
				<td class='drawcross'>Draw_Cross</td>
				<td class='drawhardcross'>Draw_Hard_Cross</td>
				<td class='sallycross'>Sally_Cross</td>
				<td class='sallyhardcross'>Sally_Hard_Cross</td>
				<td class='rockwallcross'>Rock_Wall_Cross</td>
				<td class='rockhardcross'>Rock_Hard_Cross</td>
				<td class='roughcross'>Rough_Cross</td>
				<td class='roughhardcross'>Rough_Hard_Cross</td>
				<td class='robotchallenge'>Robot_Challenge</td>
				<td class='robotclimb'>Robot_Climb</td>
				<td class='climbspeed'>Climb_Speed</td>
				<td class='climbsuccess'>Climb_Success</td>
				<td width=\"300\">Notes</td>
			</tr>";
	  while($match = mysql_fetch_array($info)){
	  
	  	if($match['activeAuto']=="1"){
	  		$auto = "Y";
	  	}
	  	else{
	  		$auto = "N";
	  	}
	  	if($match['spybotStart'] == "1"){
	  		$spy = "Y";
	  	}else{
	  		$spy = "N";
	  	}
	  	if($match['defenseBreach'] == "1"){
	  		$defBreach = "Y";
	  	}else{
	  		$defBreach = "N";
	  	}
	  	if($row == 1){
	  	$page1 .= '<tr>
				<td>'.$match['matchNumber'].'</td>';
	  	$row = 0;
	  	}else {
	  		$page1 .= '<tr class="dif">
				<td>'.$match['matchNumber'].'</td>';
	  		$row = 1;
	  	}
	  	if($match['teamNumber'] == "1323"){
	  		$page1 .= '<td class="blue">'.$match['teamNumber'].'</td>';
	  	}else if($match['teamNumber'] == "1678"){
	  		$page1 .= '<td class="green">'.$match['teamNumber'].'</td>';
	  	}else if($match['teamNumber'] == "254"){
	  		$page1 .= '<td class="poofs">'.$match['teamNumber'].'</td>';
	  	}else if($match['teamNumber'] == "971"){
	  		$page1 .= '<td class="yellow">'.$match['teamNumber'].'</td>';
	  		}else{
	  			$page1 .= '<td>'.$match['teamNumber'].'</td>';
	  		}
				
	  $page1 .='<td>'.$match['teamName'].'</td>
				<td>HOLDER</td>
				<td class="activeauto">'.$auto.'</td>
				<td class="spybotstart">'.$spy.'</td>
				<td class="defensebreach">'.$defBreach.'</td>
				<td class="autolowbar">'.$match['autoLowBar'].'</td>
				<td class="autocullis">'.$match['autoCullis'].'</td>
				<td class="autocdf">'.$match['autoCDF'].'</td>
				<td class="automoat">'.$match['autoMoat'].'</td>
				<td class="autoramp">'.$match['autoRamp'].'</td>
				<td class="autobridge">'.$match['autoBridge'].'</td>
				<td class="autosally">'.$match['autoSally'].'</td>
				<td class="autorockwall">'.$match['autoRockwall'].'</td>
				<td class="autorough">'.$match['autoRough'].'</td>
				<td class="autohighgoal">'.$match['autoHighGoal'].'</td>
				<td class="autolowgoal">'.$match['autoLowGoal'].'</td>
				<td class="shotsfired">'.$match['shotsFired'].'</td>
				<td class="highscored">'.$match['highScored'].'</td>
				<td class="lowscored">'.$match['lowScored'].'</td>
				<td class="lowbarcrossed">'.$match['lowBarCrossed'].'</td>
				<td class="lowhardcrossed"><p>'.$match['lowHardCrossed'].'</p></td>
				<td class="portcullcross">'.$match['portCullCross'].'</td>
				<td class="porthardcross">'.$match['portHardCross'].'</td>
				<td class="cdfcrossed">'.$match['cdfCrossed'].'</td>
				<td class="cdfhardcross"><p>'.$match['cdfHardCross'].'</p></td>
				<td class="moatcross"><p>'.$match['moatCross'].'</p></td>
				<td class="moathardcross"><p>'.$match['moatHardCross'].'</p></td>
				<td class="rampcross"><p>'.$match['rampCross'].'</p></td>
				<td class="ramphardcross">'.$match['rampHardCross'].'</td>
				<td class="drawcross">'.$match['drawCross'].'</td>
				<td class="drawhardcross">'.$match['drawHardCross'].'</td>
				<td class="sallycross">'.$match['sallyCross'].'</td>
				<td class="sallyhardcross">'.$match['sallyHardCross'].'</td>
				<td class="rockwallcross">'.$match['rockWallCross'].'</td>
				<td class="rockhardcross">'.$match['rockHardCross'].'</td>
				<td class="roughcross">'.$match['roughCross'].'</td>
				<td class="roughhardcross">'.$match['roughHardCross'].'</td>
				<td class="robotchallenge">'.$match['robotChallenge'].'</td>
				<td class="robotclimb">'.$match['robotClimb'].'</td>
				<td class="climbspeed">'.$match['climbSpeed'].'</td>
				<td class="climbsuccess">'.$match['climbSuccess'].'</td>
				<td>'.$match['notes'].'</td>
			</tr>';
	  }
	  echo $page1;

?>
</body>
</html>
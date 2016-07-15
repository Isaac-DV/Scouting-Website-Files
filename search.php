<html>
<head>
<meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
<title>Search Teams</title>
</head>
<body>
<form  action="search.php" method="post" id="searchform">
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

echo '<a href="http://www.gorohi.com/1323/viewdata.php">View Data</a>';
echo ' ';
echo '<a href="http://www.gorohi.com/1323/teamaverages.php">Team Averages</a>';

$page = "<table>
			<tr>
				<td>Match Number</td>
				<td>Team Number</td>
				<td>Team Name</td>
				<td>Auto Points</td>
				<td>Active Auto</td>
				<td>Spybot Start</td>
				<td>Defense Breach</td>
				<td>Auto LowBar</td>
		        <td>AutoCullis</td>
				<td>AutoCDF</td>
				<td>AutoMoat</td>
				<td>AutoRamp</td>
				<td>AutoBridge</td>
				<td>AutoSally</td>
				<td>AutoRockwall</td>
				<td>AutoRough</td>
				<td>AutoHighGoal</td>
		        <td>AutoLowGoal</td>
				<td>ShotsFired</td>
				<td>HighScored</td>
				<td>LowScored</td>
				<td>LowBarCrossed</td>
				<td>LowHardCrossed</td>
				<td>PortCullCross</td>
				<td>PortHardCross</td>
				<td>CdfCrossed</td>
				<td>CdfHardCross</td>
				<td>MoatCross</td>
				<td>MoatHardCorss</td>
				<td>RampCross</td>
				<td>RampHardCross</td>
				<td>DrawCross</td>
				<td>DrawHardCross</td>
				<td>SallyCross</td>
				<td>SallyHardCross</td>
				<td>RockWallCross</td>
				<td>RockHardCross</td>
				<td>RoughCross</td>
				<td>RoughHardCross</td>
				<td>RobotChallenge</td>
				<td>RobotClimb</td>
				<td>ClimbSpeed</td>
				<td>ClimbSuccess</td>
				<td width=\"100\">Notes</td>
			</tr>";

if(isset($_POST['submit'])){

mysql_connect($server, $username, $password);
mysql_select_db($database_name);


$searchq = $_POST['search'];
//$searchq = preg_replace("#[^0-9][^a-z][^A-Z]#","",$searchq);
if(strlen($searchq) > 4)
{
	$info = mysql_query('select * from matchData order by '.$searchq.' desc');
	if(mysql_error()){
		die(mysql_error());
	}
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
		$page .= '<tr>
				<td>'.$match['matchNumber'].'</td>
				<td>'.$match['teamNumber'].'</td>
				<td>'.$match['teamName'].'</td>
				<td>HOLDER</td>
				<td>'.$auto.'</td>
				<td>'.$spy.'</td>
				<td>'.$defBreach.'</td>
				<td>'.$match['autoLowBar'].'</td>
				<td>'.$match['autoCullis'].'</td>
				<td>'.$match['autoCDF'].'</td>
				<td>'.$match['autoMoat'].'</td>
				<td>'.$match['autoRamp'].'</td>
				<td>'.$match['autoBridge'].'</td>
				<td>'.$match['autoSally'].'</td>
				<td>'.$match['autoRockwall'].'</td>
				<td>'.$match['autoRough'].'</td>
				<td>'.$match['autoHighGoal'].'</td>
				<td>'.$match['autoLowGoal'].'</td>
				<td>'.$match['shotsFired'].'</td>
				<td>'.$match['highScored'].'</td>
				<td>'.$match['lowScored'].'</td>
				<td>'.$match['lowBarCrossed'].'</td>
				<td>'.$match['lowHardCrossed'].'</td>
				<td>'.$match['portCullCross'].'</td>
				<td>'.$match['portHardCross'].'</td>
				<td>'.$match['cdfCrossed'].'</td>
				<td>'.$match['cdfHardCross'].'</td>
				<td>'.$match['moatCross'].'</td>
				<td>'.$match['moatHardCross'].'</td>
				<td>'.$match['rampCross'].'</td>
				<td>'.$match['rampHardCross'].'</td>
				<td>'.$match['drawCross'].'</td>
				<td>'.$match['drawHardCross'].'</td>
				<td>'.$match['sallyCross'].'</td>
				<td>'.$match['sallyHardCross'].'</td>
				<td>'.$match['rockWallCross'].'</td>
				<td>'.$match['rockHardCross'].'</td>
				<td>'.$match['roughCross'].'</td>
				<td>'.$match['roughHardCross'].'</td>
				<td>'.$match['robotChallenge'].'</td>
				<td>'.$match['robotClimb'].'</td>
				<td>'.$match['climbSpeed'].'</td>
				<td>'.$match['climbSuccess'].'</td>
				<td>'.$match['notes'].'</td></tr>';
	}
}
else{
$query = mysql_query('SELECT * FROM matchData WHERE teamNumber = "'.$searchq.'" order by matchNumber ');
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
				<td>'.$match['matchNumber'].'</td>
				<td>'.$match['teamNumber'].'</td>
				<td>'.$match['teamName'].'</td>
				<td>HOLDER</td>
				<td>'.$auto.'</td>
				<td>'.$spy.'</td>
				<td>'.$defBreach.'</td>
				<td>'.$match['autoLowBar'].'</td>
				<td>'.$match['autoCullis'].'</td>
				<td>'.$match['autoCDF'].'</td>
				<td>'.$match['autoMoat'].'</td>
				<td>'.$match['autoRamp'].'</td>
				<td>'.$match['autoBridge'].'</td>
				<td>'.$match['autoSally'].'</td>
				<td>'.$match['autoRockwall'].'</td>
				<td>'.$match['autoRough'].'</td>
				<td>'.$match['autoHighGoal'].'</td>
				<td>'.$match['autoLowGoal'].'</td>
				<td>'.$match['shotsFired'].'</td>
				<td>'.$match['highScored'].'</td>
				<td>'.$match['lowScored'].'</td>
				<td>'.$match['lowBarCrossed'].'</td>
				<td>'.$match['lowHardCrossed'].'</td>
				<td>'.$match['portCullCross'].'</td>
				<td>'.$match['portHardCross'].'</td>
				<td>'.$match['cdfCrossed'].'</td>
				<td>'.$match['cdfHardCross'].'</td>
				<td>'.$match['moatCross'].'</td>
				<td>'.$match['moatHardCross'].'</td>
				<td>'.$match['rampCross'].'</td>
				<td>'.$match['rampHardCross'].'</td>
				<td>'.$match['drawCross'].'</td>
				<td>'.$match['drawHardCross'].'</td>
				<td>'.$match['sallyCross'].'</td>
				<td>'.$match['sallyHardCross'].'</td>
				<td>'.$match['rockWallCross'].'</td>
				<td>'.$match['rockHardCross'].'</td>
				<td>'.$match['roughCross'].'</td>
				<td>'.$match['roughHardCross'].'</td>
				<td>'.$match['robotChallenge'].'</td>
				<td>'.$match['robotClimb'].'</td>
				<td>'.$match['climbSpeed'].'</td>
				<td>'.$match['climbSuccess'].'</td>
				<td>'.$match['notes'].'</td></tr>';
	
	
	  }
	  }
}
	  print("$page");

?>
</body>
</html>
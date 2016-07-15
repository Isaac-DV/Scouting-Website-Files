<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$password = 'oFi0g46#';
$database_name   = '1323_scouting';
$username = 'scoutingUser';

$server = 'localhost';
mysql_connect($server, $username, $password);
mysql_select_db($database_name);

/*$data = '{"teamName":"MadTown Robotics ","teamNumber":"1323","matchtype_number":"507","AutoPoints":{"activeAuto":"1","spybotStart":"1"
		,"defenseBreach":"1","autolowBar":"1","autoportCullis":"0","autochevaldeFrise":"0","autoMoat":"0","autoRamparts":"0","autodrawBridge":"0",
		"autosallyPort":"0","autorockWall":"0","autoroughTerrain":"0","autohighScored":"0"},
		"TeleopPoints":{"shotsFired":"3","highgoalsScored":"1","lowgoalsScored":"1","lowbarCrossed":"2",
		"lowbarhardCrossed":"0","portcullisCrossed":"0","portcullishardCrossed":"0","chevaldefriseCrossed":"2","chevaldefrisehardCrossed":"0",
		"moatCrossed":"2","moathardCrossed":"0","rampartsCrossed":"0","rampartshardCrossed":"0",
		"drawbridgeCrossed":"0","drawbridgehardCrossed":"0","sallyportCrossed":"2","sallyporthardCrossed":"0",
		"rockwallCrossed":"2","rockwallhardCrossed":"0","roughterrainCrossed":"0","roughterrainhardCrossed":"0",
		"robotChallenged":"1","robotClimb":"1","climbSpeed":"6","climbSuccessful":"1","robotNotes":"the robot drives well and can shoot and score. offense list. "}}';*/
$data = $_POST["data"];

$obj = json_decode($data);

$teamName      = $obj->{'teamName'};
$teamNumber    = $obj->{'teamNumber'};
$matchNumber   = $obj->{'matchtype_number'};
$autoPoints    = $obj->{'AutoPoints'};
$activeAuto    = $autoPoints->{'activeAuto'};
$spybotStart   = $autoPoints->{'spybotStart'};
$defenseBreach = $autoPoints->{'defenseBreach'};
$autoLowBar    = $autoPoints->{'autolowBar'};
$autoCullis    = $autoPoints->{'autoportCullis'};
$autoCDF	   = $autoPoints->{'autochevaldeFrise'};
$autoMoat      = $autoPoints->{'autoMoat'};
$autoRamp      = $autoPoints->{'autoRamparts'};
$autoBridge    = $autoPoints->{'autodrawBridge'};
$autoSally     = $autoPoints->{'autosallyPort'};
$autoRockwall  = $autoPoints->{'autorockWall'};
$autoRough     = $autoPoints->{'autoroughTerrain'};
$autoHighGoal  = $autoPoints->{'autohighScored'};
$autoLowGoal   = $autoPoints->{'autolowScored'};
$telePoints    = $obj->{'TeleopPoints'};
$shotsFired    = $telePoints->{'shotsFired'};
$highScored    = $telePoints->{'highgoalsScored'};
$lowScored     = $telePoints->{'lowgoalsScored'};
$lowBarCrossed = $telePoints->{'lowbarCrossed'};
$lowHardCrossed= $telePoints->{'lowbarhardCrossed'};
$portCullCross = $telePoints->{'portcullisCrossed'};
$portHardCross = $telePoints->{'portcullishardCrossed'};
$cdfCrossed    = $telePoints->{'chevaldefriseCrossed'};
$cdfHardCross  = $telePoints->{'chevaldefrisehardCrossed'};
$moatCross     = $telePoints->{'moatCrossed'};
$moatHardCorss = $telePoints->{'moathardCrossed'};
$rampCross     = $telePoints->{'rampartsCrossed'};
$rampHardCross = $telePoints->{'rampartshardCrossed'};
$drawCross     = $telePoints->{'drawbridgeCrossed'};
$drawHardCross = $telePoints->{'drawbridgehardCrossed'};
$sallyCross    = $telePoints->{'sallyportCrossed'};
$sallyHardCross= $telePoints->{'sallyporthardCrossed'};
$rockWallCross = $telePoints->{'rockwallCrossed'};
$rockHardCross = $telePoints->{'rockwallhardCrossed'};
$roughCross    = $telePoints->{'roughterrainCrossed'};
$roughHardCross= $telePoints->{'roughterrainhardCrossed'};
$robotChallenge= $telePoints->{'robotChallenged'};
$robotClimb    = $telePoints->{'robotClimb'};
$climbSpeed    = $telePoints->{'climbSpeed'};
$climbSuccess  = $telePoints->{'climbSuccessful'};
$notes         = $telePoints->{'robotNotes'};

$matches = mysql_query('select * from ChampData where matchNumber="'.$matchNumber.'" AND teamNumber="'.$teamNumber.'"');
$match = mysql_fetch_array($matches);
if($match['id'] != null){
	if($matchNumber != ""){
		mysql_query('delete from ChampData where id="'.$match['id'].'"');
	}
	
}else{
	
}
$string = 'insert into ChampData (teamName,teamNumber,matchNumber,activeAuto,spybotStart,defenseBreach,autoLowBar,autoCullis,autoCDF,
			autoMoat,autoRamp,autoBridge,autoSally,autoRockwall,autoRough,autoHighGoal,autoLowGoal,shotsFired,highScored,lowScored,lowBarCrossed,lowHardCrossed,
			portCullCross,portHardCross,cdfCrossed,cdfHardCross,moatCross,moatHardCross,rampCross,rampHardCross,drawCross,drawHardCross,sallyCross,
			sallyHardCross,rockWallCross,rockHardCross,roughCross,roughHardCross,robotChallenge,robotClimb,climbSpeed,climbSuccess,notes) values(
			"'.$teamName.'","'.$teamNumber.'","'.$matchNumber.'","'.$activeAuto.'","'.$spybotStart.'","'.$defenseBreach.'","'.$autoLowBar.'","'.$autoCullis.'",
			"'.$autoCDF.'","'.$autoMoat.'","'.$autoRamp.'","'.$autoBridge.'","'.$autoSally.'","'.$autoRockwall.'","'.$autoRough.'","'.$autoHighGoal.'","'.$autoLowGoal.'",
			"'.$shotsFired.'","'.$highScored.'","'.$lowScored.'","'.$lowBarCrossed.'","'.$lowHardCrossed.'","'.$portCullCross.'","'.$portHardCross.'",
			"'.$cdfCrossed.'","'.$cdfHardCross.'","'.$moatCross.'","'.$moatHardCorss.'","'.$rampCross.'","'.$rampHardCross.'","'.$drawCross.'","'.$drawHardCross.'",
			"'.$sallyCross.'","'.$sallyHardCross.'","'.$rockWallCross.'","'.$rockHardCross.'","'.$roughCross.'","'.$roughHardCross.'","'.$robotChallenge.'",
			"'.$robotClimb.'","'.$climbSpeed.'","'.$climbSuccess.'","'.$notes.'")';
	mysql_query($string);
	echo "SUCCESS";


?>
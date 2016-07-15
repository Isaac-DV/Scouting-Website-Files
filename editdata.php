<html>
<head>
<meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
<link type="text/css" rel="stylesheet" href="datastyle.css"/>
<title>Edit Data</title>
</head>
<body>
<div id="bar">
	<div>
		<a href="http://www.gorohi.com/1323/viewdata.php">View Data</a>
	</div>
	<div>
		<a href="http://www.gorohi.com/1323/search.php">Search Teams</a>
	</div>
	<div>
		<a href="http://www.gorohi.com/1323/teamaverages.php">Team Averages</a>
	</div>
</div>
<form  action="editdata.php" method="post" id="searchform">
<input  type="text" name="search" class="search" placeholder="Enter SQL command"/>
<input  type="submit" name="submit" class="button" value=">>"/>
</form>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$password = 'oFi0g46#';
$database_name  = '1323_scouting';
$username = 'scoutingUser';
$server = 'localhost';

mysql_connect($server, $username, $password);
mysql_select_db($database_name);

if(isset($_POST['submit'])){
	$searchq = $_POST['search'];
		$query = mysql_query($searchq);
		if(mysql_error()){
			die(mysql_error());
		echo "Success";
	
	
	}
	
}

?>
</body>
</html>
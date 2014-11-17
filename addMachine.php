<?php

include 'php/dbConnect.php';

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<title>Add Machine</title>
</head>

<body>

<table width ="100%">
<form action="php/addMachine.php" method="POST">
<tr>
		<td>Machine ID:</td>
		<td><input type="text" name="id" width ="300"></td>
	</tr>
	<tr>
		<td>Machine Name:</td>
		<td><input type="text" name="name" width ="300"></td>
	</tr>
	<tr>
		<td>Venue:</td>
		<td><input type="text" name="venue" width ="300"></td>
	</tr>
<tr>
<td width = "16%"></td>
<td width = "84%"><input type="submit" value="Add Machine"></td>
</tr></form>

<h2>
			Current Machines
		</h2>
		<table width="100%" border ="1">
			<tr>		
				<td width ="20%"><b>Machine ID</b></td>
				<td width ="30%"><b>Machine Name</b></td>
				<td width = "30%"><b>Venue</b></td>
				<td width = "20%"><b>Available</b></td>			
			</tr>
			
<?php
$content = "";

$connect = connect_database();

$query = mysql_query(
	"SELECT * FROM machine Order by m_id");
	
$numrows = mysql_num_rows($query);

if($numrows != 0) {
	while( $row = mysql_fetch_array($query) ) {
		$dbmachineid= $row['m_id'];
		$dbmachinename = $row['m_name'];
		$dbavailable = $row['m_available'];
		$dbvenue = $row['m_venue'];
		$content .="<tr>";
		$content .="<td width ='20%'>$dbmachineid</td>";
		$content .="<td width ='30%'>$dbmachinename</td>";
		$content .="<td width ='30%'>$dbvenue</td>";
		$content .="<td width ='20%'>$dbavailable</td>";
		$content .="</tr>";
		$content .="</form>";
	}
} else echo("No rows found!");

echo $content;

?>
	</table>

	<table width="100%" border="0">
		<tr align="left">
			<td>
				<form><input type="submit" formaction="addEditMachine.php" value="Back"></form>
			</td>
			<td width="100" align="right">
				
			</td>
		</tr>
	</table>
	

</body>

</html>
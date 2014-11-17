<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add/Edit Student</title>
</head>

<body>

<table width ="100%">
<form action="php/banStudent.php" method="POST">
<tr>
		<td>Student ID:</td>
		<td><input type="text" name="studentid" width ="150"></td>
	</tr>
	<tr>
		<td>Reason:</td>
		<td><input type="text" name="reason" width ="300"></td>
	</tr>
<tr>
<td width = "16%"></td>
<td width = "84%"><input type="submit" value="Activate Ban"></td>
</tr></form>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<form action="php/unbanStudent.php" method="POST">
<tr>
		<td>Student ID:</td>
		<td><input type="text" name="de_studentid" width ="150"></td>
	</tr>
<tr>
<td width = "16%"></td>
<td width = "84%"><input type="submit" value="Deactivate Ban"></td>
</tr>
</form>
</table><br><br>
<div class="content">
		<h2>
			BanList
		</h2>
		<table width="100%" border ="1">
			<tr>		
				<td width ="10%"><b>Student ID</b></td>
				<td width ="10%"><b>Ban By</b></td>
				<td width = "30%"><b>Date (Y-M-D)</b></td>
				<td width = "50%"><b>Reason</b></td>			
			</tr>

<?php
$content = "";

include 'php/dbConnect.php';
$connect = connect_database();

$query = mysql_query(
	"SELECT * FROM banlist");
	
$numrows = mysql_num_rows($query);

if($numrows != 0) {
	while( $row = mysql_fetch_array($query) ) {
		$dbadminno = $row['ba_adminno'];
		$dbbanby = $row['ba_banby'];
		$dbdate = $row['ba_date'];
		$dbreason = $row['ba_reason'];
		$content .="<tr>";
		$content .="<td width ='10%'>$dbadminno</td>";
		$content .="<td width ='10%'>$dbbanby</td>";
		$content .="<td width = '30%'>$dbdate</td>";
		$content .="<td width = '50%'>$dbreason</td>";
		$content .="</tr>";
		$content .="</form>";
	}
} else echo("No rows found!");

echo $content;

?>

<table width="100%" border="0">
  <tr align="left">
  <br>
    <td>
      <form><input type="submit" formaction="adminPanel.php" value="Back">
</form><br></td>
  </tr>
</table>
</body>
</html>
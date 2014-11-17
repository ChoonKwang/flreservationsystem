<?php

session_start();

$lecID = $_SESSION['l_admin'];
$_SESSION['request'] = 0;

?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<title>Read Request</title>
</head>
<body>


<div class="wrap">

<?php include 'staffheader.php'; ?>	

	<div class="content">
		<h2>
			Student Request
		</h2>
		<table width="100%" border ="1">
			<tr>		
				<td width ="10%"><b>Date posted</b></td>
				<td width ="10%"><b>Student Admin</b></td>
				<td width = "30%"><b>Name</b></td>
				<td width = "35%"><b>Project Title</b></td>
				<td width = "15%"><b>View project description</b></td>				
			</tr>

<?php
$content = "";

$query = mysql_query(
	"SELECT 
		pr_id, 
		pr_studentname, 
		pr_studentid,
		pr_title,
		pr_datetime
	FROM 
		proposal
	WHERE 
		pr_lecturerid = '$lecID' 
	AND
		pr_approve = 0"
	);
$numrows = mysql_num_rows($query);

if($numrows != 0) {
	while( $row = mysql_fetch_array($query) ) {
		$dbPRID = $row['pr_id'];
		$dbID = $row['pr_studentid'];
		$dbName = $row['pr_studentname'];
		$dbTitle = $row['pr_title'];
		$dbDate = $row['pr_datetime'];
		$content .="<form action='viewRequest.php' method='POST'>";
		$content .="<tr>";
		$content .="<td width ='10%'>$dbDate</td>";
		$content .="<td width ='10%'>$dbID</td>";
		$content .="<td width = '30%'>$dbName</td>";
		$content .="<td width = '35%'>$dbTitle</td>";
		$content .="<td width = '15%''>";
		$content .="<input type='submit' value='View'>";
		$content .="<input type='hidden' name='pr_id'  value=".$dbPRID.">";
		$content .="</td>";
		$content .="</tr>";
		$content .="</form>";
	}
} else echo("No rows found!");

echo $content;

?>

					</table><br>

		<form><input type="submit" formaction="approvedRequest.php" value="View approved list"></form><br><br>
		
	</div>
</div>	

<?php include 'footer.php'; ?>

</body>
</html>
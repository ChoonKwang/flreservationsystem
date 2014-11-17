<?php

session_start();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) $classID = $_POST['class_id'];
else $classID = $_SESSION['class_id'];

?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<title>View Class</title>
</head>

<body>

<div class="wrap">

<?php include 'staffheader.php'; ?>

	<div class="content">
<?php

$query = mysql_query(
	"SELECT
		*
	FROM
		class
	WHERE
		c_id = '$classID'"
	);

$numrows = mysql_num_rows($query);

if($numrows!=0) {
	while( $row = mysql_fetch_array($query) ) {
		// $dbDate = $row['pr_datetime'];
		// $dbName = $row['pr_studentname'];
		// $dbID = $row['pr_studentid'];
		// $dbPartnerID = $row['pr_partnerid'];
		// $dbComplete = $row['pr_complete'];
		// $dbTitle = $row['pr_title'];
		// $dbSypnosis = $row['pr_sypnosis'];
		// $dbMessage = $row['pr_message'];
		// $dbApprove = $row['pr_approve'];

		$subject = $row['c_subject'];
		$date = $row['c_date'];
		//---Time---
		$startTime = $row['c_timestart'];
		$endTime = $row['c_timeend'];
		//---Time---
		$staffName = $row['c_staffname'];
		//---Slots---
		$filled = $row['c_filled'];
		$totalStudents = $row['c_totalstudents'];
		//---Slots---
		$sypnosis = $row['c_sypnosis'];
		$description = $row['c_description'];
		$students = $row['c_studentid'];
		$studentName = $row['c_studentname'];
		$studentName = explode(',', $studentName);
		$studentName = implode(', ', $studentName);

		$content = "";

		$content .= "<table width = '100%'>
						<tr>
							<td width = '16%'>Starting date:</td>
							<td width = '84%'>$date</td>
						</tr>
						<tr>
							<td width = '16%'>Teacher in charge:</td>
							<td width = '84%'>$staffName</td>
						<tr>
							<td width = '16%'>Slots:</td>
							<td width = '84%'>$filled/$totalStudents</td>
						</tr>
						<tr>
							<td width = '16%'>Students attending:</td>
							<td width = '84%'>$studentName</td>
						</tr>
					</table>

					<br>
					<table width = '100%'>
						<tr>
							<td width = '16%'><h2>Subject:</h2></td>
							<td width = '84%'><h2>$subject</h2></td>
						</tr>
						<tr>
							<td width = '16%'>Sypnosis:</td>
							<td width = '84%' height ='100%' align='left' valign='top'>$sypnosis</td>
						</tr>
						<tr>
							<td width = '16%'>Message:</td>
							<td width = '84%' height ='100%' align='left' valign='top'>$description</td>
						</tr>
					</table>
					
					<br>
					<table width='100%' border='0'>
					  <tr align='left'>
					    <td>
							<form>
						      	<input type='submit' formaction='staffClass.php' value='Back'><br>
							</form>
						</td>
						<td align='right'>
							<form action='classAttendance.php' method='POST'>
								<input type='submit' value='Attendance'><br>
								<input type='hidden' name='class_id' value=".$classID.">
							</form>
						</td>
					  </tr>
					</table>";

	}	//End of while

	echo $content;

}	else die("No rows found!");	//End of if($numrows!=0)

?>		
	</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
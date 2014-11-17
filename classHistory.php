<?php

session_start();

$studentID = $_SESSION['s_admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Class History</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="wrap">

<?php include 'studentheader.php'; ?>

	<div class="content">
		<h1>History</h1>
		<form method='POST'>
			<table width='100%'>
				<tr>
					<td align='center'><input type="submit" value='Classes' formaction='classHistory.php'></td>
					<td align='center'><input type="submit" value='Booked Machines' formaction='machineHistory.php'></td>
	<!-- 				<td align='center'><input type="submit" value='Ordered Materials' formaction='orderHistory.php'></td>
	 -->				<td align='center'><input type="submit" value='Submitted Proposals' formaction='proposalHistory.php'></td>
				</tr>
			</table>
		</form>
		
		<br><br>
		<h2>Registered Classes</h2>
		<table width='100%' border='1'>
			<tr>
				<td><b>Subject</b></td>
				<td><b>Date</b></td>
				<td><b>Time</b></td>
			</tr>

<?php

$content = "";

if( $connect ) {
	$query = mysql_query(
		"SELECT
			c_subject,
			c_date,
			c_timestart,
			c_timeend,
			c_studentid
		FROM
			class
		WHERE
			c_filled > 0"
		);

	$numrows = mysql_num_rows($query);

	if( $numrows != 0 ) {
		while( $row = mysql_fetch_array($query) ) {
			$subject = $row['c_subject'];
			$date = $row['c_date'];
			$date = date("d-m-Y",strtotime($date));
			//---Time---
			$startTime = $row['c_timestart'];
			$endTime = $row['c_timeend'];
			//---Time---
			$dbStudentID = $row['c_studentid'];

			$registered = strpos($dbStudentID, $studentID);

			if( $registered === false ) {

			} else {	//end of if( $registered === false )
				$content .= "<tr>
								<td>$subject</td>
								<td>$date</td>
								<td>$startTime - $endTime</td>
							</tr>";
			}
		}	//end of while( $row = mysql_fetch_array($query) )

		echo $content;
		
	} else echo "No rows found!";	//end of if( $numrows )
} else {	//end of if( $connect )
	die("Couldnt' connect to database!");
}

?>
		</table>

		<br>	
	</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
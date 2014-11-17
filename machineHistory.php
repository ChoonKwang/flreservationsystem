<?php

session_start();

$studentID = $_SESSION['s_admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Machine History</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="wrap">

<?php include 'studentheader.php'; ?>

	<div class="content">
		<h2>History</h2>
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
		<h2>Booked Machines</h2>
		<table width='100%' border='1'>
			<tr>
				<td><b>Machine</b></td>
				<td><b>Date</b></td>
				<td><b>Time</b></td>
			</tr>
<?php

$content = '';

if( $connect ) {
	$query = mysql_query(
		"SELECT
			b_machine,
			b_date,
			b_timefrom,
			b_timeto,
			b_admin
		FROM
			booking
		WHERE
			b_admin = '$studentID'"
		);

	$numrows = mysql_num_rows($query);

	if( $numrows ) {
		while( $row = mysql_fetch_array($query) ) {
			$machine = $row['b_machine'];
			$date = $row['b_date'];
			$date = date("d-m-Y",strtotime($date));
			//---Time---
			$timeFrom = $row['b_timefrom'];
			$timeTo = $row['b_timeto'];
			//---Time---
			$dbStudentID = $row['b_admin'];

			if( $dbStudentID == $studentID ) {
				$content .= "<tr>
								<td>$machine</td>
								<td>$date</td>
								<td>$timeFrom - $timeTo</td>
							</tr>";				
			}	//end of if( $dbStudentID === $studentID )
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
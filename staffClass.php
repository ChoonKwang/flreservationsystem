<?php

session_start();

?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<link rel="stylesheet" href="css/style.css">
	<meta charset='UTF-8'>
	<title>View Class</title>
</head>
<body>

<div class="wrap">

<?php include 'staffheader.php'; ?>

	<div class="content">
		<h2>
			Classes
		</h2>

		<table width='100%' border ='1'>
			<tr>		
				<td width='30%'><b>Subject</b></td>
				<td width='10%'><b>Date</b></td>
				<td width='10%'><b>Time</b></td>
				<td width='20%'><b>Teacher in charge</b></td>
				<td width='10%'><b>Slots</b></td>
				<td width='10%'><b>Description</b></td>			
			</tr>
	

<?php

$content = "";

if( $connect ) {
	$query = mysql_query(
		"SELECT
			*
		FROM
			class"
		);
	$numrows = mysql_num_rows($query);
	if( $numrows != 0 ) {
		while( $row = mysql_fetch_array($query) ) {
			$classID = $row['c_id'];
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

			$content .= "<form action='viewStaffClass.php' method='POST'>
							<tr>
								<td width='30%'>$subject</td>
								<td width='10%'>$date</td>
								<td width='10%'>$startTime - $endTime</td>
								<td width='20%'>$staffName</td>
								<td width='10%'>$filled/$totalStudents</td>
								<td width='10%'>
									<input type='submit' value='View'>
									<input type='hidden' name='class_id'  value=".$classID.">
								</td>
							</tr>
						</form>";
		}	//end of while( $row = mysql_fetch_array($query) )

		echo $content;
		
	}	else {	//end of if( $numrows )
		echo "No rows returned!";
	}
} else {	//end of if( $connect )
	die("Couldn't connect to database!");
}

?>
		</table><br>	
		<table>
			<tr width='100%'>
				<td align='left'>
					<form action="createClass.php">
						<input type="submit" value='Create class'>
					</form>
				</td>
			</tr>
		</table>
	</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
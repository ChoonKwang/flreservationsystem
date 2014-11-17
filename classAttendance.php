<?php

session_start();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) $classID = $_POST['class_id'];
else $classID = $_SESSION['class_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/style.css">
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<div class="wrap">

<?php include 'staffheader.php'; ?>

		<div class="content">
			<form action="submitAttendance.php" method="POST">
				<table class='attendance' width='70%' border='1'>
					<tr>
						<td>
							Student ID
						</td>
						<td>
							Name
						</td>
						<td>
							Attendance
						</td>
					</tr>

<?php

$content = "";

if( $connect ) {
	$query = mysql_query(
					"SELECT
						c_studentid,
						c_studentname,
						c_attend,
						c_orientation
					FROM
						class
					WHERE
						c_id = '$classID'"
					);
	$numrows = mysql_num_rows($query);
	if( $numrows == 0 ) die('failed');

	$row = mysql_fetch_array($query);
	$studentID = $row['c_studentid'];
	$studentName = $row['c_studentname'];
	$attend = $row['c_attend'];
	$orientation = $row['c_orientation'];

	if( (isset($studentID)) && (isset($studentName)) ) { 
		//***Array****//
		$studentIDArray = explode(',', $row['c_studentid']);
		$studentNameArray = explode(',', $row['c_studentname']);
		//***Array****//

		$i = 0;

		while( ($studentIDArray[$i] != "") && ($studentNameArray[$i] != "") ) {
			$attendance = strpos($attend, $studentIDArray[$i]);
			if( $attendance === false  ) $checked = "";
			else $checked = "checked";
			$content .= "<tr>
							<td>
								".$studentIDArray[$i]."
							</td>
							<td>
								".$studentNameArray[$i]."
							</td>
							<td>
								<input type='checkbox' name='checked[]' value=".$studentIDArray[$i]." ".$checked.">
							</td>
						</tr>";
			$i++;
		} 
	
		$content .= "<input type='hidden' name='class_id' value=".$classID .">
					<input type='hidden' name='attendance' value='1'>";	
	} 	//end of if( $attend ) 

} else {	//end of if( $connect )
	die("Unable to connect");
}

if( $orientation ) {
	$checked = "checked";
} else {
	$checked = "";
}

$content .= "</table>		
			<p id='attendadd'>
				Orientation <input type='checkbox' name='orientation' value='yes' ".$checked.">
			</p>";

echo $content;	

?>

				<table width='100%'>
					<tr>
						<td align='left'>
							<input type="submit" formaction='viewStaffClass.php' align='left' value='Back'>
						</td>
						<td align='right'>
							<input type="submit" align='right' value='Submit' onclick='return confirm("Confirm Attendance?")'>
						</td>
					</tr>
				</table>	
			</form>

		</div>

	</div>

<?php include 'footer.php'; ?>

</body>
</html>
<?php

session_start();

$studentID = $_SESSION['s_admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Proposal History</title>
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
		<h2>Submitted Proposals</h2>
		<table width='100%' border='1'>
			<tr>
				<td><b>Date Posted</b></td>
				<td><b>Project Title</b></td>
				<td><b>Estimated Completion Time</b></td>
				<td><b>Approved?</b></td>
				<td><b>Awarded?</b></td>
			</tr>

<?php

$content = "";

if( $connect ) {
	$query = mysql_query(
		"SELECT
			pr_datetime,
			pr_title,
			pr_complete,
			pr_approve,
			pr_awarded
		FROM
			proposal
		WHERE
			pr_studentid = '$studentID'"
		);

	$numrows = mysql_num_rows($query);

	if( $numrows != 0 ) {
		while( $row = mysql_fetch_array($query) ) {
			$title = $row['pr_title'];
			$datePosted = $row['pr_datetime'];
			$complete = $row['pr_complete'];
			$approve = $row['pr_approve'];
			$awarded = $row['pr_awarded'];

			if( $approve ) $statusApprove = "Yes";
			else $statusApprove = "No";

			if( $awarded ) $statusAwarded = "Yes";
			else $statusAwarded = "No";

			$content .= "<tr>
							<td>$datePosted</td>
							<td>$title</td>
							<td>$complete</td>
							<td>$statusApprove</td>
							<td>$statusAwarded</td>
						</tr>";
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
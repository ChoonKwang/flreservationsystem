<?php

session_start();

include 'dbConnect.php';

$studentID = $_SESSION['s_admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order History</title>
</head>
<body>
	<h2>History</h2>
	<form method='POST'>
		<table width='100%'>
			<tr>
				<td align='center'><input type="submit" value='Classes' formaction='classHistory.php'></td>
				<td align='center'><input type="submit" value='Booked Machines' formaction='machineHistory.php'></td>
				<td align='center'><input type="submit" value='Ordered Materials' formaction='orderHistory.php'></td>
				<td align='center'><input type="submit" value='Submitted Proposals' formaction='proposalHistory.php'></td>
			</tr>
		</table>
	</form>

	<br><br>
	<h2>Ordered Materials</h2>
	<table width='100%' border='1'>
		<tr>
			<td><b>Item</b></td>
			<td><b>Date of order</b></td>
			<td><b>Quantity</b></td>
		</tr>

<?php

$connect = connect_database();
$content = "";

if( $connect ) {
	$query = mysql_query(
		"SELECT
			o_item,
			o_dateoforder,
			o_quantity
		FROM
			ordereditems
		WHERE
			o_studentid = '$studentID'"
		);

	$numrows = mysql_num_rows($query);

	if( $numrows != 0 ) {
		while( $row = mysql_fetch_array($query) ) {
			$item = $row['o_item'];
			$dateOfOrder = $row['o_dateoforder'];
			$quantity = $row['o_quantity'];

			$content .= "<tr>
							<td>$item</td>
							<td>$dateOfOrder</td>
							<td>$quantity</td>
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
	<form>
		<input type="submit" value='Back' formaction='../student.php'>
	</form>
</body>
</html>
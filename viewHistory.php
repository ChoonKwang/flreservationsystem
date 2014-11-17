<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>View History</title>
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

		<br>
	</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
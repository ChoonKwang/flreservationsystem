<?php

session_start();

?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<title>Add Student point</title>
</head>

<body>

<div class="wrap">

<?php include 'staffheader.php'; ?>

	<div class="content">
		<h2>
			Add Student Points
		</h2>
		<table width="300">
			<tr>
				<td>Student ID:</td>
				<td><input type="text"></td>
			</tr>
			<tr>
				<td>Points add:</td>
				<td><input type="text"></td>
			</tr>
		</table><br>

		<table width="100%" border="0">
		  <tr align="left">
		    <td width="100" align="right">
				<form>
			    	<input type="submit" formaction="" value="Submit">
				</form><br>
			</td>
		  </tr>
		</table>		
	</div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
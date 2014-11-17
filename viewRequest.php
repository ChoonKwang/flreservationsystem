<?php

session_start();

$dbPRID = $_POST['pr_id'];

?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<title>View Request</title>
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
		proposal
	WHERE
		pr_id = '$dbPRID'"
	);

$numrows = mysql_num_rows($query);

if($numrows!=0) {
	while( $row = mysql_fetch_array($query) ) {
		$dbDate = $row['pr_datetime'];
		$dbName = $row['pr_studentname'];
		$dbID = $row['pr_studentid'];
		$dbPartnerID = $row['pr_partnerid'];
		$dbComplete = $row['pr_complete'];
		$dbTitle = $row['pr_title'];
		$dbSypnosis = $row['pr_sypnosis'];
		$dbMessage = $row['pr_message'];
		$dbApprove = $row['pr_approve'];
		$dbAwarded = $row['pr_awarded'];

		$content = "";

		$content .="	<table width = '100%'>";
		$content .="		<tr>";
		$content .="			<td width = '16%'>Date posted:</td>";
		$content .="			<td width = '84%'>$dbDate</td>";
		$content .="		</tr>";
		$content .="		<tr>";
		$content .="			<td width = '16%'>Proposal ID:</td>";
		$content .="			<td width = '84%'>$dbPRID</td>";
		$content .="		</tr>";
		$content .="		<tr>";
		$content .="			<td width = '16%'>Student Name:</td>";
		$content .="			<td width = '84%'>$dbName</td>";
		$content .="		</tr>";
		$content .="			<td width = '16%'>Student ID:</td>";
		$content .="			<td width = '84%'>$dbID</td>";
		$content .="		</tr>";
		// $content .="			<td width = '16%'>Working partners' ID</td>";
		// $content .="			<td width = '84%'>$dbPartnerID</td>";
		// $content .="		</tr>";
		$content .="		<tr>";
		$content .="			<td width = '16%'>Estimated completion time:</td>";
		$content .="			<td width = '84%'>$dbDate</td>";
		$content .="		</tr>";
		$content .="	</table>";

		$content .="	<br><br>";
		$content .="	<table width = '100%'>";
		$content .="		<tr>";
		$content .="			<td width = '16%'><h2>Project Title:</h2></td>";
		$content .="			<td width = '84%'><h2>$dbTitle</h2></td>";
		$content .="		</tr>";
		$content .="		<tr>";
		$content .="			<td width = '16%'>Sypnosis:</td>";
		$content .="			<td width = '84%' height ='100%' align='left' valign='top'>$dbSypnosis</td>";
		$content .="		</tr>";
		$content .="		<tr>";
		$content .="			<td width = '16%'>Message:</td>";
		$content .="			<td width = '84%' height ='100%' align='left' valign='top'>$dbMessage</td>";
		$content .="		</tr>";
		$content .="	</table>";

		$content .="	<table width='100%' border='0'>";
		$content .="	  <tr align='left'>";
		$content .="	    <td>";
		$content .="		<form>";

		//To navigate when within the Read Request page for lecturer
		if($_SESSION['request'] == 0)
			$content .="	      <input type='submit' formaction='readRequest.php' value='Back'><br>";
		else if($_SESSION['request'] == 1)
			$content .="	      <input type='submit' formaction='approvedRequest.php' value='Back'><br>";

		$content .="		</form>";
		$content .="		</td>";
		$content .="	    <td width='100' align='right'>";

		if(!$dbApprove) {
			$content .="		<form action='approve.php' method='POST'>";
			$content .="	    	<input type='hidden' name='pr_id' value=".$dbPRID."><br>";
			$content .="	    	<input type='submit' value='Approve'><br>";
			$content .="		</form>";
		}
			
		else if(!$dbAwarded){
			$content .="	<form action='php/awardPoints.php' method='POST'>";
			$content .="	    Award Points:";
			$content .="	    <select name='points'><br>";
			$content .="			<option value='1'>1</option>";
			$content .="			<option value='2'>2</option>";
			$content .="			<option value='3'>3</option>";
			$content .="			<option value='4'>4</option>";
			$content .="			<option value='5'>5</option>";
			$content .="			<option value='6'>6</option>";
			$content .="			<option value='7'>7</option>";
			$content .="			<option value='8'>8</option>";
			$content .="			<option value='9'>9</option>";
			$content .="			<option value='10'>10</option>";
			$content .="		</select>";
			$content .="	    	<input type='hidden' name='pr_id' value=".$dbPRID."><br>";
			$content .="	    	<input type='hidden' name='studentid' value=".$dbID."><br>";
			$content .="	    <input type='submit' value='Submit'><br>";
			$content .="	</form>";
		}

		$content .="		</td>";
		$content .="	  </tr>";
		$content .="	</table>";

		echo $content;

	}	//End of while
}	else die("No rows found!");	//End of if($numrows!=0)

?>		
	</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
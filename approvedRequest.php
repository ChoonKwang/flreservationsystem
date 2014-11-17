<?php

session_start();

$lecID = $_SESSION['l_admin'];
$_SESSION['request'] = 1;

?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<meta charset='utf-8'>
	<title>View approved List</title>
</head>

<body>

<div class="wrap">

<?php include 'staffheader.php'; ?>

	<div class="content">
		<table width='100%' border ='0'>
			<tr>
				<td>Approved List</td>
			</tr>
		</table><br>
		<table width='100%' border ='1'>
			<tr>
				<td width ='10%'><b>Student Admin</b></td>
				<td width = '30%'><b>Name</b></td>
				<td width = '30%'><b>Project Title</b></td>
				<td width = '15%'><b>View project description</b></td>
				<td width = '15%'><b>Award Points</b></td>
			</tr>

<?php

$content = "";

$query = mysql_query(
	"SELECT 
		pr_id, 
		pr_studentname, 
		pr_studentid,
		pr_title,
		pr_awarded
	FROM 
		proposal
	WHERE 
		pr_lecturerid = '$lecID' 
	AND
		pr_approve = 1"
	);
$numrows = mysql_num_rows($query);

if($numrows != 0) {
	while( $row = mysql_fetch_array($query) ) {
		$dbPRID = $row['pr_id'];
		$dbID = $row['pr_studentid'];
		$dbName = $row['pr_studentname'];
		$dbTitle = $row['pr_title'];
		$dbAwarded = $row['pr_awarded'];

		if($dbAwarded == 1) {
			$content .="<form action='viewRequest.php' method='POST'>";
			$content .="<tr>";
			$content .="<td width ='10%'>$dbID</td>";
			$content .="<td width = '30%'>$dbName</td>";
			$content .="<td width = '30%'>$dbTitle</td>";
			$content .="<td width = '15%''>";
			$content .=	"<input type='submit' value='View'>";
			$content .=	"<input type='hidden' name='pr_id'  value=".$dbPRID.">";
			$content .="</td>";
			$content .="</form>";
			$content .="<td width = '15%'>";	
			$content .=	"Awarded";	
			$content .="</td>";
			$content .="</tr>";
			$content .="</td>";	
		}
	}

	$query = mysql_query(
	"SELECT 
		pr_id, 
		pr_studentname, 
		pr_studentid,
		pr_title,
		pr_awarded
	FROM 
		proposal
	WHERE 
		pr_lecturerid = '$lecID' 
	AND
		pr_approve = 1"
	);
	
	while( $row = mysql_fetch_array($query) ) {
		$dbPRID = $row['pr_id'];
		$dbID = $row['pr_studentid'];
		$dbName = $row['pr_studentname'];
		$dbTitle = $row['pr_title'];
		$dbAwarded = $row['pr_awarded'];

		if($dbAwarded == 0) {
		$content .="<form action='viewRequest.php' method='POST'>";
		$content .="<tr>";
		$content .="<td width ='10%'>$dbID</td>";
		$content .="<td width = '30%'>$dbName</td>";
		$content .="<td width = '30%'>$dbTitle</td>";
		$content .="<td width = '15%''>";
		$content .=	"<input type='submit' value='View'>";
		$content .=	"<input type='hidden' name='pr_id'  value=".$dbPRID.">";
		$content .="</td>";
		$content .="</form>";
		$content .="<td width = '15%'>";	
		$content .=	"Not Awarded";	
		$content .="</td>";
		$content .="</tr>";
		$content .="</td>";	
		}
	}
} else echo("No rows found!");

echo $content;

?>		
	</table><br>
		<table width='100%' border='0'>
			<tr align='left'>
		    <td>
		     <form><input type='submit' formaction='readRequest.php' value='Back'></form><br>
		  	</td>
	<!-- 		    <td width='100' align='right'>
			    	<input type='submit' value='Submit'><br>
				</td> -->
		  	</tr>
		</table>
	</form>		
	</div>
</div>

<?php include 'footer.php'; ?>		
			
</body>
</html>
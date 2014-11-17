<?php

include 'dbConnect.php';

session_start();

$connect = connect_database();
$PRID = $_POST['pr_id'];
$studentID = $_POST['studentid'];
$points = $_POST['points'];

if($connect) {
	$queryPoints = mysql_query(
	"UPDATE
		points
	SET
		p_points = p_points+ '$points'
	WHERE
		p_studentid = '$studentID'"
	);

	$queryAwarded = mysql_query(
	"UPDATE
		proposal
	SET
		pr_awarded = 1
	WHERE
		pr_id = '$PRID'"
	);

	if($queryPoints && $queryAwarded) {
		echo "Points awarded!";
		header ("Refresh: 2; ../approvedRequest.php");
	} else die ("Failed!");
}


?>
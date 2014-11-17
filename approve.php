<?php

session_start();

include 'php/dbConnect.php';

$dbPRID = $_POST['pr_id'];

$connect = connect_database();
$query = mysql_query(
	"UPDATE
		proposal
	SET
		pr_approve = 1
	WHERE
		pr_id = '$dbPRID'"
	);

echo "Proposal id of $dbPRID has been approved!";
header("Refresh: 2; readRequest.php")

?>
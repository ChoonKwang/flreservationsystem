<?php

session_start();

include 'dbConnect.php';

$connect = connect_database();
error_reporting(0);

if ( strpos($_SESSION['l_admin'], 's') !== false ){
if( $_POST['studentid']&&$_POST['reason']) {
	$studentID = $_POST['studentid'];
	$reason = $_POST['reason'];
	$query = mysql_query("SELECT * FROM student WHERE s_admin ='$studentID'");
    $numrows = mysql_num_rows($query);
	if( $numrows != 0 ) {
	
	

if( $connect ) {
	$banby = $_SESSION['l_admin'];
	$date = date("Y-n-j");

	$query2 = mysql_query(
		"INSERT INTO banlist VALUES ( '$studentID', '$banby', '$date', '$reason')"
		);
		echo "Ban successful";
		header("Refresh: 2;url=../addEditBanlist.php");
		} else die("Unable to connect!");
	} else {
		echo "Invalid Student ID";
		header("Refresh: 2;url=../addEditBanlist.php");
		die();
	}
} else {
	echo "Please fill in all values.";
	header("Refresh: 2;url=../addEditBanlist.php");
	die();
}
}	
else
{
echo "You do not have permission to perform this action";
header("Refresh: 2;url=../index.php");
}
disconnect_database($connect);

?>
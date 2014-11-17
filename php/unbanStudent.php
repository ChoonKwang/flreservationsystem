<?php

session_start();

include 'dbConnect.php';

$connect = connect_database();
error_reporting(0);

if ( strpos($_SESSION['l_admin'], 's') !== false ){		
if( $_POST['de_studentid']) {
	$studentID = $_POST['de_studentid'];
	$query = mysql_query("SELECT * FROM banlist WHERE ba_adminno ='$studentID'");
    $numrows = mysql_num_rows($query);
	if( $numrows != 0 ) {

if( $connect ) {
	$query2 = mysql_query(
		"DELETE FROM banlist WHERE ba_adminno = '$studentID'"
		);
		echo "Deactivate ban successful";
		header("Refresh: 2;url=../addEditBanlist.php");
		} else die("Unable to connect!");
	} else {
		echo "This Student has not been banned";
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
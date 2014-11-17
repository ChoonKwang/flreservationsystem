<?php

session_start();

include 'dbConnect.php';

if( isset($_SESSION['admin']) )
	$studentID = $_SESSION['admin'];
else if( isset($_SESSION['s_admin']) )
	$studentID = $_SESSION['s_admin'];

$IPAdd = $_SERVER['SERVER_ADDR'];

$connect = connect_database();

if( $connect ) {
	$query = mysql_query("SELECT
							*
						FROM
							student
						WHERE
							s_admin = '$studentID'");

	$row = mysql_fetch_array($query);
	$fullname = $row['s_name'];
	$studentID = $row['s_admin'];
	$school = $row['s_school'];
	$diploma = $row['s_diploma'];
	$contact = $row['s_contact'];
	$email = $row['s_email'];
	
	$name = $fullname;
	$to  = $email;
	$subject = 'Thank you for registering!';
	$body = "Dear $name,\n\nThank for registering to the Fab-Lab Reservation System! \n\nClick the following link the activate your account!";
	$body .= "\n\nhttp://$IPAdd/fyp/php/activate.php?admin=$studentID";
	$headers = 'From: Fab-Lab Reservation System <fablab@reserve.com>';
	
	if(mail($to, $subject, $body, $headers)) {
		echo "Email has been sent $to";
	} else {
		echo "There was an error sending the mail.";
	}
	
}	//end of if( $connect )

header("Refresh: 2;url=../index.php");
?>
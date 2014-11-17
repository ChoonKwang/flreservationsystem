<?php

session_start();

include 'dbConnect.php';

if( $_POST['name']&&$_POST['admin']&&$_POST['pass']&&$_POST['confirmpass']&&$_POST['school']&&$_POST['diploma']&&$_POST['contact']&&$_POST['email'] ) {
	if( $_POST['pass'] == $_POST['confirmpass'] ) {
		$fullname = $_POST['name'];
		$studentID = $_POST['admin'];
		$password = md5($_POST['pass']);
		$school = $_POST['school'];
		$diploma = $_POST['diploma'];
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		$email .= '@ichat.sp.edu.sg';	
		$activated = 'false';
		$orientated = 'false';		
	} else {	//end of if( $_POST['pass'] == $_POST['confirmpass'] )
		echo "Passwords do not match!";
		header("Refresh: 3;url=http://localhost/fyp/register.php");
		die();
	}
} else {
	echo "Please fill in all values.";
	header("Refresh: 3;url=http://localhost/fyp/register.php");
	die();
}

$connect = connect_database();

if( $connect ) {
	$query = mysql_query(
		"INSERT INTO student VALUES ( '', '$fullname', '$studentID', '$password', '$school', '$diploma', '$contact', '$email', '$activated', '$orientated' )"
		);

	$_SESSION['name'] = $fullname;
	$_SESSION['admin'] = $studentID;
	$_SESSION['school'] = $school;
	$_SESSION['diploma'] = $diploma;
	$_SESSION['contact'] = $contact;
	$_SESSION['email'] = $email;
	
	header("Location: activationEmail.php");
} else die("Unable to connect!");

disconnect_database($connect);

?>
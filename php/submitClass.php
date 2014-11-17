<?php

session_start();

include 'dbConnect.php';

$connect = connect_database();

$staffName = $_SESSION['l_name'];
$staffID = $_SESSION['l_admin'];

$subject = $_POST['subject'];
$date = $_POST['date'];

//---Start time---
	$startTime = $_POST['startHr'];
	$startTime .=':';
	$startTime .=$_POST['startMin'];
//---Start time---

//---End time---
	$endTime = $_POST['endHr'];
	$endTime .= ':';
	$endTime .= $_POST['endMin'];
//---End time---

$totalStudents = $_POST['totalStudents'];
$sypnosis = $_POST['sypnosis'];
$description = $_POST['description'];

echo $staffName;
echo "<br>";
echo $staffID;
echo "<br>";
echo $subject;
echo "<br>";
echo $date;
echo '<br>';
echo $startTime;
echo '<br>';
echo $endTime;
echo '<br>';
echo $totalStudents;
echo '<br>';
echo $sypnosis;
echo '<br>';
echo $description;
echo '<br>';

if( $connect ) {
	$date = date("Y-m-d",strtotime($date));

	$query = mysql_query(
		"INSERT INTO
			class
		VALUES
			('', '$staffName', '$staffID', '$subject', '$date', '$startTime', '$endTime', '0', '$totalStudents', '$sypnosis', '$description', '', '', '', '')"
		);
	header('Refresh: 2; url=../staff.php');
} else {
	die("Couldn't connect to database!");
	header('Refresh: 2; url=../staff.php');
}

?>
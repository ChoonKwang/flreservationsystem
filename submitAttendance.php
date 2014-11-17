<?php

session_start();

include 'php/dbConnect.php';

$connect = connect_database();

$classID = $_POST['class_id'];
$attend = array();

foreach( $_POST['checked'] as $check ) {
	array_push($attend, $check);
	}
$attend = implode(',', $attend);

if( $_POST['orientation'] == 'yes' ) $orientation = 1;
else $orientation = 0;

$queryUpdate = mysql_query(
					"UPDATE
						class
					SET
						c_attend = '$attend',
						c_orientation = '$orientation'
					WHERE
						c_id = '$classID'"
					);
// if( $orientation == 1 ){
// $attend = explode(',', $attend);
// 	$queryUpdate = mysql_query(
// 						"UPDATE
// 							student
// 						SET
// 							s_orientated = 1
// 						WHERE
// 							s_admin IN ('$attend')"
// 						);	
// }

$studentIDArray = explode(',', $attend);
print_r($studentIDArray);

if( $orientation == 1 ){
	foreach( $studentIDArray as $studentID ) {
		$queryUpdate = mysql_query(
					"UPDATE
						student
					SET
						s_orientated = 1
					WHERE
						s_admin = '$studentID'"
					);
	}
}

$_SESSION['class_id'] = $classID;

header('Location: classAttendance.php');

?>
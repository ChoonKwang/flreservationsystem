<?php

session_start();

include 'dbConnect.php';

$connect = connect_database();

$classID = $_POST['class_id'];
$studentID = $_SESSION['s_admin'];
$studentName = $_SESSION['s_name'];

if( $connect ) {
	$queryCheck = mysql_query(
		"SELECT
			*
		FROM
			class
		WHERE
			c_id = $classID"
		);
	$numrows = mysql_num_rows($queryCheck);
	if( $numrows ) {
		while( $row = mysql_fetch_array($queryCheck) ) {
			$filled = $row['c_filled'];
			$totalStudents = $row['c_totalstudents'];
			$dbStudentID = $row['c_studentid'];
		}	//end of while( $row = mysql_fetch_array($queryCheck) )
	}	//end of if( $queryCheck )

	$registered = strpos($dbStudentID, $studentID);

	if( $registered === false ) {	//Student admin doesn't exists	
		if ( $filled != $totalStudents ) {	
			$queryUpdate = mysql_query(
				"UPDATE
					class
				SET
					c_filled = (c_filled + 1),
					c_studentid = concat(c_studentid, '$studentID,'),
					c_studentname = concat(c_studentname, '$studentName,')
				WHERE
					c_id = '$classID'"
				);
			if( $queryUpdate ) {
				echo "Registered!";
			} else {	//end of if( $queryUpdate )
				echo "Registration failed!";
			}
		} else {	//end of if ( $filled != $totalStudents )
			echo "Registration full!";
		}		
				
 	} else echo "Already registered!"; //end of if( $registered === false ) //Student admin exists

} else {	//end of if( $connect )
	die("Couldn't connect to database!");
}

header('Refresh :1; url=../student.php');


?>
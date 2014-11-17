<?php

$admin = $_SESSION['s_admin'];
$name = $_SESSION['s_name'];

if( $admin&&$name ) {
	$queryActivated = mysql_query("SELECT s_activated FROM student WHERE s_admin = '$admin'");
	$numrows = mysql_num_rows($queryActivated);

	if ($numrows != 0) {
		while( $row = mysql_fetch_array($queryActivated) ) {
			$dbActivated = $row['s_activated'];

			if($dbActivated) {
				$queryPoints = mysql_query("SELECT p_points FROM points WHERE p_studentid = '$admin'");
				$numrows = mysql_num_rows($queryPoints);
				if( $numrows != 0 ) {
					while( $row = mysql_fetch_array($queryPoints) ) {
						$dbPoints = $row['p_points'];
					}				
					$points = $dbPoints;
					$_SESSION['points'] = $dbPoints;
				} else {	//end of if( $numrows != 0 )
					die("An error has occured! Please see admin!");
				}
			} else {	//end of if($dbActivated)
				$points = "Please activate account!";
				$_SESSION['points'] = $points;	
			}
		}	//end of while( $row = mysql_fetch_array($queryActivated) )
	} else die("Student ID not found!");	//end of if ($numrows != 0)	
} else { 	//end of if( $admin&&$name )
	header('Location: index.php');
}




?>
<?php

include 'dbConnect.php';

session_start();

$connect = connect_database();
$studentID = $_SESSION['s_admin'];
$points = $_SESSION['points'];
$costpoint = $_SESSION['costPoint'];
$itemNumber = $_SESSION['itemNumber'];
$date = date('d-m-Y');

$arrayItem = 0;	//Array position of $itemNumber for item name
$arrayQuantity = 1;	//Array position of $itemNumber for selected quantity

if( $connect ) {
	if( ($points - $costpoint) >= 0 ) {
		$query = mysql_query(
			"UPDATE
				points
			SET
				p_points = p_points - '$costpoint'
			WHERE
				p_studentid = '$studentID'"
			);

		if( $query ) {
			echo "Order successful!";
			header('Refresh: 3; url=../student.php');

			while( isset($itemNumber[$arrayQuantity]) ) {	
				//---Update values in item table, deduct item quantity respectively---
				$queryDeduct = mysql_query(	
					"UPDATE
						item
					SET
						i_quantity = i_quantity - '$itemNumber[$arrayQuantity]'
					WHERE
						i_name = '$itemNumber[$arrayItem]'"
					);
				//---Update values in item table, deduct item quantity respectively---
				$queryInsert = mysql_query(
					"INSERT INTO
						ordereditems
					VALUES
						('', '$studentID', '$itemNumber[$arrayItem]', '$itemNumber[$arrayQuantity]', '$date')"
					);
				$arrayItem += 2;
				$arrayQuantity += 2;
			}	//end of while( isset($itemNumber[$arrayQuantity]) )

		} else {	//end of if( $query )
			echo "Order unsuccesful!<br>Please try again!";
			header('Refresh: 2; url=../orderMaterial.php');
		}

	} else {	//end of if( ($points - $costpoint) > 0 )
		echo "Not enough points!";
		header('Refresh: 2; url=../student.php');

	}

}	//end of if( $connect )

?>
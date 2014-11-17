<?php

include 'dbConnect.php';

$connect = connect_database();
$query = mysql_query("SELECT * FROM student WHERE s_approved = 0");
$numrows = mysql_num_rows($query);

$content = " ";

while( $row = mysql_fetch_array($query) ) {
	$dbVal = $row['s_id'];
	$dbAdmin = $row['s_admin'];
	$dbName = $row['s_name'];
	$dbDiploma = $row['s_diploma'];
	$dbContact = $row['s_contact'];
	$dbEmail = $row['s_email'];

	$content .= "<tr>";
	$content .= "<td>$dbAdmin</td>";
	$content .= "<td>$dbName</td>";
	$content .= "<td>$dbDiploma</td>";
	$content .= "<td>$dbContact</td>";
	$content .= "<td>$dbEmail</td>";
	$content .= "<td><input type='checkbox' name='id[]' value=".$dbVal."></td>";
	$content .= "</tr>";
}

if( isset($_POST['id']) ) {
	foreach( $_POST['id'] as $check ) {
		$query = mysql_query("SELECT s_admin FROM student WHERE s_id = '$check'");
		$numrows = mysql_num_rows($query);

		while( $row = mysql_fetch_array($query) ) {
			$dbAdmin = $row['s_admin'];
			$queryUpdate = mysql_query(
				"UPDATE student 
				SET s_approved = 1 
				WHERE s_id = $check"
				);
			$queryInsert = mysql_query(
				"INSERT INTO points VALUES ('', '$dbAdmin', '', '', 50)"
				);
		}	//End of while	
	}	//End of foreach
	header('Location: php/redirect.php');
} 

echo $content;

?>
<?php

session_start();

include 'dbConnect.php';

$connect = connect_database();
//error_reporting(0);

if ( strpos($_SESSION['l_admin'], 's') !== false ){
	if( $_POST['id']&&$_POST['name']&&$_POST['venue']) 
		{
		$id = $_POST['id'];
		$name = $_POST['name'];
		$venue = $_POST['venue'];
		$query = mysql_query("SELECT m_id FROM machine WHERE m_id ='$id'");
		$numrows = mysql_num_rows($query);
			if( $numrows == 0 ) 
				{
				$query2 = mysql_query(
				"INSERT INTO machine VALUES ('', '$id', '$name', '0', '$venue')"
				);
				echo "Successfully add machine";
				header("Refresh: 0;url=../addMachine.php");
				} 
			else
				{
				echo "Please Insert another Machine ID (No duplicate is allowed)";
				header("Refresh: 1.5;url=../addMachine.php");
				}
		}
		else 
		{
		echo "Please fill in all values.";
		header("Refresh: 1.5;url=../addMachine.php");
		}
}	
else
{
echo "You do not have permission to perform this action";
header("Refresh: 2;url=../index.php");
}

disconnect_database($connect);

?>
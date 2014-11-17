<?php

include 'php/dbConnect.php';

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<title>Update Machine Availability</title>
</head>

<body>

	<h2>3D Printers</h2>

	<form method="POST">
	<table width ="100%">
		<tr>
			<td width ="16%">ID</td>
			<td width ="84%">Available</td>
		</tr>

		<div id='form'>
<?php

$connect = connect_database();
$content = '';
$query = mysql_query(
	"SELECT
		m_id,
		m_name,
		m_available,
		m_index
	FROM
		machine"
	);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach( $_POST['checked'] as $check ) {
		if( $check != 'yes' ) {
			$queryUpdate = mysql_query(
	                "UPDATE  
	                  machine
	                SET
	                 m_available = 0
	                WHERE
	                  m_index = $check"
	                );
		} 
	}
	foreach( $_POST['check'] as $check ) {
	if( $check != 'yes' ) {
		$queryUpdate = mysql_query(
                "UPDATE  
                  machine
                SET
                 m_available = 1
                WHERE
                  m_index = $check"
                );
	} 
}
	header("Location: addEditMachine.php");
}

if( $query ) {
	$arrayNo = 0;
	while( $row = mysql_fetch_array($query) ) {
		$id = $row['m_index'];
		$available = $row['m_available'];
		$machine = $row['m_name'];
		if ( $available ) {
			$content .= "<tr>
							<td width ='16%'>$machine</td>
							<td width ='84%'>
								<input name='checked[".$arrayNo."]' type='hidden' value=".$id.">
								<input name='checked[".$arrayNo."]' type='checkbox' value='yes' checked='checked'>
							</td>
						</tr>";
		}	//end of if ( $available )
		else {
			$content .= "<tr>
							<td width ='16%'>$machine</td>
							<td width ='84%'><input name='check[".$arrayNo."]' type='checkbox' value=".$id."></td>
						</tr>";			
		}
		$arrayNo++;
	}	//end of while( $row = mysql_fetch_array($query) )

	echo $content;

}	//end of if( $query )

?>
		</div>

	</table><hr>

	<table width="100%" border="0">
		<tr align="left">
			<td>
				<input type="submit" formaction="adminPanel.php" value="Back">
				<input type="submit" formaction="addMachine.php" value="Add/Edit Machine Values">
			</td>
			<td width="100" align="right">
				<input id="apply" type="submit" value="Update Availability" onclick="return confirm('Apply Changes?')">
			</td>
		</tr>
	</table>
	</form>

</body>

</html>
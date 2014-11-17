<?php

include 'dbConnect.php';

session_start();

$connect = connect_database();
$content = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="confirmOrder.php" method="POST">
		<div>
			<h2>Confirm order</h2>

<?php

echo $content .="<p>";

$costPoint = 0;
$itemNumber = array();

foreach( $_POST['quantity'] as $quantity ) {
		if( $quantity != '' ) {
			list($item, $number) = explode( ",", $quantity );
			$itemNumber[] = $item;
			$itemNumber[] = $number;
			if( $number > 0 ) {
				$query = mysql_query(
					"SELECT
						i_costpoint
					FROM
						item
					WHERE
						i_name = '$item'"
					);

				$numrows = mysql_num_rows($query);

				if( $numrows ) {
					$row = mysql_fetch_array($query);
					$dbCostPoint = $row['i_costpoint'];
				}	//end of if( $numrows )

				$costPoint += $dbCostPoint * $number;

				echo $item ." -> ". $number;
				echo "<br>";			
			}	//end of if( $number > 0 )
		}	//end of if( $quantity != '' )

}	//end of foreach( $_POST['quantity'] as $quantity )

echo $content .="</p>";

echo $content .="<p>
				Total cost points: $costPoint";

$_SESSION['costPoint'] = $costPoint;
$_SESSION['itemNumber'] = $itemNumber;

?>

			<table width="100%">
				<tr>
					<td align="left">
						<input type="submit" value="Back" formaction="../orderMaterial.php">
					</td>
					<td align="right">
						<input type="submit" value="Confirm">
					</td>				
				</tr>
			</table>
		</div>
	</form>
</body>
</html>
<?php

include 'dbConnect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../js/attc.googleCharts.js"></script>
    <!--optional css-->
    <link rel="stylesheet" type="text/css" href="../css/attc.css">
    <meta charset="UTF-8">
        <title>View History</title>
</head>
<body>
<div class="mainContent">
<table
title="Tracking Data" 
                id="TrackingData" 
                summary="Description of table" 
                data-attc-createChart="true"
                data-attc-colDescription="colDescription" 
                data-attc-colValues="colValue1" 
                data-attc-location="TrackingDataPie" 
                data-attc-hideTable="true" 
                data-attc-type="pie"
                data-attc-googleOptions='{"is3D":true}'
                data-attc-controls='{"showHide":true,"create":true,"chartType":true}'>
        <thead>
                <tr>
                        <th id="colDescription">Machine ID</th>
                        <th id="colValue1">Total booking</th>
						<th>Total Booking Time</th>
						<th>Down Time</th>
                </tr>
        </thead>
        <tbody>
		<tr>
<?php
$content = " ";
$extracontent = " ";

$connect = connect_database();

$durationarray = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$totalbooking = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$x = 0;
$machineidarray = array('P_1', 'P_2', 'P_3', 'P_4', 'P_5', 'P_6','P_7','P_8','P_9','P_10','L_1','L_2','L_3');
if( $connect )
{
$queryGet = mysql_query( 
      "SELECT * FROM trackmachine"
      );
	  $user[] = mysql_num_rows($queryGet);
		
	  while( $row=mysql_fetch_array($queryGet) ) {
        $id = $row['tr_trackid'];
        $machineid = $row['tr_machineid'];
        $adminno = $row['tr_admin'];
		$duration = $row['tr_duration'];
		$dbdate = $row['tr_date'];
		$dbtime = $row['tr_time'];
        $extracontent .= "
				<tr>
                    <td>$id</td>
					<td>$machineid</td>
					<td>$adminno</td>
					<td>$duration</td>
					<td>$dbdate</td>
					<td>$dbtime</td>
               </tr>";
			   //Get the month user and sort by printer or laser

		list($machinetype, $machinenumber) = explode("_", $machineid);
		if ($machinetype == 'P')
		{
		$x = $machinenumber;
		$totalbooking[$x]++;
		$durationarray[$x] = $durationarray[$x] + $duration;
		}
		else
		{
		$x = $machinenumber;
		$x = $x + 9;
		$totalbooking[$x]++;
		$durationarray[$x] = $durationarray[$x] + $duration;
		}
		
} // end of while
} // end of if connected

$x = 0;
while($x!=13)
	{
		$content .= "<tr>
		<td>$machineidarray[$x]</td>
		<td>$totalbooking[$x]</td>
		<td>$durationarray[$x]</td>
		<td>0</td>
		";
		$x++;
	}


echo $content;
?>
		</tr>
        </tbody>
</table>
<div id="TrackingDataPie"></div>
<br>

<table><tr>
	<form>
			<td><center><input type="submit" value='Back' formaction='../adminPanel.php'></center></td>
		<td><center><input type="submit" value='Year' formaction='loadChartYear.php'></center></td>
		<td><center><input type="submit" value='Month' formaction='loadChartMonth.php'></center></td>
		<td><center><input type="submit" value='Day' formaction='loadChartDay.php'></center></td>
		<td><center><input type="submit" value='Admin No' formaction='loadAdmin.php'></center></td>
		<td><center><input type="submit" value='All Booking' formaction='viewAllBooking.php'></center></td>
		<td><center><input type="submit" value='Machine Usage' formaction='loadMachineUsage.php'></center></td>
	</form>
	</tr>
	</table>
</div>
</body>
</html>

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
                        <th id="colDescription">Year</th>
                        <th id="colValue1">Number of Booking</th>
						<th id="colValue1">3D Printer Only</th>
						<th id="colValue1">Laser Cutter Only</th>
                </tr>
        </thead>
        <tbody>
		<tr>
<?php
$content = " ";
$extracontent = " ";

$connect = connect_database();

$year = array();
$x = 0;
$totalusers = 0;
$user = array(0,0,0,0,0);
$printer = array(0,0,0,0,0);
$laser = array(0,0,0,0,0);


$todaydate = date("Y-n-j");
list($todayyear, $todaymonthvalue, $todayday) = explode("-", $todaydate);

$whilecount = 0;
while( $whilecount < 5)
{
$year[] = $todayyear - $whilecount;
$whilecount++;
}

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
		list($dbyear, $dbmonth, $dbday) = explode("-", $dbdate);
		$adduseryearvalue = $todayyear - $dbyear;
		$user[$adduseryearvalue]++;
		list($machinetype, $machinenumber) = explode("_", $machineid);
		if ($machinetype == 'P')
		$printer[$adduseryearvalue]++;
		else
		$laser[$adduseryearvalue]++;
		$totalusers++;
} // end of while
} // end of if connected

while($x!=5)
	{
		$content .= "<tr>
		<td>$year[$x]</td>
		<td>$user[$x]</td>
		<td>$printer[$x]</td>
		<td>$laser[$x]</td>
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
		<td><center><input type="submit" value='By 5 Years' formaction='loadChart5Year.php'></center></td>
		<td><center><input type="submit" value='By Year' formaction='loadChartYear.php'></center></td>
		<td><center><input type="submit" value='By Month' formaction='loadChartMonth.php'></center></td>
		<td><center><input type="submit" value='By Day' formaction='loadChartDay.php'></center></td>
		<td><center><input type="submit" value='All Booking' formaction='viewAllBooking.php'></center></td>
	</form>
	</tr>
	</table>
</div>
</body>
</html>

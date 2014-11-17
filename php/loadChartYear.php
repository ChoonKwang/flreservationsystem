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
<form action='loadChartYear.php' method='POST'><center>Enter Year (eg. 2014): <input name='variable' type='text'><input type='submit' value='Submit'></center></form><br>
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
                        <th id="colDescription">Month</th>
                        <th id="colValue1">Number of Booking</th>
						<th>3D Printer Only</th>
						<th>Laser Cutter Only</th>
                </tr>
        </thead>
        <tbody>
		<tr>
<?php
$content = " ";
$extracontent = " ";

$connect = connect_database();

$month = array('Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
$x = 0;
$totalusers = 0;
$user = array(0,0,0,0,0,0,0,0,0,0,0,0);
$printer = array(0,0,0,0,0,0,0,0,0,0,0,0);
$laser = array(0,0,0,0,0,0,0,0,0,0,0,0);

$todaydate = date("Y-n-j");
list($todayyear, $todaymonthvalue, $todayday) = explode("-", $todaydate);

$checkyear = (!isset($_POST['variable']) ? $todayyear : $_POST['variable']); 
echo "<center><h1>$checkyear</h1></center>";
if( $connect )
{
$queryGetMonth = mysql_query( 
      "SELECT * FROM trackmachine"
      );
	  $user[] = mysql_num_rows($queryGetMonth);
		
	  while( $row=mysql_fetch_array($queryGetMonth) ) {
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
		if ($dbyear == $checkyear)
		{
		$intdbmonth = (int)$dbmonth;
		$addusermonthvalue = $intdbmonth - 1;
		$user[$addusermonthvalue]++;
		list($machinetype, $machinenumber) = explode("_", $machineid);
		if ($machinetype == 'P')
		$printer[$addusermonthvalue]++;
		else
		$laser[$addusermonthvalue]++;
		$totalusers++;
		}
} // end of while
} // end of if connected

while($x!=12)
	{
		$content .= "<tr>
		<td>$month[$x]</td>
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
	
</div></body>
</html>

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
<form action='loadChartMonth.php' method='POST'><center>Enter Month (eg. 10): <input name='variable' type='text'><input type='submit' value='Submit'></center><br>
<center>Enter Year (eg. 2014): <input name='variableyear' type='text'><input type='submit' value='Submit'></center>
</form><br>
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
                        <th id="colDescription">Day</th>
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

$totalusers = 0;
$user = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$printer = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$laser = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$monthload = 0;

$todaydate = date("Y-n-j");
list($todayyear, $todaymonthvalue, $todayday) = explode("-", $todaydate);

$checkyear = (!isset($_POST['variableyear']) ? $todayyear : $_POST['variableyear']);
$checkmonth = (!isset($_POST['variable']) ? $todaymonthvalue : $_POST['variable']); 
$monthname = '';
switch ($checkmonth){
	case "1":
		$monthname = 'Jan';
		break;
		case "2":
		$monthname = 'Feb';
		break;
		case "3":
		$monthname = 'March';
		break;
		case "4":
		$monthname = 'April';
		break;
		case "5":
		$monthname = 'May';
		break;
		case "6":
		$monthname = 'June';
		break;
		case "7":
		$monthname = 'July';
		break;
		case "8":
		$monthname = 'August';
		break;
		case "9":
		$monthname = 'September';
		break;
		case "10":
		$monthname = 'October';
		break;
		case "11":
		$monthname = 'November';
		break;
		case "12":
		$monthname = 'December';
		break;
}

echo "<center><h1>$monthname ($todayyear)</h1></center>";

if($todaymonthvalue == 1 || $todaymonthvalue == 3 || $todaymonthvalue == 5 || $todaymonthvalue == 7 || $todaymonthvalue == 8 || $todaymonthvalue == 10 || $todaymonthvalue == 12  )
{
$days = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
$monthload = 31;
}
if($todaymonthvalue == 4 || $todaymonthvalue == 6 || $todaymonthvalue == 9 || $todaymonthvalue == 11)
{
$days = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30');
$monthload = 30;
}
if($todaymonthvalue == 2)
{
$days = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29');
$monthload = 29;
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
			   //Get the day user and sort by printer or laser
		list($dbyear, $dbmonth, $dbday) = explode("-", $dbdate);
		if ($dbyear == $checkyear && $dbmonth == $checkmonth)
		{
		$adduservalue = $dbday - 1;
		$user[$adduservalue]++;
		list($machinetype, $machinenumber) = explode("_", $machineid);
		if ($machinetype == 'P')
		$printer[$adduservalue]++;
		else
		$laser[$adduservalue]++;
		$totalusers++;
		}
} // end of while
} // end of if connected

$x = 0;
while($x!= $monthload)
	{
		$content .= "<tr>
		<td>$days[$x]</td>
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

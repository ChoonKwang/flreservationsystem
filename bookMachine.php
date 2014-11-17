<?php

error_reporting(0);

session_start();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $active = 1;
  $machineSelected = $_POST['machine'];
  $date = $_POST['date'];
}

$studentName = $_SESSION['s_name'];
$studentID = $_SESSION['s_admin'];
$points = $_SESSION['points'];
$costpoints = 0;

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <title>Book a Machine</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
</head>
<body>

<div class="wrap">

<?php include 'studentheader.php'; ?>

  <div class="content">

  <h2>
    Book a Machine
  </h2>

<?php

$queryCheck = mysql_query(
    "SELECT
      s_orientated
    FROM
      student
    WHERE
      s_admin = '$studentID'"
    );
$row = mysql_fetch_array($queryCheck);

if( $row['s_orientated'] == 0 ) {
    $content .= "<p>
                    Please go through the orientations first!
                </p>
            </div>
          </div>";

echo $content;

include 'footer.php';

$content .= "</body>
            </html>";

echo $content;

die();
}

?>

  <form id="selectInfo" action="bookMachine.php" method="POST">
    <table width="100%" border="0">
      <tr>
        <td width="10%">Machine:
        <select name='machine'>

<?php
$content = '';
$query = mysql_query(
    "SELECT * From machine Order by m_id"
    );
$numrows = mysql_num_rows($query);
if( $numrows != 0 ) {
    while( $row = mysql_fetch_array($query) ) {
    $id = $row['m_id'];
    $available = $row['m_available'];
    $machine = $row['m_name'];
    if( $available ) {
      $content .= "<option value='$machine'>$machine</option>";
    }
  }
  echo $content;
} else echo "Error";
?>
          </select>
          </td>
        </tr>
        <tr>
          <td width="10%">
              <?php 
                $content = "Date: <input type='text' name='date' id='datepicker' value='$date' readonly='readonly'>";
                echo $content;
              ?>
          </td>
        </tr>
        <tr>
          <td width="20%">
              <?php 
                if($machineSelected && $date) {
                  $content = 
                  "Selected date: $date <br>
                  Time slot for: $machineSelected";
                  echo $content;
                }
              ?>
          </td>
        </tr>
      </table>

      <table>
<?php
    if($active) {

    $date = date("Y-n-j",strtotime($date));

    $queryCheck = mysql_query( //check if dates are added
      "SELECT
        *
      FROM
        booking
      WHERE
        b_date = '$date'
      AND
        b_machine = '$machineSelected'" 
      );

    $numrows1 = mysql_num_rows($queryCheck);

    if( ($numrows1 == 0) && ($date != " ") ) {

      $insert = mysql_query(
        "INSERT INTO
          booking
        VALUES
          ('', '$date', '$machineSelected', '08:00:00', '09:00:00', '', 0),
          ('', '$date', '$machineSelected', '09:00:00', '10:00:00', '', 0),
          ('', '$date', '$machineSelected', '10:00:00', '11:00:00', '', 0),
          ('', '$date', '$machineSelected', '11:00:00', '12:00:00', '', 0),
          ('', '$date', '$machineSelected', '12:00:00', '13:00:00', '', 0),
          ('', '$date', '$machineSelected', '13:00:00', '14:00:00', '', 0),
          ('', '$date', '$machineSelected', '14:00:00', '15:00:00', '', 0),
          ('', '$date', '$machineSelected', '15:00:00', '16:00:00', '', 0),
          ('', '$date', '$machineSelected', '16:00:00', '17:00:00', '', 0)
          "
        );
    }   //end of if(!$numrows)

    $queryRetrieve = mysql_query( //retrieve date and timing
      "SELECT
        b_id,
        b_date,
        b_machine,
        b_timefrom,
        b_timeto
      FROM
        booking
      WHERE
        b_date = '$date'
      AND
        (b_machine = '$machineSelected' AND b_taken = 0)" 
      );

    $numrows2 = mysql_num_rows($queryRetrieve);

    if($numrows2 != 0) {
      while( $row=mysql_fetch_array($queryRetrieve) ) {
        $id = $row['b_id'];
        $timefrom = $row['b_timefrom'];
        $timeto = $row['b_timeto'];
		$b_machine = $row['b_machine'];
        $content = "<tr>
                    <td width = '10%'><input name='id[]' type='checkbox' value=".$id.">$timefrom - $timeto</td>
                  </tr>";

        echo $content;
      } //end of while

        if( isset($_POST['id']) && isset($_POST['book']) ) {
          foreach( $_POST['id'] as $check ) {
            $costpoints++;
          } //end of foreach( $_POST['id'] as $check )
          if ( ($points - $costpoints) >= 0 ) {
            foreach( $_POST['id'] as $check ) {
              $queryUpdate = mysql_query(
                "UPDATE  
                  booking
                SET
                  b_admin = '$studentID',
                  b_taken = 1
                WHERE
                  b_id = $check"
                );
            } //end of foreach( $_POST['id'] as $check )
          } //end of if ( ($points - $costpoints) > 0 )

          $_SESSION['cost'] = $costpoints;
		  $_SESSION['trackdate']= $date;
		  $_SESSION['timefrom']= $timefrom;
		  $_SESSION['$b_machine']=$b_machine;
          header("Location: php/confirmBooking.php");
      }   //end of if( isset($_POST['id']) )

    } else {//end of if($numrows2 != 0)
        echo "Fully booked!";
      }

  } else {  //end of if($connect)
    echo "";
  } 
?>    
          </table>
        <table>
          <tr>
            <td>Total cost points: </td>
            <td id="cost"></td>
          </tr>
        </table>

        <table width="100%" border="0">
          <tr align="left">
            <td width="100" align="right">
              <?php
                $content = "<input type='submit' id='book' name='book' value='Book' onclick=\"return confirm('Confirm booking?')\"><br>";
                if ($active) echo $content;
              ?>
            </td>
          </tr>
        </table>
      </form>    
    
    </div>

</div>

<?php include 'footer.php'; ?>



</body>
</html>

<script>
  $(function() {
    $( "#book" ).attr('disabled', true);

    $( "#datepicker" ).datepicker({
      dateFormat: 'dd-mm-yy',  
      minDate: 0, 
      maxDate: 2,
      onSelect: ("option", "onSelect", function() { 
        $( "#selectInfo" ).submit();
      } )
    });

    $("input[type=checkbox]").each(function () {
        $(this).change(updateCount);
      });

      updateCount();

      function updateCount () {
        var count = $("input[type=checkbox]:checked").size();

        $("#cost").text(count);

        if( count > 0 ) {
          $( "#book" ).attr('disabled', false);
        } else {
          $( "#book" ).attr('disabled', true);
        }
      };

});

</script>
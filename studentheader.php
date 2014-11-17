<?php

include 'php/dbConnect.php';

$admin = $_SESSION['s_admin'];
$name = $_SESSION['s_name'];

$connect = connect_database();

$query = mysql_query(
                "SELECT
                  p_points
                FROM
                  points
                WHERE
                  p_studentid = '$admin'"
                );

$row = mysql_fetch_array($query);
$points = $row['p_points'];

?>

<div class="header">

  <div class="upper">
    <p>
      <?php echo "Welcome, $name&nbsp;&nbsp;&nbsp;&nbsp;ID: $admin&nbsp;&nbsp;&nbsp;&nbsp;Points: $points"; ?>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <a href="logout.php"><img src="img/logout.png">Logout</a>
    </p>
  </div>

  <p class="title">
    <a href="student.php">Fab-lab <br>Reservation System</a>
  </p>
  <a href="student.php"><img width="400px" height="200px" src="img/fablab.jpg"></a>

  <ul class="studentNav">
    <li>
      <a href="bookMachine.php"><img src="img/3dprinter.png">Book Machine</a>
    </li>
    <li>
      <a href="requestForm.php"><img src="img/request.png">Request</a>     
    </li>
    <li>
      <a href="readClass.php"><img src="img/classes.png">Classes</a>       
    </li>
    <li>
      <a href="viewHistory.php"><img src="img/history.png">History</a>       
    </li>
  </ul> 
</div>
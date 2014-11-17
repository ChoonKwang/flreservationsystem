<?php

session_start();

?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <link rel="stylesheet" href="css/style.css">
  <meta charset='UTF-8'>
  <title>Student</title>
</head>

<body>

<div class="wrap">

<?php include 'studentheader.php'; ?>
<?php include 'php/loadStudentInfo.php'; ?>

  <div class="content">
    <p class="heading">
      Welcome to the fab lab reservation system!
    </p>
    <p class="heading">
      In this site, you will be able to reserve machines, <br>register for classes and even submit <br>project proposals to your lecturers!
    </p>
  </div>

</div>

<?php include 'footer.php'; ?>


</body>
</html>
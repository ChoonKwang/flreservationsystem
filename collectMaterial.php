<?php

include 'php/dbConnect.php';

session_start();

$studentName = $_SESSION['s_name'];
$studentID = $_SESSION['s_admin'];
$points = $_SESSION['points'];

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Collect Material</title>
</head>

<body>
<table width="500" border="0">
  <tr>
    <td align="left" width="10%">Name:</td>
    <td align="left" width="30%"><?= $studentName; ?></td>
    <td align="left" width="20%">Cost Point</td>
    <td align="left" width="20%">M_costpoint</td>
  </tr>
  <tr>
    <td align="left" width="10%">Admin:</td>
    <td align="left" width="30%"><?= $studentID; ?></td>
    <td width="117"><form action="" method="post">
    <form><input type="submit" formaction="" value="Update Cost Point">
</form></td>
  </tr>
    <tr>
    <td align="left" width="10%">Point:</td>
    <td align="left" width="30%"><?=$points; ?></td>
  </tr>
  </table>
  <table width="100%" border="0">
  <tr width ="100%">
  <td width = "16%">Please Choose</td>
  <td width = "84%">Quantity</td>
  </tr>
  <tr width ="100%">
  <td width = "16%">Filament</td>
  <td width = "84%"><input type="text"></td>
  </tr>
  <tr width ="100%">
  <td width = "16%">Arcylic</td>
  <td width = "84%"><input type="text"></td>
  </tr>
  </table>
  <table width="100%" border="0">
  <tr align="left">
    <td>
      <form><input type="submit" formaction="student.php" value="Back">
</form><br></td>
    <td width="100" align="right"><form action="" method="post">
    <input type="submit" formaction="" value="Submit">
</form><br></td>
  </tr>
</table>
</body>
</html>
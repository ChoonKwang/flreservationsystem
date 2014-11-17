<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Approve Student</title>
</head>

<body>
<table width="100%" border ="0">
<tr><td>Student to approve (select and click approve)</td></tr>
</table><br>
<table width="100%" border ="0">
<tr>
<td width="10%">Student ID</td>
<td width="25%">Name</td>
<td width="20%">Diploma</td>
<td width="20%">Contact No</td>
<td width="25%">Email</td>
</tr>
<form action="approveStudent.php" method="POST">

<?php include 'php/viewApprove.php' ?>

</tr>
</table><br>
<table width="100%" border="0">
  <tr align="left">
    <td>
      <input type="submit" formaction="staff.php" value="Back">
<br></td>
    <td width="100" align="right">
    <input type="submit" value="Approve" method="POST">
</form><br></td>
  </tr>
</table>
</body>
</html>
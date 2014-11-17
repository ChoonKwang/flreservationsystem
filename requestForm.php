<?php

session_start();

$studentName = $_SESSION['s_name'];
$studentID = $_SESSION['s_admin'];

?>


<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <meta charset="utf-8">
  <title>Request Form</title>
</head>

<body>

<div class="wrap">

<?php include 'studentheader.php'; ?>

  <div class="content">
  
    <h2>
      Submit Proposal
    </h2>  

     <form action="php/submitForm.php" method="POST">
<!--      <table width="400px" border="0">
        <tr>
          <td width="50%">Student Name:</td>
          <td width="50%"><?php echo $studentName; ?></td>
        </tr>
        <tr>
          <td width="50%">Student Admin:</td>
          <td width="50%"><?php echo $studentID; ?></td>
        </tr> -->

    <!--     <tr>
          <td>Other partners' Admin No: </td>
          <td>
            <textarea name="partner" cols="30" rows="5" readonly='readonly'></textarea>
            Not functioning yet!
          </td>
        </tr> -->
<!--       </table><br> -->

      <table width='60%' border='0'>
        <tr>
          <td>Lecturer name:</td>
          <td>
            <select name='lecturer'>
<?php

$content = "";

$query = mysql_query("SELECT l_name, l_admin FROM lecturer");
$numrows = mysql_num_rows($query);

if($numrows != 0) {
  while( $row = mysql_fetch_array($query) ) {
      $dbName = $row['l_name'];
      $dbAdmin = $row['l_admin'];


      $content .="<option value=$dbAdmin>$dbName</option>";
  }
}

echo $content;

?>
              </select>
            </td>
          </tr>
          <tr>
            <td>Project Title</td>
            <td><input name="title" type="text" width="250"></td>
          </tr>

          <tr>
            <td>Project sypnosis</td>
            <td>
              <textarea name="sypnosis" cols="60" rows="8"></textarea>
            </td>
          </tr>

          <tr>
            <td>Estimated completion time: </td>
            <td>
              <input type="text" name="complete" value="<?php $date ?>" />
            </td>
          </tr>

          <tr>
            <td>Additional comments: </td>
            <td>
              <textarea name="message" cols="40" rows="8"></textarea>
            </td>
          </tr>
        </table>

      <table width="100%" border="0">
        <tr align="left">
          <td width="100" align="right">
          <input type="submit" value="Submit">
          <br>
          </td>
        </tr>
      </table>
    </form>    
  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
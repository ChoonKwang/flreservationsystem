<?php

session_start();

$staffName = $_SESSION['l_name'];
$staffID = $_SESSION['l_admin'];

?>


<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>Create Class</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
</head>

<body>

<div class="wrap">

<?php include 'staffheader.php'; ?>

  <div class="content">
    <form action='php/submitClass.php' method='POST'>
      <table width='225' border='0'>
        <tr>
          <td width='50%'>Staff Name:</td>
          <td width='50%'><?php echo $staffName; ?></td>
        </tr>
        <tr>
          <td width='50%'>Staff Admin:</td>
          <td width='50%'><?php echo $staffID; ?></td>
        </tr>
      </table><br>

      <table width='60%' border='0'>
        <tr>
          <td>Subject:</td>
          <td>
            <input name='subject' type='text'>
          </td>
        </tr>

        <tr>
          <td>Date:</td>
          <td>
            <input name='date' type='text' id='datepicker' readonly='readonly'>
          </td>
        </tr>

        <tr>
          <td>Time:</td>
          <td>
            <select name='startHr'>
              <option value='08'>08</option>
              <option value='09'>09</option>
              <option value='10'>10</option>
              <option value='11'>11</option>
              <option value='12'>12</option>
              <option value='13'>13</option>
              <option value='14'>14</option>
              <option value='15'>15</option>
              <option value='16'>16</option>
              <option value='17'>17</option>
            </select>
            :
            <select name='startMin'>
              <option value='00'>00</option>
              <option value='15'>15</option>
              <option value='30'>30</option>
              <option value='45'>45</option>
            </select>

            &nbsp;to&nbsp;

            <select name='endHr'>
              <option value='08'>08</option>
              <option value='09'>09</option>
              <option value='10'>10</option>
              <option value='11'>11</option>
              <option value='12'>12</option>
              <option value='13'>13</option>
              <option value='14'>14</option>
              <option value='15'>15</option>
              <option value='16'>16</option>
              <option value='17'>17</option>
            </select>
            :
            <select name='endMin'>
              <option value='00'>00</option>
              <option value='15' selected='selected'>15</option>
              <option value='30'>30</option>
              <option value='45'>45</option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Total students:</td>
          <td>
            <select name='totalStudents'>
              <option value='0'>0</option>
              <option value='1'>1</option>
              <option value='2'>2</option>
              <option value='3'>3</option>
              <option value='4'>4</option>
              <option value='5'>5</option>
              <option value='6'>6</option>
              <option value='7'>7</option>
              <option value='8'>8</option>
              <option value='9'>9</option>
              <option value='10'>10</option>
              <option value='11'>11</option>
              <option value='12'>12</option>
              <option value='13'>13</option>
              <option value='14'>14</option>
              <option value='15'>15</option>
              <option value='16'>16</option>
              <option value='17'>17</option>
              <option value='18'>18</option>
              <option value='19'>19</option>
              <option value='20'>20</option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Sypnosis: </td>
          <td>
            <textarea name='sypnosis' cols='60' rows='6'></textarea>
          </td>
        </tr>

        <tr>
          <td>Description: </td>
          <td>
            <textarea name='description' cols='60' rows='8'></textarea>
          </td>
        </tr>
      </table>

      <table width='100%' border='0'>
        <tr align='left'>
          <td>
            <input type='submit' formaction='staffClass.php' value='Back'>
            <br>

          </td>
          <td width='100' align='right'>
          <input type='submit' value='Submit'>
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

<script>
  $(function() {
    $( "#datepicker" ).datepicker({
      dateFormat: 'dd-mm-yy',  
      minDate: 0
    });
});

</script>
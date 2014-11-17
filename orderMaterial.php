<?php

include 'php/dbConnect.php';

session_start();

$connect = connect_database();

$studentName = $_SESSION['s_name'];
$studentID = $_SESSION['s_admin'];
$points = $_SESSION['points'];
$content = "";

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>
  Collect Material
</title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
</head>

<body>
  <table width="200" border="0">
    <tr>
      <td align="left" width="10%">Name:</td>
      <td align="left" width="30%"><?= $studentName; ?></td>
    </tr>
    <tr>
      <td align="left" width="10%">Admin:</td>
      <td align="left" width="30%"><?= $studentID; ?></td>
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
    <form action="php/orderQuery.php" method ="POST">
<?php

$query = mysql_query(
  "SELECT
    i_name,
    i_quantity
  FROM
    item"
  );

$numrows = mysql_num_rows($query);

if($numrows) {
  while( $row = mysql_fetch_array($query) ) {
    $dbItem = $row['i_name'];
    $dbQuantity = $row['i_quantity'];

    if($dbQuantity > 0) {
      $content .="<tr width ='100%'>
                  <td width = '16%'>$dbItem</td>
                  <td width = '84%'>
                    <select class='quantity' name='quantity[]'>
                      <option value=''></option>
                      <option value='$dbItem,1'>1</option>
                      <option value='$dbItem,2'>2</option>
                      <option value='$dbItem,3'>3</option>
                    </select>
                  </td>
                  </tr>";      
            } else {  // end of if($dbQuantity > 0)
              $content .="<tr width ='100%'>
                          <td width = '16%'>$dbItem</td>
                          <td width = '84%'>
                            Out of Stock!
                          </td>
                          </tr>";                
            }

  } //end of while
} //end of if($numrows)



echo $content;
?>

      </table>
      <table width="100%" border="0">
      <tr align="left">
        <td>
          <input type="submit" formaction="Student.php" value="Back"><br>
        </td>
        <td width="100" align="right">
        <input id="submitorder" type="submit" value="Submit"><br>
        </td>
      </tr>
    </table>
  </form>
</body>
</html>

<script>
  $(function() {
    $('#submitorder').attr('disabled', 'disabled');

    $('select.quantity').change(function (){
      if ( $(this).val() != '' ) {
            $('#submitorder').attr('disabled', false);
        } else {
            $('#submitorder').attr('disabled', true);
        }
    });

    // function updateFormEnabled() {
    //     if (verifyAdSettings()) {
    //         $('#submitorder').attr('disabled', false);
    //     } else {
    //         $('#submitorder').attr('disabled', true);
    //     }
    // }

    // function verifyAdSettings() {
    //     if ($('select').val() != '') {
    //         return true;
    //     } else {
    //         return false
    //     }
    // }   
    
    // $('select.quantity').each(function () {
    //   $( this ).change(updateFormEnabled);
    // });

  }); 
</script>
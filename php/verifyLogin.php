<?php

include 'dbConnect.php';

session_start();

$student = false;
$lec = false;

if ( strpos($_POST['admin'], 'p') !== false ) {

    $studentID = $_POST['admin'];
    $studentPass = $_POST['pass']; 
    $student = true;

} else if ( strpos($_POST['admin'], 's') !== false ) {

    $lecID = $_POST['admin'];
    $lecPass = $_POST['pass'];  
    $lec = true;

}

if ( $student || $lec ) {
    $connect = connect_database();
	
	$queryban = mysql_query("SELECT * FROM banlist WHERE ba_adminno ='$studentID'");
    $numrows = mysql_num_rows($queryban);
	$row=mysql_fetch_array($queryban);
	$reason = $row['ba_reason'];
	if($numrows == 1)
	{
	echo "You have been banned, please contact the TSO<br>";
	echo "Reason: $reason";
	echo "<br><br><button onclick='history.go(-1);'>Back </button>";
	}
	else
	{
    if ( $student ) {
        $query = mysql_query("SELECT * FROM student WHERE s_admin ='$studentID'");
        $numrows = mysql_num_rows($query);
    } else if ( $lec ) {
        $query = mysql_query("SELECT * FROM lecturer WHERE l_admin ='$lecID'");
        $numrows = mysql_num_rows($query);
    }

    if ( $numrows != 0) {
        if ( $student ) {
            while ($row=mysql_fetch_array($query)) {
                $dbName = $row['s_name'];
                $dbStudentID = $row['s_admin'];
                $dbPassword = $row['s_pass'];
                $dbDiploma = $row['s_diploma'];
            }
        } else if ( $lec ) {
            while ($row=mysql_fetch_array($query)) {
                $dbName = $row['l_name'];
                $dbLecID = $row['l_admin'];
                $dbPassword = $row['l_pass'];
                $dbSchool = $row['l_school'];

            }
        }

    if ( $student ) {
        if ( $studentID==$dbStudentID&&md5($studentPass)==$dbPassword ) {
            echo "Login as student successful!";
            header("Location: ../student.php");

            $_SESSION['s_name'] = $dbName;
            $_SESSION['s_admin'] = $dbStudentID;
            $_SESSION['s_diploma'] = $dbDiploma;

        } else {
            echo "Incorrect user or password!";
            header("Refresh: 1; url= ../index.php");
        } 
    } else if ($lec) {
        if ( $lecID==$dbLecID&&$lecPass==$dbPassword ) {
            echo "Login as staff successful!";
            header("Location: ../staff.php");

            $_SESSION['l_name'] = $dbName;
            $_SESSION['l_admin'] = $dbLecID;
            $_SESSION['l_school'] = $dbSchool;
        } else {
            echo "Incorrect user or password!";
            header("Refresh: 2; url=../index.php");
        } 
    }

    } else {
        echo "That user doesn't exists!";
        header("Refresh: 2; url=../index.php");
    }
	}
} else {
    echo "Please enter a username and password!";
    header("Refresh: 2; url=../index.php");
}
  
?>
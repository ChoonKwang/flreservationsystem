<?php

session_start();

echo $_SESSION['cost'];

echo "Values set";
header('Refresh: 3; url=../student.php');

?>
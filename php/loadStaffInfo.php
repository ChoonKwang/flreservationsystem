<?php

session_start();

$name = $_SESSION['l_name'];
$admin = $_SESSION['l_admin'];

if( !($name&&$admin) ) {
	header('Location: index.php');
}

?>

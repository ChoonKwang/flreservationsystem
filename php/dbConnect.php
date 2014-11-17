<?php

function connect_database() {
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'fab_lab';

	$connect = mysql_connect($host, $username, $password) or die("Unable to connect!");
	mysql_select_db($db, $connect) or die("Unable to select database!");

	return $connect;
}

function disconnect_database($connection) {
	mysql_close($connection);
}

?>
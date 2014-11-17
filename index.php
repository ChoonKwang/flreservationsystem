<?php

session_start();

if( isset($_SESSION['s_admin']) ) {
	header('Location: student.php');
} else if( isset($_SESSION['l_admin']) ) {
	header('Location: staff.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/style.css">

	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
<div class="container">

	<div class="title">
		<h1>Fab-Lab <br>Reservation System</h1>
	</div>

	<div class="login">
		<form action="php/verifyLogin.php" method="POST">
			<ul>
				<li id="admission">Admission ID: <input type="text" name="admin" width ="200"></li>
				<li> Password: <input type="password" name="pass" width ="200"></li>
				<li id="login"><input type="submit" value="Login"></li>
				<li id="register"><input type="submit" value="Register" formaction="register.php"></li>
				<li> <input type="submit" value="Forget Password" formaction=""></li>
			</ul>
		</form>
	</div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
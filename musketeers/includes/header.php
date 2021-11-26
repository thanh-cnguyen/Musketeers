<?php
require 'config/config.php';

if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_querry = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_querry);
} else {
	header("Location: reg.php");
}

?>
<html>
<head>
	<title>Welcome to Happy</title>

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="resources/js/bootstrap.js"></script>
	<script src="https://kit.fontawesome.com/cbc9e853d8.js" crossorigin="anonymous"></script> <!-- Icon Kit Library -->

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="resources/css/style.css">
</head>
<body>
	<div class="top_bar">
		<div class="logo">
			<a href="home.php">HAPPY</a>
		</div>

		<nav>
			<div>

			</div>
			<a href="<?php echo $userLoggedIn; ?>"><?php echo ucfirst($user['first_name']) ?></a>
			<a href="#"><i class="fas fa-comment-dots"></i></a>
			<a href="#"><i class="fas fa-users"></i></a>
			<a href="#"><i class="fas fa-bell"></i></a>
			<a href="#"><i class="fas fa-cogs"></i></a>
			<a href="reg.php"><i class="fas fa-sign-out-alt"></i></a>
		</nav>
	</div>

	<div class="wrapper">
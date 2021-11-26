<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>
<html>
<head>
	<title>Log in or Register</title>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="resources/css/register_style.css">

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="resources/js/register.js"></script>
</head>
<body>

	<!-- Show error message without going back to login/register -->
	<?php
if (isset($_POST['reg_button'])) {
	echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});
		</script>
		';
}
?>

	<div class="wrapper">
		<div class="login_header">
			<h1>HAPPY</h1>
		</div>
		<div class="login_box">
			<div id="first">
				<form action="reg.php" method ="POST">
					<input type="email" name="log_email" placeholder="Email Address" value="<?php
if (isset($_SESSION['log_email'])) {
	echo $_SESSION['log_email'];
}

?>" required><br>
					<input type="password" name="log_pass" placeholder="Password" required><br>
					<?php if (in_array("Email or password was incorrect.<br>", $error_array)) {
	echo "<span style='color: red;'>Email or password was incorrect.<br></span>";
}
?>

					<input type="submit" name="log_button" value="Log In" required><br>
					<a href="#" id="signup" class="signup">Need an account? Register here!</a>
				</form>
			</div>

			<div id="second">
				<form action="reg.php" method="POST">
					<input type="text" name="reg_fname" placeholder= "First Name" value="<?php
if (isset($_SESSION['reg_fname'])) {
	echo $_SESSION['reg_fname'];
}

?>" required>
				 <?php if (in_array("Your First name must be between 2 and 25 characters.<br>", $error_array)) {
	echo "<span style='color: red;'>Your First name must be between 2 and 25 characters.<br></span>";
}
?>

					<input type="text" name="reg_lname" placeholder= "Last Name" value="<?php
if (isset($_SESSION['reg_lname'])) {
	echo $_SESSION['reg_lname'];
}

?>" required><br>
				 <?php if (in_array("Your Last name must be between 2 and 25 characters.<br>", $error_array)) {
	echo "<span style='color: red;'>Your Last name must be between 2 and 25 characters.<br></span>";
}
?>

					<input type="email" name="reg_em" placeholder= "Email Address" value="<?php
if (isset($_SESSION['reg_em'])) {
	echo $_SESSION['reg_em'];
}

?>" required><br>

					<input type="email" name="reg_em2" placeholder= "Confirm Email" value="<?php
if (isset($_SESSION['reg_em2'])) {
	echo $_SESSION['reg_em2'];
}

?>" required><br>
				 <?php if (in_array("Email already in use.<br>", $error_array)) {
	echo "<span style='color: red;'>Email already in use.<br></span>";
} elseif (in_array("Invalid Format.<br>", $error_array)) {
	echo "<span style='color: red;'>Invalid Format.<br></span>";
} elseif (in_array("Your emails do not match.<br>", $error_array)) {
	echo "<span style='color: red;'>Your emails do not match.<br></span>";
}
?>

					<input type="password" name="reg_pass" placeholder= "Password" required><br>

					<input type="password" name="reg_pass2" placeholder= "Confirm Password" required><br>
				<?php if (in_array("Your passwords do not match.<br>", $error_array)) {
	echo "<span style='color: red;'>Your passwords do not match.<br></span>";
} elseif (in_array("Your password can only contains english characters or numbers.<br>", $error_array)) {
	echo "<span style='color: red;'>Your password can only contains english characters or numbers.<br></span>";
} elseif (in_array("Your password must be between 6 and 30 characters.<br>", $error_array)) {
	echo "<span style='color: red;'>Your password must be between 6 and 30 characters.<br></span>";
}
?>

					<input type="submit" name="reg_button" value="Sign up" required><br>
					<a href="#" id="signin" class="signup">Already have an account? Login here!</a>
					<?php if (in_array("<span style='color: #14c800;'>Registration complete!</span><br>", $error_array)) {
	echo "<span style='color: #14c800;'>Registration complete!</span><br>";
}
?>
				</form>
			</div>

		</div>
	</div>
</body>
</html>
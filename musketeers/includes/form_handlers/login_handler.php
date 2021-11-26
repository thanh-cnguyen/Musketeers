<?php

if (isset($_POST['log_button'])) {
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Sanitize email
	$_SESSION['log_email'] = $email; //Store email into session variable

	$pass = md5($_POST['log_pass']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$pass'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if ($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query); //Fetch username in database
		$username = $row['username']; //Get username from database

		//Reopen a closed account
		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND user_closed = 'yes'");
		if (mysqli_num_rows($user_closed_query) == 1) {
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email'");
		}

		$_SESSION['username'] = $username; //Indicate logged-in account
		header("Location: home.php"); //Redirect to homepage
		exit();
	} else {
		array_push($error_array, "Email or password was incorrect.<br>");
	}
}

?>
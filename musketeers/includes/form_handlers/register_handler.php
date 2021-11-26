<?php
//Declare variables
$fname = ""; //First name
$lname = ""; //Last name
$email = ""; //Email
$email2 = ""; //Confirmed email
$pass = ""; //Password
$pass2 = ""; //Confirmed password
$date = ""; //Registration date
$error_array = array(); //Contains error messages

if (isset($_POST['reg_button'])) {
	//Registration form values

	//Names
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //Remove spaces
	$fname = strtolower($fname); //Uppercase all letters
	$_SESSION['reg_fname'] = $fname; //Store first name into session variable

	$lname = strip_tags($_POST['reg_lname']);
	$lname = str_replace(' ', '', $lname);
	$lname = strtolower($lname);
	$_SESSION['reg_lname'] = $lname;

	//Emails
	$email = strip_tags($_POST['reg_em']); //Remove html tags
	$email = str_replace(' ', '', $email); //Remove spaces
	$email = strtolower($email); //Lowercase all letters
	$_SESSION['reg_em'] = $email;

	$email2 = strip_tags($_POST['reg_em2']);
	$email2 = str_replace(' ', '', $email2);
	$email2 = strtolower($email2);
	$_SESSION['reg_em2'] = $email2;

	//Passwords
	$pass = strip_tags($_POST['reg_pass']);
	$pass2 = strip_tags($_POST['reg_pass2']);

	//Registration Date
	$date = date("Y-m-d");

	//Validate names
	if (strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your First name must be between 2 and 25 characters.<br>");
	}

	if (strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array, "Your Last name must be between 2 and 25 characters.<br>");
	}

	//Validate emails
	if ($email == $email2) {

		//Check if email is in a correct format

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);

			//Check if email already exists
			//Get email from data table
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$email'");
			//Count the number rows returned
			$num_rows = mysqli_num_rows($e_check);

			if ($num_rows > 0) {
				//echo "Email already in use";
				array_push($error_array, "Email already in use.<br>");
			}

		} else {
			array_push($error_array, "Invalid Format.<br>");
		}
	} else {
		array_push($error_array, "Your emails do not match.<br>");
	}

	//Verify Passwords
	if ($pass != $pass2) {
		array_push($error_array, "Your passwords do not match.<br>");
	} else {
		//Check if passwords contain the correct characters
		if (preg_match('/[^A-Za-z0-9]/', $pass)) {
			array_push($error_array, "Your password can only contains english characters or numbers.<br>");
		}

	}
	if (strlen($pass) > 30 || strlen($pass) < 6) {
		array_push($error_array, "Your password must be between 6 and 30 characters.<br>");
	}

	if (empty($error_array)) {
		$pass = md5($pass); //Encrypt password before sending to database

		//Generate username by concatenating first and last names
		$username = strtolower($fname . "_" . $lname);
		$user_check_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");

		$i = 0;
		//If username exists, add number to username
		while (mysqli_num_rows($user_check_query) > 0) {
			$i++;
			$username = $username . $i;
			$user_check_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
		}

		//Assign a random profile picture to an account
		$rand = rand(1, 6); //Generate random numbers between 1 and 16
		switch ($rand) {
		case 1:
			$profile_pic = "resources/images/profile_pics/defaults/head_alizarin.png";
			break;
		case 2:
			$profile_pic = "resources/images/profile_pics/defaults/head_wisteria.png";
			break;
		case 3:
			$profile_pic = "resources/images/profile_pics/defaults/head_belize_hole.png";
			break;
		case 4:
			$profile_pic = "resources/images/profile_pics/defaults/head_carrot.png";
			break;
		case 5:
			$profile_pic = "resources/images/profile_pics/defaults/head_pete_river.png";
			break;
		case 6:
			$profile_pic = "resources/images/profile_pics/defaults/head_sun_flower.png";
			break;
		}

		//Send values to datebase
		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname','$lname', '$username','$email','$pass', '$date', '$profile_pic', '0', '0','no', ',')");

		//Show complete message
		array_push($error_array, "<span style='color: #14c800;'>Registration complete!</span><br>");

		//Clear all session
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_em'] = "";
		$_SESSION['reg_em2'] = "";
	}
}
?>
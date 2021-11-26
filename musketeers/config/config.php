<?php
ob_start(); //Turn on output buffering
session_start(); //Start a session for each input time

$timezone = date_default_timezone_set("America/Chicago");

$con = mysqli_connect("localhost", "root", "", "social"); //Connection variable

if (mysqli_connect_errno()) {
	echo "Failed to connect: " . mysql_connect_errno();
}

?>
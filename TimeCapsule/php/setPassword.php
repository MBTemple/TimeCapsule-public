<?php
	error_reporting(0);
	session_start();
	require_once("config.php");

	//Get data off the web:
	$Email = $_SESSION["Email"];
	$Password1 = md5($_POST["password1"]);
	$Password2 = md5($_POST["password2"]);
	// check if two are the same if not send it back setPasswordForm.php
	//print "Web data ($Email) ($Password) <br>";
  if ($Password1 != $Password2) {
		$_SESSION["RegState"] = -11;
		$_SESSION["Message"] = "Passwords not match. Please try again. ";
		echo json_encode($_SESSION);
		exit();
	}
	//Connect to database
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Database connection failed: ".
			mysqli_error($con);
			echo json_encode($_SESSION);
		exit();
	}
	//print "Database connected <br>";

	//Build a query to update user Password
	$query = "Update Users set Password='$Password1' where Email='$Email';";
	//execute the query
	$result = mysqli_query($con, $query);
	//check for correctness
	if (!$result) {
		$_SESSION["RegState"] = -6;
		$_SESSION["Message"] = "Password update failed: ".
			mysqli_error($con);
			echo json_encode($_SESSION);
		exit();
	}
	//Password set successfully
	$_SESSION["RegState"] = 0;
	$_SESSION["Message"] = "Password set. Please login.";
	echo json_encode($_SESSION);
	exit();
?>

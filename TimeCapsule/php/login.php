<?php
	error_reporting(0); 
	session_start();
	require_once("config.php");

	//Get data off the web:
	$Email = $_POST["email"];
	$Password = md5($_POST["password"]);
	$rememberMe = $_POST["rememberMe"]; //You have to figure out how to handle cookies

	//print "Web data ($Email) ($Password) <br>";

	//Connect to database
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		echo json_encode($_SESSION);
		//header("location:../loginForm.php");
		exit();
	}
	//print "Database connected <br>";

	//Build a query to update user Password
	$query = "Select * from Users where Password='$Password' and Email='$Email';";
	//execute the query
	$result = mysqli_query($con, $query);
	//check for correctness
	if (!$result) {
		$_SESSION["RegState"] = -7;
		$_SESSION["Message"] = "Login query failed: ".
			mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}
	// print "Query worked!!! <br>";
	//Check that only one user/row matches
	if (mysqli_num_rows($result) != 1) {
		$_SESSION["RegState"] = -8;
		$_SESSION["Message"] = "Either Email or Password did not match. Please try again.";
		echo json_encode($_SESSION);
		exit();
	}
	//print "Logged in <br>";

	//Login successfully
	$_SESSION["Message"] = "Login successful.";
	$_SESSION["RegState"] = 4; //Login success
	$_SESSION["Email"] = $Email;
	echo json_encode($_SESSION);
	exit();
?>

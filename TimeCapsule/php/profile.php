<?php
	error_reporting(0);
	session_start();
	require_once("config.php");

  //Get data off the web:
	$Email = $_SESSION["Email"];  // Force profile ONLY to logged in user
	$FirstName = $_POST["first-name"];
	$LastName = $_POST["last-name"];
	$Age = $_POST["age"];
	$Country = $_POST["country"];
	$AboutMe = $_POST["aboutMe"];

	//print "Web data FirstName($FirstName) <br>";

	//print "Web data ($Email) ($FirstName) ($LastName) ($Age) ($Country) ($AboutMe) <br>";

  //Connect to database
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}
	//print "Database connected <br>";

	//Build an insert query
	$Acode = rand(); //get a new activation code
	$Rdatetime = date("Y-m-d h:i:s");

	$query = "Update Users set FirstName='$FirstName', LastName='$LastName',".
		"Age=$Age, Country='$Country', AboutMe='$AboutMe', Rdatetime='$Rdatetime' ".
		"where Email='$Email';";
	$result = mysqli_query($con, $query);
	// print "Profile updated.<br>";
	if (!$result) {
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "Profile update failed: ".mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}
	$_SESSION["Message"] = "Profile updated: ";
	$_SESSION["Email"] = $Email; // Save it for "updateProfile.php"
	$_SESSION["Rdatetime"] = $Rdatetime;
	echo json_encode($_SESSION);
	exit();
?>

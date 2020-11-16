<?php
	error_reporting(0);
	session_start();
	require_once("config.php");
  // print "in updateProfile <br>";

	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Database connection failed: ".mysqli_error($con);
		//print "Database connection failed: ".mysqli_error($con);
		//header("location:../editProfile.php");
		echo json_encode($_SESSION);
		exit();
	}
	$query = "select * from Users where Email='".$_SESSION["Email"]."';";
	$result = mysqli_query($con, $query);
	if (!$result) {
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "Database query failed: ".mysqli_error($con);
		//print "Database query failed: ".mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}
	$row = mysqli_fetch_array($result);
	// print "Data retrieved Email=(".$row["Email"].") FirstName(".$row["FirstName"].") <br>";
	echo json_encode($row);
	exit();
?>

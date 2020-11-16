<?php
	error_reporting(0);
	session_start();
	require_once("config.php");

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	require '../PHPMailer-master/src/Exception.php';
	require '../PHPMailer-master/src/PHPMailer.php';
	require '../PHPMailer-master/src/SMTP.php';

	//print "Called register2.php <br>";

	//Get the data off web
	$Email = $_POST["email"];
	$FirstName = $_POST["first-name"];
	$LastName = $_POST["last-name"];

	//print "Web data ($Email) ($FirstName) ($LastName) <br>";

	//Connect to DB
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
	$query = "Insert into Users (FirstName,LastName,Email,Acode,Rdatetime,Status) values ('$FirstName','$LastName','$Email','$Acode','$Rdatetime','1');";
	//execute the query
	$result = mysqli_query($con, $query);
	//check for correctness
	if (!$result) {
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "Query failed: ".
			mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}
	//print "Query worked! <br>";
	//Registration success. Build authentication email.

	//Build the PHPMailer object:
	$mail= new PHPMailer(true);
	try {
		$mail->SMTPDebug = 0; // Wants to see all errors
		$mail->IsSMTP();
		$mail->Host="smtp.gmail.com";
		$mail->SMTPAuth=true;
		$mail->Username="cis105223053238@gmail.com";
		$mail->Password = 'g+N3NmtkZWe]m8"M';
		$mail->SMTPSecure = "ssl";
		$mail->Port=465;
		$mail->SMTPKeepAlive = true;
		$mail->Mailer = "smtp";
		$mail->isHTML(true);
		$mail->setFrom("tug01026@temple.edu", "TimeCapsule");
		$mail->addReplyTo("tug01026@temple.edu", "TimeCapsule");
		$msg = "Please click the <a href='http://tec2.hpc.temple.edu/~tug01026/4398/Project/php/authenticate.php?Acode=$Acode&Email=$Email'>link</a> to complete the registration process. ";
		$mail->addAddress($Email,"$FirstName $LastName");
		$mail->Subject = "Welcome to TimeCapsule!";
		$mail->Body = $msg;
		$mail->send();
		// print "Email sent ... <br>";
		$_SESSION["RegState"] = 3;
		$_SESSION["Message"] = "Email sent.";
		echo json_encode($_SESSION);
		exit();
	} catch (phpmailerException $e) {
		$_SESSION["Message"] = "Mailer error: ".$e->errorMessage();
		$_SESSION["RegState"] = -4;
		//print "Mail send failed: ".$e->errorMessage;
		echo json_encode($_SESSION);
		exit();
	}
?>

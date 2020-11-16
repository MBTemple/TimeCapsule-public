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

	//print "Called resetPassword2.php <br>";

    //Get the data off web
	$Email = $_POST["email"];
//	print "Web data ($Email) <br>";

	//Connect to DB
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Database connection failed: ".
			mysqli_error($con);
			echo json_encode($_SESSION);
		exit();
	}
	//print "Database connected <br>";

    //Build a select query to verify user email exists
    $query = "SELECT * FROM Users WHERE Email='$Email'; ";
    $result = mysqli_query($con, $query);
    if(!$result){
        $_SESSION["RegState"] = -9;
				$_SESSION["Message"] = "Select query to find user email failed: ".
					mysqli_error($con);
				echo json_encode($_SESSION);
				exit();
    }
    //print "Query worked! <br>";
	//Success, Email exists in database

    //Verify that query returns only one result.
	if (mysqli_num_rows($result) != 1) {
		$_SESSION["RegState"] = -10;
		$_SESSION["Message"] = "Email is not registered. Please try again.";
		echo json_encode($_SESSION);
		exit();
    }

    //Send an Email to redirect user and have the user set the new password.
	$Acode = rand(); // get a new activation code
	$query = "UPDATE Users SET Acode=$Acode WHERE Email='$Email'; ";
	//execute the query
	$result = mysqli_query($con, $query);
	//check for correctness
	if (!$result) {
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "Acode update query failed: ".
			mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	}
	//print "Query worked! <br>";

	//Build the PHPMailer object:
	$mail= new PHPMailer(true);
	try {
		$mail->SMTPDebug = 0; // 2: Wants to see all errors
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
		$msg = "Please click the <a href='http://tec2.hpc.temple.edu/~tug01026/4398/Project/php/authenticate.php?Acode=$Acode&Email=$Email'>link</a> to reset your password.";
		$mail->addAddress($Email,"$FirstName $LastName");
		$mail->Subject = "TimeCapsule Password Reset";
		$mail->Body = $msg;
		$mail->send();
		//print "Email sent ... <br>";
		$_SESSION["RegState"] = 8;
		$_SESSION["Message"] = "Please check your email to continue resetting your password.";
		echo json_encode($_SESSION);
		exit();
	} catch (phpmailerException $e) {
		$_SESSION["Message"] = "Mailer error: ".$e->errorMessage();
		$_SESSION["RegState"] = -11;
		//print "Reset password email send failed: ".$e->errorMessage;
		echo json_encode($_SESSION);
		exit();
    }
?>

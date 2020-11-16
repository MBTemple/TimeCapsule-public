<?php
	//session_start();
  //ini_set('display_errors', 1);
  //ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
  session_start();
  require_once("config.php");
  $address = $_POST['address'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $imageDate = $_POST['image-date'];
  $longitude = $_POST['longitude'];
  $latitude = $_POST['latitude'];
  // $myImage = $_POST['my-image']; // Follow the tutorial on w3c school

  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["#my-image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["my-image"]["tmp_name"]);
      if($check !== false) {
          $_SESSION["Message"] = "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          $_SESSION["Message"] = "File is not an image.";
        //  echo json_encode($_SESSION);
        //  exit();
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      $_SESSION["Message"] = "Sorry, file already exists [".$target_file."].";
    //  echo json_encode($_SESSION);
    //  exit();
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["my-image"]["size"] > 500000) {
      $_SESSION["Message"] =  "Sorry, your file is too large.";
    //  echo json_encode($_SESSION);
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      $_SESSION["Message"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //  echo json_encode($_SESSION);
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      $_SESSION["Message"] = "Sorry, your file was not uploaded.";
    //  echo json_encode($_SESSION);
    //  exit();
  // if everything is ok, try to upload file
  }
  if (move_uploaded_file($_FILES["my-image"]["tmp_name"], $target_file)) {
        $_SESSION["Message"] = "The file ". basename( $_FILES["my-image"]["name"]). " has been uploaded.";
  } else {
        $_SESSION["Message"] = "Sorry, there was an error uploading your file.";
    //    echo json_encode($_SESSION);
  //      exit();
  }
  //print "webdata ($address) ($title) ($description) ($imageDate) ($longitude) ($latitude) <br>";
  $filePath = basename( $_FILES["my-image"]["name"]);
  if ((!empty($address)) && (!empty($title)) && (!empty($description))
    && (!empty($imageDate)) && (!empty($longitude)) && (!empty($latitude)) ) {
          // Create connection
          //print "Before database connection <br>";
          $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
          if (!$con){
            $_SESSION["RegState"] = -1;
            $_SESSION["Message"] = "database connection failed: ".mysqli_error($con);
            print "connection failure:".mysqli_error($con);
            echo json_encode($_SESSION);
            exit();
          }
          $timeSubmit = date("Y-d-m h:i:s");
          $query = "INSERT INTO markers (address, title, description, imageDate, longitude, latitude, ".
            "timeSubmitted, imagePath)".
            " values ('$address', '$title', '$description', '$imageDate', '$longitude', '$latitude',".
            "'$timeSubmit', '$filePath')";
          $result = mysqli_query($con, $query);
          if (!$result) {
            $_SESSION["RegState"] = -2;
            $_SESSION["Message"] = "Insert marker query failed: ".mysqli_error($con);
            print "Insert marker query failure:".mysqli_error($con);
            echo json_encode($_SESSION);
            exit();
          }
          $_SESSION["Message"] = "New record is inserted sucessfully";
          echo json_encode($_SESSION);
          exit();
    }
    echo "Empty web data??? ";
    exit();
?>

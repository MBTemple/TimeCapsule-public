<?php
	session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ERROR | TimeCapsule</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/ionicons.min.css">
    <link rel="stylesheet" href="fonts/line-awesome.min.css">
    <link rel="stylesheet" href="fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="css/Login-Form-Dark.css">
    <link rel="stylesheet" href="css/Profile-Card.css">
    <link rel="stylesheet" href="css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="css/smoothproducts.css">
    <link rel="stylesheet" href="css/Social-Icons.css">
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
	<link rel="manifest" href="images/favicon/site.webmanifest">
	<link rel="mask-icon" href="images/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar" style="background-image: url(images/materialDark2.webp);">
        <div class="container"><a class="navbar-brand logo" href="index.html" style="color: #fff;font-weight: 700;">TimeCapsule</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-2">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="features.html" style="color: white;">Features</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="about-us.html" style="color: white;">About Us</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="loginForm.html" style="color: white;">Login</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="registerForm.html" style="color: white;">Register</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <div class="login-dark" style="background-image: url(images/material.webp);">
        <form>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
						<h6 class="text-center">Error Form</h6>
	    <div id="Message" class="btn btn-primary btn-block">
		<?php
			echo $_SESSION["Message"];
			$_SESSION["Message"] = "";
			$_SESSION["RegState"] = 0;
		?>
	    </div>
            <div class="nav-item text-center" role="presentation">
          	<a class="text-center" href="index.html" style="color: white;">
            		Home
          	</a>
            </div>
	</form>
    </div>
      <footer class="page-footer dark" style="padding: 1px; position: absolute; width: 100%">
         <div class="footer-copyright">
            <p>© 2020 TimeCapsule</p>
         </div>
      </footer>
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="js/smoothproducts.min.js"></script>
    <script src="js/theme.js"></script>
    <script src="js/Profile-Edit-Form.js"></script>
	<script src="js/final.js"></script>
</body>

</html>

<?php
   error_reporting(0); 
   session_start();
   $myjson->name="RegState";
   if (!isset($_SESSION["RegState"])) $_SESSION["RegState"] = 0;
      $myjson->value=$_SESSION["RegState"];
   echo json_encode($myjson);
   exit();
?>